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

class Ajax extends Admin_Controller
{
    public $ajax_controller = TRUE;

    public function save()
    {
        $this->load->model('quotes/mdl_quote_items');
        $this->load->model('quotes/mdl_quotes');
        $this->load->model('item_lookups/mdl_item_lookups');
        $this->load->library('encrypt');

        $quote_id = $this->input->post('quote_id');
        $delete_tax = $this->input->post('delete_tax');
        
        $this->mdl_quotes->set_id($quote_id);
        $rider = $this->input->post('rider');
        
        
        /*if($rider === ""){
            //dont fuckin save it
            $test = false;
            $this->session->setflashdata('alert_error', 'Enter riders name');
            return;
        }*/
        
        if ($this->mdl_quotes->run_validation('validation_rules_save_quote')) {
	$items = json_decode($this->input->post('items'));
if($this->input->post('rider')!==''){
			
				foreach ($items as $item) {
					if ($item->item_name) {
						$item->item_quantity = standardize_amount($item->item_quantity);
						$item->item_price = standardize_amount($item->item_price);
						$item->item_discount_amount = standardize_amount($item->item_discount_amount);

						$item_id = ($item->item_id) ?: NULL;

						$save_item_as_lookup = (isset($item->save_item_as_lookup)) ? $item->save_item_as_lookup : 0;

						unset($item->item_id, $item->save_item_as_lookup);

						$this->mdl_quote_items->save($quote_id, $item_id, $item);

						if ($save_item_as_lookup) {
							$db_array = array(
								'item_name' => $item->item_name,
								'item_description' => $item->item_description,
								'item_price' => $item->item_price
							);

							$this->mdl_item_lookups->save(NULL, $db_array);
						}
					}
				}

				if ($this->input->post('quote_discount_amount') === '') {
					$quote_discount_amount = floatval(0);
				} else {
					$quote_discount_amount = $this->input->post('quote_discount_amount');
				}

				if ($this->input->post('quote_discount_percent') === '') {
					$quote_discount_percent = floatval(0);
				} else {
					$quote_discount_percent = $this->input->post('quote_discount_percent');
				}
                                
                                if ($this->input->post('quote_other_expenses') === '') {
					$quote_other_expenses = floatval(0);
				} else {
					$quote_other_expenses = str_replace(',', '.',$this->input->post('quote_other_expenses'));
				}
                                
                                  if ($this->input->post('quote_material_length') === '') {
					$quote_material_length = floatval(0);
				} else {
					$quote_material_length = str_replace(',', '.',$this->input->post('quote_material_length'));
				}
				
				$quote_designer=$this->input->post('responsible_id');
				$quote_currency=$this->input->post('quote_currency');

				$db_array = array(
					'quote_number' => $this->input->post('quote_number'),
					'quote_date_created' => date_to_mysql($this->input->post('quote_date_created')),
					'quote_date_expires' => date_to_mysql($this->input->post('quote_date_expires')),
					'quote_status_id' => $this->input->post('quote_status_id'),
					'quote_password' => $this->input->post('quote_password'),
					'notes' => $this->input->post('notes'),
					'quote_discount_amount' => $quote_discount_amount,
					'quote_discount_percent' => $quote_discount_percent,
                                        'quote_other_expenses' => $quote_other_expenses,
					'quote_material_length' => $quote_material_length,
					'responsible_id'=> $quote_designer,
					'quote_currency'=>$quote_currency
				);

		 $this->mdl_quotes->save($quote_id, $db_array);
         if($delete_tax === 'true'){
            
        $this->load->model('mdl_quote_tax_rates');
        $quote_tax_rates = $this->mdl_quote_tax_rates->where('quote_id', $quote_id)->get()->result();
        foreach ($quote_tax_rates as $tax_rate){
        $tax_id = $tax_rate->quote_tax_rate_id;
        $this->mdl_quote_tax_rates->delete($tax_id);
        }
        $this->load->model('mdl_quote_amounts');
        $this->mdl_quote_amounts->calculate($quote_id);
            
        }
				 // Recalculate for discounts
				$this->load->model('quotes/mdl_quote_amounts');
				$this->mdl_quote_amounts->calculate($quote_id);

				$response = array(
					'success' => 1
				);
}else{
    //$this->session->set_flashdata('alert_success', 'Enter riders name');
	$response = array(
	'success' =>1
	);
}

						
        } else {
            $this->load->helper('json_error');
            $response = array(
                'success' => 0,
                'validation_errors' => json_errors()
            );
        }

        if ($this->input->post('custom')) {
            $db_array = array();

            foreach ($this->input->post('custom') as $custom) {
                // I hate myself for this...
                $db_array[str_replace(']', '', str_replace('custom[', '', $custom['name']))] = $custom['value'];
            }

            $this->load->model('custom_fields/mdl_quote_custom');
            $this->mdl_quote_custom->save_custom($quote_id, $db_array);
        }

        
        echo json_encode($response);
    }

