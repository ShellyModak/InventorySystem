<?php
class Customer_cont extends CI_Controller 
{    
    function __construct()
	{
                parent::__construct();
                $this->load->library('session');
                $this->load->model('Common_model');   
                $this->load->model('NewModel');              
              	 $this->load->library('email');
          $this->load->model('excel_import_model');
         //$this->load->library('excel');
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
   $value=$this->uri->segment(3);
 
 
		$StoreId=$this->session->userdata('StoreId');
		$where=array('store_id'=>$StoreId,
					 'status'=>1);
		$cutomerData['details']=$this->Common_model->getAllDataWithMultipleWhere('Customer',$where,'customer_id');
    if($value==1){
      $cutomerData['value']=$value;
    }
    else{
       $cutomerData['value']=0;
    }


	    $this->load->view('includes/header');
      $this->load->view('includes/sidepanel');
		  $this->load->view('customer/customer_details',$cutomerData);
		  $this->load->view('includes/footer');
   }
function notification(){
  $StoreId=$this->session->userdata('StoreId');
    $whereArr=array('store_id'=>$StoreId);
    $val =$this->Common_model->getAllDataWithMultipleWhere('Customer',$whereArr,'customer_id');
    
    
  $m=date('m');   
  $d=date('d');
  $y=date('Y');
  $date=$y."-".$m."-".$d;

  for($i=0;$i<$val['num_row'];$i++){
    $cu_id=$val['result'][$i]->customer_id;
    $whereArr2=array('customer_table_id'=>$cu_id,'store_id'=>$StoreId);
    $cu_val =$this->Common_model->getAllDataWithMultipleWhere('notification',$whereArr2,'id');


 $bday=$val['result'][$i]->DOB;
$arr = explode('/', $bday); 
// $bdaydate=$arr[2]."-".$arr[1]."-".$arr[0]; 
$annday=$val['result'][$i]->anniversary;
$arr01= explode('/', $annday);
  if($cu_val['num_row'] == ""){
    if($arr[1]==$m){
    if($val['result'][$i]->DOB != ""){
       // $bday=$val['result'][$i]->DOB;
       // $arr10 = explode('/', $bday); 
      $bdaydate=$arr[2]."-".$arr[1]."-".$arr[0];
         $data2=array(
              'customer_table_id'=>$val['result'][$i]->customer_id,
              'store_id'=>$StoreId,
              'cupon_title_name'=>$val['result'][$i]->customer_name,
              'cupon_type'=>1,
              'current_date'=>$date,
              'event_on'=>$bdaydate,
              'update_on'=>$date,
              'status'=>1
      );
      $insert_new=$this->Common_model->insertData('notification',$data2);
    }
  }
   if($arr01[1]==$m){
     if($val['result'][$i]->anniversary != ""){
      $aniday=$val['result'][$i]->anniversary;
      $arr1 = explode('/', $aniday); 
      $anidaydate=$arr1[2]."-".$arr1[1]."-".$arr1[0];
       $data2=array(
              'customer_table_id'=>$val['result'][$i]->customer_id,
              'store_id'=>$StoreId,
              'cupon_title_name'=>$val['result'][$i]->customer_name,
              'cupon_type'=>2,
              'current_date'=>$date,
              'event_on'=>$anidaydate,
              'update_on'=>$date,
              'status'=>1
      );
      $insert_new=$this->Common_model->insertData('notification',$data2);
    }
  }
   
 }
   else{
         
        for($j=0;$j<$cu_val['num_row'];$j++){
          $id=$cu_val['result'][$j]->id;
            if($cu_val['result'][$j]->cupon_type==1){
              $event_on=$cu_val['result'][$j]->event_on;
          
             $arr3 = explode('-', $event_on);
           
             $a=$d-$arr3[2];
             if($a==0){
                $status1=0;
             } 
             
             else if($a>0){
              $status1=2;
             }
             else{
              $status1=1;
             }
           
                 $data6=array(
                      // 'customer_table_id'=>$val['result'][$i]->customer_id,
                      // 'store_id'=>$StoreId,
                      // 'cupon_title_name'=>$val['result'][$i]->customer_name,
                      // 'cupon_type'=>1,
                      'update_on'=>$date,
                      'status'=>$status1
              );
        $whereArr2=array('id'=>$id,'store_id'=>$StoreId);
            $update=$this->Common_model->updateDetailsWithMultipleWhere('notification',$whereArr2,$data6);
          }

          if($cu_val['result'][$j]->cupon_type==2){
             $event_on=$cu_val['result'][$j]->event_on;
          
             $arr3 = explode('-', $event_on);
       
             $a=$d-$arr3[2];
             if($a==0){
                $status=0;
             } 
             
             else if($a>0){
              $status=2;
             }
             else{
              $status=1;
             }
            
                 $data6=array(
                      // 'customer_table_id'=>$val['result'][$i]->customer_id,
                      // 'store_id'=>$StoreId,
                      // 'cupon_title_name'=>$val['result'][$i]->customer_name,
                      // 'cupon_type'=>2,
                      'update_on'=>$date,
                      'status'=>$status
              );
        $whereArr2=array('id'=>$id);
            $update=$this->Common_model->updateDetailsWithMultipleWhere('notification',$whereArr2,$data6);
          }
        }
        }   
    
  }
}
       
  
function event(){

 $StoreId=$this->session->userdata('StoreId');

   $data['totalPage']="";
   $rowno=0;
   $del_status=2;
   $rowperpage = 4;
   $page_from_ajax=$this->input->post('page');
  
   if (isset($page_from_ajax)) 
   {
    $page  = $page_from_ajax; 
   } 
   else { 
     $page=1; 
   }; 
 
   if($page > 0){
          $rowno = ($page-1) * $rowperpage;
   }

   $allcount = $this->NewModel->getrecordCountforpagination('notification',$StoreId);
   $table='notification';
   $users_record = $this->NewModel->getDataforpagelisting( $rowno,$rowperpage,$table,$StoreId);

   $total_pages = ceil($allcount / $rowperpage); 
   $data['listing']= $users_record;
   $data['row'] = $rowno;

   $data['totalPage']=$total_pages;
   $data['page'] =  $page_from_ajax;
 
   $this->load->view('customer/event',$data);
}
// function event(){   
//        $this->load->view('customer/event'); 
// } 
  
