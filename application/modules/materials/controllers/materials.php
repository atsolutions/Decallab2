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

class Materials extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('mdl_materials');
    }

    public function index($page = 0)
    {
        $this->mdl_materials->paginate(site_url('materials/index'), $page);
        $materials = $this->mdl_materials->result();

        $this->layout->set('materials', $materials);
        $this->layout->buffer('content', 'materials/index');
        $this->layout->render();
    }

    public function form($id = NULL)
    {
        if ($this->input->post('btn_cancel')) {
            redirect('materials');
        }

        if ($this->mdl_materials->run_validation()) {
            $this->mdl_materials->save($id);
            redirect('materials');
        }

        if ($id and !$this->input->post('btn_submit')) {
            if (!$this->mdl_materials->prep_form($id)) {
                show_404();
            }
        }


        $this->layout->buffer('content', 'materials/form');
        $this->layout->render();
    }

    public function delete($id)
    {
        $this->mdl_materials->delete($id);
        redirect('materials');
    }

}
