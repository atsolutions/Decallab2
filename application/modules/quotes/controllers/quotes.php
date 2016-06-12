<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * InvoicePlane
 * 
 * A free and open source web based invoicing system
 *
 * @package		InvoicePlane
 * @author		Kovah (www.kovah.de)
 * @copyright	Copyright (c) 2012 - 2015 InvoicePlane.com
 * @license		https://invoiceplane.com/license.txt
 * @link		https://invoiceplane.com
 * 
 */

class Quotes extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('mdl_quotes');
    }

    public function index()
    {
        // Display all quotes by default
		if($this->session->userdata('user_subtype')!=1){
        redirect('quotes/status/all');
		}else{
			redirect('quotes/status/draft');
			
		}
		
		
    }

    public function status($status = 'all', $page = 0, $designer_id=0)
    {
		$this->load->model('mdl_quote_items');
        $this->load->model('tax_rates/mdl_tax_rates');
        $this->load->model('mdl_quote_tax_rates');
        $this->load->model('custom_fields/mdl_custom_fields');
        $this->load->model('custom_fields/mdl_quote_custom');
        $this->load->library('encrypt');
		
if($designer_id !=0){
	 $this->mdl_quotes->by_designer($designer_id);
	
}
        // Determine which group of quotes to load
        switch ($status) {
            case 'draft':
                $this->mdl_quotes->is_draft();
                break;
			case 'designer':
                $this->mdl_quotes->is_designer();
                break;
            case 'sent':
                $this->mdl_quotes->is_sent();
                break;
            case 'viewed':
                $this->mdl_quotes->is_viewed();
                break;
            case 'approved':
                $this->mdl_quotes->is_approved();
                break;
            case 'rejected':
                $this->mdl_quotes->is_rejected();
                break;
            case 'canceled':
                $this->mdl_quotes->is_canceled();
                break;
			case 'invoiced':
				$this->mdl_quotes->is_invoiced();
				break;
			case 'myquotes':
				$this->mdl_quotes->is_my();
				break;
			
        }

        $this->mdl_quotes->paginate(site_url('quotes/status/' . $status), $page);
        $quotes = $this->mdl_quotes->result();

        $this->layout->set(
            array(
                'quotes' => $quotes,
                'status' => $status,
				'userlist' => $this->db->get('ip_users')->result(),
                'filter_display' => TRUE,
                'filter_placeholder' => lang('filter_quotes'),
                'filter_method' => 'filter_quotes',
                'quote_statuses' => $this->mdl_quotes->statuses(),
				'custom_fields' => $this->mdl_custom_fields->by_table('ip_quote_custom')->get()->result()
            )
        );

        $this->layout->buffer('content', 'quotes/index');
        $this->layout->render();
    }

    public function view($quote_id)
    {
        $this->load->model('mdl_quote_items');
        $this->load->model('tax_rates/mdl_tax_rates');
        $this->load->model('mdl_quote_tax_rates');
        $this->load->model('custom_fields/mdl_custom_fields');
        $this->load->model('custom_fields/mdl_quote_custom');
        $this->load->library('encrypt');
	

        $quote_custom = $this->mdl_quote_custom->where('quote_id', $quote_id)->get();

        if ($quote_custom->num_rows()) {
            $quote_custom = $quote_custom->row();

            unset($quote_custom->quote_id, $quote_custom->quote_custom_id);

            foreach ($quote_custom as $key => $val) {
                $this->mdl_quotes->set_form_value('custom[' . $key . ']', $val);
            }
        }

        $quote = $this->mdl_quotes->get_by_id($quote_id);


        if (!$quote) {
            show_404();
        }


        $this->layout->set(
            array(
                'quote' => $quote,
                'items'=>$items,
				'items' => $this->mdl_quote_items->where('quote_id', $quote_id)->get()->result(),
                'quote_id' => $quote_id,
				'userlist' => $this->db->get('ip_users')->result(),
                'tax_rates' => $this->mdl_tax_rates->get()->result(),
                'quote_tax_rates' => $this->mdl_quote_tax_rates->where('quote_id', $quote_id)->get()->result(),
                'custom_fields' => $this->mdl_custom_fields->by_table('ip_quote_custom')->get()->result(),
                'custom_js_vars' => array(
                    'currency_symbol' => $this->mdl_settings->setting('currency_symbol'),
                    'currency_symbol_placement' => $this->mdl_settings->setting('currency_symbol_placement'),
                    'decimal_point' => $this->mdl_settings->setting('decimal_point')
                ),
                'quote_statuses' => $this->mdl_quotes->statuses(),
            )
        );

        $this->layout->buffer(
            array(
                array('modal_delete_quote', 'quotes/modal_delete_quote'),
                array('modal_add_quote_tax', 'quotes/modal_add_quote_tax'),
                array('content', 'quotes/view')
            )
        );

        $this->layout->render();
    }

    public function delete($quote_id)
    {
        // Delete the quote
        $this->mdl_quotes->delete($quote_id);

        // Redirect to quote index
        redirect('quotes/index');
    }

    public function delete_item($quote_id, $item_id)
    {
        // Delete quote item
        $this->load->model('mdl_quote_items');
        $this->mdl_quote_items->delete($item_id);

        // Redirect to quote view
        redirect('quotes/view/' . $quote_id);
    }

    public function generate_pdf($quote_id, $stream = TRUE, $quote_template = NULL)
    {
        $this->load->helper('pdf');

        if ($this->mdl_settings->setting('mark_quotes_sent_pdf') == 1) {
            $this->mdl_quotes->mark_sent($quote_id);
        }

        generate_quote_pdf($quote_id, $stream, $quote_template);
    }
	
	    public function generate_multiple($quote_array, $stream = TRUE, $quote_template = NULL)
    {
        /*$this->load->helper('pdf');

        if ($this->mdl_settings->setting('mark_quotes_sent_pdf') == 1) {
            $this->mdl_quotes->mark_sent($quote_id);
        }

        generate_quote_pdf($quote_id, $stream, $quote_template);*/
    }
	

    public function delete_quote_tax($quote_id, $quote_tax_rate_id)
    {
        $this->load->model('mdl_quote_tax_rates');
        $this->mdl_quote_tax_rates->delete($quote_tax_rate_id);

        $this->load->model('mdl_quote_amounts');
        $this->mdl_quote_amounts->calculate($quote_id);

        redirect('quotes/view/' . $quote_id);
    }

    public function recalculate_all_quotes()
    {
        $this->db->select('quote_id');
        $quote_ids = $this->db->get('ip_quotes')->result();

        $this->load->model('mdl_quote_amounts');

        foreach ($quote_ids as $quote_id) {
            $this->mdl_quote_amounts->calculate($quote_id->quote_id);
        }
    }
	
	    public function quotes_to_invoice($quotes)
    {
$this->load->model('mdl_quote_items');
$this->load->model('mdl_quotes');
$quote_ids = explode("_", $quotes);
$quote_list=array();
$client_list=array();
foreach($quote_ids as $quote_id){
$this->db->where('quote_id',$quote_id);
$this->db->from('ip_quotes');
array_push($quote_list,$this->db->get()->row());
}
foreach($quote_list as $quote){
$this->db->where('client_id',$quote->client_id);
$this->db->from('ip_clients');
array_push($client_list,$this->db->get()->row());
}








		$this->layout->set(
			array(
			'quote_list' => $quote_list,
			'clientlist' => $client_list,
			)
		);
        $this->layout->buffer('content', 'quotes/quotes_to_invoice');
        $this->layout->render();
    }
	

}
