<?php
class Login_model extends CI_Model{
	
	function facebook_login($user_profile){
		
		$this->load->view('facebook_view', $user_profile);
		
	}
	
	 
	function google_login(){
	
	}
	
	

}
?>