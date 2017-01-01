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

class Issues extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function view()
    {
        //if issue has been submitted
        if ($this->input->post('btn_submit')) {
            $data = array(
                'title' => $this->input->post('title_text'),
                'body' => $this->input->post('body_text'),
            );
            $json = json_encode($data);
            $result = $this->CallAPI('POST', 'https://api.github.com/repos/atsolutions/Decallab2/issues',$json);
            if($result['code']=='201'){
                $this->session->set_flashdata('alert_success', 'Issue sucessfully created');
            }else{
                $this->session->set_flashdata('alert_error', 'There was an error creating the issue');
            }
        }
        
        $result = $this->CallAPI('GET', 'https://api.github.com/repos/atsolutions/Decallab2/issues');
        $issues = json_decode($result['result']);
        
        $this->layout->set(
            array(
                'issues' => $issues
            )
        );

        $this->layout->buffer('content', 'issues/index')->render();
    }
    
    
    function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "GET":
            curl_setopt($curl, CURLOPT_GET, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "atsolutions:ac071778989768fb6338a9838a8d66c0339ce9bb");
    curl_setopt($curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    
    $data = array(
        'result' =>$result,
        'code'=>$httpcode
    );
    
    return $data;
}

}