    public function save_quote_tax_rate()
    {
        $this->load->model('quotes/mdl_quote_tax_rates');

        if ($this->mdl_quote_tax_rates->run_validation()) {
            $this->mdl_quote_tax_rates->save($this->input->post('quote_id'));

            $response = array(
                'success' => 1
            );
        } else {
            $response = array(
                'success' => 0,
                'validation_errors' => $this->mdl_quote_tax_rates->validation_errors
            );
        }

        echo json_encode($response);
    }

    public function create()
    {
        $this->load->model('quotes/mdl_quotes');
        
        
        if ($this->mdl_quotes->run_validation()) {
            $quote_id = $this->mdl_quotes->create();

            $response = array(
                'success' => 1,
                'quote_id' => $quote_id
            );
        } else {
            $this->load->helper('json_error');
            $response = array(
                'success' => 0,
                'validation_errors' => json_errors()
            );
        }

        echo json_encode($response);
    }

    public function modal_change_client()
    {
        $this->load->module('layout');
        $this->load->model('clients/mdl_clients');

        $data = array(
            'client_name' => $this->input->post('client_name'),
            'quote_id' => $this->input->post('quote_id'),
            'clients' => $this->mdl_clients->get()->result(),
        );

        $this->layout->load_view('quotes/modal_change_client', $data);
    }

    public function change_client()
    {
        $this->load->model('quotes/mdl_quotes');
        $this->load->model('clients/mdl_clients');

        // Get the client ID
        $client_name = $this->input->post('client_name');
        $client = $this->mdl_clients->where('client_name', $this->db->escape_str($client_name))
            ->get()->row();

        if (!empty($client)) {
            $client_id = $client->client_id;
            $quote_id = $this->input->post('quote_id');

            $db_array = array(
                'client_id' => $client_id,
            );
            $this->db->where('quote_id', $quote_id);
            $this->db->update('ip_quotes', $db_array);

            $response = array(
                'success' => 1,
                'quote_id' => $quote_id
            );
        } else {
            $this->load->helper('json_error');
            $response = array(
                'success' => 0,
                'validation_errors' => json_errors()
            );
        }

        echo json_encode($response);
    }

    public function get_item()
    {
        $this->load->model('quotes/mdl_quote_items');

        $item = $this->mdl_quote_items->get_by_id($this->input->post('item_id'));

        echo json_encode($item);
    }

    public function modal_create_quote()
    {
        $this->load->module('layout');

        $this->load->model('invoice_groups/mdl_invoice_groups');
        $this->load->model('tax_rates/mdl_tax_rates');
        $this->load->model('clients/mdl_clients');

        $data = array(
            'invoice_groups' => $this->mdl_invoice_groups->get()->result(),
            'tax_rates' => $this->mdl_tax_rates->get()->result(),
            'client_name' => $this->input->post('client_name'),
            'clients' => $this->mdl_clients->get()->result(),
        );

        $this->layout->load_view('quotes/modal_create_quote', $data);
    }

    public function modal_copy_quote()
    {
        $this->load->module('layout');

        $this->load->model('quotes/mdl_quotes');
        $this->load->model('invoice_groups/mdl_invoice_groups');
        $this->load->model('tax_rates/mdl_tax_rates');

        $data = array(
            'invoice_groups' => $this->mdl_invoice_groups->get()->result(),
            'tax_rates' => $this->mdl_tax_rates->get()->result(),
            'quote_id' => $this->input->post('quote_id'),
            'quote' => $this->mdl_quotes->where('ip_quotes.quote_id', $this->input->post('quote_id'))->get()->row()
        );

        $this->layout->load_view('quotes/modal_copy_quote', $data);
    }

