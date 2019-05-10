<?php
class SuperAdmin_cont extends CI_Controller 
{
	function __construct()
	{
                parent::__construct();
                $this->load->library('session');
                $this->load->model('Common_model');
     }
	  
function index(){
		//$StoreId=$this->session->userdata('StoreId');
		$where=array('status'=>1,
					 'isSuperAdmin'=>1);
		$superAdminData['details']=$this->Common_model->getAllDataWithMultipleWhere('Admin',$where,'id');
		//echo "<pre>";print_r($superAdminData);die;
	    $this->load->view('includes/owner_header');
		$this->load->view('includes/owner_sidepanel');
		$this->load->view('super_admin/superAdminDetails',$superAdminData);
	    $this->load->view('includes/owner_footer');
		
   }
   
function addsuperAdmin(){
$this->load->view('super_admin/add_superAdmin');	
}
	
function edit_superAdmin(){
	$id = $this->input->post('id');
	//echo $id;die;
	  $whereArr=array('id'=>$id);
	  $superAdminData['details']=$this->Common_model->getAllDataWithMultipleWhere('Admin',$whereArr,'id');
	  //echo "<pre>";print_r($superAdminData);die;
	$this->load->view('super_admin/edit_superAdmin',$superAdminData);
}

function update_superadmin(){
	$id=$this->uri->segment(3);
	$superAdminName=$this->input->post('Super_admin_name');
	$details=$this->input->post('super_admin_details');
	$password=$this->input->post('password');
	//echo $password;die;
	$whereArr=array('id'=>$id);
	$data_to_update=array('Name'=>$superAdminName,
						  'details'=>$details,
						  'password' =>md5($password),
                          'originalPassword' =>$password);
	$update=$this->Common_model->updateDetailsWithMultipleWhere('Admin',$whereArr,$data_to_update);
    
    if($update){
		$this->session->set_userdata('success_msg', 'Successfully updated admin details');
			//$this->session->set_userdata('error_msg', '');
			redirect(base_url().'SuperAdmin_cont/index'); 
	}
	 else
    {
        // $this->session->set_userdata('success_msg', '');
         $this->session->set_userdata('error_msg', 'Could not update admin details');
		 redirect(base_url().'SuperAdmin_cont/index'); 

     }
}
}