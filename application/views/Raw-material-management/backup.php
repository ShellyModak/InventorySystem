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
 $whereArr=array('status<>'=>"2",'storeId'=>$this->session->userdata('StoreId'));
        $vendor=$this->Common_model->getAllDataWithMultipleWhere('vendorType',$whereArr,'id');

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
                                            foreach($unit['result'] as $row): 
                                            if($row->status != 2){ ?>
                                              <option value="<?php echo $row->unit_id?>"><?php echo $row->unit_name?></option> 
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
                                    foreach($vendor['result'] as $row):
                                        if($row->status != 2 ) { ?>

                                     <li class="line"> <input type="checkbox" value="<?php echo $row->id?>" name=vendor[] class="test_vendor"  label=Vendor  ><?php echo $row->name?>
                                        </li>
                                                                   <?php 
                                                               }
                                    endforeach;  ?>
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
    