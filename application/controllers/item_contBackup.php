<?php
class Item_cont extends CI_Controller {
   // Controller class for site_settings
	function __construct()
{
               parent::__construct();
               $this->load->library('session');
               $this->load->model('Common_model');
               $this->load->model('NewModel');
             $this->load->library('pagination');
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
        $data['listing']=$this->Common_model->getAllDataWithMultipleWhere('Item',$whereArr,'item_id');
        
        $whereArr=array('status<>'=>"2",'store_id'=>$this->session->userdata('StoreId'));
        $data['material']=$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArr,'material_id');
        
       // $data['listing']=$this->Common_model->fetchAllData('Item','item_id');
        //$data['material']=$this->Common_model->fetchAllData('RawMaterial','material_id','DESC');
		$this->load->view('includes/header');
        $this->load->view('includes/sidepanel');
		$this->load->view('Item-management/itemListingbackup',$data);
        $this->load->view('includes/footer');
	}
//    function index()
//	{
//      //  echo $this->session->userdata('StoreId');die;
//        $whereArr=array('status<>'=>"2",'store_id'=>$this->session->userdata('StoreId'));
//        $data['item']=$this->Common_model->getAllDataWithMultipleWhere('Item',$whereArr,'item_id');
//        
//        $whereArr=array('status<>'=>"2",'store_id'=>$this->session->userdata('StoreId'));
//        $data['material']=$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArr,'material_id');
//        
//        
//        $data['search'] ="";
//         $data['totalPage']="";
//        $rowno=0;
//        $search_text = "";
//        $rowperpage = 4;
//        if (isset($_GET["page"])) 
//        { $page  = $_GET["page"]; 
//        } 
//        else { $page=1; 
//             }; 
//            if($page > 0){
//                  $rowno = ($page-1) * $rowperpage;
//                }
//    if(isset($_REQUEST['search']) && $_REQUEST['search']!=""){
//        $search_text=urldecode(trim($_REQUEST['search']));
//       
//         
//    }
//     $allcount = $this->NewModel->getrecordCount1($search_text,'Item');
//        //echo $this->db->last_query();die;
//    $users_record = $this->NewModel->getData1($rowno,$rowperpage,$search_text,'Item');
//    
//
//        //$data['pagination'] = $this->pagination->create_links();
//   $total_pages = ceil($allcount / $rowperpage); 
//// $allcount = $this->NewModel->getrecordCount($search_text,'Item','final_price');
////          $users_record = $this->NewModel->getData($rowno,$rowperpage,$search_text,'Item','final_price'); 
//    $data['listing']= $users_record;
//    $data['row'] = $rowno;
//    $data['search'] = $search_text;
//    $data['totalPage']=$total_pages;
//    //$this->load->view('Registration/listing_template', $data);   // $data['listing']=$this->Common_model->fetchAllData('Item','item_id');
//        //$data['material']=$this->Common_model->fetchAllData('RawMaterial','material_id','DESC');
//		$this->load->view('includes/header');
//        $this->load->view('includes/sidepanel');
//		$this->load->view('Item-management/itemListing',$data);
//        $this->load->view('includes/footer');
//	}
//    

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
        
        
       $data['listing']=$this->Common_model->fetchAllData('UnitType','unit_id','DESC');
        //$data['unit']=$this->Common_model->fetchAllData('UnitType','unit_id','DESC');
        //$data['material']=$this->Common_model->fetchAllData('RawMaterial','material_id','DESC');
        
         $data['unit']=$this->Common_model->fetchAllData('UnitType','unit_id','DESC');
        
        $whereArr=array('status<>'=>"2",'store_id'=>$this->session->userdata('StoreId'));
        $data['material']=$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArr,'material_id');
        
       // echo"<pre>";
        //print_r($data['material']);die;
		//$this->load->view('includes/header');
       // $this->load->view('includes/sidepanel');
		$this->load->view('Item-management/additemDiv',$data);
       // $this->load->view('includes/footer'); 
        
        
    }
    
    
    function addForm()
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

 $unit=$this->Common_model->fetchAllData('UnitType','unit_id','DESC');
//$vendor=$this->Common_model->fetchAllData('vendorType','id','DESC');

