<!--link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css"-->


 <?php  
 $StoreId=$this->session->userdata('StoreId');
 $whereArr=array('status'=>1,'StoreId'=>$StoreId);
$customer_type=$this->Common_model->getAllDataWithMultipleWhere('customer_type',$whereArr,'id');
//echo "<pre>";print_r($customer_type);die;
?> 
<div class="panel-body">
<div class="">
<form role="form"  action="<?php echo base_url(); ?>Customer_cont/insertData" method="post" id="updt" enctype="multipart/form-data">
  <div class="row">
      <div class="form-group">
		  <input type="hidden" name="mode" value="updateDetails">

               <div class=" col-md-3">
                      <label class="control-label">Customer Name</label> <span style="color: red;">*</span>
                      <input  type="text"  placeholder="Customer Name" class="form-control test" name="customer_name" id="customer_name" label="Customer Name">
                      <span id="customer_name_error" style="color: red"></span><br>
               </div>

               <!--#####################NEW ADDED FOR CUSTOMER EMAIL####################-->
               <div class=" col-md-3">
                      <label class="control-label">Customer Email</label> <span style="color: red;"></span>
                      <input  type="text"  placeholder="Customer Email" class="form-control test" name="customer_email" id="customer_email" label="Customer Email">
                      <span id="customer_email_error" style="color: red"></span><br>
               </div>
               <!--#####################END FOR CUSTOMER EMAIL##########################-->
			<div class=" col-md-3">
                    <label class="control-label">Mobile</label> <span style="color: red;">*</span>
                    <input  type="number"  placeholder="Mobile" class="form-control test" name="mobile" id="mobile" label="Mobile" onblur="check_if_exists();" min="0">
                    <span id="mobile_error" style="color: red"></span><br>
                </div>
			<div class=" col-md-3">
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
			
			<div class=" col-md-4">
					  <label class="control-label">Date Of Birth</label>
							 <div class='input-group date' id='datetimepicker2'>
               <input  type=""   placeholder="Date Of Birth" class="form-control test" name="dob" id="dob" label="dob" onkeypress="return myFunction();">
							 
							 <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
              </span>
							 
          </div>
				 </div>
				 
				 
				 
				 
		    <div class=" col-md-4">
				<label class="control-label">Anniversary</label>
					<div class='input-group date' id='datetimepicker3'>
               <input  type=""  placeholder="Anniversary" class="form-control test" name="anniversary" id="anniversary" label="anniversary" onkeypress="return myFunction();">
							 <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
              </span>
				</div>
			</div>
		<div class=" col-md-4">
			<label class="control-label">Address</label>
			<textarea  placeholder="Customer Address" class="form-control test" name="customer_address" id="customer_address" label="customer_address" rows="1" cols="1"></textarea>
		</div> 
    
</div>
</div>
 
 

 
<div class="row">
     <div class="form-group">
       

         <div class="save_but">
				 <button type="button" class="btn btn-default btn pull-right" id="btn" onclick="addNewForm();" style="margin-left:5px;margin-top: 10px;">Cancel</button>
                    <button type="button" class="btn btn-primary btn pull-right" id="btn" style="margin-right: 5px; margin-top: 10px;" onclick="validate_frm();">Save</button>

         </div>
     </div>
</div>
 
 
 
 
 
</form>

    </div>
</div>


<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script-->
<script>
	
	function myFunction(){

  return false;
}
	
function validate_frm(){
	var error=0;
	var phoneno=$('#mobile').val();
	var	email=$('#customer_email').val();
	//alert(error);
	$(".test").each(function(){
		//alert('Hi');
		var elementvalue= $(this).val();
		//alert(elementvalue);
		var elementid=$(this).attr('id');
		//alert(elementid);
	       var elementlabel=$(this).attr('label');
		//alert(elementlabel);
		if(elementvalue.search(/\S/) ==-1)
		{
			//alert(elementid);
			if(elementid=="customer_name"||elementid=="mobile")
            {
				$("#"+elementid+"_error").html(elementlabel+" is needed");
				error++;
            }
																												
            
		}else{
			$("#"+elementid+"_error").html("");
		}
											
		
	});
	//alert(error);
	//alert(phoneno);
	  if(phoneno!=''){
         if(phoneno.length!=10){
            //$('#mobile_error').html('Please insert a 10 digit mobile number');
			//alert('please enter 10 digit number');
				$("#mobile_error").html("Correct phonenumber is needed");
            error++;
         }
        }
      if(email!="")
	{
		var pat=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
		if(!pat.test(email)){ 
			$('#customer_email_error').text("Email not correct");
			$('#customer_email_error').css('color','red');
			error++;
		}
		else{
						$('#customer_email_error').text("");
		}
														
	}
		//alert(error);
		
		 if(error==0){
            $('#updt').submit();
		}
}


</script>

<script type='text/javascript'>
/*$(document).ready(function(){
 var v = new Date();
var y=v.getFullYear();
var y2=y-10;
var m=v.getMonth();
var d=v.getDate();
var date=y2+"-"+m+"-"+d;

 $('#dob').datepicker({

  dateFormat: "yy-mm-dd",
  maxDate: new Date(date)

 });
// $( function() {
// $( "#datepicker" ).datepicker();
// dateFormat: "yyyy-mm-dd"
} ); */
    
 </script>



<script type='text/javascript'>
/*$(document).ready(function(){
 var v = new Date();
var y=v.getFullYear();
var y2=y-10;
var m=v.getMonth();
var d=v.getDate();
var date=y2+"-"+m+"-"+d;

 $('#anniversary').datepicker({

  dateFormat: "yy-mm-dd",
  maxDate: new Date(date)

 });
// $( function() {
// $( "#datepicker" ).datepicker();
// dateFormat: "yyyy-mm-dd"
} ); */
    
 </script>
            
	
