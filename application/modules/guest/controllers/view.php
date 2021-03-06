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

class View extends Base_Controller
{
    public function invoice($invoice_url_key)
    {
        $this->load->model('invoices/mdl_invoices');

        $invoice = $this->mdl_invoices->guest_visible()->where('invoice_url_key', $invoice_url_key)->get();

        if ($invoice->num_rows() == 1) {
            $this->load->model('invoices/mdl_items');
            $this->load->model('invoices/mdl_invoice_tax_rates');
            $this->load->model('payment_methods/mdl_payment_methods');

            $invoice = $invoice->row();

            if ($this->session->userdata('user_type') <> 1 and $invoice->invoice_status_id == 2) {
                $this->mdl_invoices->mark_viewed($invoice->invoice_id);
            }

            $payment_method = $this->mdl_payment_methods->where('payment_method_id', $invoice->payment_method)->get()->row();
            if ($invoice->payment_method == 0) $payment_method = NULL;

            $data = array(
                'invoice' => $invoice,
                'items' => $this->mdl_items->where('invoice_id', $invoice->invoice_id)->get()->result(),
                'invoice_tax_rates' => $this->mdl_invoice_tax_rates->where('invoice_id', $invoice->invoice_id)->get()->result(),
                'invoice_url_key' => $invoice_url_key,
                'flash_message' => $this->session->flashdata('flash_message'),
                'payment_method' => $payment_method
            );

            $this->load->view('invoice_templates/public/' . $this->mdl_settings->setting('public_invoice_template') . '.php', $data);
        }
    }

    public function generate_invoice_pdf($invoice_url_key, $stream = TRUE, $invoice_template = NULL)
    {
        $this->load->model('invoices/mdl_invoices');

        $invoice = $this->mdl_invoices->guest_visible()->where('invoice_url_key', $invoice_url_key)->get();

        if ($invoice->num_rows() == 1) {
            $invoice = $invoice->row();

            if (!$invoice_template) {
                $invoice_template = $this->mdl_settings->setting('pdf_invoice_template');
            }

            $this->load->helper('pdf');

            generate_invoice_pdf($invoice->invoice_id, $stream, $invoice_template, 1);
        }
    }

    public function quote($quote_url_key)
    {
       // header("Location: http://crm.decallab.eu/guest/view/quote/" . $quote_url_key);
        $this->load->model('quotes/mdl_quotes');
		
		
		$quote = $this->mdl_quotes->guest_visible()->where('quote_url_key', $quote_url_key)->get();
		
		
		if ($quote->num_rows() == 1) {
            $this->load->model('quotes/mdl_quote_items');
            $this->load->model('quotes/mdl_quote_tax_rates');


            $quote = $quote->row();

            if ($this->session->userdata('user_type') <> 1 and $quote->quote_status_id == 2) {
                $this->mdl_quotes->mark_viewed($quote->quote_id);
            }

            $data = array(
                'quote' => $quote,
                'items' => $this->mdl_quote_items->where('quote_id', $quote->quote_id)->get()->result(),
                'quote_tax_rates' => $this->mdl_quote_tax_rates->where('quote_id', $quote->quote_id)->get()->result(),
                'quote_url_key' => $quote_url_key,
	
                'flash_message' => $this->session->flashdata('flash_message')
            );
}
switch($quote->quote_status_id){
	case 2:
	$this->load->view('quote_templates/public/Sent.php', $data);
	break;
	case 3:
	$this->load->view('quote_templates/public/Sent.php', $data);
	break;
	case 4:
	$this->load->view('quote_templates/public/Approved.php', $data);
	break;
	case 5:
	$this->load->view('quote_templates/public/rejected.php', $data);
	break;
	case 7:
	$this->load->view('quote_templates/public/designer.php', $data);
	break;
	case 8:
	$this->load->view('quote_templates/public/Invoiced.php', $data);
	break;
	
}

}


    public function generate_quote_pdf($quote_url_key, $stream = TRUE, $quote_template = NULL)
    {
        $this->load->model('quotes/mdl_quotes');

        $quote = $this->mdl_quotes->guest_visible()->where('quote_url_key', $quote_url_key)->get();

        if ($quote->num_rows() == 1) {
            $quote = $quote->row();

            if (!$quote_template) {
                $quote_template = $this->mdl_settings->setting('pdf_quote_template');
            }

            $this->load->helper('pdf');

            generate_quote_pdf($quote->quote_id, $stream, $quote_template);
        }
    }

    public function approve_quote($quote_url_key, $quote_id)
    {
		$this->load->model('quotes/mdl_quotes');
        $this->load->helper('mailer');
		$quote = $this->mdl_quotes->guest_visible()->where('quote_url_key', $quote_url_key)->get();
        $this->mdl_quotes->approve_quote_by_key($quote_url_key, $quote_id);
        //email_quote_status($this->mdl_quotes->where('ip_quotes.quote_url_key', $quote_url_key)->get()->row()->quote_id, "approved");
		
        redirect('guest/view/quote/' . $quote_url_key);
    }

    public function reject_quote($quote_url_key, $quote_id)
    {
        $this->load->model('quotes/mdl_quotes');
        $this->load->helper('mailer');

        $this->mdl_quotes->reject_quote_by_key($quote_url_key, $quote_id);
        //email_quote_status($this->mdl_quotes->where('ip_quotes.quote_url_key', $quote_url_key)->get()->row()->quote_id, "rejected");

        redirect('guest/view/quote/' . $quote_url_key);
    }

}
