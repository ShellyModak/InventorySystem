<?php
class Vendormanagement extends CI_Controller {
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
        $whereArr=array('status<>'=>"2",'storeId'=>$this->session->userdata('StoreId'));
        $data['listing']=$this->Common_model->getAllDataWithMultipleWhere('vendorType',$whereArr,'vendor_id'); 
		$this->load->view('includes/header');
        $this->load->view('includes/sidepanel');
		$this->load->view('Vendor-management/show -all-vendors',$data);
        $this->load->view('includes/footer');
	}
    
    function profile(){
        $id= $this->session->userdata('id');
        $mode=$this->input->get('m');
        
                   
                     if($mode=='add')
                    {          
                        $id="VD".rand(000,999);
                                 $data_ins=array(
                                        'id'=>$id,
                                        'name' => $this->input->post('name'),
                                        'details'=>$this->input->post('details'),
                                        'email'  =>$this->input->post('email'),
                                        'phoneno'  =>$this->input->post('phoneno'),
                                        'note'  =>$this->input->post('note'),
                                        'admin_id'=>$this->session->userdata('id'),
                                        'storeId'=>$this->session->userdata('StoreId')
                                            );



                                   $insert=$this->Common_model->insertData('vendorType',$data_ins); 
                                   if($insert)
                                   {
                                        $this->session->set_userdata('msg', 'Successfully inserted ');
                                       $this->session->set_userdata('err_msg', '');

                                    }
                                    else
                                    {
                                        $this->session->set_userdata('msg', '');
                                         $this->session->set_userdata('err_msg', 'Couldnot be inserted');

                                    }
                          redirect(base_url().'Vendormanagement/index'); 
                    }
        
                     else if($mode=='upd')
                    {
                                  $update_id=$this->input->get('id');
                                 $data_ins=array(
                                        'name' => $this->input->post('name'),
                                        'email'  =>$this->input->post('email'),
                                        'details' =>$this->input->post('details'),
                                        'phoneno'  =>$this->input->post('phoneno'),
                                        'note'  =>$this->input->post('note'),
                                        'status'  =>$this->input->post('status'),
                                         'storeId'=>$this->session->userdata('StoreId'),
                                        'admin_id'=>$this->session->userdata('id')
                                        
                                            );

                                 $whereArr=array('id'=>$update_id);

                               $update=$this->Common_model->updateDetailsWithMultipleWhere('vendorType',$whereArr,$data_ins);
                                if($update)
                               {
                                     $this->session->set_userdata('msg', 'Successfully updated');
                                     $this->session->set_userdata('err_msg', '');

                                }
                                else
                                {
                                    $this->session->set_userdata('msg', '');
                                     $this->session->set_userdata('err_msg', 'Not  updated');

                                }
                           redirect(base_url().'Vendormanagement/index'); 

                    }
        

                    else if($mode=='d')
                    {
                                  $delete_id=$this->input->get('id');
                                 $data_ins=array( 'status' => '2');

                                 $whereArr=array('id'=>$delete_id);

                               $delete=$this->Common_model->updateDetailsWithMultipleWhere('vendorType',$whereArr,$data_ins);
                                if($delete)
                                {
                                    $this->session->set_userdata('msg', 'Successfully deleted');
                                    $this->session->set_userdata('err_msg', '');

                                }
                                else
                                {
                                     $this->session->set_userdata('msg', '');
                                     $this->session->set_userdata('err_msg', 'Not  deleted');

                                }
                          redirect(base_url().'Vendormanagement/index'); 
                    }
        
        
        
        
                     else if($mode=='s')
                    {
                                  $status_id=$this->input->get('id');
                                    $status=$this->input->get('status');
                                 $data_ins=array( 'status' => $status);

                                 $whereArr=array('id'=>$status_id);

                               $status=$this->Common_model->updateDetailsWithMultipleWhere('vendorType',$whereArr,$data_ins);
                                if($status)
                               {
                                    $this->session->set_userdata('msg', 'Status Changed ');
                                    $this->session->set_userdata('err_msg', '');
                                }
                                else
                                {
                                     $this->session->set_userdata('msg', '');
                                     $this->session->set_userdata('err_msg', 'Status Not Changed');

                                }
                          redirect(base_url().'Vendormanagement/index'); 
                    }
        
      
        
        
        
 }
    
    
     function addForm()
     {

    $name="";$address="";$email="";$phoneNumber="";$status='1';$note="";
    if($this->input->post('id')!="")
    {
          $vendorId=$this->input->post('id');
          $whereArr=array('id'=>$vendorId);
          $data=$this->Common_model->getAllDataWithMultipleWhere('vendorType',$whereArr,'id'); 
        
          $name=$data['result'][0]->name;
          $address=$data['result'][0]->details;
          $email=$data['result'][0]->email;
          $phoneNumber=$data['result'][0]->phoneno;
          $status=$data['result'][0]->status;
          $note=$data['result'][0]->note;
    }



?>
    <div class="panel-body">
        <div class="">
            <?php 
            if($this->input->post('id')!="")
            {   
                $action=base_url()."Vendormanagement/profile?m=upd&id=".$this->input->post('id');

            }      
            else
            { 

                  $action=base_url()."Vendormanagement/profile?m=add";

            } 
            ?>        
      <form class=" bucket-form" method="post" action="<?php echo $action;?>" onsubmit="return validateForm();">
            <div class="row">
                 <div class="form-group">
                     <div class=" col-md-3">
                              <label class="control-label ">Vendor Name <span style="color: red;">*</span>:</label>
                              <input type="text" class="form-control test" name="name" id="name" label="Name" value="<?php echo $name;?> ">
                               <span id="name_error" style="color:red"></span><br>       
                     </div> 

                      <div class=" col-md-3">
                            <label class="control-label">Email</label>
                            <input type="text" class="form-control test" name="email" id="email" label="Email"  value="<?php echo $email;?>" >
                            <span id="email_error" style="color:red"></span><br>
                       </div> 

                      <div class=" col-md-3">
                        <label class="control-label">Phone<span style="color: red;">*</span>:</label>
                        <input type="text" class="form-control test" name="phoneno" id="phoneno" label="Phoneno"  value="<?php echo $phoneNumber;?>" >
                        <span id="phoneno_error" style="color:red"></span><br>
                    </div>

                     <div class=" col-md-3">
                          <label class="control-label">status</label>
                          <select class="form-control " id="status" name="status" label="Status"   data-max-options="1">
                                <option value="0" <?php if($status==0) echo 'selected';?>>Inactive</option> 
                                <option value="1" <?php if($status==1) echo 'selected';?>>Active</option>
                          </select>    
                     </div> 


                </div>
            </div>
            <div class="row">
                 <div class="form-group">
                     <div class=" col-md-5">
                            <label class="control-label">Address</label>
                            <textarea class="form-control" name="details" name="details"  id="details" label="Details"  rows="2" cols="1" value=""><?php echo $address;?></textarea>
                            <span id="details_error" style="color:red"></span><br>
                     </div>

                    <div class=" col-md-5">
                            <label class="control-label">Note</label>
                            <textarea class="form-control" name="note"  rows="2" cols="1" value=""><?php echo ucfirst($note);?></textarea>
                    </div>
                </div><br>
           
                  <div class="save_but">
                    <button type="button" class="btn btn-default btn pull-right" id="btn" onclick="addNewForm('')" style="margin-left:5px">Cancel</button>
                    <button type="submit" class="btn btn-primary btn pull-right" id="btn" style="margin-right: 5px;
                    ">Save</button>
                </div>
           </div>
      </form>
</div>
    </div>
    
<?php }
    
   function add_rawmaterial()
    {
        
       $material_id = $this->input->post('rawmaterialbox');
        
       $i=count($material_id);
        
       
            $vendor_id=$this->uri->segment(3);
        
            $whereArr=array('store_id'=>$this->session->userdata('StoreId'));
            $material_available=$this->Common_model->find_in_set('RawMaterial',$vendor_id,$whereArr);
            foreach($material_available['result'] as $row)
            {
                $array=explode(",",$row->vendor_id);
                $key=array_search($vendor_id,$array);
                unset($array[$key]);
                $vendor_id=implode(",",$array);
                $whereArr=array('material_id'=>$row->material_id);
                $data_ins=array('vendor_id' =>$vendor_id);   
                $update=$this->Common_model->updateDetailsWithMultipleWhere('RawMaterial',$whereArr,$data_ins);

            }
            
        
 if($i!=0){
            
           
        for($j=0;$j<$i;$j++){
         $vendor_id=$this->uri->segment(3);
         $whereArr=array('material_id'=>$material_id[$j]);
        $data =$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArr,'material_id'); 
    
                if($data['result'][0]->vendor_id)
                {
                    $array=explode(",",$data['result'][0]->vendor_id);
                    $count=count($array);
                    $array[$count+1]=$vendor_id;

                    $data_ins=array( 'vendor_id' => implode(",",$array));   
                    $update=$this->Common_model->updateDetailsWithMultipleWhere('RawMaterial',$whereArr,$data_ins);
                }
                else
                {

                    $data_ins=array('vendor_id' => $vendor_id);   
                    $update=$this->Common_model->updateDetailsWithMultipleWhere('RawMaterial',$whereArr,$data_ins);

                }

        if($update)
        {
            $this->session->set_userdata('msg', 'Rawmaterial added successfully');
            $this->session->set_userdata('err_msg', '');
        }
        else
        {
            $this->session->set_userdata('msg', '');
            $this->session->set_userdata('err_msg', 'Rawmaterial not added ');
            
        }
       
       
        
        }
    }
         redirect(base_url().'Vendormanagement/index');
        
    }
    
    
    
    
    
    function show_material()
    {
        
    $vendor_id=$this->input->post('vendor_id');
       
          $whereArr=array('id'=>$vendor_id);
         $vendor_details =$this->Common_model->getAllDataWithMultipleWhere('vendorType',$whereArr,'id');   
        ?>
        
        
        
      
       
            
            
            
                    <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title"><center>Vendor-<?php echo ucfirst($vendor_details['result'][0]->name);?></center></h4>
                      </div>
                     
                 
                      
                      
                 
            
          
                      
            <form id="checkbox" method="post" action="<?php echo base_url();?>Vendormanagement/add_rawmaterial/<?php echo $vendor_id;?>"> 
                              
               
        
                              
            
                <div class="modal-body">
                      
                  <input type="text" class="form-control" id="search" placeholder="RawMaterial Search" onkeyup="searchValues()">    
                     <?php    
                                               
                                $whereArr=array('status<>'=>"2",'store_id'=>$this->session->userdata('StoreId'));
                                $data=$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArr,'material_id');               
                                
                                    
                                 
                                    
                                
                                    
                          ?>      
                       
                          
                      
                        
    
           
            <fieldset class="group">     
            <ul class="checkbox underLine">      
                                <?php 
           foreach($data['result'] as $rawmaterial){
                                    
            $whereArr=array('material_id'=>$rawmaterial->material_id);
            $material_available=$this->Common_model->find_in_set('RawMaterial',$vendor_id,$whereArr);  ?>
                     
            
             <li class="line"><input type="checkbox" id="rawmaterialbox" name="rawmaterialbox[]" value="<?php echo $rawmaterial->material_id;?>"  <?php if($material_available['num_row']>0){echo 'checked';}?> />
            <label class="lebel" for="cb1"><?php echo ucfirst($rawmaterial->material_name);?></label></li>       
             
                     
             
               
                                           <?php 
                                       }
                      ?>
                    
                </ul>
            </fieldset>
     
                          
                          
                          
                          
                          
                          
                          
                          
    
                        
                    
                        
                       
                      </div>
                      <span id="rawmaterialbox_error" style="color:red"></span><br>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button" >Cancel</button>
                          <button class="btn btn-primary" type="button" onclick="checkbox()">Add</button>
                      </div>
                    </form>
                
            </div>

            <?php }  
    

             
        
}
	