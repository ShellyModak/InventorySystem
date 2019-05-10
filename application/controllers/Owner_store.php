
<?php
class Owner_store extends CI_Controller 
{
    
    function __construct()
	{
                parent::__construct();
                $this->load->library('session');
                $this->load->model('Common_model');
     }
 
function index(){
		//$StoreId=$this->session->userdata('StoreId');
		$where=array('status'=>1);
		$storeData['details']=$this->Common_model->getAllDataWithMultipleWhere('store',$where,'id');
	    $this->load->view('includes/owner_header');
		$this->load->view('includes/owner_sidepanel');
		$this->load->view('store/store_details',$storeData);
	    $this->load->view('includes/owner_footer');
		
   }
 /*function insertCustomer(){
        
        $this->load->view('includes/header');
        $this->load->view('includes/sidepanel');
		$this->load->view('customer/addCustomer');
        $this->load->view('includes/footer');
    }*/
	
function insertData(){
	$name=ucfirst($this->input->post('Store_name'));
	$address=$this->input->post('store_address');
	$phno=$this->input->post('Mobile');
	$storeId="S".rand(100,999);
	$superAdminName=$this->input->post('Super_admin_name');
    $superAdminEmail=$this->input->post('super_admin_email');
	$superAdminPassword=$this->input->post('super_admin_password');
	$count=count($superAdminEmail);
	
	$data_to_store=array('name'=>$name,
						 'phoneNumber'=>$phno,
						 'address'=>$address,
						 'storeId'=>$storeId);
	
	  //echo "<pre>";print_r($data_to_store);die;
	  $insert_store=$this->Common_model->insertData('store',$data_to_store);
	  
	for($i=0;$i<$count;$i++){
		$data_to_insert=array(
					 'Name' =>$superAdminName[$i],
                    'email' => $superAdminEmail[$i],
                    'Store_name' => $superAdminName[$i],
                    'password' =>md5($superAdminPassword[$i]),
                    'originalPassword' =>$superAdminPassword[$i],
                    'phoneno' => '',
                    'status'=> '1',
                    'pageaccess' =>'',
					'storeId'=>$storeId,
					'isSuperAdmin'=>'1');
		$insert_superAdmin=$this->Common_model->insertData('Admin',$data_to_insert);
	}
	
	
	  //echo  $insert_superAdmin;
	  //echo $insert_store;die;
	   if($insert_superAdmin){
            $this->session->set_userdata('success_msg', 'Store added successfully');
                redirect(base_url().'Owner_store/index'); 
        }  else{
            $this->session->set_userdata('error_msg', 'Cannot insert store.');
                redirect(base_url().'Owner_store/index');  
        }
	
}

function store_exists(){
	if($this->input->post('id')!=''){
		$mobile=$this->input->post('Mobile');
		//echo $mobile;
		$id=$this->input->post('id');
		
		$whereArr=array('phoneNumber'=>$mobile,
					'status'=>1,
					'id<>'=>$id);
	}else{
	$mobile=$this->input->post('Mobile');
	//echo $mobile;
	$whereArr=array('phoneNumber'=>$mobile,
					'status'=>1);
	}
	$store=$this->Common_model->getAllDataWithMultipleWhere('store',$whereArr,'id');
	$num_row=$store['num_row'];
	echo $num_row;
	
}






function addstore(){

	$this->load->view('store/add_store');
}



function edit_store(){
	  $id = $this->input->post('id');
	  $whereArr=array('id'=>$id);
	  $storeData['details']=$this->Common_model->getAllDataWithMultipleWhere('store',$whereArr,'id');
	  //echo "<pre>";print_r($storeData);die;
	  $this->load->view('store/edit_store',$storeData);
}

function update_store(){
	$id=$this->uri->segment(3);
	$name=$this->input->post('Store_name');
	$address=$this->input->post('store_address');
	$mobile=$this->input->post('Mobile');
	
	$superAdminName=$this->input->post('Super_admin_name');
    $superAdminEmail=$this->input->post('super_admin_email');
	$superAdminPassword=$this->input->post('super_admin_password');

	$count=count($superAdminEmail);
	$superAdminList=$this->input->post('super_admin_name');

    $whereArr=array('id'=>$id);
	$storeData=$this->Common_model->getAllDataWithMultipleWhere('store',$whereArr,'id');
	$storeId=$storeData['result'][0]->storeId;
	$activeAdmin=$this->Common_model->activeAdmin('Admin',$superAdminList);
	foreach($activeAdmin['result'] as $admin){
		$where=array('id'=>$admin->id);
		$data_to_updt=array('status'=>1);
		$update_status=$this->Common_model->updateDetailsWithMultipleWhere('Admin',$where,$data_to_updt);
	 }
	$whereArray=array('storeId'=>$storeId);
	
	$inactiveAdmin=$this->Common_model->inactiveAdmin('Admin',$whereArray,$superAdminList);
	 foreach($inactiveAdmin['result'] as $admin){
		$where=array('id'=>$admin->id);
		$data_to_updt=array('status'=>3);
		$update_status=$this->Common_model->updateDetailsWithMultipleWhere('Admin',$where,$data_to_updt);
	 }
    
	$data_to_update=array('name'=>$name,
						 'phoneNumber'=>$mobile,
						 'address'=>$address,);
	$update=$this->Common_model->updateDetailsWithMultipleWhere('store',$whereArr,$data_to_update);
	
	for($i=0;$i<$count;$i++){
		$where=array('email'=>$superAdminEmail[$i],
					 'storeId'=>$storeId);
		$adminData=$this->Common_model->getAllDataWithMultipleWhere('Admin',$where,'id');
	    //0echo "<pre>";print_r($adminData);die;
		/*if($adminData['num_row']==1){
			redirect(base_url().'Owner_store/index'); 
		}else{*/
			if($superAdminName[$i]!='' && $superAdminEmail!='' && $superAdminPassword!='')
			{
			$data_to_ins=array(
					'Name' =>$superAdminName[$i],
                    'email' => $superAdminEmail[$i],
                    'Store_name' => $superAdminName[$i],
                    'password' =>md5($superAdminPassword[$i]),
                    'originalPassword' =>$superAdminPassword[$i],
                    'phoneno' => '',
                    'status'=> '1',
                    'pageaccess' =>'',
					'storeId'=>$storeId,
					'isSuperAdmin'=>'1');
			         $insert_superAdmin=$this->Common_model->insertData('Admin',$data_to_ins);
		   }
		//}
	}
	
	if($update){
		$this->session->set_userdata('success_msg', 'Successfully updated store');
			//$this->session->set_userdata('error_msg', '');
			redirect(base_url().'Owner_store/index'); 
	}
	 else
    {
        // $this->session->set_userdata('success_msg', '');
         $this->session->set_userdata('error_msg', 'Could not update store');
		 redirect(base_url().'Owner_store/index');  

     }
}

function delete_store(){
	$id=$this->uri->segment(3);
	$where=array('id'=>$id);
	$store=$this->Common_model->getAllDataWithMultipleWhere('store',$where,'id');
	$storeId=$store['result'][0]->storeId;
	//echo "<pre>";print_r($store);die;\
	$whereArr=array('id'=>$id);
	 $data_updt=array('status' => '2');
	$where=array('storeId'=>$storeId);
	$del=$this->Common_model->updateDetailsWithMultipleWhere('Admin',$where,$data_updt);
	$delete=$this->Common_model->updateDetailsWithMultipleWhere('store',$whereArr,$data_updt);
	//echo $delete;die;
	if($delete){
			$this->session->set_userdata('success_msg', 'Successfully deleted store');
			//$this->session->set_userdata('error_msg', '');
			redirect(base_url().'Owner_store/index');  
			
	}
	 else
    {
         //$this->session->set_userdata('success_msg', '');
         $this->session->set_userdata('error_msg', 'Cannot delete store');
		 redirect(base_url().'Owner_store/index');  

     }

    
    }
	
	
	function generateField()
	{
		$count = $this->input->post('count');
		//echo $count;
		$data=array();
		$data['count']=$count;
	   $this->load->view('store/addmore',$data);
		
	}
	
	function email_check(){
		//echo "hello";die;
		$storeId=$this->input->post('storeId');
		$email=$this->input->post('email');
		$where=array('storeId'=>$storeId,
					 'email'=>$email);
		$emailData=$this->Common_model->getAllDataWithMultipleWhere('Admin',$where,'id');
		echo $emailData['num_row'];
	
	}
	
	
}
?>