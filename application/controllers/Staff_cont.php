<?php
class Staff_cont extends CI_Controller {
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
      //  echo $this->session->userdata('StoreId');die;
        $whereArr=array('status<>'=>"2",'store_id'=>$this->session->userdata('StoreId'));
        $data['listing']=$this->Common_model->getAllDataWithMultipleWhere('staff',$whereArr,'staff_id');
         $data['staff_post']=$this->Common_model->fetchAllData('staff_post','post_id','DESC');
        
        
		$this->load->view('includes/header');
        $this->load->view('includes/sidepanel');
		$this->load->view('Staff-management/staffListing',$data);
        $this->load->view('includes/footer');
	}
    function insertview(){
        
        $data['listing']=$this->Common_model->fetchAllData('UnitType','unit_id','DESC');
        $data['unit']=$this->Common_model->fetchAllData('UnitType','unit_id','DESC');
       
        $whereArr=array('status<>'=>"2",'store_id'=>$this->session->userdata('StoreId'));
        $data['material']=$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArr,'material_id');
		
        $this->load->view('includes/header');
        $this->load->view('includes/sidepanel');
		$this->load->view('Item-management/additem',$data);
        $this->load->view('includes/footer');
    }
    function addForm1(){
        
        
//       $data['listing']=$this->Common_model->fetchAllData('UnitType','unit_id','DESC');
//        //$data['unit']=$this->Common_model->fetchAllData('UnitType','unit_id','DESC');
//        //$data['material']=$this->Common_model->fetchAllData('RawMaterial','material_id','DESC');
//        
         $data['staff_post']=$this->Common_model->fetchAllData('staff_post','post_id','DESC');
//        
//        $whereArr=array('status<>'=>"2",'store_id'=>$this->session->userdata('StoreId'));
//        $data['material']=$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArr,'material_id');
//        
       // echo"<pre>";
        //print_r($data['material']);die;
		//$this->load->view('includes/header');
       // $this->load->view('includes/sidepanel');
		$this->load->view('Staff-management/addstuff',$data);
       // $this->load->view('includes/footer'); 
        
        
    }
    
    
    
    
    
    function insertStaff(){
        
        $id= $this->session->userdata('id');
         $StoreId=$this->session->userdata('StoreId');
        //echo $StoreId;die;
        $staffname=$this->input->post('staffname');
        $post = $this->input->post('post');
         $dob = $this->input->post('dob');
        $doj = $this->input->post('doj');
        $address = $this->input->post('address');
        $salary = $this->input->post('salary');
        $status=$this->input->post('status');
        
        $data_to_insert_staff=array(
                             'staff_name' => $staffname,
                                'address'=>$address,
				                'date_of_birth' =>$dob ,
                                'date_of_joining'=>$doj,
                                'post_id'=>$post,
                                'salary' => $salary,
                                'admin_subadmin_id'=>$id,
                                'store_id'=>$StoreId,
                                'status'=>$status
													
                    );
        
       // print_r($data_to_insert_staff);die;
        $insrt_data=$this->Common_model->insertData('staff', $data_to_insert_staff);
			 

                
        if($insrt_data){
                $this->session->set_userdata('success_msg', 'Successfully inserted staff');
                redirect(base_url().'Staff_cont/index'); 
        }
        else{
             $this->session->set_userdata('error_msg', 'staff not inserted');
                redirect(base_url().'Staff_cont/index'); 
        }
   // }
            
    }
    
   
    function edit(){
        
        
        $id=$this->input->post('id');
    // $data['edit']=$this->NewModel->fetch_data('UnitType',array('unit_id'=>$id));
//       $data['edit']=$this->Common_model->getAllDataWithMultipleWhere('UnitType',array('unit_id'=>$id));
        
        $whereArray = array('staff_id' => $id,'store_id'=>$this->session->userdata('StoreId'));		
        $data['staff']=$this->Common_model->getAllDataWithMultipleWhere('staff',$whereArray,'staff_id','ASC');
        
       
        
        $data['staff_post']=$this->Common_model->fetchAllData('staff_post','post_id','DESC');
         
        
        
        
       // $this->load->view('includes/header');
        //$this->load->view('includes/sidepanel');
		$this->load->view('Staff-management/editstaff',$data);
       // $this->load->view('includes/footer');
        
        
        
    }