  function send_mail(){
       $cusid=$this->uri->segment(3);
       $flg=$this->uri->segment(4);
        $whereArr=array('customer_id'=>$cusid);
        $val =$this->Common_model->getAllDataWithMultipleWhere('Customer',$whereArr,'customer_id');

        $subject=$val['result'][0]->customer_name." greetings from company ";
        $cusemail=$val['result'][0]->cust_email;
        $dtob=$val['result'][0]->DOB;
        $anni=$val['result'][0]->anniversary;
        $sub="cupon gift";
        $month=date('m');
        $date = explode('/', $dtob);
        $dm=$date[1];
        $anni_date = explode('/', $anni);
        $am=$anni_date[1];
        $offervalue=$this->input->post('offervalue');
        $offermonth=$this->input->post('offermonth');
        if($flg==1){
        if($month==$dm){
           if($offermonth==1)
            {
              $option1="Offer is valid only for April";
            }
            if($offermonth==2)
            {
              $option1="Offer is valid on".$dtob;
            }
             $message="Wish you a happy birthday and you have a cupon as a gift of value ".$offervalue."% off on any purchase and ".$option1;

          
         }
     }
     	if($flg==2){
          if($month==$am){
           if($offermonth==1)
            {
              $option1="Offer is valid only for April";
            }
            if($offermonth==2)
            {
              $option1="Offer is valid on".$anni;
            }
             $message="Wish you a happy anniversary and you have a cupon as a gift of value ".$offervalue."% off on any purchase and ".$option1;
             
         }
       }
           $cupon_number=$this->createRandomPassword(); 
           
           $emailId=1;
           $replaceArr=array('[USER]'=>$subject,
                            '[LINK]'=>$message,
                             '[CUPON]'=>$cupon_number );
          $email_cupon_template=$this->Common_model->getEmailTemplateforCupon($emailId,$replaceArr);
          $getTemplateArr = explode('[ESOLZ]', $email_cupon_template);
          $mailSend = $this->Common_model->common_mail_function($cusemail,$getTemplateArr[0],$getTemplateArr[1],'','');
          if($mailSend){
                $this->session->set_userdata('success_msg', 'Successfully mail send to customer');
                $this->insert_values($cusid,$cupon_number,$flg,$offervalue,$offermonth,$dtob);
                 redirect(base_url().'Customer_cont/index'); 
        }
        else{
             $this->session->set_userdata('error_msg', 'Successfully mail not send to customer');
                redirect(base_url().'Customer_cont/index'); 
        }
  }
    function insert_values($cusid,$cupon_number,$flg,$offervalue,$offermonth,$dtob){
    	 $d=date('d');
    	  $m=date('m');
    	   $y=date('Y');
    	$year=$d."/".$m."/".$y;
    	$lastDayThisMonth = date("Y-m-t");

    	$arr1=(explode("/",$year));
       $year1=$arr1[2]."-".$arr1[1]."-".$arr1[0];

    	$arr=(explode("-",$lastDayThisMonth));
    	$lastdate=$arr[2]."/".$arr[1]."/".$arr[0];
    	
    	$arr23=(explode("/",$dtob));
    	$bdaydate=$arr23[0]."/".$arr23[1]."/".$arr[0];
    	
    	 if($offermonth==1){
    	 	$end_date=$lastdate;
    	 	$type_date=2;
    	 }
    	 if($offermonth==2){
    	 	$end_date=$bdaydate;
    	 	$type_date=1;
    	 }
       $arr=(explode("/",$end_date));
       $end_date1=$arr[2]."-".$arr[1]."-".$arr[0];

      $StoreId=$this->session->userdata('StoreId');
      $data=array (     
            'customer_id'=>$cusid,
            'cupon_code'=>$cupon_number,
            'store_id'=> $StoreId,
            'type'=>$flg,
            'discount_on'=>$offervalue,
            'offer_start_date'=>$year1,
            'offer_end_date'=>$end_date1,
            'offer_date_type'=>$type_date
 	 );
    $table='cuponCodeDetials';
    $insert_status = $this->Common_model->insertData($table,$data);

  }
 function createRandomPassword() { 

    $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
    srand((double)microtime()*1000000); 
    $i = 0; 
    $pass = '' ; 

    while ($i <= 7) { 
        $num = rand() % 33; 
        $tmp = substr($chars, $num, 1); 
        $pass = $pass . $tmp; 
        $i++; 
    } 

    return $pass; 

} 
  function showCupon()
  {
        $year=date('Y');
        $cusid=$this->input->post('cusid');
        $month=$this->input->post('month_name');
        $d=$this->input->post('dob');

        $arr=(explode("-",$d));
        $newdate=$arr[2]."/".$arr[1]."/".$year;


        $flg=$this->input->post('flg');
        $whereArr=array('customer_id'=>$cusid);
        $val =$this->Common_model->getAllDataWithMultipleWhere('Customer',$whereArr,'customer_id');
     ?>   
        <div class="modal-content">
             <div class="modal-header">
                  <h4 class="modal-title"><center>Customer-<?php echo ucfirst($val['result'][0]->customer_name);?></center></h4>
              </div>     
             <form id="form_content" method="post" action="<?php echo base_url(); ?>Customer_cont/send_mail/<?php echo $cusid; ?>/<?php echo $flg; ?>"> 
                <div class="modal-body">
                 <div class="row">
                        <label class="col-lg-4 control-label" style="width: 19%;">Offer value:  <span style="color: red;">*</span></label>
                                 <div class="form-group col-lg-6">                                    
                                       <div class="col-lg-11">
                                           <input type="number" min="1" class="form-control" name="offervalue" id="offervalue" label="offervalue" value="">
                                            <span id="offervalue_error" style="color: red"></span>
                                       </div>
                                      <label >%</label>
                                   </div>  
                     </div>  
                 <label class="control-label">Offer Validity : <span style="color: red;">*</span></label>    
                  <div class="row">
                                  <div class=" col-md-12"> 
                                            <label for="chkYes">
                                                <input type="radio" id="offermonth" name="offermonth" value=1 checked />
                                                   <span id="month_show"><?php echo "Offer is valid only for ";echo $month; ?></span>
                                            </label><br>
                                            <label for="chkNo">
                                                <input type="radio" id="offermonth" name="offermonth" value=2 />
                                                   <span id="month_show"><?php echo "Offer is valid on ";echo $newdate; ?></span>
                                            </label>
                                               
                                               
                                  </div>        
                   </div>               
                   
               </div>
                   
                      <div class="modal-footer">
                       
                          <button class="btn btn-primary" type="button" onclick="popupsubmit();" >Submit</button>
                             <button data-dismiss="modal" class="btn btn-default" type="button" >Cancel</button>
                      </div>
                    </form>
                
            </div>

            <?php 

}  
    

            