    public function copy_quote()
    {
        $this->load->model('quotes/mdl_quotes');
        $this->load->model('quotes/mdl_quote_items');
        $this->load->model('quotes/mdl_quote_tax_rates');

        if ($this->mdl_quotes->run_validation()) {
            $target_id = $this->mdl_quotes->save();
            $source_id = $this->input->post('quote_id');

            $this->mdl_quotes->copy_quote($source_id, $target_id);

            $response = array(
                'success' => 1,
                'quote_id' => $target_id
            );
        } else {
            $this->load->helper('json_error');
            $response = array(
                'success' => 0,
                'validation_errors' => json_errors()
            );
        }

        echo json_encode($response);
    }

    public function modal_quote_to_invoice($quote_id)
    {
        $this->load->model('invoice_groups/mdl_invoice_groups');
        $this->load->model('quotes/mdl_quotes');

        $data = array(
            'invoice_groups' => $this->mdl_invoice_groups->get()->result(),
            'quote_id' => $quote_id,
            'quote' => $this->mdl_quotes->where('ip_quotes.quote_id', $quote_id)->get()->row()
        );

        $this->load->view('quotes/modal_quote_to_invoice', $data);
    }
    
    public function modal_quotes_to_invoices($quotes)
    {
        $this->load->model('invoice_groups/mdl_invoice_groups');
        $this->load->model('quotes/mdl_quotes');
        //make a list of quote ids
        $this->load->model('mdl_quote_items');
        $this->load->model('mdl_quote_amounts');
        $this->load->model('mdl_quotes');
        $quote_ids = explode("_", $quotes);
        $quote_list=array();
        $client_list=array();
        $amounts=array();
        $items = array();
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

        foreach($quote_ids as $quote_id){
            $this->db->where('quote_id',$quote_id);
            $this->db->from('ip_quote_amounts');
            array_push($amounts,$this->db->get()->row());
        }

        foreach($quote_ids as $quote_id){
            $this->db->where('quote_id',$quote_id);
            $this->db->from('ip_quote_items');
            array_push($items,$this->db->get()->row());
        }
        
        $data = array(
            'invoice_groups' => $this->mdl_invoice_groups->get()->result(),
            'clientlist' => $client_list,
            'quote_id' => $quote_list,
            'quote' => $this->mdl_quotes->where('ip_quotes.quote_id', $quote_list[0]->quote_id)->get()->row(),
            'quote_list' => $quote_list,
            'item_list'=>$items,
            'string_list' => $quotes,
            'amount_list' =>$amounts
            /*'clientlist'=>$client_list,
            'items'=>$items,
            'amounts'=>$amounts*/
        );

        $this->load->view('quotes/modal_quotes_to_invoices', $data);
    }
    
    

