<div class="panel-body">
<div class="">
<?php
//echo "<pre>";print_r($details);die;
foreach ($details['result'] as $data){
//echo "<pre>";print_r($data);die;
?>
<form role="form"  action="<?php echo base_url(); ?>SuperAdmin_cont/update_superadmin/<?php echo $data->id?>" method="post" id="updt" enctype="multipart/form-data">
  <input type="hidden" name="mode" value="updateDetails">
            <div class="row">
                <div class="form-group col-lg-3">
	        <label class="control-label">Super Admin Name<span style="color: red;">*</span></label>
	        <input  type="text" style="color: black" placeholder="Super Admin Name" class="form-control test" name="Super_admin_name" id="Super_admin_name" label="Super Admin Name"  value="<?php echo $data->Name?>">
	        <span id="Super_admin_name_error" style="color: red"></span><br>
                 </div>
                <div class="form-group col-lg-3">
                        <label class="control-label">Email <span style="color: red;">*</span></label>
                        <input  type="text"  placeholder="email" class="form-control test" name="email" id="email" label="Email"  value="<?php echo $data->email?>" readonly>
		     <span id="email_error" style="color: red"></span><br>
                </div>
		   <div class="form-group col-lg-3">
	                   <label class="control-label">Details</label>
                             <textarea  placeholder="Super Admin Details" class="form-control" name="super_admin_details" id="super_admin_details" label="Super Admin Details"><?php echo $data->details?></textarea>
	                   <span id="address_error" style="color: red"></span><br>
	             </div>
            </div>
	 <div class="row ">
	     <div class="form-group col-lg-3">
        	       <button type="button" id="pass" onclick="genrate_pass();">Generate Password</button>
                 <input  type="password"  placeholder="Password" class="form-control test" name="password" id="password" label="Password"  value="">
	     </div>
	 </div>
	  

	 <div class="row">
	    
		
              <div class="col-md-3">
                     <button type="button" class="btn btn-default btn pull-right" id="cnbtn" onclick="addNewForm();" style="margin-left:5px;margin-top: 25px;">Cancel</button>
                     <button type="button" class="btn btn-primary btn pull-right" id="btn" style="margin-right: 5px;margin-top: 25px;" onclick="validate();" >Save</button>
	    </div>
	 </div>
   
<?php } ?>
<?php //echo "<pre>";print_r($details);die?>
<input type="hidden" name="storeId" id="storeId" value="<?php echo $details['result'][0]->storeId?>">
</form>
</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>



function validate(){
    var v1=0;
    
        $(".test").each(function(){
         var elementvalue= $(this).val();
         alert(elementvalue);
         var elementid=$(this).attr('id');
         alert(elementid);
         var elementlabel=$(this).attr('label');
         //alert(elementlabel);
        if(elementvalue.search(/\S/) ==-1)
        {
            
             $("#"+elementid+"_error").html(elementlabel+" is needed");
             v1++;
            //alert('needed');
        
         
    } else{
             $("#"+elementid+"_error").html("");	
          }
   });
    
   if(v1===0){
    $('#updt').submit();	
} 
    
}

function genrate_pass(){
	  $('#password').show();
}
  


</script>   
