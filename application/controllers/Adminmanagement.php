 <?php
class Adminmanagement extends CI_Controller {
   // Controller class for site_settings
    function __construct()
{
               parent::__construct();
               $this->load->library('session');
               $this->load->model('Common_model');
               $this->load->model('excel_import_model');
               // $this->load->library('excel');
               
             
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
		$StoreId=$this->session->userdata('StoreId');
		$userId=$this->session->userdata('id');
	   $this->load->view('includes/header');
        $this->load->view('includes/sidepanel');
		$where=array('id'=>$userId);
		$data1=$this->Common_model->getAllDataWithMultipleWhere('Admin',$where,'Id');
		$storeAcces=$data1['result'][0]->storeIdAccess;
		$storeArr=explode(",",$storeAcces);
		$storeCount=count($storeArr);
		//echo $storeCount;die;
		//print_r($storeArr);die;
		//echo "<pre>";print_r($data1);die;
		for($i=0;$i<$storeCount;$i++){
		print_r( $storeArr[$i]);	
		}
		 $whereArr = array('isSuperAdmin' => '0',
						   'storeId'=>$StoreId,
						  'Id<>'=>$userId );
		 //$a=$this->Common_model->getAllDataWithMultipleWhere('subadmin',$whereArr,'id');

		$data['listing']=$this->Common_model->getAllDataWithMultipleWhere('Admin',$whereArr,'Id');
	    //echo "<pre>";print_r($data);die;
		
		$this->load->view('subAdmin/subAdminDetails',$data);

        $this->load->view('includes/footer');
	}

    //##################################### IMPORT #########################################//
    function import()
 {
    //echo "hello";
        $this->load->library('excel');
  if(isset($_FILES["file"]["name"]))
  {
    //echo $_FILES["file"]["tmp_name"];die;
   $path = $_FILES["file"]["tmp_name"];
   $object = PHPExcel_IOFactory::load($path);
   foreach($object->getWorksheetIterator() as $worksheet)
   {
    $highestRow = $worksheet->getHighestRow();
    $highestColumn = $worksheet->getHighestColumn();
    for($row=2; $row<=$highestRow; $row++)
    {
     $sub_admin_name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
     //echo $sub_admin_name;die;
     $email = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
     $phone = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
     $username = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
     $password = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
     $data[] = array(
      'Name' => $sub_admin_name,
      'email' => $email,
      'phoneno' => $phone,
      'Store_name' => $username,
      'password' =>$password
     );
    }
   }
   //echo "<pre>";print_r($data);die;
   $this->excel_import_model->insert($data,'Admin');
   echo 'Data Imported successfully';
  } 
 }
    //##################################### END FOR IMPORT ##################################//

