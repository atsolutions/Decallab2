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

class Mdl_Users extends Response_Model
{
    public $table = 'ip_users';
    public $primary_key = 'ip_users.user_id';
    public $date_created_field = 'user_date_created';
    public $date_modified_field = 'user_date_modified';

    public function user_types()
    {
        return array(
            '1' => lang('administrator'),
            '2' => lang('guest_read_only'),
			'3' => 'Designer'
        );
    }

    public function default_select()
    {
        $this->db->select('SQL_CALC_FOUND_ROWS ip_user_custom.*, ip_users.*', FALSE);
    }

    public function default_join()
    {
        $this->db->join('ip_user_custom', 'ip_user_custom.user_id = ip_users.user_id', 'left');
    }

    public function default_order_by()
    {
        $this->db->order_by('ip_users.user_name');
    }

    public function validation_rules()
    {
        return array(
            'user_type' => array(
                'field' => 'user_type',
                'label' => lang('user_type'),
                'rules' => 'required'
            ),
            'user_email' => array(
                'field' => 'user_email',
                'label' => lang('email'),
                'rules' => 'required|valid_email|is_unique[ip_users.user_email]'
            ),
            'user_name' => array(
                'field' => 'user_name',
                'label' => lang('name'),
                'rules' => 'required'
            ),
            'user_password' => array(
                'field' => 'user_password',
                'label' => lang('password'),
                'rules' => 'required|min_length[8]'
            ),
            'user_passwordv' => array(
                'field' => 'user_passwordv',
                'label' => lang('verify_password'),
                'rules' => 'required|matches[user_password]'
            ),
            'user_company' => array(
                'field' => 'user_company'
            ),
            'user_address_1' => array(
                'field' => 'user_address_1'
            ),
            'user_address_2' => array(
                'field' => 'user_address_2'
            ),
            'user_city' => array(
                'field' => 'user_city'
            ),
            'user_state' => array(
                'field' => 'user_state'
            ),
            'user_zip' => array(
                'field' => 'user_zip'
            ),
            'user_country' => array(
                'field' => 'user_country',
                'label' => lang('country'),
            ),
            'user_phone' => array(
                'field' => 'user_phone'
            ),
            'user_fax' => array(
                'field' => 'user_fax'
            ),
            'user_mobile' => array(
                'field' => 'user_mobile'
            ),
            'user_web' => array(
                'field' => 'user_web'
            ),
            'user_vat_id' => array(
                'field' => 'user_vat_id'
            ),
            'user_tax_code' => array(
                'field' => 'user_tax_code'
            )
        );
    }

    public function validation_rules_existing()
    {
        return array(
            'user_type' => array(
                'field' => 'user_type',
                'label' => lang('user_type'),
                'rules' => 'required'
            ),
            'user_email' => array(
                'field' => 'user_email',
                'label' => lang('email'),
                'rules' => 'required|valid_email'
            ),
            'user_name' => array(
                'field' => 'user_name',
                'label' => lang('name'),
                'rules' => 'required'
            ),
            'user_company' => array(
                'field' => 'user_company'
            ),
            'user_address_1' => array(
                'field' => 'user_address_1'
            ),
            'user_address_2' => array(
                'field' => 'user_address_2'
            ),
            'user_city' => array(
                'field' => 'user_city'
            ),
            'user_state' => array(
                'field' => 'user_state'
            ),
            'user_zip' => array(
                'field' => 'user_zip'
            ),
            'user_country' => array(
                'field' => 'user_country',
                'label' => lang('country'),
                'rules' => 'required'
            ),
            'user_phone' => array(
                'field' => 'user_phone'
            ),
            'user_fax' => array(
                'field' => 'user_fax'
            ),
            'user_mobile' => array(
                'field' => 'user_mobile'
            ),
            'user_web' => array(
                'field' => 'user_web'
            ),
            'user_vat_id' => array(
                'field' => 'user_vat_id'
            ),
            'user_tax_code' => array(
                'field' => 'user_tax_code'
            )
        );
    }

    public function validation_rules_change_password()
    {
        return array(
            'user_password' => array(
                'field' => 'user_password',
                'label' => lang('password'),
                'rules' => 'required'
            ),
            'user_passwordv' => array(
                'field' => 'user_passwordv',
                'label' => lang('verify_password'),
                'rules' => 'required|matches[user_password]'
            )
        );
    }

