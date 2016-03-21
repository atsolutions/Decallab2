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

class Mdl_Client_Notes extends Response_Model
{
    public $table = 'ip_quote_notes';
    public $primary_key = 'ip_quote_notes.note_id';

    public function default_order_by()
    {
        $this->db->order_by('ip_quote_notes.note_date DESC');
    }

    public function validation_rules()
    {
        return array(
            'quote_id' => array(
                'field' => 'quote_id',
                'label' => lang('quote'),
                'rules' => 'required'
            ),
            'quote_note' => array(
                'field' => 'quote_note',
                'label' => lang('quote'),
                'rules' => 'required'
            )
        );
    }

    public function db_array()
    {
        $db_array = parent::db_array();

        $db_array['note_date'] = date('Y-m-d');

        return $db_array;
    }

}