//$material=$this->Common_model->fetchAllData('RawMaterial','material_id','DESC');
 $data['unit']=$this->Common_model->fetchAllData('UnitType','unit_id','DESC');
        
        $whereArr=array('status<>'=>"2",'store_id'=>$this->session->userdata('StoreId'));
        $data['material']=$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArr,'material_id');
?> 
<div class="panel-body">
     <div class="position-center">
         
         <form role="form"  action="<?php echo base_url(); ?>Item_cont/insertItem"method="post" id="updt" enctype="multipart/form-data" onsubmit=" return validateForm();">
                    <div class="row">
                        <div class="form-group">
                        <div class=" col-md-6">
                                <input type="hidden" name="mode" value="updateDetails">
                                    <label class="control-label">Item Name</label>    
                                     <input  type="text"  placeholder="Item Name" class="form-control test" name="itemname" id="item" label="Item" onblur="check_if_exists();">
                            <span id="name_error" style="color: red"></span><br>
                        </div> 
                        </div>
             </div>
 <div class="row">
<div class="form-group">
 <div class=" col-md-8">
        <label class="control-label">Enter Raw Material</label>
        <p id="addMoreHtml_error" style="color: red;"></p>
        <div id="addMoreHtml" class="test">
     <?php
     $lableVal = '';
     $subCategoryId = $this->uri->segment(3);
//     $wherefldTypeArrArry =array('subCategoryId' => $subCategoryId);
//     $productSeacrhOptionArr=$this->Common_model->getAllDataWithMultipleWhere('productSeacrhOption',$wherefldTypeArrArry,'productSeacrhOptionId','ASC');
//     
          $nxtCount = 1;
          ?>
          <div class="form-group col-lg-12 srchFlds test" id="div_<?php echo $nxtCount;?>">
               <div class="col-lg-3">
              <label class="control-label">Material</label>
            <select name="fld_label1[]" class=" form-control material_test"  id="fld_label<?php echo $nxtCount;?>" label="Unit" onchange="dependable_unit(this);">
            <option value="" >Select</option>
         <?php 
                foreach($material['result'] as $row): 
                if($row->status != 2 && $row->quantity != 0.00 && $row->avg_price != 0.00 ){ ?>
              <option value="<?php echo $row->material_id?>"><?php echo $row->material_name?></option> 
         <?php  }     
            endforeach;?>
               
                  </select>
                  <span id="material_error" style="color: red"></span><br>
              </div>
              <div class="col-lg-3 test_parent">
              <label class="control-label">Unit</label>
            <select name="fld_label2[]" class=" form-control unit_test"  id="fld_label<?php echo $nxtCount;?>" label="Unit" onchange=" fetch_value();" >
            <option value="" >Select</option>
                  </select>
                  <span id="unit_error" style="color: red"></span><br>
              </div>
              
              <div class="col-lg-3">
                   <label>Quantity <span style="color: red;">*</span>:</label>
                   <input  type="number"class="form-control qty_test" id="fld_label<?php echo $nxtCount;?>" name="fld_label3[]" label="Field Label" min=1 value=1 onblur="check(this);">
                   <span id="qty_error" style="color: red"></span><br>
               </div>
               
               <?php
               //if($productSeacrhOptionArr['num_row'] == $nxtCount)
               //{
               ?>
               <div class="col-lg-2" style="margin-top: 3.0%;" id="actionBtn_<?php echo $nxtCount;?>">
                    <?php
                    if($nxtCount == 1)
                    //if($productSeacrhOptionArr['num_row'] == $nxtCount)
                    {
                    ?>
                    <input type="button" class="btn btn-success" value="+" onclick="addMore('add', '<?php echo $nxtCount;?>');">
                    <!--<input type="button" class="btn btn-default" value="-" onclick="addMore('remove', '<?php echo $nxtCount;?>');">-->
                    <?php
                    }
                    else
                    {
                    ?>
                    <!--<input type="button" class="btn btn-success" value="+" onclick="addMore('add', '<?php echo $nxtCount;?>');">-->
                    <input type="button" class="btn btn-default" value="-" onclick="addMore('remove', '<?php echo $nxtCount;?>');">
                    <?php
                    }
                    ?>
               </div>
    </div>
               <?php
               //}
               ?>
          </div>
 </div>    
</div>
 </div>
