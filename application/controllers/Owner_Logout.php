<?php
class Owner_Logout extends CI_Controller {
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
		
		$this->session->unset_userdata('owner_id');
        
		$this->session->sess_destroy();
		redirect(base_url().'Owner');
	}
}
?>