 function insertCustomer(){          
        $this->load->view('includes/header');
        $this->load->view('includes/sidepanel');
		$this->load->view('customer/addCustomer');
        $this->load->view('includes/footer');
    }	
function insertData(){
	$name=ucfirst($this->input->post('customer_name'));
	$address=$this->input->post('customer_address');
	$phno=$this->input->post('mobile');
  $email=$this->input->post('customer_email');
	$type=$this->input->post('customer_type');
	$StoreId=$this->session->userdata('StoreId');
	$dob=$this->input->post('dob');
	$anni=$this->input->post('anniversary');
	//echo $StoreId;die;
	$data_to_store=array('customer_name'=>$name,
						 'customer_phone'=>$phno,
						 'address'=>$address,
             'cust_email'=>$email,
						 'customer_type'=>$type,
						 'store_id'=>$StoreId,
						 'DOB'=>$dob,
						 'anniversary'=>$anni
        );
	  $insert=$this->Common_model->insertData('Customer',$data_to_store);
	   if($insert){
            $this->session->set_userdata('success_msg', 'customer added successfully');
                 
        }  else{
            $this->session->set_userdata('error_msg', 'Cannot insert customer.');          
        }
  //    $d=date('d');
  //    $m=date('m');
  //    $y=date('Y');
  //    $date=$y."-".$m."-".$d;
   
  //   $insert_id=$this->db->insert_id();	

  //   if($dob != "") {  

  //   $arr= explode('/', $dob);
  //   $dob1=$arr[2]."-".$arr[1]."-".$arr[0];

  //   $data2=array(
  //           'customer_table_id'=>$insert_id,
  //           'store_id'=>$StoreId,
  //           'cupon_title_name'=>$name,
  //           'cupon_type'=>1,
  //           'current_date'=>$date,
  //           'offer_date'=>$dob1
  //   );
  //   $insert_new=$this->Common_model->insertData('notification',$data2);
  // }
  // if($anni != "") {
  //   $arr1= explode('/', $anni);
  //   $anni1=$arr1[2]."-".$arr1[1]."-".$arr1[0];
  
  //   $data2=array(
  //           'customer_table_id'=>$insert_id,
  //           'store_id'=>$StoreId,
  //           'cupon_title_name'=>$name,
  //           'cupon_type'=>2,
  //           'current_date'=>$date,
  //           'offer_date'=>$anni1
  //   );
  //   $insert_new=$this->Common_model->insertData('notification',$data2);
  // }  
    redirect(base_url().'Customer_cont/index');    
  
}
function customer_exists(){
	$StoreId=$this->session->userdata('StoreId');
	if($this->input->post('id')!=''){
		$mobile=$this->input->post('mobile');
		$id=$this->input->post('id');
		
		$whereArr=array('customer_phone'=>$mobile,
					'status'=>1,
					'customer_id<>'=>$id,
					'store_id'=>$StoreId
					);
	}else{
		$mobile=$this->input->post('mobile');
		$whereArr=array('customer_phone'=>$mobile,
					'status'=>1,
					'store_id'=>$StoreId
					);
	}
	//echo "<pre>"; print_r($whereArr);die;
	$customer=$this->Common_model->getAllDataWithMultipleWhere('Customer',$whereArr,'customer_id');
	$num_row=$customer['num_row'];
	echo $num_row;	
}
function edit_customer(){
	  $id = $this->input->post('id');
	  $whereArr=array('customer_id'=>$id);
	  $cutomerData['details']=$this->Common_model->getAllDataWithMultipleWhere('Customer',$whereArr,'customer_id');
	  //echo "<pre>";print_r($cutomerData);die;
	  $this->load->view('customer/editCustomer',$cutomerData);
}
function update_customer(){
	$id=$this->uri->segment(3);
	//echo $id;die;
  $whereArr1=array('customer_id'=>$id);
  $fetch_new=$this->Common_model->getAllDataWithMultipleWhere('Customer',$whereArr1,'customer_id'); 

	$name=$this->input->post('customer_name');
	$address=$this->input->post('address');
	$mobile=$this->input->post('mobile');
  $email=$this->input->post('customer_email');
	$cust_type=$this->input->post('customer_type');
	$dob=$this->input->post('dob');
	$anniversary=$this->input->post('anniversary');
	$whereArr=array('customer_id'=>$id);
	$data_to_update=array('customer_name'=>$name,
						 'customer_phone'=>$mobile,
						 'address'=>$address,
             'cust_email'=>$email,
						 'customer_type'=>$cust_type,
						 'DOB'=>$dob,
						 'anniversary'=>$anniversary);
	$update=$this->Common_model->updateDetailsWithMultipleWhere('Customer',$whereArr,$data_to_update);
	if($update){
		$this->session->set_userdata('success_msg', 'Successfully updated');
			$this->session->set_userdata('error_msg', '');		
	}
	 else
    {
         $this->session->set_userdata('success_msg', '');
         $this->session->set_userdata('error_msg', 'Could not update');  
     }
     
   
    

    //  $StoreId=$this->session->userdata('StoreId');
    // if($fetch_new['result'][0]->DOB != $dob){
    //   $arr= explode('/', $dob);
    //   $dob1=$arr[2]."-".$arr[1]."-".$arr[0];

     
    //   $data2=array(
    //           'cupon_title_name'=>$name,
    //           'offer_date'=>$dob1
    // );
    //    $whereArr1=array('customer_table_id'=>$id,'cupon_type'=>1);
    // $update_new=$this->Common_model->updateDetailsWithMultipleWhere('notification',$whereArr1,$data2);
    // }
    // if($fetch_new['result'][0]->anniversary != $anniversary){
    //   $arr= explode('/', $anniversary);
    //   $anniversary1=$arr[2]."-".$arr[1]."-".$arr[0];

    //   $cupon_title=$name." have birthday on ".$dob;
    //   $data2=array(
    //           'cupon_title_name'=>$name,
    //           'offer_date'=>$anniversary1
    // );
    //    $whereArr1=array('customer_table_id'=>$id,'cupon_type'=>2);
    // $update_new=$this->Common_model->updateDetailsWithMultipleWhere('notification',$whereArr1,$data2);
     
    // }
    redirect(base_url().'Customer_cont/index');
}
function delete_customer(){
	//$id=$this->input->get('id');
	$id=$this->uri->segment(3);
	$whereArr=array('customer_id'=>$id);
	 $data_updt=array('status' => '2');
	$delete=$this->Common_model->updateDetailsWithMultipleWhere('Customer',$whereArr,$data_updt);
	if($delete){
			$this->session->set_userdata('success_msg', 'Successfully deleted');
			$this->session->set_userdata('error_msg', '');
			redirect(base_url().'Customer_cont/index');  			
	}
	 else
    {
         $this->session->set_userdata('success_msg', '');
         $this->session->set_userdata('error_msg', 'Cannot delete');
		 redirect(base_url().'Customer_cont/index');  
     }
}
function more_details(){
	$id=$this->uri->segment(3);
	$StoreId=$this->session->userdata('StoreId');
	//echo $StoreId;die;
	$where=array('store_id'=>$StoreId,
					 'status'=>1,
					 'customer_id'=>$id);
	//echo "<pre>";print_r($where);die;
		$customer['details']=$this->Common_model->getAllDataWithMultipleWhere('Customer',$where,'customer_id');
		//echo "<pre>";print_r($customer);die;
	    $this->load->view('includes/header');
        $this->load->view('includes/sidepanel');
		$this->load->view('customer/more_detail',$customer);
		$this->load->view('includes/footer');
   }









/* function addForm()
{

//    $name="";$address="";$email="";$phoneNumber="";$status="";$note="";
//    if($this->input->post('id')!="")
//    {
//          $vendorId=$this->input->post('id');
//          $whereArr=array('id'=>$vendorId);
//          $data=$this->Common_model->getAllDataWithMultipleWhere('vendorType',$whereArr,'id'); 
//        
//          $name=$data['result'][0]->name;
//          $address=$data['result'][0]->details;
//          $email=$data['result'][0]->email;
//          $phoneNumber=$data['result'][0]->phoneno;
//          $status=$data['result'][0]->status;
//          $note=$data['result'][0]->note;
//    }

 //$unit=$this->Common_model->fetchAllData('UnitType','unit_id','DESC');
 $whereArr=array('status'=>1);
$customer_type=$this->Common_model->getAllDataWithMultipleWhere('customer_type',$whereArr,'id');
//echo "<pre>";print_r($customer_type);die;
?> 
<div class="panel-body">
     <div class="position-center">
         
         <form role="form"  action="<?php echo base_url(); ?>Customer_cont/insertData" method="post" id="updt" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group">
                        <div class=" col-md-6">
                                <input type="hidden" name="mode" value="updateDetails">
                                    <label class="control-label">Customer Name</label> <span style="color: red;">*</span>
                                    <input  type="text"  placeholder="Customer Name" class="form-control test" name="customer_name" id="customer_name" label="customer_name">
                            <span id="name_error" style="color: red"></span><br>
                        </div>
						
						 <div class=" col-md-6">
                             <label class="control-label">Mobile</label> <span style="color: red;">*</span>
                               <input  type="number"  placeholder="Mobile" class="form-control test" name="mobile" id="mobile" label="mobile" onblur="check_if_exists();" min="0">
                            
                    <span id="phoneno_error" style="color: red"></span><br>
                </div>
    
</div>
</div>
					
 <div class="row">
     <div class="form-group">
         <div class=" col-md-6">
			
                    <label class="control-label">Address</label>
					<textarea  placeholder="Customer Address" class="form-control test" name="customer_address" id="customer_address" label="customer_address"></textarea>
        </div> 
       
        
   

 
 <div class=" col-md-6">
         <label class="control-label">Customer Type</label>
 <select class="form-control " style="color: black" id="customer_type" name="customer_type" label="customer_type"   data-max-options="1">
	<option value="select">select</option>
		<?php
			foreach($customer_type['result'] as $type){?>
			<option value="<?php echo $type->id;?>"><?php echo $type->name;?></option>
			<?php }
		?>
 </select>
 </div>
	 </div>
 </div>
 
 
 

 
<div class="row">
     <div class="form-group">
       

         <div class="save_but">
        
         
         <button type="button" class="btn btn-default btn pull-right" id="cnbtn" onclick="location.href='<?php echo base_url(); ?>Customer_cont/index'" style="margin: 10px;">Cancel</button>
              <button type="button" class="btn btn-primary btn pull-right" id="btn" onclick="validate_frm();" style="margin: 13px;">Save</button>

         </div>
     </div>
</div>
 
 
 
 
 
</form>

    </div>
</div>
        
        
        
    
<?php }*/
    
