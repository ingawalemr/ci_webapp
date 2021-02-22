<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function about()
	{
		$this->load->view('front/about');
	}

	public function services()
	{
		$this->load->view('front/services');
	}

	public function contact()
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');

				if ($this->form_validation->run() == true) {
					# code for sending email vai SMTP Protocol...

					$config = Array(
	                'protocol' => 'smtp',
	                'smtp_host' => 'ssl://smtp.gmail.com',
	                'smtp_port' => 465,
	                'smtp_user' => 'ingawalemr12@gmail.com', // please replace this with yours 
	                'smtp_pass' => 'MywifeisGayatri@2015', // please replace this with yours
	                'mailtype'  => 'html',
	                'charset'   => 'iso-8859-1' );

	            $this->load->library('email', $config);
	            $this->email->set_newline("\r\n");


	             $this->email->from('ingawalemr12@yahoo.com');
	             $this->email->to('ingawalemr12@gmail.com');
	             //$this->email->to('mahadevr.brandturtleindia@gmail.com');// This is an email where you want to receive email
	             $this->email->subject('You have received an enquiry');

	             $name = $this->input->post('name');
	             $email = $this->input->post('email');
	             $msg = $this->input->post('msg');

	             $message = "Name :". $name;     $message .= "<br>";
	             $message .= "Email :". $email;  $message .= "<br>";
	             $message .= "Message :". $msg;  $message .= "<br>";$message .= "<br>";
	            
	             $this->email->message($message);
	             $this->email->send();

	             $this->session->set_flashdata('success', 'Thanks for your enquiry, message has been sent successfully');
   				 redirect(base_url('Pages/contact'));
				}
			else 
			{
				$this->load->view('front/contact_us');
			}
			

		}	
}