    //####################################### EXPORT AS EXCEL############################### //
    public function excel()
    {
        $StoreId=$this->session->userdata('StoreId');
        $userId=$this->session->userdata('id');
        $whereArr = array
            (
            'isSuperAdmin' => '0',
            'storeId'=>$StoreId,
            'Id<>'=>$userId 
            );
        $data['listing']=$this->Common_model->getAllDataWithMultipleWhere('Admin',$whereArr,'Id');
        //echo "<pre>";print_r($data);die;
        require(APPPATH .'libraries/PHPExcel.php');
        require(APPPATH .'libraries/PHPExcel/Writer/Excel2007.php');

        $objPHPExcel =new PHPExcel();

        $objPHPExcel->getProperties()->setCreator("");
        $objPHPExcel->getProperties()->setLastModifiedBy("");
        $objPHPExcel->getProperties()->setTitle("");
        $objPHPExcel->getProperties()->setSubject("");
        $objPHPExcel->getProperties()->setDescription("");

        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->SetCellValue('A1','Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1','UserName');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1','Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1','PhoneNo');

        $row=2;

        foreach ($data['listing']['result'] as $value)  
         {
            
            
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$value->Name);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$value->Store_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$value->email); 
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$value->phoneno); 

            $row++;
         }

         $filename="Tasks-Exported-on".date("Y-m-d-H-i-s").'.xlsx';
         $objPHPExcel->getActiveSheet()->setTitle("Task-overview");

         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment;filename='.$filename);
         header('Cache-Control: max-age=0');

         $writer= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
         $writer->save('php://output');
         exit;

    }
    //####################################### END FOR EXPORT AS EXCEL#######################//

	function insertSubadmin(){
        
        $this->load->view('includes/header');
        $this->load->view('includes/sidepanel');
		$this->load->view('subAdmin/addSubadmin');
        $this->load->view('includes/footer');
    }
    function insertdata(){
       $id= $this->session->userdata('id');
       $page =	$this->input->post('pageaccess');
       $storeAccess = $this->input->post('storename');
       $originalPass = $this->input->post('password');
	   $storeId=$this->session->userdata('StoreId');
	   $whereArray=array('mandatory'=>1);
	   $mandetory=$this->Common_model->getAllDataWithMultipleWhere('sidepanel',$whereArray,'id');
	   $mandatoryId=$mandetory['result'][0]->id;
	   //echo $mandatoryId;die;
	   //echo "<pre>";print_r($mandetory);die;
	   $pageAccess=implode(",",$page);
	   $pageAccess=$pageAccess.",".$mandatoryId;
	   //echo "<pre>";print_r($pageAccess);die;
        $data_ins=array(
                    'Name' => ucfirst($this->input->post('subadminName')),
                    'email' => $this->input->post('email'),
                    'Store_name' => $this->input->post('username'),
                    'password' =>md5($this->input->post('password')),
                    'originalPassword' =>$originalPass,
                    'phoneno' => $this->input->post('phoneno'),
                    'status'=> $this->input->post('status'),
                    'pageaccess' =>$pageAccess,
                    //'storeIdAccess'=>implode(",",$storeAccess),
					'storeId'=>$storeId
                        );
                    
            
                
           $insert=$this->Common_model->insertData('Admin',$data_ins); 
        if($insert){
                //$this->session->set_userdata('msg', 'Successfully inserted unit');
            $this->session->set_userdata('success_msg', 'subadmin added successfully');
                redirect(base_url().'Adminmanagement/index'); 
        }
        else{
             //$this->session->set_userdata('msg', ' not inserted');
            $this->session->set_userdata('error_msg', 'Cannot insert subadmin.');
                redirect(base_url().'Adminmanagement/index'); 
        }
            }


    function editSubAdmin(){
         
        
            $this->load->view('includes/header');
            $this->load->view('includes/sidepanel');

            $id = $this->uri->segment(3);
            $whereArrayLogin = array('id'=>$id);        
            $data['subadmin_data']=$getarticleData=$this->Common_model->getAllDataWithMultipleWhere('Admin',$whereArrayLogin,'id');
			//echo "<pre>";print_r($data);die;
            $this->load->view('subAdmin/editSubAdmin',$data);
            $this->load->view('includes/footer');
    }

    function updateSubAdmin()
    {
        //echo "<pre>";print_r($_REQUEST);die;
        if($this->input->post('mode_article')=='update_article')
        {
            //$id=$this->uri->segment(3);
            $id= $this->input->post('id');
            //echo $id;
            $subadminName = strtolower(trim($this->input->post('subadminName')));
            //$last_name = strtolower(trim($this->input->post('last_name')));
            $urltitle = strtolower(trim($this->input->post('subadminEmail')));
            $store_name=$this->input->post('username');
            $phone=$this->input->post('phoneno');
            $password=md5($this->input->post('password'));
            $originalPass = $this->input->post('password');

            //$status=$this->input->post('status');

            $page = $this->input->post('pageaccess');
            $store= $this->input->post('storename');
			//echo "<pre>";print_r($page);die;
			  $whereArray=array('mandatory'=>1);
			  $mandetory=$this->Common_model->getAllDataWithMultipleWhere('sidepanel',$whereArray,'id');
	          $mandatoryId=$mandetory['result'][0]->id;
			  //echo $mandatoryId;die;
			  array_push($page,$mandatoryId);
				//echo "<pre>";print_r($page);die;
            $subadminStatus = trim($this->input->post('status'));
            //$address = trim($this->input->post('address'));
            $data_to_store=array('Name' => $subadminName,'email' => $urltitle,'Store_name' => $store_name,'password' => $password,'originalPassword' => $originalPass,'phoneno' => $phone,'status' => $subadminStatus,'pageaccess' =>implode(",",$page));
            //$data_to_store=array('uname' => $first_name,'lastname' => $last_name,'email' => $url_title_new);
            $whereArray = array('id'=>$id);
            $update_data = $this->Common_model->updateDetailsWithMultipleWhere('Admin',$whereArray,$data_to_store);
            //$update_data = $this->Common_model->updateDetailsWithMultipleWhere('admin',$whereArray,$data_to_store);
            if($update_data)
            {
                $this->session->set_userdata('success_msg', 'subadmin updated successfully');
            }
            else
            {
                $this->session->set_userdata('error_msg', 'Cannot update duplicate data.');
            }
            redirect(base_url().'Adminmanagement');
        }
    }

    function changeStatusReview()
    {
        $Id = $this->uri->segment(3);
        $Status = $this->uri->segment(4);
        //========= update email template status ==========//
        $whereArrayVal = array('id' => $Id);
        $data_to_store = array('status' => $Status);
        $updtData = $this->Common_model->updateDetailsWithMultipleWhere('Admin',$whereArrayVal,$data_to_store);
        //========= update email template status ==========//
        
        $this->session->set_userdata('success_msg', ' status has been updated successfully.');
        redirect(base_url().'Adminmanagement/index');
    }

    function deleteData()
    {
        $Id = $this->uri->segment(3);
        
        //===== fetch data from img table =====//
         $whereArray = array('id'=>$Id);
             $data_store=array(
                    'status' => "2");
        $update_data = $this->Common_model->updateDetailsWithMultipleWhere('Admin',$whereArray,$data_store);
        if($update_data)
            {
                $this->session->set_userdata('success_msg', 'subadmin deleted successfully');
            }
            else
            {
                $this->session->set_userdata('error_msg', 'Error in deleting subadmin.');
            }
        redirect(base_url().'Adminmanagement/index'); 

    }

    //=================email check with ajax for sub admin=======================//
    function username_check(){
         $username=$this->input->post('username');
         $StoreId=$this->session->userdata('StoreId');


         //echo $email;die;
         $whereArr = array('Store_name' => $username,'storeId'=>$StoreId);
         // echo '<pre>';
         // print_r($whereArr);
         // die;
         $a=$this->Common_model->getAllDataWithMultipleWhere('Admin',$whereArr,'id');
         //$a=$this->Common_model->getAllDataWithMultipleWhere('admin',$whereArr,'id');
         //echo "<pre>";print_r($a);die;
         $num_row=$a['num_row'];
         echo $num_row;
         //print_r($a);
    }    

    function email_check() {
        
        $email=$this->input->post('email');


         //echo $email;die;
         $whereArr = array('email' => $email);
         // echo '<pre>';
         // print_r($whereArr);
         // die;
         $a=$this->Common_model->getAllDataWithMultipleWhere('Admin',$whereArr,'id');
         //$a=$this->Common_model->getAllDataWithMultipleWhere('admin',$whereArr,'id');
         //echo "<pre>";print_r($a);die;
         $num_row=$a['num_row'];
         echo $num_row;
    }

    function email_checking() {
        $id= $this->input->post('id');
        //echo $id;
        $email=$this->input->post('email');
        //echo $email;

         //echo $email;die;
         $whereArr = array('id <>' => $id , 'email' => $email);
         // echo '<pre>';
         // print_r($whereArr);
         // die;
         $a=$this->Common_model->getAllDataWithMultipleWhere('Admin',$whereArr,'id');
         //$a=$this->Common_model->getAllDataWithMultipleWhere('admin',$whereArr,'id');
         //echo "<pre>";print_r($a);
         $num_row=$a['num_row'];
         echo $num_row;
    }

     function username_checking(){
        $id= $this->input->post('id');
         $username=$this->input->post('username');


         //echo $email;die;
         $whereArr = array('id <>' =>$id , 'Store_name' => $username);
         // echo '<pre>';
         // print_r($whereArr);
         // die;
         $a=$this->Common_model->getAllDataWithMultipleWhere('Admin',$whereArr,'id');
         //$a=$this->Common_model->getAllDataWithMultipleWhere('admin',$whereArr,'id');
         //echo "<pre>";print_r($a);die;
         $num_row=$a['num_row'];
         echo $num_row;
         //print_r($a);
    }    

	


//new form
function addForm()
{
	$this->load->view('subAdmin/add_subadmin');
 }



function edit(){
        
        

	  
	  $this->load->view('subAdmin/editSubAdmin');
	  
}

}
