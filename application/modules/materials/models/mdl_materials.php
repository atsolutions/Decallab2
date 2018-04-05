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

class Mdl_Materials extends Response_Model
{
    public $table = 'ip_materials';
    public $primary_key = 'ip_materials.material_id';

    public function default_select()
    {
        $this->db->select('SQL_CALC_FOUND_ROWS *', FALSE);
    }

    public function default_order_by()
    {
        $this->db->order_by('ip_materials.material_id');
    }


    public function validation_rules()
    {
        return array(
            'material_name' => array(
                'field' => 'material_name',
                'label' => 'Material name',
                'rules' => 'required'
            ),
             'material_description' => array(
                'field' => 'material_description',
                'label' => 'Material description',
            ),
             'material_price' => array(
                'field' => 'material_price',
                'label' => 'Material price',
            ),
            'material_quantity' => array(
                'field' => 'material_quantity',
                'label' => 'Material quantity',
            ),
        );
    }

}
