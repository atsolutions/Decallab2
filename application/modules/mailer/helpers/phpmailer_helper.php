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

function phpmail_send($from, $to, $subject, $message, $email_server, $email_port, $email_user, $email_pass, $attachment_path = NULL, $cc = NULL, $bcc = NULL, $more_attachments = NULL)
{
    require 'phpmailer/PHPMailerAutoload.php';

    $CI = &get_instance();
    $CI->load->library('encrypt');

    // Create the basic mailer object
    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';
    $mail->isHTML();
	


		//$this->load->model('custom_fields/mdl_custom_fields');
       // $this->load->model('custom_fields/mdl_user_custom');
        //$user_custom = $CI->mdl_user_custom->where('user_id', $CI->session->userdata('user_id'))->get()->row();
        //print_r($user_custom);
        

	

    switch ($CI->mdl_settings->setting('email_send_method')) {
        case 'smtp':
            $mail->IsSMTP();

            // Set the basic properties
            $mail->Host = $email_server;
            $mail->Port = $email_port;

            // Is SMTP authentication required?
            if ($CI->mdl_settings->setting('smtp_authentication')) {
                $mail->SMTPAuth = TRUE;
                $mail->Username = $email_user;
                $mail->Password = $email_pass;
            }

            // Is a security method required?
            if ($CI->mdl_settings->setting('smtp_security')) {
                $mail->SMTPSecure = $CI->mdl_settings->setting('smtp_security');
            }

            break;
        case 'sendmail':
            $mail->IsMail();
            break;
        case 'phpmail':
        case 'default':
            $mail->IsMail();
            break;
    }

    $mail->Subject = $subject;
    $mail->Body = $message;


    if (is_array($from)) {
        // This array should be address, name
        $mail->setFrom($from[0], $from[1]);
    } else {
        // This is just an address
        $mail->setFrom($from);
    }

    // Allow multiple recipients delimited by comma or semicolon
    $to = (strpos($to, ',')) ? explode(',', $to) : explode(';', $to);

    // Add the addresses
    foreach ($to as $address) {
        $mail->addAddress($address);
    }

    if ($cc) {
        // Allow multiple CC's delimited by comma or semicolon
        $cc = (strpos($cc, ',')) ? explode(',', $cc) : explode(';', $cc);

        // Add the CC's
        foreach ($cc as $address) {
            $mail->addCC($address);
        }
    }

    if ($bcc) {

        // Allow multiple BCC's delimited by comma or semicolon
        $bcc = (strpos($bcc, ',')) ? explode(',', $bcc) : explode(';', $bcc);
        // Add the BCC's
        foreach ($bcc as $address) {
            $mail->addBCC($address);
        }

    }

    if ($CI->mdl_settings->setting('bcc_mails_to_admin') == 1) {
        // Get email address of admin account and push it to the array
        $CI->load->model('users/mdl_users');
        $CI->db->where('user_id', 1);
        $admin = $CI->db->get('ip_users')->row();
        $mail->addBCC($admin->user_email);
    }

    // Add the attachment if supplied
    if ($attachment_path && $CI->mdl_settings->setting('email_pdf_attachment')) {
        $mail->addAttachment($attachment_path);
    }
    // Add the other attachments if supplied
    if ($more_attachments) {

        foreach ($more_attachments as $paths) {
            $mail->addAttachment($paths['path'], $paths['filename']);
        }
    }

    // And away it goes...
    if ($mail->send()) {
        $CI->session->set_flashdata('alert_success', 'The email has been sent');
        return TRUE;
    } else {
        // Or not...
        $CI->session->set_flashdata('alert_error', $mail->ErrorInfo);
        return FALSE;
    }
}