<div class="row">
<div class="form-group">
<div class=" col-md-6">  
    <label class="control-label">Enter Tax</label>    
                 <input  type="number"  placeholder="Tax" class="form-control tax_test" name="tax" id="tax" label="tax" min=0 onblur="check_tax();">
                <span id="tax_error" style="color: red"></span><br>
    
     </div>
    </div>
             </div>
 <div class="row">
     <div class="form-group">
         <div class=" col-md-6">
                    <label class="control-label">Mode of price</label>            
                        <label for="chkYes">
                            <input type="radio" id="chkYes" name="chkPassPort" value=1 onchange="fetch_value('<?php echo $nxtCount;?>');" checked/>
                                Automated
                        </label>
                        <label for="chkNo">
                            <input type="radio" id="chkNo" name="chkPassPort" value=0 >
                                Manual
                        </label>
                            <span id="price_error" style="color: red"></span><br>
                            <hr />
                <div id="dvyesshow" >
                        <label class="control-label"> price</label> 
                <input type="text" class="form-control" id="automatedNumber" name="automatedNumber1" placeholder="price" readonly/>
                    <span id="nan_error" style="color: red"></span><br>
                </div>
        </div> 
     </div>
</div>
<div class="row">
     <div class="form-group">
        <div class=" col-md-6">
                              <label class="control-label">Status</label>
               <select class="form-control " id="status" name="status" label="status"   data-max-options="1">
                    <option value="1" >Active</option>
                   <option value="0">Inactive</option>
                   </select>
                      <span id="status_error" style="color: red"></span><br>
               
         </div>
        </div>
    </div>
 <div class="row">
     <div class="form-group">
         <div class="save_but">
        
         
         <button type="button" class="btn btn-default btn pull-right" id="btn" onclick="addNewForm('')">Cancel</button>
             <button type="submit" class="btn btn-primary btn pull-right" id="btn">Save</button>
         </div>
     </div>
</div>
                                    
     </form>
    </div>