   function addForm(){
			$this->load->view('customer/add_customer');
	} 
    


function loadmore(){
	$row=$this->input->post('row');
	$rowperpage=$this->input->post('rowperpage');
	$cust_id=$this->input->post('cust_id');
	//echo $row;
	//echo $cust_id;die;
	$where=array('customer_id'=>$cust_id);
	$order=$this->Common_model->getAllDataWithMultipleWhere('Order',$where,'order_id','DESC',$row,$rowperpage);
	echo "<pre>";print_r($order);die;
	echo $rowperpage;
	echo $row;die;
}
    
    
    
    
    function import(){
        
        
  //echo "hello";die;
       $this->load->library('excel');
  if(isset($_FILES["file"]["name"]))
  {
   // echo $_FILES["file"]["tmp_name"];
   $path = $_FILES["file"]["tmp_name"];
   $object = PHPExcel_IOFactory::load($path);
   foreach($object->getWorksheetIterator() as $worksheet)
   {
    $highestRow = $worksheet->getHighestRow();
    $highestColumn = $worksheet->getHighestColumn();
    for($row=2; $row<=$highestRow; $row++)
    {
     $customer_name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
     $customer_phone = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
     $cust_email = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
     $address=$worksheet->getCellByColumnAndRow(3, $row)->getValue();
    $customer_type=$worksheet->getCellByColumnAndRow(4, $row)->getValue();
        
      $whereArr=array('name'=>$customer_type);
    $val =$this->Common_model->getAllDataWithMultipleWhere('customer_type',$whereArr,'id');  
        $customer_id=$val['result'][0]->id;
        
    $DOB=$worksheet->getCellByColumnAndRow(5, $row)->getValue();
    $anniversary=$worksheet->getCellByColumnAndRow(6, $row)->getValue();
     $data[] = array(
      'customer_name'  => $customer_name,
      'customer_phone'   => $customer_phone,
      'cust_email'    => $cust_email,
      'address'    => $address,
      'customer_type'    => $customer_id,
     'store_id'=> $this->session->userdata('StoreId'),
      'DOB'    => $DOB,
      'anniversary'    => $anniversary
         
         
        
     );
    }
   }
      //print_r($data);die;
   $this->excel_import_model->insert($data,'Customer');
   echo 'Data Imported successfully';
  } 
           
        
 }
    
}


?>