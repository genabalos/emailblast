<?php

class Email extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('email');
	}
	
	public function index() {
		
		$email = $this->input->post('email');
		
		if ($email == 'send'){
			$this->sendMail();
		}
		else{
			$this->load->view('templates/header');
			$this->load->view('home_view');
			$this->load->view('templates/footer');
		}
	
	}

	
	public function sendMail(){
		$config = Array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'ssl://smtp.googlemail.com',
		  'smtp_port' => 465,
		  'smtp_user' => 'geniferaabalos@gmail.com', // change it to yours
		  'smtp_pass' => 'daking1939', // change it to yours
		  'mailtype' => 'text',
		  'charset' => 'utf-8',
		  'wordwrap' => TRUE
		);
		
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('recipients', 'Recipients', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');
		
		$data['subject'] = $this->input->post('subject');
		$data['recipients'] = $this->input->post('recipients');
		$data['message'] = $this->input->post('message');
		
		$myString = $data['recipients'];
		$myRecipients = explode(',', $myString);
		//$count = count($myRecipients);
		//print_r($myArray);
		//print_r($count);

			$this->email->initialize($config);
			
			foreach($myRecipients as $my_Recipients){
				$my_Recipients = preg_replace('/\s+/', '', $my_Recipients);
				if (valid_email($my_Recipients)){
					//echo $my_Recipients . "<br>";
					$this->email->set_newline("\r\n");
					$this->email->from('geniferaabalos@gmail.com'); 
					$this->email->to($my_Recipients);
					$this->email->subject(' ' . " " . $data['subject']);
					$this->email->message(' ' . " " . $data['message']); 
					
					if($this->email->send()){
						$data['message'] = "Email Successfully Sent!";
						$this->load->view('templates/header');
						$this->load->view('email_view', $data);
						$this->load->view('templates/footer');
						header("refresh:3; url=email");
					}else{
						//show_error($this->email->print_debugger());
						$data['message'] = "An error occured while sending the message.!";
						$this->load->view('templates/header');
						$this->load->view('email_view', $data);
						$this->load->view('templates/footer');
						header("refresh:3; url=email");
					}
				}else{
					$data['message'] = "Email is incorrect!";
					$this->load->view('templates/header');
					$this->load->view('email_view', $data);
					$this->load->view('templates/footer');
					header("refresh:3; url=email");
				}
			}
		
		
	}
	
}

?>