</div>
        
        
        
    
<?php }
    
    
    function insertItem(){
//       $data['material']=$this->Common_model->fetchAllData('RawMaterial','material_id','DESC');
//        $data['unit']=$this->Common_model->fetchAllData('UnitType','unit_id','DESC');
        $id= $this->session->userdata('id');
         $StoreId=$this->session->userdata('StoreId');
        
        $itemname=$this->input->post('itemname');
        $fld_label1 = $this->input->post('fld_label1');
         $fld_label2 = $this->input->post('fld_label2');
        $fld_label3 = $this->input->post('fld_label3');
        $status=$this->input->post('status');
       $total_price=$this->input->post('automatedNumber1');
       // $total_price1=$this->input->post('automatedNumber');
        $mode_price=$this->input->post('chkPassPort');
        $tax=$this->input->post('tax');
        $final_price=$total_price+$tax;
       // echo $total_price;die;
            $data_to_insert_item=array(
                             'item_name' => $itemname,
                                'tax'=>$tax,
				                'price' => $total_price,
                                'final_price'=>$final_price,
                                'price_mode'=>$mode_price,
                                'status' => $status,
                                'admin_subadmin_id'=>$id,
                                'store_id'=>$StoreId
													
                    );
        $insrt_data=$this->Common_model->insertData('Item', $data_to_insert_item);
			 
        $whereArray = array('item_name' => $itemname);		
			$item_details=$this->Common_model->getAllDataWithMultipleWhere('Item',$whereArray,'item_id');	
        
        $item_id=$item_details['result'][0]->item_id;     
           // $total_price=0;
				for($i=0; $i<count($fld_label1); $i++)
				{
//                   $convert=0;
//                    $convert_mg=0;
//                    $price=0;
//                    
//					
//            $whereArray = array('material_id' => $fld_label1[$i]);		
//			$material_details=$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArray,'material_id');
//               
//        $whereArray = array('unit_id' => $fld_label2[$i]);	
//        $unit_details=$this->Common_model->getAllDataWithMultipleWhere('UnitType',$whereArray,'unit_id');
//                $item_quantity=$fld_label3[$i];
//                $quantity= $material_details['result'][0]->quantity;
//                $avg_price=$material_details['result'][0]->avg_price;
//                $value=$unit_details['result'][0]->value;
//                    
//                    $convert=$quantity*$value;
//                    $convert_mg=$avg_price/$convert;
//                    $a=number_format($convert_mg,20);
//                    $price=(($a*$item_quantity)*$value);
//                    $total_price=$total_price+$price;
//                   // echo $total_price;echo"<br>";
                    
                     $data_to_insert_item_material=array(
                    'item_id' => $item_id,
                    'material_id'=>$fld_label1[$i],
                    'unit_id'=>$fld_label2[$i],
                    'quantity'=>$fld_label3[$i]
                        );
                    
                    
          $insrt_data=$this->Common_model->insertData('Item_material', $data_to_insert_item_material); 
                }
//        $tax_added_price=$total_price+$tax;
//        $data_to_update_price=array(
//                                        'item_name' => $itemname,
//										'price' => $tax_added_price,
//                                        'status' => $status,	
//										//'Quantity' => $fld_label3[$i]
//											
//				
//                    );
//             $whereArray = array('item_id'=>$item_id);
//            $update_data = $this->Common_model->updateDetailsWithMultipleWhere('Item',$whereArray,$data_to_update_price);   
       
                
        if($insrt_data){
                $this->session->set_userdata('success_msg', 'Successfully inserted item');
                redirect(base_url().'Item_cont/index'); 
        }
        else{
             $this->session->set_userdata('error_msg', 'item not inserted');
                redirect(base_url().'Item_cont/index'); 
        }
   // }
            
    }
    
    function calculate(){
        
        $material_id=$this->input->post('material_id');
         $unit_id=$this->input->post('unit_id');
        $quantity_ajax=$this->input->post('quantity');
        //echo $material_id;
       // echo $unit_id;
        //echo $quantity_ajax;
       // die;
      
        if($material_id!="" && ($unit_id!="" && $quantity_ajax!="") ){
        
        $whereArray = array('material_id' => $material_id);		
        $material_details=$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArray,'material_id');
            
          // echo "<pre>";
            //print_r($material_details);die;
            $unit_id_kg=$material_details['result'][0]->unit_id ;
        
        $whereArray = array('unit_id' =>$unit_id_kg);	
        $unit_details=$this->Common_model->getAllDataWithMultipleWhere('UnitType',$whereArray,'unit_id');
            
            $whereArray = array('unit_id' =>$unit_id);	
        $unit_details1=$this->Common_model->getAllDataWithMultipleWhere('UnitType',$whereArray,'unit_id');
            //cho "<pre>";
            //print_r($unit_details);die;
        
        $item_quantity=$quantity_ajax;
        $quantity= $material_details['result'][0]->quantity;
        $avg_price=$material_details['result'][0]->avg_price;
         $value=$unit_details['result'][0]->value;
        $value_togm_ml=$unit_details1['result'][0]->value;
            //echo $value_togm_ml;
        
            if($unit_id_kg==$unit_id && $item_quantity==1 ){
                echo $avg_price;
            }
            else{
           
            if($quantity==0){
             $convert=$value;  
            }
            else{
         $convert=$value_togm_ml;
            }
      // echo $convert;die;
         $convert_mg=$avg_price/$convert;
           //echo $convert_mg;die;
       // $a=number_format($convert_mg,20);
          //echo $a;die;
        $price=($convert_mg*$item_quantity);
           // echo $price;die;
            //$final_price=$price*$value_togm_ml;
           // echo $final_price;
         //$total_price=$total_price+$price;
        
        echo $price;
       }
   }
        else
        {
           // echo "0";
        }
//        echo $quantity;
//        echo $avg_price;
//        echo $value;
//        echo "<pre>";
//        print_r($material_details);
//        print_r($unit_details);
//        die;
        
    }
    
    function edit(){
        
        
        $id=$this->input->post('id');
    // $data['edit']=$this->NewModel->fetch_data('UnitType',array('unit_id'=>$id));
//       $data['edit']=$this->Common_model->getAllDataWithMultipleWhere('UnitType',array('unit_id'=>$id));
        
        $whereArray = array('item_id' => $id,'store_id'=>$this->session->userdata('StoreId'));		
        $data['item']=$this->Common_model->getAllDataWithMultipleWhere('Item',$whereArray,'item_id','ASC');
        
       
        $whereArray = array('item_id' => $id);		
        $data['item_material']=$this->Common_model->getAllDataWithMultipleWhere('Item_material',$whereArray,'id','ASC');
        
        $data['unit']=$this->Common_model->fetchAllData('UnitType','unit_id','DESC');
         
        $whereArr=array('status<>'=>"2",'store_id'=>$this->session->userdata('StoreId'));
        $data['material']=$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArr,'material_id');
        
        
        
       // $this->load->view('includes/header');
        //$this->load->view('includes/sidepanel');
		$this->load->view('Item-management/edititemDiv',$data);
       // $this->load->view('includes/footer');
        
        
        
    }
