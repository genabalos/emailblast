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
		  'smtp_user' => '<your_email_here>', // change it to yours
		  'smtp_pass' => '<your_password_here>', // change it to yours
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

			$this->email->initialize($config);
			
			foreach($myRecipients as $my_Recipients){
				$my_Recipients = preg_replace('/\s+/', '', $my_Recipients);
				if (valid_email($my_Recipients)){
					
					$this->email->set_newline("\r\n");
					$this->email->from('geniferaabalos@gmail.com'); 
					$this->email->to($my_Recipients);
					$this->email->subject($data['subject']);
					$this->email->message($data['message']); 
					//$this->email->attach('C:/Bitnami/wampstack-5.6.22-0/apache2/htdocs/emailblast/images/letters.jpg');
					
					if($this->email->send()){
						$data['prompt'] = "Email Successfully Sent!";
						$this->load->view('templates/header');
						$this->load->view('email_view', $data);
						$this->load->view('templates/footer');
						header("refresh:3; url=email");
					}else{
						//show_error($this->email->print_debugger());
						$data['prompt'] = "An error occured while sending the message.!";
						$this->load->view('templates/header');
						$this->load->view('email_view', $data);
						$this->load->view('templates/footer');
						header("refresh:3; url=email");
					}
				}else{
					$data['prompt'] = "Email is incorrect!";
					$this->load->view('templates/header');
					$this->load->view('email_view', $data);
					$this->load->view('templates/footer');
					header("refresh:3; url=email");
				}
			}
		
		
	}
	
}

?>
