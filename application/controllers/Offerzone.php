<?php
class Offerzone extends CI_Controller {
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

 
  function index(){
  $StoreId=$this->session->userdata('StoreId');
    $whereArray = array('store_id'=>$StoreId);
    $data['listing']=$this->Common_model->getAllDataWithMultipleWhere('Offer_zone',$whereArray,'id','ASC');

    $this->load->view('includes/header');
    $this->load->view('includes/sidepanel');
    $this->load->view('offerzone/offerzonelist',$data);
    $this->load->view('includes/footer');
  }
 function pagewise(){
  $StoreId=$this->session->userdata('StoreId');
 // echo $StoreId;die;
   // $whereArray = array('store_id'=>$StoreId);
   // $data['listing']=$this->Common_model->getAllDataWithMultipleWhere('Offer_zone',$whereArray,'id','ASC');

  //  $data['search'] ="";
    $data['totalPage']="";
    $rowno=0;
  //  $search_text = "";
    $rowperpage = 4;
    $page_from_ajax=$this->input->post('page');
   // echo $page_from_ajax;
    if (isset($page_from_ajax)) 
    {
     $page  = $page_from_ajax; 
    } 
    else { 
      $page=1; 
    }; 
  // echo $page;
    if($page > 0){
           $rowno = ($page-1) * $rowperpage;
    }
    $allcount = $this->NewModel->getrecordCountforpagination('Offer_zone');
    $users_record = $this->NewModel->getDataforpagelist($rowno,$rowperpage,'Offer_zone');
   //echo "<pre>";print_r($users_record);die;
  $total_pages = ceil($allcount / $rowperpage); 
    $data['listing']= $users_record;
    $data['row'] = $rowno;
   // $data['search'] = $search_text;
    $data['totalPage']=$total_pages;
   // echo "<pre>";
   // print_r($data['listing']);die;
      $this->load->view('offerzone/replace',$data);
 }

  function offerzone_add(){
    $this->load->view('offerzone/offerzoneadd');
  }

  function offerzone_edit(){
    $StoreId=$this->session->userdata('StoreId');
     $id=$this->input->post('id');
     $whereArray = array('id'=>$id,'store_id'=>$StoreId);
     $data['edit_data']=$this->Common_model->getAllDataWithMultipleWhere('Offer_zone',$whereArray,'id','ASC');

    // $this->load->view('includes/header');
  //       $this->load->view('includes/sidepanel');
    $this->load->view('offerzone/offerzoneedit',$data);
      //  $this->load->view('includes/footer');
  }

function deleteUnit()
  {
    $Id = $this->uri->segment(3);
    
    //===== fetch data from img table =====//
     $whereArray = array('id'=>$Id);
             $data_store=array(
                    'status' => "2");
    $update_data = $this->Common_model->updateDetailsWithMultipleWhere('Offer_zone',$whereArray,$data_store);
        // $this->session->set_userdata('success_msg', 'Material deleted successfully.');
        redirect(base_url().'Offerzone/index'); 

  }     

function changeStatusReview(){
    $id = $this->uri->segment(3);
    $status = $this->uri->segment(4);
    $whereArray = array('id'=>$id);
    $data_store=array(
                    'status' => $status);
    $update_data = $this->Common_model->updateDetailsWithMultipleWhere('Offer_zone',$whereArray,$data_store);
    redirect(base_url().'Offerzone/index'); 
  }

  function insert_values(){
  
    // $hobby = implode(',', $_REQUEST['checkbox']);
    $StoreId=$this->session->userdata('StoreId');
    $checkbox=$this->input->post('checkbox');
   
    $cust=implode(',', $checkbox);
 
    $offer_type=$this->input->post('offer_type');
    $amount=$this->input->post('amount');
    $minamount=$this->input->post('minamount');
    $offerpurpose=$this->input->post('offerpurpose');
    $note=$this->input->post('note');
    $status=$this->input->post('status');
    $data=array (
            'store_id'=> $StoreId,
            'customer_id' => $cust,
            'offer_type'=>$offer_type,
            'amount'=>$amount,
            'min_amount'=>$minamount,
            'offer_purpose'=>$offerpurpose,
            'note'=>$note,
            'status'=>$status
                );
    $table='Offer_zone';
    $insert_status = $this->Common_model->insertData($table,$data);
    if($insert_status){
                $this->session->set_userdata('success_msg', 'Successfully inserted offer details');
                redirect(base_url().'Offerzone/index'); 
        }
        else{
             $this->session->set_userdata('error_msg', 'offer details not inserted');
                redirect(base_url().'Offerzone/index'); 
        }

   // redirect(base_url().'Offerzone/index');
  }
  function update(){
    $id=$this->uri->segment(3);
      $StoreId=$this->session->userdata('StoreId');
   $checkbox=$this->input->post('checkbox');
   
    $cust=implode(',', $checkbox);
 
    $offer_type=$this->input->post('offer_type');
    $amount=$this->input->post('amount');
    $minamount=$this->input->post('minamount');
    $offerpurpose=$this->input->post('offerpurpose');
    $note=$this->input->post('note');
    $status=$this->input->post('status');
    $data=array (
            'store_id'=> $StoreId,
            'customer_id' => $cust,
            'offer_type'=>$offer_type,
            'amount'=>$amount,
            'min_amount'=>$minamount,
            'offer_purpose'=>$offerpurpose,
            'note'=>$note,
            'status'=>$status
                );
    $whereArray = array('id' => $id);
    $updt_status = $this->Common_model->updateDetailsWithMultipleWhere('Offer_zone',$whereArray,$data);

    if($updt_status){
                
                $this->session->set_userdata('success_msg', 'Successfully Updated offer details');
               redirect(base_url().'Offerzone/index'); 
        }
        else{
              
             $this->session->set_userdata('error_msg', 'offer details not updated');
               redirect(base_url().'Offerzone/index'); 
        }
    //redirect(base_url().'Offerzone/index');
       // echo $this->session->userdata('success_msg');die;
  }
}
?>