<?php
class Orderdetails extends CI_Controller {
   // Controller class for site_settings
    function __construct()
{
               parent::__construct();
               $this->load->library('session');
               $this->load->model('Common_model');
               
             
               $id= $this->session->userdata('id');
               
               $whereArr=array('id'=>$id);
               $admin_val_arr=$this->Common_model->getAllDataWithMultipleWhere('Admin',$whereArr,'id');
       
       if(($admin_val_arr['result'][0]->pageAccess!="") && ($admin_val_arr['result'][0]->isSuperAdmin!=1))
       {
           
               $page_name=$this->uri->segment(1);
               
               $whereArr=array('link'=>$page_name);
               $page_id=$this->Common_model->getAllDataWithMultipleWhere('sidepanel',$whereArr,'id');
               $page_access=explode(",",$admin_val_arr['result'][0]->pageAccess);
             
       
               if(!in_array($page_id['result'][0]->id,$page_access))
               {
                     $this->session->set_userdata('error_msg', 'You have no access to '.$page_name);
                           redirect(base_url().'Login');  
               }

              //echo $id;
       }    
       if(!isset($id) && $id == '')
               {
                           $this->session->set_userdata('error_msg', 'Please login first to access this page.');
                           redirect(base_url().'Login');
               }
    
  
}

	
	
	function index()
	{
	   $this->load->view('includes/header');
        $this->load->view('includes/sidepanel');
		
		 //$whereArr = array('isSuperAdmin' => '0');
		 //$a=$this->Common_model->getAllDataWithMultipleWhere('subadmin',$whereArr,'id');

		//$data['listing']=$this->Common_model->getAllDataWithMultipleWhere('Admin',$whereArr,'Id');
		$data['listing']=$this->Common_model->fetchAllData('Order','order_id','DESC');
		//echo "<pre>";print_r($data);die;
    //$customer_id=   $data['listing']['result'][0]->customer_id;
    //echo $customer_id;die;
    //$whereArr = array('customer_no' => $customer_id);
    ///$data['customer_name']=$this->Common_model->getAllDataWithMultipleWhere('Customer',$whereArr,'customer_id');
    //echo "<pre>";print_r($data['customer_name']);die;
		
		$this->load->view('ItemStockManagement/orderdetailsview',$data);

        $this->load->view('includes/footer');
	}
  function viewOrderDetails()
{
    
    //echo "hello";die;
       $this->load->view('includes/header');
        $this->load->view('includes/sidepanel');
        $this->load->view('ItemStockManagement/viewOrderDetails');
        $this->load->view('includes/footer');
    
}
	
	
}
?>