function updateitem(){
    
    $id=$this->uri->segment(3);
   // echo $id;
        $itemname=$this->input->post('itemname');
        $fld_label1 = $this->input->post('fld_label1');
         $fld_label2 = $this->input->post('fld_label2');
        $fld_label3 = $this->input->post('fld_label3');
        $status=$this->input->post('status');
       $total_price=$this->input->post('automatedNumber1');
        $mode_price=$this->input->post('chkPassPort');
        $tax=$this->input->post('tax');
     $final_price=$total_price+$tax;
    $data_store_item=array(
                             'item_name' => $itemname,
                                'tax'=>$tax,
				                'price' => $total_price,
                                'final_price'=>$final_price,
                                'price_mode'=>$mode_price,
                                'status' => $status	
													
                    );
    if($this->input->post()){
            
            $whereArray = array('item_id'=>$id);
            $update_data_item = $this->Common_model->updateDetailsWithMultipleWhere('Item',$whereArray,$data_store_item);
        
         if($update_data_item)
         {
             $whereArray = array('item_id' => $id);
				$delAllOptions = $this->Common_model->deleteDataWithMultipleWhere('Item_material',$whereArray);
        
             for($i=0; $i<count($fld_label1); $i++)
				{
           
                    $data_to_insert_item_material=array(
                        'item_id'=>$id,
                    'material_id'=>$fld_label1[$i],
                    'unit_id'=>$fld_label2[$i],
                    'quantity'=>$fld_label3[$i]
                        );
                    
                    
           $insrt_item_material_data=$this->Common_model->insertData('Item_material', $data_to_insert_item_material);
             
                }
       
       
            $this->session->set_userdata('success_msg', 'Successfully updated item');
            redirect(base_url().'Item_cont/index'); 
        }
        else{
             $this->session->set_userdata('error_msg', 'item not updated');
                redirect(base_url().'Item_cont/index'); 
        }
        
    }
       
        
}

    
    function changeStatusReview()
	{
		$Id = $this->uri->segment(3);
		$Status = $this->uri->segment(4);
		//========= update email template status ==========//
		$whereArrayVal = array('item_id' => $Id);
		$data_to_store = array('status' => $Status);
		$updtData = $this->Common_model->updateDetailsWithMultipleWhere('Item',$whereArrayVal,$data_to_store);
		//========= update email template status ==========//
		
		$this->session->set_userdata('success_msg', 'Item status has been updated successfully.');
		redirect(base_url().'Item_cont/index');
	}
        function deleteUnit()
	{
		$Id = $this->uri->segment(3);
		
		//===== fetch data from img table =====//
		 $whereArray = array('item_id'=>$Id);
             $data_store=array(
                    'status' => "2");
		$update_data = $this->Common_model->updateDetailsWithMultipleWhere('Item',$whereArray,$data_store);
            $this->session->set_userdata('success_msg', 'Item deleted successfully.');
        redirect(base_url().'Item_cont/index'); 

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
        

    
    function generateField()
	{
		$count = $this->input->post('count');
		$nxtCount = $count + 1;
        $unit=$this->Common_model->fetchAllData('UnitType','unit_id','DESC');
       // $material=$this->Common_model->fetchAllData('RawMaterial','material_id','DESC');
        $whereArr=array('status<>'=>"2",'store_id'=>$this->session->userdata('StoreId'));
        $material=$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArr,'material_id');
		?>
    		<div class="form-group col-lg-12 srchFlds test" id="div_<?php echo $nxtCount;?>">
		 <div class="col-lg-3">
              <label class="control-label">Material</label>
            <select name="fld_label1[]" class=" form-control material_test"  id="fld_label<?php echo $nxtCount;?>" label="Unit" onchange="dependable_unit(this);" >
            <option value="" >Select</option>
         <?php 
                foreach($material['result'] as $row): 
                    if($row->status != 2 && $row->quantity != 0.00 && $row->avg_price != 0.00 ){ ?>
              <option value="<?php echo $row->material_id?>"><?php echo $row->material_name?></option> 
         <?php  }     
            endforeach;?>
               
                  </select>
                  <span id="material_error" style="color: red"></span><br>
              </div>
              <div class="col-lg-3">
              <label class="control-label">Unit</label>
            <select name="fld_label2[]" class=" form-control unit_test"  id="fld_label<?php echo $nxtCount;?>" label="Unit" onblur=" fetch_value();" >
            <option value="" >Select</option>
               
                 </select>
                  <span id="unit_error" style="color: red"></span><br>
              </div>
              
              <div class="col-lg-3">
                   <label>Quantity <span style="color: red;">*</span>:</label>
                   <input  type="number"class="form-control qty_test" id="fld_label<?php echo $nxtCount;?>" name="fld_label3[]" label="Field Label" min=0 onblur="check(this);" value=1>
                  <span id="qty_error" style="color: red"></span><br>
               </div>
              
			<div class="col-lg-2" style="margin-top: 2%;" id="actionBtn_<?php echo $nxtCount;?>">
				<input type="button" class="btn btn-success" value="+" onclick="addMore('add', '<?php echo $nxtCount;?>');">
				<?php
				if($nxtCount > 1)
				{
				?>
				<input type="button" class="btn btn-default" value="-" onclick="addMore('remove', '<?php echo $nxtCount;?>');">
				<?php
				}
				?>
			</div>
</div>

		<?php
	}
