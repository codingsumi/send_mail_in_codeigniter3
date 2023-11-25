<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'mail.domainname', //mail.domainname
			'smtp_port' => 587,
			'smtp_user' => 'hello@domainname', //webmail username
			'smtp_pass' => 'password', // webmail password
			'smtp_crypto' => 'tls', // ssl or tls
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'wordwrap' => TRUE
		);

		$this->email->initialize($config);

	}
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function send()
	{
		$email_to = $this->input->post('email');
		$this->email->from('webmail', 'Welcome to Smartways');
		$this->email->to($email_to);
		$this->email->subject('Testing');
		$this->email->message('Hi, This is only for Testing');

		if ($this->email->send()) {
			echo 'Email sent successfully';
		} else {
			echo 'Email sending failed';
			echo $this->email->print_debugger(); // To display any errors
		}

	}
}

