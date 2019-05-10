
<!-- <section id="main-content">
        <section class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Edit Customer Type -->
                            
                            <!-- </header> -->
         
                       <?php    
                       foreach ($edit_data['result'] as $row)  
                        { 
                            // $arry=explode(",",$row->vendor_id);
                        ?>
                        
              <div>

<a href="<?php echo base_url(); ?>CustomerType/index" style="color: white;">
<button type="button" class="btn btn-primary btn-sm" style="float: right; margin-top: -5px;">Add Customer Type</button>
</a>
</div><br>          
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" id="frm" name="frm"action="<?php echo base_url(); ?>CustomerType/update/<?php echo $row->id ; ?>" method="post" id="updt" enctype="multipart/form-data">
                    <div class="row">
                    <div class="form-group col-lg-6">
                   
                    <input type="hidden" name="mode" value="updateDetails">
                        <label class="control-label">Customer Type:</label>    
                        <input  type="text"  placeholder="Customer Type" class="form-control test need" name="customer_type_name" id="customer_type_name" value="<?php echo $row->name ?>" label="Customer type" onblur="check_if_exists();">
                		<span id="customer_type_name_error" style="color: red"></span>
                		</div>
        			
        			

        			<div class="form-group col-lg-6">
                   	  <label class="control-label">Discount Type:</label>
                  <select class="form-control " id="discount_name" name="discount_name" label="discount_name"   data-max-options="1">
                    <option value="1" <?php if($row->discount_type==1) echo 'selected';?>>Amount</option>
                    <option value="2" <?php if($row->discount_type==2) echo 'selected';?>>Percentage</option>
                      </select>
                        <span id="discount_type_error" style="color: red"></span>
                   	</div>
                   	</div>
                    
   
    				<div class="row">
         			<div class="form-group col-lg-6">   
              <label class="control-label">Amount:</label>
            <input  type="text"  placeholder="Amount" class="form-control test need" name="amount" id="amount" value="<?php echo $row->amount ?>"label="Amount" onblur="check_if_exists();">
                    <span id="amount_error" style="color: red"></span>                    
     			
                   
                    </div>
					
                   <div class="form-group col-lg-6"> 
                   <label class="control-label">Minimum Amount:</label>
                    <input  type="text"  placeholder="Minimum Amount" class="form-control test need" name="minamount" id="minamount" value="<?php echo $row->min_amount ?>"label="Amount" onblur="check_if_exists();">
                    <span id="minamount_error" style="color: red"></span>
                 
                    </div>
                    </div>

                    <div class="row">
                     <div class="form-group col-lg-6">
                     <label class="control-label">Status:</label>
                  <select class="form-control " id="status" name="status" label="status"   data-max-options="1">
                    <option value="1" <?php if($row->status==1) echo 'selected';?>>Active</option>
                    <option value="0" <?php if($row->status==0) echo 'selected';?>>Inactive</option>
                    </select>
                    <span id="status_error" style="color: red"></span>
                    </div>
                   </div><br>

                       

                    </form>

<div class="row">
     <div class="form-group col-lg-6">
         <div class="save_but">
        
        <button type="button" class="btn btn-default btn pull-right" id="btn" onclick="location.href='<?php echo base_url(); ?>CustomerType/index'" style="margin: 13px;">Cancel</button>
       
      <button type="submit" class="btn btn-primary btn pull-right" id="btn" onclick="validate(<?php echo $row->id ; ?>);" style="margin: 13px;">Save</button>
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
           function validate(uid){
                 
        var error_count=0;
       

        var name=$("#customer_type_name").val();   
        if(name==""){
            $("#customer_type_name_error").html("Customer type is needed");
            error_count++;
         }
         else{
            
           $.ajax({
              url:"<?php echo base_url();?>CustomerType/customer_type_duplicate_edit", 
              data: {'name':name,'uid':uid},
              type:"POST",            
              async:false,
              success:function(response)
              {   console.log(response);
                  if(response>0){
                      $("#customer_type_name_error").html("Customer type is already exist");
                      error_count++;
              }
              else{
                 $("#customer_type_name_error").html("");
                 
              }
            }
          });
        }


        var amount=$("#amount").val();
         if(amount==""){
            $("#amount_error").html("Amount is needed");
            error_count++;
         }
         else{
         var amountReg = /^[0-9]+(\.[0-9]{2})?$/;
         if(amountReg.test(amount)){
           $("#amount_error").html("");
         }
         else{
             $("#amount_error").html("Please enter a valid amount");
              error_count++;
            } 
         }


        var minamount=$("#minamount").val();
         if(minamount==""){
            $("#minamount_error").html("Minimum amount is needed");
            error_count++;
         }
         else{
         var minamountReg = /^[0-9]+(\.[0-9]{2})?$/;
         if(minamountReg.test(minamount)){
           $("#minamount_error").html("");
         }
         else{
             $("#minamount_error").html("Please enter a valid min amount");
              error_count++;
            } 
         }

         
 if(error_count==0){
    $('#frm').submit(); 
  }                      
} 
</script>   
                    
            