//        function pagination($record=0){
//             // echo "1";die; 
//            
//		$recordPerPage = 5;
//		if($record != 0){
//			$record = ($record-1) * $recordPerPage;
//		}      	
//      	$recordCount = $this->NewModel->getCount('Item');
//      	$empRecord = $this->NewModel->getRecord($record,$recordPerPage,'Item');
//      	$config['base_url'] = base_url().'Item_cont/pagination';
//      	$config['use_page_numbers'] = TRUE;
//		$config['next_link'] = 'Next';
//		$config['prev_link'] = 'Previous';
//		$config['total_rows'] = $recordCount;
//		$config['per_page'] = $recordPerPage;
//		$this->pagination->initialize($config);
//		$data['pagination'] = $this->pagination->create_links();
//		$data['empData'] = $empRecord;
//		echo json_encode($data);	
//        }
    
    public function pagination(){
        $whereArr=array('status<>'=>"2",'store_id'=>$this->session->userdata('StoreId'));
        $data['material']=$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArr,'material_id');
        $StoreId=$this->session->userdata('StoreId');
       // $this->load->model('NewModel', 'custom_model');
             // echo "1";die; 
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
    $allcount = $this->NewModel->getrecordCountforpagination('Item');
    $users_record = $this->NewModel->getDataforpagelist($rowno,$rowperpage,'Item');
   //echo "<pre>";print_r($users_record);die;
  $total_pages = ceil($allcount / $rowperpage); 
    $data['listing']= $users_record;
    $data['row'] = $rowno;
   // $data['search'] = $search_text;
    $data['totalPage']=$total_pages;
   // echo "<pre>";
   // print_r($data['listing']);die;
     		$this->load->view('Item-management/replace',$data);
    
    }
      
    
   public function loadRecord($rowno=0){
       $whereArr=array('status<>'=>"2",'store_id'=>$this->session->userdata('StoreId'));
        $data['material']=$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArr,'material_id');
        $StoreId=$this->session->userdata('StoreId');
      // $whereArr=array('status<>'=>"2",'store_id'=>$this->session->userdata('StoreId'));
      //  $listing=$this->Common_model->getAllDataWithMultipleWhere('Item',$whereArr,'item_id');
        $item_name= $this->input->post('iten_name');
       $item_stock_condition= $this->input->post('iten_stock_condition');
       $item_stock= $this->input->post('iten_stock');
      $item_price_condition= $this->input->post('iten_price_condition');
       $item_price= $this->input->post('iten_price');
       
      // echo $item_name;
      // echo $iten_stock;
      //echo $item_stock_condition;
       //echo $item_stock;die;
       
      // echo $item_name;die;
        $whereArr=array('item_id'=>$item_name,'store_id'=>$this->session->userdata('StoreId'));
        $itemName=$this->Common_model->getAllDataWithMultipleWhere('Item',$whereArr,'item_id');
      
       //$whereArr=array('item_id'=>$item_stock,'store_id'=>$this->session->userdata('StoreId'));
       // $itemStock=$this->Common_model->getAllDataWithMultipleWhere('Item',$whereArr,'item_id');
       
      // print_r($itemStock);die;
    
       $data['search'] ="";
         $data['totalPage']="";
        
       // $data['listing']=$this->NewModel->select();
        $rowno=0;
        $search_text = "";
        $rowperpage = 2;
        if (isset($_GET["page"])) 
        { 
            $page  = $_GET["page"]; 
        } 
        else 
            { 
            $page=1; 
             } 
            if($page > 0){
                  $rowno = ($page-1) * $rowperpage;
                }
       
       if($item_name!= ""){
           
          foreach ($itemName['result'] as $row){
        $search_text=$row->item_name;
              
       }
           $whereArr=array('item_name'=>$search_text,'store_id'=>$this->session->userdata('StoreId'));
        $users_record=$this->Common_model->getAllDataWithMultipleWhere('Item',$whereArr,'item_id');
            $allcount= $users_record['num_row']; 
        // $allcount = $this->NewModel->getrecordCount($search_text,'Item','item_name');
          //$users_record = $this->NewModel->getData($rowno,$rowperpage,$search_text,'Item','item_name');
           
       }
       else if($item_stock!= "" && $item_stock_condition!=""){
           
           if($item_stock_condition==1){
        $whereArr=array('stock >'=>$item_stock,'store_id'=>$this->session->userdata('StoreId'));
        $users_record=$this->Common_model->getAllDataWithMultipleWhere('Item',$whereArr,'item_id');
            $allcount= $users_record['num_row']; 
              //echo $this->db->last_query();die;
              // echo "<pre>";
              // print_r($users_record);
               //echo $allcount;die;
           }
           
           else if($item_stock_condition==2){
         $whereArr=array('stock <'=>$item_stock,'store_id'=>$this->session->userdata('StoreId'));
        $users_record=$this->Common_model->getAllDataWithMultipleWhere('Item',$whereArr,'item_id');
                $allcount= $users_record['num_row']; 
               
           }
           else if($item_stock_condition==3){
          
               $search_text=$item_stock;
              $allcount = $this->NewModel->getrecordCount($search_text,'Item','stock');
          $users_record = $this->NewModel->getData($rowno,$rowperpage,$search_text,'Item','stock');  
           }
          
       }
       
       else if($item_price!= "" && $item_price_condition!=""){
          
           if($item_price_condition==1){
        $whereArr=array('final_price >'=>$item_price,'store_id'=>$this->session->userdata('StoreId'));
        $users_record=$this->Common_model->getAllDataWithMultipleWhere('Item',$whereArr,'item_id');
            $allcount= $users_record['num_row']; 
              //echo $this->db->last_query();die;
              // echo "<pre>";
               
           }
           
           else if($item_price_condition==2){
         $whereArr=array('final_price <'=>$item_price,'store_id'=>$this->session->userdata('StoreId'));
        $users_record=$this->Common_model->getAllDataWithMultipleWhere('Item',$whereArr,'item_id');
                $allcount= $users_record['num_row']; 
               
           }
           else if($item_price_condition==3){
          
               $search_text=$item_price;
              $allcount = $this->NewModel->getrecordCount($search_text,'Item','final_price');
          $users_record = $this->NewModel->getData($rowno,$rowperpage,$search_text,'Item','final_price');  
           }
           
       }
         
  //  if(isset($_REQUEST['search']) && $_REQUEST['search']!=""){
      
        //echo $search_text;
       
         
    //}
        //echo $rowno;die;
   // $allcount = $this->NewModel->getrecordCount($search_text);
       
       //echo $allcount;die;
        //echo $this->db->last_query();die;
    //$users_record = $this->NewModel->getData($rowno,$rowperpage,$search_text);
     //print_r($users_record);die;

        //$data['pagination'] = $this->pagination->create_links();
   $total_pages = ceil($allcount / $rowperpage);
       
        $data['listing']= $users_record;
    $data['row'] = $rowno;
   // $data['search'] = $search_text;
    $data['totalPage']=$total_pages;
   // echo "<pre>";
   // print_r($data['listing']);die;
     		$this->load->view('Item-management/replace',$data);
   
        
    
                       
                      
                         

    
    }
    
}
 ?>   

	