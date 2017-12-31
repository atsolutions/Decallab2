<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Keys Controller
 *
 * This is a basic Key Management REST controller to make and delete keys.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php
require(APPPATH.'/libraries/REST_Controller.php');

class Quote extends REST_Controller
{
	public function index_get()
	{
		//log_message('error', 'API access');
		$this->response($this->db->get('ip_quotes')->result());
	}

	public function index_post()
	{
		// Create a new book
	}
}
