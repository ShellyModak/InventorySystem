<?php
class Material_cont extends CI_Controller {
   // Controller class for site_settings
	function __construct()
{
               parent::__construct();
        
       
                $this->load->model('excel_import_model');
              //  $this->load->library('excel');
               $this->load->library('session');
               
               $this->load->model('Common_model');
               $this->load->model('NewModel');
             
               $id= $this->session->userdata('id');
               
               $whereArr=array('id'=>$id);
               $admin_val_arr=$this->Common_model->getAllDataWithMultipleWhere('Admin',$whereArr,'id');
       
       if(($admin_val_arr['result'][0]->pageAccess!="") && ($admin_val_arr['result'][0]->isSuperAdmin!=1))
       {
           
               $link=$this->uri->segment(1)."/show";
               $page_name="Raw material";
               $whereArr=array('link'=>$link);
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
    
  
}   function index()
	{
	}
  function import(){
        $this->load->library('excel');
     $id= $this->session->userdata('id');
     $StoreId=$this->session->userdata('StoreId');
  //echo "hello";die;
       
  if(isset($_FILES["file"]["name"]))
  {
 //   echo $_FILES["file"]["tmp_name"];die;
   $path = $_FILES["file"]["tmp_name"];
   $object = PHPExcel_IOFactory::load($path);
   foreach($object->getWorksheetIterator() as $worksheet)
   {
    $highestRow = $worksheet->getHighestRow();
    $highestColumn = $worksheet->getHighestColumn();
    for($row=2; $row<=$highestRow; $row++)
    {
     $material_name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
     $unit_name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
   
        $whereArr=array('unit_name'=>$unit_name);
    $val =$this->Common_model->getAllDataWithMultipleWhere('UnitType',$whereArr,'unit_id');  
        $unit_id=$val['result'][0]->unit_id;
    
        $vendor_id = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
        
//        $whereArr=array('name'=>$vendor_name);
//    $val =$this->Common_model->getAllDataWithMultipleWhere('vendorType',$whereArr,'vendor_id');  
//        $vendor_id=$val['result'][0]->id;
//        
     $data[] = array(
      'material_name'  => $material_name,
      'unit_id'   => $unit_id,
      'vendor_id'    => $vendor_id,
    'admin_subadmin_id'=>$id,
    'store_id'=>$StoreId,
     );
    }
   }
   $this->excel_import_model->insert($data,'RawMaterial');
   echo 'Data Imported successfully';
  } 
           
        
 }
    
    function show()
	{
        $whereArr=array('status<>'=>"2",'store_id'=>$this->session->userdata('StoreId'));
        $data['listing']=$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArr,'material_id');
        
        $whereArr=array('status<>'=>"2",'storeId'=>$this->session->userdata('StoreId'));
        $data['vendor']=$this->Common_model->getAllDataWithMultipleWhere('vendorType',$whereArr,'id');
       
       // $data['listing']=$this->Common_model->fetchAllData('RawMaterial','material_id','DESC');
        $data['unit']=$this->Common_model->fetchAllData('UnitType','unit_id','DESC');
        //$data['vendor']=$this->Common_model->fetchAllData('vendorType','id','DESC');
		$this->load->view('includes/header');
        $this->load->view('includes/sidepanel');
		$this->load->view('Raw-material-management/materialListing',$data);
        $this->load->view('includes/footer');
	}
    function insertview(){
        $data['unit']=$this->Common_model->fetchAllData('UnitType','unit_id','DESC');
        $data['vendor']=$this->Common_model->fetchAllData('vendorType','id','DESC');
        $this->load->view('includes/header');
        $this->load->view('includes/sidepanel');
		$this->load->view('Raw-material-management/addMaterial',$data);
        $this->load->view('includes/footer');
    }
   
