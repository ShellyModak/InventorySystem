<?php
class Owner_login extends CI_Controller {
   // Controller class for site_settings
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('Common_model');
		//if($this->session->userdata('id')!='' && $this->session->userdata('id')==1)
		//{
		//	redirect(base_url().'Dashboard');
		//}
		
	}
	
	function index()
	{
		//echo EMAIL_TYPE;die;
		$this->load->view('login/owner_login');
	}
	
	public function user_login()
    {
      
         $email = $this->input->post('email'); 
		$password = $this->input->post('psw');
		$whereArr=array('email'=>$email,
						'password'=>$password);
         $ownerData=$this->Common_model->getAllDataWithMultipleWhere('owner',$whereArr,'id');
		// echo "<pre>";print_r($ownerData);die;
		 if(!empty($ownerData['result'])){
			$this->session->set_userdata('owner_id', $ownerData['result'][0]->id);
				redirect(base_url().'Owner_panel');
		 }else{
			$this->load->view('login/owner_login');
		 }
     
     
       
        
    }
	
	
	
	
}
?>