    public function db_array()
    {
        $db_array = parent::db_array();

        if (isset($db_array['user_password'])) {
            unset($db_array['user_passwordv']);

            $this->load->library('crypt');

            $user_psalt = $this->crypt->salt();

            $db_array['user_psalt'] = $user_psalt;
            $db_array['user_password'] = $this->crypt->generate_password($db_array['user_password'], $user_psalt);
        }

        return $db_array;
    }

    public function save_change_password($user_id, $password)
    {
        $this->load->library('crypt');

        $user_psalt = $this->crypt->salt();
        $user_password = $this->crypt->generate_password($password, $user_psalt);

        $db_array = array(
            'user_psalt' => $user_psalt,
            'user_password' => $user_password
        );

        $this->db->where('user_id', $user_id);
        $this->db->update('ip_users', $db_array);

        $this->session->set_flashdata('alert_success', 'Password Successfully Changed');
    }

    public function save($id = NULL, $db_array = NULL)
    {
        $id = parent::save($id, $db_array);

        if ($user_clients = $this->session->userdata('user_clients')) {
            $this->load->model('users/mdl_user_clients');

            foreach ($user_clients as $user_client) {
                $this->mdl_user_clients->save(NULL, array('user_id' => $id, 'client_id' => $user_client));
            }

            $this->session->unset_userdata('user_clients');
        }

        return $id;
    }

    public function delete($id)
    {
        parent::delete($id);

        $this->load->helper('orphan');
        delete_orphans();
    }
    
    public function get_current($id){
        
 $today = date('Y-n-j', strtotime('today'));
 $prevMonthStart = date('Y-n-j', strtotime('first day of this month'));
        $prevMonthEnd = $today;
       
        
$this->db->select('invoice_group_name, invoice_group_id');
$this->db->from('ip_invoice_groups');
$invoice_groups = $this->db->get()->result();
$this->db->select('user_name, user_id');
$this->db->where('user_id',$id);
$this->db->from('ip_users');
$users = $this->db->get()->result();

$user_data = array();
$user_info = array();

         foreach ($invoice_groups as $invoice_group) {
        
$this->db->select('ip_quotes.quote_id, ip_quotes.invoice_group_id, ip_quotes.user_id, ip_quotes.responsible_id, ip_quotes.quote_currency,'
        . 'ip_quotes.quote_number, ip_quotes.quote_date_printed,'
        . 'ip_quote_amounts.quote_item_subtotal');
$this->db->where('quote_date_printed >=', $prevMonthStart );
$this->db->where('quote_date_printed <=', $prevMonthEnd );
$this->db->where('quote_currency', 'EUR' );
$this->db->where('invoice_group_id', $invoice_group->invoice_group_id);
$this->db->where('responsible_id', $id);
$this->db->join('ip_quote_amounts', 'ip_quote_amounts.quote_id = ip_quotes.quote_id');
$this->db->from('ip_quotes');
$quotes_EUR = $this->db->get()->result();


$this->db->select('ip_quotes.quote_id, ip_quotes.invoice_group_id, ip_quotes.user_id, ip_quotes.responsible_id, ip_quotes.quote_currency,'
        . 'ip_quotes.quote_number, ip_quotes.quote_date_printed,'
        . 'ip_quote_amounts.quote_item_subtotal');
$this->db->where('quote_date_printed >=', $prevMonthStart );
$this->db->where('quote_date_printed <=', $prevMonthEnd );
$this->db->where('quote_currency', 'USD' );
$this->db->where('invoice_group_id', $invoice_group->invoice_group_id);
$this->db->where('responsible_id', $id);
$this->db->join('ip_quote_amounts', 'ip_quote_amounts.quote_id = ip_quotes.quote_id');
$this->db->from('ip_quotes');

$quotes_USD = $this->db->get()->result();
$size = count($quotes_USD)+count($quotes_EUR);
$group_info = array(
        'group_name'=>$invoice_group->invoice_group_name,
        'EUR' => $quotes_EUR,
        'USD' => $quotes_USD,
        'size' => $size,
        'start' =>$prevMonthStart,
        'end' => $prevMonthEnd,
        'today' =>$today,
        'user' =>$users
);

array_push($user_info, $group_info);
$group_info = array();
}

 return $user_info;
}

}