    public function quote_to_invoice()
    {
        $this->load->model(
            array(
                'invoices/mdl_invoices',
                'invoices/mdl_items',
                'quotes/mdl_quotes',
                'quotes/mdl_quote_items',
                'invoices/mdl_invoice_tax_rates',
                'quotes/mdl_quote_tax_rates'
            )
        );

        if ($this->mdl_invoices->run_validation()) {
           $quote = $this->mdl_quotes->get_by_id($this->input->post('quote_id'));
            $invoice_id = $this->mdl_invoices->create(null, false);
            // Update the discounts
            $this->db->where('invoice_id', $invoice_id);
            $this->db->set('invoice_discount_amount', $quote->quote_discount_amount);
            $this->db->set('invoice_discount_percent', $quote->quote_discount_percent);
            $this->db->update('ip_invoices');
            // Save the invoice id to the quote
            $this->db->where('quote_id', $this->input->post('quote_id'));
            $this->db->set('invoice_id', $invoice_id);
            $this->db->update('ip_quotes');
            $quote_items = $this->mdl_quote_items->where('quote_id', $this->input->post('quote_id'))->get()->result();

          
           
            foreach ($quote_items as $quote_item) {
                $db_array = array(
                    'invoice_id' => $invoice_id,
                    'item_tax_rate_id' => $quote_item->item_tax_rate_id,
                    'item_name' => $quote_item->item_name,
                    'item_description' => $quote_item->item_description,
                    'item_quantity' => $quote_item->item_quantity,
                    'item_price' => $quote_item->item_price,
                    'item_order' => $quote_item->item_order
                );

                $this->mdl_items->save($invoice_id, NULL, $db_array);
            }
			//$this->mdl_invoices->set_notes($invoice_id, $this->input->post('quote_number'));
			$this->mdl_invoices->set_currency($invoice_id, $this->input->post('currency'));
            $quote_tax_rates = $this->mdl_quote_tax_rates->where('quote_id', $this->input->post('quote_id'))->get()->result();
			
            foreach ($quote_tax_rates as $quote_tax_rate) {
                $db_array = array(
                    'invoice_id' => $invoice_id,
                    'tax_rate_id' => $quote_tax_rate->tax_rate_id,
                    'include_item_tax' => $quote_tax_rate->include_item_tax,
                    'invoice_tax_rate_amount' => $quote_tax_rate->quote_tax_rate_amount
                );

                $this->mdl_invoice_tax_rates->save($invoice_id, NULL, $db_array);
            }

            $response = array(
                'success' => 1,
                'invoice_id' => $invoice_id
            );
        } else {
            $this->load->helper('json_error');
            $response = array(
                'success' => 0,
                'validation_errors' => json_errors()
            );
        }

        echo json_encode($response);
    }
    
    
    public function quotes_to_invoices()
    {
        $this->load->model(
            array(
                'invoices/mdl_invoices',
                'invoices/mdl_items',
                'quotes/mdl_quotes',
                'quotes/mdl_quote_items',
                'invoices/mdl_invoice_tax_rates',
                'quotes/mdl_quote_tax_rates'
            )
        );

        if ($this->mdl_invoices->run_validation()) {
            $invoice_id = $this->mdl_invoices->create(NULL, FALSE);
  
            $quotes = $this->input->post('string_list');
            
            $quote_list = explode("_", $quotes);
            foreach ($quote_list as $quote_id) {
            $this->db->where('quote_id', $quote_id);
            $this->db->set('invoice_id', $invoice_id);
            $this->db->update('ip_quotes');
            }

            
            foreach ($quote_list as $quote_id) {
            
            $quote_items = $this->mdl_quote_items->where('quote_id', $quote_id)->get()->result();

            foreach ($quote_items as $quote_item) {
                $db_array = array(
                    'invoice_id' => $invoice_id,
                    'item_tax_rate_id' => $quote_item->item_tax_rate_id,
                    'item_name' => $quote_item->item_name,
                    'item_description' => $quote_item->item_description,
                    'item_quantity' => $quote_item->item_quantity,
                    'item_price' => $quote_item->item_price,
                    'item_order' => $quote_item->item_order
                );

                $this->mdl_items->save($invoice_id, NULL, $db_array);
            }
            
			//$this->mdl_invoices->set_notes($invoice_id, $this->input->post('quote_number'));
            }
            $quote_tax_rates = $this->mdl_quote_tax_rates->where('quote_id', $this->input->post('quote_id'))->get()->result();
			
            foreach ($quote_tax_rates as $quote_tax_rate) {
                $db_array = array(
                    'invoice_id' => $invoice_id,
                    'tax_rate_id' => $quote_tax_rate->tax_rate_id,
                    'include_item_tax' => $quote_tax_rate->include_item_tax,
                    'invoice_tax_rate_amount' => $quote_tax_rate->quote_tax_rate_amount
                );

                $this->mdl_invoice_tax_rates->save($invoice_id, NULL, $db_array);
            }
            

            $response = array(
                'success' => 1,
                'invoice_id' => $invoice_id
            );
        } else {
            $this->load->helper('json_error');
            $response = array(
                'success' => 0,
                'validation_errors' => json_errors()
            );
        }

        echo json_encode($response);
    }
    
     public function save_quote_note()
    {
        $this->load->model('quotes/mdl_quote_notes');
        $quote_id = $this->input->post('quote_id');
        $quote_note = $this->input->post('quote_note');
        $user = $this->session->userdata('user_name');
        $this->mdl_quote_notes->save_note($quote_note, $quote_id, $user);
        
        $response = array(
                'success' => 1
            );

        echo json_encode($response);

    }
        
    public function load_quote_notes()
    {
        $this->load->model('quotes/mdl_quote_notes');
        $query = $this->mdl_quote_notes->get_notes($this->input->post('quote_id'));
       
        
        
        
        
        $data = array(
            'quote_notes' => $query
            //'quote_notes' => $this->mdl_quote_notes->where('quote_id', $this->input->post('quote_id'))->get()->result()
        );

        $this->layout->load_view('quotes/partial_notes', $data);
    }
    

}