    function addForm()
     {
 //$classnew;
  $whereArr=array('status<>'=>"2",'storeId'=>$this->session->userdata('StoreId'));
$vendor=$this->Common_model->getAllDataWithMultipleWhere('vendorType',$whereArr,'id');
  //$val=$this->Common_model->leftpaneldata();
  $col1=6;$col2=4;
  $data=$vendor['num_row'];
  //echo $data;die;
  $mod1=$data%$col1;
  $mod2=$data%$col2;
  $row1=round(($data/$col1)+1);
  $row2=round(($data/$col2)+1);
  $last_row1=$col1-$mod1;
  $last_row2=$col2-$mod2;
  $percentage1=round((($last_row1/$col1)*100));
  $percentage2=round((($last_row2/$col2)*100));
  if($percentage1>$percentage2){
	$row=$row1;
  }else{
	$row=$row2;
  }
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

 $unit=$this->Common_model->fetchAllData('UnitType','unit_id','DESC');
 

?> 
<div class="panel-body">
     <div >
         <form role="form"  action="<?php echo base_url(); ?>Material_cont/insert_material" method="post" id="updt" enctype="multipart/form-data" onsubmit=" return validateForm();">
                <div class="row">
                    <div class="form-group">
                        <div class=" col-md-3">
                                <input type="hidden" name="mode" value="updateDetails">
                                    <label class="control-label">Material Name<span style="color: red;">*</span></label>    
                                    <input  type="text"  placeholder="Material Name" class="form-control test" name="materialname" id="material" label="Material" onblur="check_if_exists();">
                            <span id="name_error" style="color: red"></span><br>
                        </div> 
                        <div class=" col-md-3">
                                    <label class="control-label">Enter Unit<span style="color: red;">*</span></label>
                                <select name="unit" class=" form-control unit_test"  id="unit" label="Unit" >
                                        <option value="" >Select</option>
                                         <?php 
                                            foreach($unit['result'] as $row1): 
                                            if($row->status != 2){ ?>
                                              <option value="<?php echo $row1->unit_id?>"><?php echo $row1->unit_name?></option> 
                                         <?php }      
                                        endforeach;?>
                                </select>
                                <span id="unit_error" style="color: red"></span><br>
                        </div>
                        <div class=" col-md-3">
                                    <label class="control-label">Status</label>
                                <select class="form-control " id="status" name="status" label="status"   data-max-options="1">
                                        <option value="1" >Active</option>
                                        <option value="0">Inactive</option></select>
                                <span id="status_error" style="color: red"></span><br>
                        </div> 
                        <div class=" col-md-3">
                                <label class="control-label">Note</label>
                                <textarea class="form-control test"  name="note" rows="1" value=""></textarea>
                                <span id="note" style="color: red"></span>
                        </div>
                    </div>
             </div>
             <hr>
            <div class="row">
                <div class="form-group">
                    <div class=" col-md-12">  
                        <label class="control-label">Select Vendor<span style="color: red;">*</span></label>
                            <fieldset class="group">     
                                <ul class="checkbox underLine">      
										 <?php
											  if(!empty($vendor)){
												foreach($vendor['result'] as $value){ //echo "<pre>"; print_r($value);
												?>
											<?php if($row==5){?>
												 <li class="line <?php echo 'a'?>"> <input type="checkbox" value="<?php echo $value->id?>" name=vendor[] class="test_vendor"  label=Vendor  ><?php echo ucfirst($value->name);?>
                                                 </li>
											<?php } ?>
											
											<?php if($row==4){?>
												<li class="line <?php echo 'b'?>"> <input type="checkbox" value="<?php echo $value->id?>" name=vendor[] class="test_vendor"  label=Vendor  ><?php echo ucfirst($value->name);?>
                                                 </li>
											<?php } ?>
											
											<?php if($row==3){?>
												<li class="line <?php echo 'c'?>"> <input type="checkbox" value="<?php echo $value->id?>" name=vendor[] class="test_vendor"  label=Vendor  ><?php echo ucfirst($value->name);?>
                                                 </li>
											<?php } ?>
											
											<?php if($row==2){?>
												<li class="line <?php echo 'd'?>"> <input type="checkbox" value="<?php echo $value->id?>" name=vendor[] class="test_vendor"  label=Vendor  ><?php echo ucfirst($value->name);?>
                                                 </li>
											<?php } ?>
											
											<?php if($row==1){?>
												<li class="line <?php echo 'e'?>"> <input type="checkbox" value="<?php echo $value->id?>" name=vendor[] class="test_vendor"  label=Vendor  ><?php echo ucfirst($value->name);?>
                                                 </li>
											<?php } ?>
										<?php   }
										       }?>
                                </ul>
                            </fieldset>
                            <span id="vendor_error" style="color: red"></span><br>
                    </div>
                </div>
            </div>
 
        <div class="row">
            <div class="form-group">
                <div class="save_but">
                    <button type="button" class="btn btn-default btn pull-right" id="btn" onclick="addNewForm('')" style="margin-left:5px">Cancel</button>
                    <button type="submit" class="btn btn-primary btn pull-right" id="btn" style="margin-right: 5px;
 ">Save</button>
                </div>
            </div>
        </div>
                                    
        </form>
    </div>
</div>
        
        
        
    
<?php }
    
    
    