function updateStaff(){
    
        $id=$this->uri->segment(3);
   // echo $id;
        $file_name = $_FILES['file']['name'];
        $file_size =$_FILES['file']['size'];
        $file_type=$_FILES['file']['type'];
        $source=$_FILES['file']['tmp_name'];
        $destination="/var/www/esolz.co.in/public/lab4/fresher/InventorySystem/assets/user/". $file_name;
      
        $upload=move_uploaded_file($source,$destination);
        if($upload==1){
          $source_path1="/var/www/esolz.co.in/public/lab4/fresher/InventorySystem/assets/user/". $file_name;
          $target_path1="/var/www/esolz.co.in/public/lab4/fresher/InventorySystem/assets/thumbnail_new/". $file_name;

          $val=$this->Common_model->thumbnail($target_path1,$source_path1,'');

        }
    
    
    
        $whereArray = array('staff_id' => $id,'store_id'=>$this->session->userdata('StoreId'));		
        $staff=$this->Common_model->getAllDataWithMultipleWhere('staff',$whereArray,'staff_id','ASC');
    $frst_salary=$staff['result'][0]->salary;
    //echo $salary;
     $post_id=$staff['result'][0]->post_id;
       
    $staffname=$this->input->post('staffname');
       
    $post = $this->input->post('post');
         $dob = $this->input->post('dob');
        $doj = $this->input->post('doj');
        $address = $this->input->post('address');
        $salary = $this->input->post('salary');
        $status=$this->input->post('status');
    
    if($salary!=$frst_salary){
         $new="Salary Changed Rs.".$frst_salary." to Rs.".$salary;
          $uid= $this->session->userdata('id');
          $data2=array(
              'user_id'=>$uid,
              'staff_id'=>$id,
              'type'=>'2',
              'purpose'=>'1',
              'message'=>$new,
              'date'=>date("Y/m/d")
            );
          $table='activity';
          $insert_status = $this->Common_model->insertData($table,$data2);
        }
    
    if($post!=$post_id){
           $uid= $this->session->userdata('id');
          $whereArr=array('post_id'=>$post_id);
            $post1=$this->Common_model->getAllDataWithMultipleWhere('staff_post',$whereArr,'post_id');
         $first_post_name=$post1['result'][0]->post_name;

          $whereArr=array('post_id'=>$post);
            $post2=$this->Common_model->getAllDataWithMultipleWhere('staff_post',$whereArr,'post_id');
         $sec_post_name=$post2['result'][0]->post_name;
          
        $newdeg="Change designation ".$first_post_name." to ".$sec_post_name;
          
            $data2=array(
              'user_id'=>$uid,
                'staff_id'=>$id,
              'type'=>'2',
              'purpose'=>'2',
              'message'=>$newdeg,
              'date'=>date("Y/m/d")
            );
          $table='activity';
          $insert_status = $this->Common_model->insertData($table,$data2);
        }
    
        
    
   $data_to_insert_staff=array(
                             'staff_name' => $staffname,
                                'address'=>$address,
				                'date_of_birth' =>$dob ,
                                'date_of_joining'=>$doj,
                                'image'=>$file_name,
                                'post_id'=>$post,
                                'salary' => $salary,
                                'status'=>$status
													
                    );
    
//    echo "<pre>";
//    print_r($data_to_insert_staff);die;
    if($this->input->post()){
            
            $whereArray = array('staff_id'=>$id);
            $update_data_item = $this->Common_model->updateDetailsWithMultipleWhere('staff',$whereArray,$data_to_insert_staff);
        
         if($update_data_item)
         {
       
            $this->session->set_userdata('success_msg', 'Successfully updated staff');
            redirect(base_url().'Staff_cont/index'); 
        }
        else{
             $this->session->set_userdata('error_msg', 'staff not updated');
                redirect(base_url().'Staff_cont/index'); 
        }
        
    }
       
        
}
   
    
    function changeStatusReview()
	{
		$Id = $this->uri->segment(3);
		$Status = $this->uri->segment(4);
		//========= update email template status ==========//
		$whereArrayVal = array('staff_id' => $Id);
		$data_to_store = array('status' => $Status);
		$updtData = $this->Common_model->updateDetailsWithMultipleWhere('staff',$whereArrayVal,$data_to_store);
		//========= update email template status ==========//
		
		$this->session->set_userdata('success_msg', 'Staff status has been updated successfully.');
		redirect(base_url().'Staff_cont/index');
	}
        function deleteUnit()
	{
		$Id = $this->uri->segment(3);
		
		//===== fetch data from img table =====//
		 $whereArray = array('staff_id'=>$Id);
             $data_store=array(
                    'status' => "2");
		$update_data = $this->Common_model->updateDetailsWithMultipleWhere('staff',$whereArray,$data_store);
            $this->session->set_userdata('success_msg', 'Staff deleted successfully.');
        redirect(base_url().'Staff_cont/index'); 

	}     
    function item_exists()
    {
        $name = $this->input->post('itemname');
         $store_id = $this->session->userdata('StoreId');
        
        $exists = $this->NewModel->item_exists($name,'Item',$store_id);
        echo $exists;
        //$count = count($exists);
         //echo $count ;

//        if ($count !=0) {
//            echo 1;
//        } else {
//            echo 0;
//        }
    }
    
    function fetch_unit(){
        
       $material_id = $this->input->post('material');
        
        $whereArray = array('material_id' => $material_id);		
        $data_unit_id=$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArray,'material_id');
        
        $unit_id=$data_unit_id['result'][0]->unit_id;
        
        $whereArray = array('unit_id' => $unit_id);		
        $data_unit_type=$this->Common_model->getAllDataWithMultipleWhere('UnitType',$whereArray,'unit_id');
        
        $unit_type=$data_unit_type['result'][0]->unit_type;
        
        $whereArray = array('unit_type' => $unit_type);		
        $data_unit_type=$this->Common_model->getAllDataWithMultipleWhere('UnitType',$whereArray,'unit_id');
        
        $output = '<option value="">Select</option>';
        foreach($data_unit_type['result'] as $row)
        {
            $output .= '<option value="'.$row->unit_id.'">'.$row->unit_name.'</option>';
        }
        echo $output;
    }
        
