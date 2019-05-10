<?php
class Unit_cont extends CI_Controller {
   // Controller class for site_settings
	 function __construct()
{
               parent::__construct();
               $this->load->library('session');
               $this->load->model('Common_model');
               $this->load->model('NewModel');
             
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
        $data['listing']=$this->Common_model->fetchAllData('UnitType','unit_id','DESC');
		$this->load->view('includes/header');
        $this->load->view('includes/sidepanel');
		$this->load->view('Unit-type-management/unitlisting',$data);
        $this->load->view('includes/footer');
	}
    function insertview(){
        
        $this->load->view('includes/header');
        $this->load->view('includes/sidepanel');
		$this->load->view('Unit-type-management/addUnit');
        $this->load->view('includes/footer');
    }
    
    function inserUnit(){
       $id= $this->session->userdata('id');
        $StoreId=$this->session->userdata('StoreId');
       // $unit_name=$this->input->post('unitname');
        //if($unit_name!=""){
        $data_ins=array(
                    'unit_name' => $this->input->post('unitname'),
                    'status'=>"1",
                    'admin_subadmin_id'=>$id,
                    'store_id'=>$StoreId
                        );
                    
            
                
           $insert=$this->Common_model->insertData('UnitType',$data_ins); 
        if($insert){
                $this->session->set_userdata('success_msg', 'Successfully inserted unit');
                redirect(base_url().'Unit_cont/index'); 
        }
        else{
             $this->session->set_userdata('error_msg', 'unit not inserted');
                redirect(base_url().'Unit_cont/index'); 
        }
   // }
            
    }
    
    function edit(){
        
        
        $id=$this->uri->segment(3);
     $data['edit']=$this->NewModel->fetch_data('UnitType',array('unit_id'=>$id));
       // $data['edit']=$this->Common_model->getAllDataWithMultipleWhere('UnitType',array('unit_id'=>$id));
        
        $this->load->view('includes/header');
        $this->load->view('includes/sidepanel');
		$this->load->view('Unit-type-management/editUnit',$data);
        $this->load->view('includes/footer');
        
        
        
    }
function updateUnit(){
    
    $id=$this->uri->segment(3);
    echo $id;
    $data_store=array(
                    'unit_name' => $this->input->post('unitname'),
                        'status'=>$this->input->post('status')
                        );
    if($this->input->post()){
            
        $whereArray = array('unit_id'=>$id);
            $update_data = $this->Common_model->updateDetailsWithMultipleWhere('UnitType',$whereArray,$data_store);
        
        if($update_data){
                $this->session->set_userdata('success_msg', 'Successfully updated unit');
                redirect(base_url().'Unit_cont/index'); 
        }
        else{
             $this->session->set_userdata('error_msg', 'unit not updated');
                redirect(base_url().'Unit_cont/index'); 
        }
        redirect(base_url().'Unit_cont/index'); 
        
}
}
    
    function changeStatusReview()
	{
		$Id = $this->uri->segment(3);
		$Status = $this->uri->segment(4);
		//========= update email template status ==========//
		$whereArrayVal = array('unit_id' => $Id);
		$data_to_store = array('status' => $Status);
		$updtData = $this->Common_model->updateDetailsWithMultipleWhere('UnitType',$whereArrayVal,$data_to_store);
		//========= update email template status ==========//
		
		$this->session->set_userdata('success_msg', 'Unit status has been updated successfully.');
		redirect(base_url().'Unit_cont/index');
	}
        function deleteUnit()
	{
		$Id = $this->uri->segment(3);
		
		//===== fetch data from img table =====//
		 $whereArray = array('unit_id'=>$Id);
             $data_store=array(
                    'status' => "2");
		$update_data = $this->Common_model->updateDetailsWithMultipleWhere('UnitType',$whereArray,$data_store);
            $this->session->set_userdata('success_msg', 'Unit deleted successfully.');
        redirect(base_url().'Unit_cont/index'); 

	}     
    function filename_exists()
    {
        $name = $this->input->post('unitname');
        $exists = $this->NewModel->filename_exists($name,'UnitType');
        echo $exists;
        //$count = count($exists);
         //echo $count ;

//        if ($count !=0) {
//            echo 1;
//        } else {
//            echo 0;
//        }
    }
        
        
    }
	