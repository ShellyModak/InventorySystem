<?php
class Logout extends CI_Controller {
   // Controller class for Login
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('encrypt');     
		//loading session

	}
        
        function index()
	{
		$this->session->unset_userdata('is_loged_in');
		$this->session->unset_userdata('uid');
		$this->session->sess_destroy();
		$this->session->set_userdata('success_msg', 'Successfully Logged Out .');
		redirect('login');
	}
}
?>