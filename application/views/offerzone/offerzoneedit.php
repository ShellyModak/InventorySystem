
                       <?php    
                       foreach ($edit_data['result'] as $value)  
                        { 
                             $arry=explode(",",$value->customer_id);
                            
                        ?>
                        
              <div>

              <a href="<?php echo base_url(); ?>Offerzone/index" style="color: white;">
              <button type="button" class="btn btn-primary btn-sm" style="float: right; margin-top: -5px;">Add offer Type</button>
              </a>
              </div><br>          
            <div class="panel-body">
                <div class="position-center">
                   <!--  <form role="form" id="frm" name="frm" action="<?php echo base_url(); ?>Offerzone/update/<?php echo $row->id ; ?>" method="post" id="updt" enctype="multipart/form-data"> -->
                      <form role="form" id="frm" name="frm" action="<?php echo base_url(); ?>Offerzone/update/<?php echo $value->id ; ?>"  method="post" >
                          <div class="row">
                            <label class="control-label">Customer Name:</label>
                
              

                             <div class="icheck">
                              <div class="flat-green single-row">
                                   <div class="radio row">

                                     <span id="pageaccess_title_error" style="color: red;"></span>
                                      <?php $val=$this->Common_model->fetchAllData('Customer','customer_id');
                                       
                                       
                                     //  echo $val['result'][0]->customer_id;
                                   
                                       foreach($val['result'] as $row1){
                                                //  echo $val[customer_id];     
                                      ?>


                                   <div class="form-group col-md-3">
                                                            
                                      <input  type="checkbox" value="<?php echo $row1->customer_id;?>" id="check_box" name="checkbox[]" label=checkbox_title<?php if (in_array( $row1->customer_id,$arry)){?> checked="checked" <?php } ?> style="height: 20px;width: 20px;"><?php echo " ".ucfirst($row1->customer_name)?>
                                     </div>              
                                   <?php }?> 




                     
                                  </div>
                            </div>
                          </div>

                          
                    </div>
                    
   
                    <div class="row">
                      <div class="form-group col-lg-6">
                                  <label class="control-label">Offer Type:</label>
                              <select class="form-control" id="offer_type" name="offer_type" label="offer_type" data-max-options="1">
                                <option value="1" <?php if($value->offer_type==1) echo 'selected';?>>Amount</option>
                                <option value="2" <?php if($value->offer_type==2) echo 'selected';?>>Percentage</option>
                                </select>
                                <span id="offer_type_error" style="color: red"></span>
                          </div>
                      <div class="form-group col-lg-6"> 
                         <label class="control-label">Amount:<span style="color: red;">*</span></label>
                             <input  type="text"  placeholder="Amount" class="form-control test need" name="amount" id="amount" value="<?php echo $value->amount ?>" label="Amount" onblur="check_if_exists();">
                            <span id="amount_error" style="color: red"></span>                      
                  
                       </div>
                  
                     
                    </div>



                    <div class="row">
                        <div class="form-group col-lg-6"> 
                          <label class="control-label">Minimum Amount:<span style="color: red;">*</span></label>
                            <input  type="text"  placeholder="Minimum Amount" class="form-control test need" name="minamount" id="minamount" value="<?php echo $value->min_amount ?>" label="Min Amount" onblur="check_if_exists();">
                            <span id="minamount_error" style="color: red"></span>
                         
                      </div>
                       <div class="form-group col-lg-6"> 
                           <label class="control-label">Offer Purpose:<span style="color: red;">*</span></label>
                             <input  type="text"  placeholder="Offer Purpose" class="form-control test need" name="offerpurpose" id="offerpurpose" value="<?php echo $value->offer_purpose ?>" label="Offer Purpose" >
                              <span id="offerpurpose_error" style="color: red"></span>
                 
                         </div>
                       


                   </div><br>

                   <div class="row">

                      
                    <div class="form-group col-lg-6">   
                       <label>Note:</label>
                       <textarea id="note" name="note" placeholder="Note..." rows="4" class="form-control "><?php echo $value->note;?></textarea>
                       <span id="note_error" style="color: red;"></span>  
                    </div>


                    <div class="form-group col-lg-6">
                          <label class="control-label">Status:</label>
                             <select class="form-control " id="status" name="status" label="status"  data-max-options="1">
                              <option value="1" <?php if($value->status==1) echo 'selected';?>>Active</option>
                              <option value="0" <?php if($value->status==0) echo 'selected';?>>Inactive</option>
                            </select>
                             <span id="status_error" style="color: red"></span>
                     </div>
                  </div>

        </form>



<div class="row">
     <div class="form-group">
       

         <div class="save_but">
        
         
         <button type="button" class="btn btn-default btn pull-right" id="cnbtn" onclick="location.href='<?php echo base_url(); ?>CustomerType/index'" style="margin: 10px;">Cancel</button>
            <button type="button" class="btn btn-primary btn pull-right" id="btn"onclick="validate(<?php echo $value->id ; ?>);" style="margin: 10px;">Save</button>

         </div>
     </div>
</div>           
                                   
       
                    <?php } ?>
                 </div>
            </div>
          <!--   </section>
        </div>
        </div>
    </section>
</section> -->
 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
        function validate(){
                 
                var error_count=0;
               // $('#frm').submit(); 
                var amount=$("#amount").val();   
                if(amount==""){
                    $("#amount_error").html("Amount is needed !!!");
                     error_count++;
                    
                 }
                  else{
                     var amountReg = /^[0-9]+(\.[0-9]{2})?$/;
                     if(amountReg.test(amount)){
                       $("#amount_error").html("");
                     }
                     else{
                         $("#amount_error").html("Please enter a valid amount !!!");
                          error_count++;
                     } 
                  }

                var minamount=$("#minamount").val();
                 if(minamount==""){
                    $("#minamount_error").html("Minimum amount is needed !!!");
                     error_count++;
                 }
                 else{
                 var minamountReg = /^[0-9]+(\.[0-9]{2})?$/;
                 if(minamountReg.test(minamount)){
                   $("#minamount_error").html("");
                 }
                 else{
                     $("#minamount_error").html("Please enter a valid min amount !!!");
                      error_count++;
                    } 
                 }

                 var offerpurpose=$("#offerpurpose").val();
                 if(offerpurpose==""){
                    $("#offerpurpose_error").html("Offer purpose is needed !!!");
                     error_count++;
                 }
                 else{
                    $("#offerpurpose_error").html(" ");
                 }

    
               if(error_count==0){
                  $('#frm').submit(); 
                }                      
} 
</script>   
                    
            
