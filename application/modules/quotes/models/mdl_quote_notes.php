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

class Mdl_Quote_notes extends Response_Model
{
    public $table = 'ip_quote_notes';
    public $primary_key = 'ip_quote_notes.note_id';

    public function default_order_by()
    {
        $this->db->order_by('ip_quote_notes.note_date ASC');
    }

    public function validation_rules()
    {
        return array(
            'quote_id' => array(
                'field' => 'quote_id',
                'label' => lang('quote')
            ),
            'quote_note' => array(
                'field' => 'quote_note',
                'label' => lang('quote')

            )
        );
    }

    public function db_array()
    {
        $db_array = parent::db_array();

        $db_array['note_date'] = date('Y-m-d');

        return $db_array;
    }
    
    public function save_note($note, $id, $author = "System") {
        $data = array(
            'note' =>$note,
            'quote_id'=>$id,
            'note_date' => date('Y-m-d H:i:s'),
            'note_author' => $author
        );
            $this->db->insert('ip_quote_notes', $data);
        
    }
    
    public function get_notes($quote_id){
        
        $result = $this->db->order_by('note_date', 'DESC')->get_where('ip_quote_notes', array('quote_id'=>$quote_id))->result();
        return $result;

    }

}
