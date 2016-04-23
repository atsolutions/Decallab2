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

class Dashboard extends Admin_Controller
{
    public function index()
    {
		$this->load->model('invoices/mdl_invoice_amounts');
        $this->load->model('quotes/mdl_quote_amounts');
        $this->load->model('invoices/mdl_invoices');
        $this->load->model('quotes/mdl_quotes');
		
        $quote_overview_period = $this->mdl_settings->setting('quote_overview_period');
        $invoice_overview_period = $this->mdl_settings->setting('invoice_overview_period');
		$this->db->where('action_date <=', date('Y-m-d'));

		$this->db->order_by('id','desc');
		$query = $this->db->get('ip_actions', 20,0)->result();
        $this->layout->set(
            array(
                'invoice_status_totals' => $this->mdl_invoice_amounts->get_status_totals($invoice_overview_period),
                'quote_status_totals' => $this->mdl_quote_amounts->get_status_totals($quote_overview_period),
                'invoice_status_period' => str_replace('-', '_', $invoice_overview_period),
                'quote_status_period' => str_replace('-', '_', $quote_overview_period),
                'invoices' => $this->mdl_invoices->limit(100)->get()->result(),
                'quotes' => $this->mdl_quotes->limit(100)->get()->result(),
				'quotelist' => $this->db->get('ip_quotes')->result(),
				'userlist' => $this->db->get('ip_users')->result(),
                'invoice_statuses' => $this->mdl_invoices->statuses(),
                'quote_statuses' => $this->mdl_quotes->statuses(),
                'overdue_invoices' => $this->mdl_invoices->is_overdue()->limit(20)->get()->result(),
				'activities' => $query
            )
        );

        $this->layout->buffer('content', 'dashboard/index');
        $this->layout->render('layout');
    }

}