function fetch_unit1(){
        
       $material_id = $this->input->post('material');
        //echo $material_id;die;
         $whereArray = array('material_id' => $material_id);		
        $data_unit_id_ins=$this->Common_model->getAllDataWithMultipleWhere('Item_material',$whereArray,'material_id');
        
        //echo "<pre>";
       // print_r($data_unit_id_ins);
        $unit_id_ins=$data_unit_id_ins['result'][0]->unit_id;   
       // echo $unit_id_ins;
        $new_array=array();
     foreach($data_unit_id_ins['result'] as $row1){
         array_push($new_array,$row1->unit_id);
     }
        //print_r($new_array);die;
        $whereArray = array('material_id' => $material_id);		
        $data_unit_id=$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArray,'material_id');
        
        $unit_id=$data_unit_id['result'][0]->unit_id;
        
        $whereArray = array('unit_id' => $unit_id);		
        $data_unit_type=$this->Common_model->getAllDataWithMultipleWhere('UnitType',$whereArray,'unit_id');
        
        $unit_type=$data_unit_type['result'][0]->unit_type;
        
        $whereArray = array('unit_type' => $unit_type);		
        $data_unit_type=$this->Common_model->getAllDataWithMultipleWhere('UnitType',$whereArray,'unit_id');
        
        $output = '<option value="">Select</option>';
   
        foreach($data_unit_type['result'] as $row)
        {
            if(in_array($row->unit_id,$new_array)){
                 $selected='selected';
                
            }
            else{
                 $selected="";
            }
            $output .= '<option value="'.$row->unit_id.'" '.$selected.'>'.$row->unit_name.'</option>';
            
        }
        echo $output;
    }
        
public function showdetails(){
    
        $id=$this->uri->segment(3);
        $whereArr=array('staff_id'=>$id,'store_id'=>$this->session->userdata('StoreId'));
        $data['staff_details']=$this->Common_model->getAllDataWithMultipleWhere('staff',$whereArr,'staff_id');
    
        $whereArr=array('staff_id'=>$id,'type'=>'2');
        $data['activity_details']=$this->Common_model->getAllDataWithMultipleWhere('activity',$whereArr,'staff_id');
    
            
    
//        echo "<pre>";
//        print_r($data['activity_details']);die;
    
        $this->load->view('includes/header');
        $this->load->view('includes/sidepanel');
		$this->load->view('Staff-management/staffdetails',$data);
        $this->load->view('includes/footer');
    
}
    
    
        
        
    }
	 
    
    
    ?>