    function show_add_material(){?>
        
                   
                        
        
        
        
   <?php     
    }
     public function insert_material()
    { 
         $id= $this->session->userdata('id');
         $StoreId=$this->session->userdata('StoreId');
        // echo $StoreId;die;
     $data_ins=array(
                    'material_name' => $this->input->post('materialname'),
                    'unit_id'=>$this->input->post('unit'),
                    'vendor_id'=>implode(",",$this->input->post('vendor')),
                    'admin_subadmin_id'=>$id,
                    'store_id'=>$StoreId,
                    'status'=>$this->input->post('status'),
                    'note'=>$this->input->post('note')
                    
                    );
            
              // print_r($data_ins);die;
           $insert=$this->Common_model->insertData('RawMaterial',$data_ins); 
        if($insert){
                $this->session->set_userdata('success_msg', 'Successfully inserted material');
                redirect(base_url().'Material_cont/show'); 
        }
        else{
             $this->session->set_userdata('error_msg', 'material not inserted');
                redirect(base_url().'Material_cont/show'); 
        }
    }
    
    
    function edit(){
        
        
        $id=$this->input->post('id');
     $edit=$this->NewModel->fetch_data('RawMaterial',array('material_id'=>$id));
        $unit=$this->Common_model->fetchAllData('UnitType','unit_id','DESC');
        //$vendor=$this->Common_model->fetchAllData('vendorType','id','DESC');
        
        $whereArr=array('status<>'=>"2",'storeId'=>$this->session->userdata('StoreId'));
        $vendor=$this->Common_model->getAllDataWithMultipleWhere('vendorType',$whereArr,'id');
        
       // $data['edit']=$this->Common_model->getAllDataWithMultipleWhere('UnitType',array('unit_id'=>$id));
        
//        $this->load->view('includes/header');
//        $this->load->view('includes/sidepanel');
//		$this->load->view('Raw-material-management/editMaterial',$data);
//        $this->load->view('includes/footer');
        ?>
        <?php    foreach ($edit as $row)  
                        { 
                            $arry=explode(",",$row->vendor_id);
                        ?>
<div class="panel-body">
     <div>
         
        <form role="form"  action="<?php echo base_url(); ?>Material_cont/updateMaterial/<?php echo $row->material_id ; ?>" method="post" id="updt" enctype="multipart/form-data" onsubmit=" return validateForm();">
                <div class="row">
                    <div class="form-group">
                        <div class=" col-md-3">
                                <input type="hidden" name="mode" value="updateDetails">
                                    <label class="control-label">Material Name<span style="color: red;">*</span></label>    
                                    <input  type="text"  placeholder="Material Name" class="form-control test" name="materialname" id="material" label="Material" onblur="check_if_exists();"value="<?php echo $row->material_name ?>">
                            <span id="name_error" style="color: red"></span><br>
                        </div>          
                        <div class=" col-md-3">
                                    <label class="control-label">Enter Unit<span style="color: red;">*</span></label>
                                    <select name="unit" class=" form-control unit_test"  id="unit" label="Unit" >
                                        <option value="" >Select</option>
                                         <?php 
                                            foreach($unit['result'] as $row1): 
                                             if($row1->status != 2 ) { ?>
                                              <option  value="<?php echo $row1->unit_id?>" <?php if($row1->unit_id==$row->unit_id){?> selected <?php } ?>><?php echo $row1->unit_name?></option> 
                                         <?php  }     
                                            endforeach;?>
                                    </select>
                                    <span id="unit_error" style="color: red"></span><br>
                        </div>    
                        <div class=" col-md-3">
                                    <label class="control-label">Status</label>
                                    <select class="form-control " id="status" name="status" label="status"   data-max-options="1">
                                        <option value="1" <?php if($row->status==1) echo 'selected';?>>Active</option>
                                       <option value="0" <?php if($row->status==0) echo 'selected';?>>Inactive</option>
                                    </select>
                                    <span id="status_error" style="color: red"></span>
                        </div> 
                        <div class=" col-md-3">
                                     <label class="control-label">Note</label>
                                     <textarea class="form-control test"  name="note" rows="1" value=""><?php echo $row->note ?></textarea>
                                    <span id="note" style="color: red"></span>
                        </div>
                    </div>
                </div>
                <hr>
         <div class="row">
            <div class="form-group">  
                    <div class=" col-md-12">
                         <label class="control-label">Select Vendor<span style="color: red;">*</span></label>
                            <fieldset class="group">     
                                <ul class="checkbox underLine">  
                                        <?php 
                                    foreach($vendor['result'] as $row1): 
                                        if($row1->status != 2 ) { ?>

                                        <li class="line"> <input type="checkbox" value="<?php echo $row1->id?>" name=vendor[] class="test_vendor"  label=Vendor <?php if (in_array( $row1->id,$arry)){?> checked="checked" <?php } ?>><?php echo ucfirst("&nbsp".$row1->name);?>
                                        </li>
                                           <?php  
                                        }
                                    endforeach;?>      
                                </ul>
                            </fieldset>
                            <span id="vendor_error" style="color: red"></span><br>
                        </div>
                </div>
            </div>

        
            <?php } ?>                                       
       
                        
 <div class="row">
            <div class="form-group">
                <div class="save_but">
                    <button type="button" class="btn btn-default btn pull-right" id="btn" onclick="addNewForm('')" style="margin-left:5px">Cancel</button>
                    <button type="submit" class="btn btn-primary btn pull-right" id="btn" style="margin-right: 5px;
 ">Save</button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div> 
        
   <?php }
function updateMaterial(){
    
    $id=$this->uri->segment(3);
  
   
    if($this->input->post()){
        
        
           $whereArray = array('material_id'=>$id);
           $rawMaterialData = $this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArray,'material_id');
        
            $avgPrice=$rawMaterialData['result'][0]->avg_price;
            $totalQuantity=$rawMaterialData['result'][0]->quantity;
          
        
           if($rawMaterialData['result'][0]->quantity!=0)
           {
               $totalPrice=$totalQuantity*$avgPrice;
               
               $whereArray = array('unit_id'=>$rawMaterialData['result'][0]->unit_id);
               $unitArrData = $this->Common_model->getAllDataWithMultipleWhere('UnitType',$whereArray,'unit_id');
               
               $unitName=$unitArrData['result'][0]->unit_name;
           
               
                if($unitName!="pic")
                {
                       $toDivide=$unitArrData['result'][0]->value;
                       $quotient=1/$toDivide;  
                       $totalQuantity=($totalQuantity*$quotient);
                  
                    
                    
                      $whereArray = array('unit_id'=>$this->input->post('unit'));
                      $RequiredUnitArrData = $this->Common_model->getAllDataWithMultipleWhere('UnitType',$whereArray,'unit_id');
                    
                     
                        
                    if($RequiredUnitArrData['result'][0]->value>1)
                     {
                         $totalQuantity=$totalQuantity*$RequiredUnitArrData['result'][0]->value;
                     }
                    
                      
                     
                    
                    $avgPrice=$totalPrice/$totalQuantity;
                    
                }
               
               
               
               
               
           }
        
        
         $data_store=array(
                    'material_name' => $this->input->post('materialname'),
                    'unit_id'=>$this->input->post('unit'),
                    'vendor_id'=>implode(",",$this->input->post('vendor')),
                    'avg_price'=>number_format($avgPrice,2),
                    'quantity'=>$totalQuantity,
                    'status'=>$this->input->post('status'),
                    'note'=>$this->input->post('note')
                        );
        
        
        
        
        
            
        $whereArray = array('material_id'=>$id);
            $update_data = $this->Common_model->updateDetailsWithMultipleWhere('RawMaterial',$whereArray,$data_store);
        
        if($update_data){
                $this->session->set_userdata('success_msg', 'Successfully updated material');
                redirect(base_url().'Material_cont/show'); 
        }
        else{
             $this->session->set_userdata('error_msg', 'material not updated');
               redirect(base_url().'Material_cont/show'); 
        }
        
}
}
    
    function changeStatusReview()
	{
		$Id = $this->uri->segment(3);
		$Status = $this->uri->segment(4);
		//========= update email template status ==========//
		$whereArrayVal = array('material_id' => $Id);
		$data_to_store = array('status' => $Status);
		$updtData = $this->Common_model->updateDetailsWithMultipleWhere('RawMaterial',$whereArrayVal,$data_to_store);
		//========= update email template status ==========//
		
		$this->session->set_userdata('success_msg', 'Material status has been updated successfully.');
		redirect(base_url().'Material_cont/show');
	}
        function deleteUnit()
	{
		$Id = $this->uri->segment(3);
		
		//===== fetch data from img table =====//
		 $whereArray = array('material_id'=>$Id);
             $data_store=array(
                    'status' => "2");
		$update_data = $this->Common_model->updateDetailsWithMultipleWhere('RawMaterial',$whereArray,$data_store);
        $this->session->set_userdata('success_msg', 'Material deleted successfully.');
        redirect(base_url().'Material_cont/show'); 

	}     
     function material_exists()
    {
        $name = $this->input->post('materialname');
         $store_id = $this->session->userdata('StoreId');
        $exists = $this->NewModel->material_exists($name,'RawMaterial',$store_id);
        echo $exists;
        //$count = count($exists);
         //echo $count ;

//        if ($count !=0) {
//            echo 1;
//        } else {
//            echo 0;
//        }
    }
    
    
    public function excel()
    {
      
       $whereArr=array('status<>'=>"2",'store_id'=>$this->session->userdata('StoreId'));
        $data['listing']=$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArr,'material_id');
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

        $objPHPExcel->getActiveSheet()->SetCellValue('A1',' Material Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1','Unit Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1','Vendor Name');

        $row=2;

        foreach ($data['listing']['result'] as $value)  
         {
            $whereorderTypeArray = array('unit_id' => $value->unit_id);
            $unitDtlsArr = $this->Common_model->getAllDataWithMultipleWhere('UnitType',$whereorderTypeArray,'unit_id');
            
                $arry=explode(",",$value->vendor_id);
                $vendor_data=$this->NewModel->fetch_data_vendor($arry,'vendorType');
             // print_r($vendor_data);die;
                $vendor=array();
                foreach($vendor_data as $vendor_rec){
               
                    if($vendor_rec->status != 2){
                        array_push($vendor, $vendor_rec->name);
                        }
                }
                $vendor_string=implode(",",$vendor);
            
            
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$value->material_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$unitDtlsArr['result'][0]->unit_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$vendor_string); 
            //$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$value->phoneno); 

            $row++;
         }
            
       //print_r($objPHPExcel);exit;
         $filename="RawMaterial-Exported-on".date("Y-m-d-H-i-s").'.xlsx';
         $objPHPExcel->getActiveSheet()->setTitle("RawMaterial-overview");

         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment;filename='.$filename);
         header('Cache-Control: max-age=0');

         $writer= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
         $writer->save('php://output');
         exit;

    }
        public function excel1()
    {
      
      $whereArr=array('status<>'=>"2",'store_id'=>$this->session->userdata('StoreId'));
        $data['listing']=$this->Common_model->getAllDataWithMultipleWhere('Item',$whereArr,'item_id');
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

        $objPHPExcel->getActiveSheet()->SetCellValue('A1',' Item Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1','Item Stock');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1','Price');

        $row=2;

        foreach ($data['listing']['result'] as $value)  
         {
            
            //echo "<pre>";print_r($value);die;
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$value->item_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$value->stock);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$value->price); 
            //$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$value->phoneno); 
            
            $row++;
         }
         
         //print_r($objPHPExcel);exit;

         $filename="Item-Exported-on".date("Y-m-d-H-i-s").'.xlsx';
         $objPHPExcel->getActiveSheet()->setTitle("Item-overview");

         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment;filename='.$filename);
         header('Cache-Control: max-age=0');

         $writer= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
         $writer->save('php://output');
         exit;

    }
    
    
    
        
        
    }
	