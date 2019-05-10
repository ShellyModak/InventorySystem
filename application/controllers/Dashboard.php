<?php
class Dashboard extends CI_Controller {
   // Controller class for site_settings
	function __construct()
{
              parent::__construct();
              $this->load->library('session');
              $this->load->model('Common_model');
              $this->load->model('NewModel');
              $this->load->library('upload');
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
		$this->load->view('Dashboard/dashboard');
    $this->load->view('includes/footer');
	}
  public function customer_type_duplicate_edit(){
    $phnmbr=$this->input->post('phnmbr');
    $uid=$this->input->post('uid');
 
    $whereArray = array('phoneno'=>$phnmbr, 'status <>'=>'2');
    $data=$this->Common_model->getAllDataWithMultipleWhere('Admin',$whereArray,'id','ASC');
    if($data['num_row']>0){
      if($data['result'][0]->id!=$uid){
        echo 1;
      }
    }
    else{
      echo 0;
    }
  }

 
	public function profile()
    {
        $this->load->view('includes/header');
        $this->load->view('includes/sidepanel');
         $id= $this->session->userdata('id');
         $whereArr=array('id'=>$id);
        $data['listing']=$this->Common_model->getAllDataWithMultipleWhere('Admin',$whereArr,'id');
        $this->load->view('Dashboard/profile',$data);
        $this->load->view('includes/footer');
    }
    public function cngpassword(){
      $id=$this->uri->segment(3);
      
      $newpass=$this->input->post('newpass');
      
      
      $data2=array(
              'password'=>md5($this->input->post('newpass')),
              'originalPassword'=>$newpass
            );
      $whereArr=array('id'=>$id);
      $updt_status = $this->Common_model->updateDetailsWithMultipleWhere('Admin',$whereArr,$data2);
      redirect(base_url().'Dashboard/profile');
    }
    public function updateprofile(){
        $id=$this->uri->segment(3);

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
        $name=$this->input->post('name');
        $designation=$this->input->post('designation');
        $phnumber=$this->input->post('phnumber');
        $birth_date=$this->input->post('birth_date');
        $salary=$this->input->post('salary');
        $address=$this->input->post('address');
        $adminDetails=$this->input->post('adminDetails');
        $birth_date1=date_create($birth_date);
        $birth_date2=date_format($birth_date1,"Y/m/d");
        $whereArr=array('id'=>$id);
        $Admin=$this->Common_model->getAllDataWithMultipleWhere('Admin',$whereArr,'id');
        $fst_salary= $Admin['result'][0]->salary;
        $designation_id=$Admin['result'][0]->designation_id;
       
        

        if($salary!=$fst_salary){
         $new="Increase salery Rs.".$fst_salary." to Rs.".$salary;
          $uid= $this->session->userdata('id');
          $data2=array(
              'user_id'=>$uid,
              'type'=>'1',
              'purpose'=>'1',
              'message'=>$new,
              'date'=>date("Y/m/d")
            );
          $table='activity';
          $insert_status = $this->Common_model->insertData($table,$data2);
        }
        if($designation!=$designation_id){
           $uid= $this->session->userdata('id');
          $whereArr2=array('id'=>$designation);
          $activity1=$this->Common_model->getAllDataWithMultipleWhere('designation',$whereArr2,'id');
          $scnd_designation=$activity1['result'][0]->designation;

          $whereArr1=array('id'=>$designation_id);
          $activity=$this->Common_model->getAllDataWithMultipleWhere('designation',$whereArr1,'id');
          $fst_designation=$activity['result'][0]->designation;
          $newdeg="Change designation ".$fst_designation." to ".$scnd_designation;
          
            $data2=array(
              'user_id'=>$uid,
              'type'=>'1',
              'purpose'=>'2',
              'message'=>$newdeg,
              'date'=>date("Y/m/d")
            );
          $table='activity';
          $insert_status = $this->Common_model->insertData($table,$data2);
        }
           $data=array (
            'Name'=> $name,
            'designation_id' => $designation,
            'phoneno'=>$phnumber,
            'bdate'=>$birth_date2,
            'salary'=>$salary,
            'address'=>$address,
            'details'=>$adminDetails,
            'image' =>$file_name
               );
        
        $whereArray = array('id' => $id);
        $updt_status = $this->Common_model->updateDetailsWithMultipleWhere('Admin',$whereArray,$data);

        

        redirect(base_url().'Dashboard/profile');
    }
    public function customer_type_edit()
    {
        $id=$this->input->post('id');
       
        $whereArr=array('id'=>$id);
        $data['listing']=$this->Common_model->getAllDataWithMultipleWhere('Admin',$whereArr,'id');
        $this->load->view('Dashboard/profileedit',$data);
       

     } 
     
	 public function Logout()
    {
        $this->session->sess_destroy();
         redirect(base_url().'Login');
    }
    
    public function showDays()
    {
        $monthNumber=$this->input->post('monthNumber');
      
        if(strlen((string)$monthNumber)==1)
                    {
                        $monthNumber='0'.$monthNumber;
                    }
         $YearNumber=$this->input->post('YearNumber');
          
          $days=cal_days_in_month(CAL_GREGORIAN,$monthNumber,$YearNumber);
          $dayArray=array();
          $orderArray=array();
          $priceArray=array();
          for($i=1;$i<=$days;$i++)
          {
              
              array_push($dayArray,$i);
              
              if($i<10)
                    {
                        $day='0'.$i;
                    }
              
                $day=$i;
              
               $date=$day.'-'.$monthNumber.'-'.$YearNumber;
               
               
               
               $whereArr=array('orderDate'=>$date,'storeId'=>$this->session->userdata('StoreId'));
               $order_details_arr=$this->Common_model->getAllDataWithMultipleWhere('Order',$whereArr,'order_id');
            
              $orderno=0;
               $price=0;
               $avgPrice=0;
              
              if($order_details_arr['num_row']>0)
              {
                   foreach($order_details_arr['result'] as $order)
                   {
                         $orderno++;
                         $price=$price+$order->paidAmount;
                   }
                   $avgPrice=floor($price/$orderno);
              }
               array_push($priceArray,$avgPrice);
               array_push($orderArray,$orderno);
          }
        
        if($YearNumber==date('Y'))
            $totalMonth=date('m');
        else
            $totalMonth=12;
        
        $option="";
       
        
        
        for($j=1; $j<=$totalMonth; $j++)
        {
            $selected="";
            if($j==$this->input->post('monthNumber'))
            {
                $selected= 'selected';
            }
       
        $option.='<option value="'.$j.'"'.$selected.'>'.date("F", mktime(0, 0, 0, $j, 10)).'</option>';
         
        }
         
       
       
        echo json_encode($dayArray)."Arnab".json_encode($orderArray)."Arnab".json_encode($priceArray)."Arnab".$option;

      
         
         
    }
     
}
?>