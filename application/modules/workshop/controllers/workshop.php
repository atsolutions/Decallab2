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

class Workshop extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('quotes/mdl_quotes');
    }

    public function index()
    {
        // Display all quotes by default
 redirect('workshop/status/all');
			
    }

    public function status($status = 'all', $page = 0)
    {
	$this->load->model('quotes/mdl_quote_items');
        $this->load->model('tax_rates/mdl_tax_rates');
        $this->load->model('quotes/mdl_quote_tax_rates');
        $this->load->model('custom_fields/mdl_custom_fields');
        $this->load->model('custom_fields/mdl_quote_custom');
        $this->load->library('encrypt');
		
        // Determine which group of quotes to load
        $this->mdl_quotes->is_workshop();

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

        $this->layout->buffer('content', 'workshop/index');
        $this->layout->render();
    }
    
    public function mark_printed($id){
        $this->mdl_quotes->mark_printed($id);
        redirect('workshop/status/all');
    }
    
        public function mark_packed($id){
        $this->mdl_quotes->mark_packed($id);
        redirect('workshop/status/all');
    }
    
        public function mark_shipped($id){
        $this->mdl_quotes->mark_shipped($id);
        redirect('workshop/status/all');
    }

}
