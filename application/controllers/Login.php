<?php
class Login extends CI_Controller {
   // Controller class for site_settings
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('NewModel');
		if($this->session->userdata('is_loged_in')!='' && $this->session->userdata('is_loged_in')==1)
		{
			//redirect(base_url().'Dashboard');
		}
		
	}
	
	function index()
	{
		//echo base_url();
		$this->load->view('login/login_template');
	}
	//login functionality
    public function user_login()
    {
         $username = $this->input->post('storename'); 
       
        $password = $this->input->post('psw'); 
        $rem=$this->input->post('remember_me');
       // $res=$this->NewModel->login_user($email,$password,'details');
        $res_admin=$this->NewModel->login_user($username,$password,'Admin');
        //print_r($res_admin);
        
        if(!empty($res_admin)){
            if ($this->input->post('remember_me')){
                
                $this->input->set_cookie('storename', $username, 86500);
                $this->input->set_cookie('psw', $password, 86500);
                $this->input->set_cookie('remember_me', $rem, 86500);  
               
                
        } 
            $this->session->set_userdata('id', $res_admin[0]->id);
               // $id= $this->session->userdata('id');
                
           //echo "logged in";
              $this->session->set_userdata('success_msg', 'Logged In Successfully.');
			redirect(base_url().'Dashboard');
        }
        else{
        
           $this->session->set_userdata('error_msg', 'Wrong Username Or Password.');
			redirect(base_url().'Login');
        }
        
    }
	
	
}
?>