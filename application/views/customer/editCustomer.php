<!--link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css"-->
  
 <?php
$whereArr = array('status'=>1);
$customer_type = $this->Common_model->getAllDataWithMultipleWhere('customer_type',$whereArr,'id');
//echo "<pre>";print_r($details);die;
					   if(!empty($details['result'])){
                       foreach ($details['result'] as $row)  
                        {
							//echo "<pre>";print_r($row);die;
							//echo $row->DOB;echo $row->anniversary;die;
							//echo $row->customer_id;die;
                            $where=array('customer_id'=>$row->customer_id);
							$order=$this->Common_model->getAllDataWithMultipleWhere('Order',$where,'order_id');
							//echo "<pre>";print_r($order);die;
							if(!empty($order['result'])){
								$paidAmount=0;
								$orders=$order['num_row'];
								$lastTrans=$order['result'][0]->paidAmount;
								foreach($order['result'] as $item){
									//echo "<pre>";print_r($item->customer_id);die;
									$paidAmount=$paidAmount+($item->paidAmount);
									/*if($row->customer_id==$item->customer_id){
										$order++;
									}*/
									
									
								
								//echo $paidAmount;die;
								//echo $order;die;
								}
						}else{
							$paidAmount="NA";
							$orders="NA";
							$lastTrans="NA";
						}
                        ?>

<div class="panel-body">
     <div class="">
         <form role="form" action="<?php echo base_url();?>Customer_cont/update_customer/<?php echo $row->customer_id ; ?>" method="post" id="updt" enctype="multipart/form-data">
              <div class="row">
               <div class="form-group">
                        <div class=" col-md-3">
                                <input type="hidden" name="mode" value="updateDetails">
							    <label class="control-label">Customer Name:</label><span style="color: red;">*</span>
							    <input  type="text"  placeholder="Customer Name" class="form-control test need" name="customer_name" id="customer_name" value="<?php echo $row->customer_name ?>" label="Customer Name">
							    <span id="customer_name_error" style="color: red"></span>
                        </div>

                        <!--#######################NEW ADDED FOR CUSTOMER EMAIL##################-->
                        <div class=" col-md-3">
							    <label class="control-label">Customer Email:</label><span style="color: red;"></span>
							    <input  type="text"  placeholder="Customer Email" class="form-control test need" name="customer_email" id="customer_email" value="<?php echo $row->cust_email ?>" label="Customer Email">
							    <span id="customer_email_error" style="color: red"></span>
                        </div>
                        <!--#######################END FOR NEW ADDED FOR CUSTOMER EMAIL##################-->
						
						 <div class=" col-md-3">
							<label class="control-label">Mobile:</label><span style="color: red;">*</span>
							<input  type="text"  placeholder="Mobile" class="form-control test " name="mobile" id="mobile" value="<?php echo $row->customer_phone ?>"label="Mobile" onblur="check_if_exists('<?php echo $row->customer_id;?>');">
							<span id="mobile_error" style="color: red"></span>
						</div>
						 
						   <div class=" col-md-3">
							<label class="control-label">Customer Type</label>
							<select class="form-control " style="color: black" id="customer_type" name="customer_type" label="customer_type"   data-max-options="1">
									<option value="select">select</option>
									<?php
									foreach($customer_type['result'] as $type){
									if($type->id==$row->customer_type){?>
									<option value="<?php echo $type->id;?>" selected="selected"><?php echo $type->name;?></option>
								<?php }else{?>
									<option value="<?php echo $type->id;?>"><?php echo $type->name?></option>								
						<?php }
							}
						?>
						</select>
					 </div>
    
</div>
</div>
					
 <div class="row">
     <div class="form-group">
		<div class=" col-md-4">
               <input type="hidden" name="mode" value="updateDetails">
               <label class="control-label">Date Of Birth</label>
			   	 <div class='input-group date' id='datetimepicker1'>
					 <input  type=""  placeholder="Date Of Birth" class="form-control test" name="dob" id="Dob" label="dob" value="<?php echo $row->DOB ?>"onkeypress="return myFunction();">
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
		</div>
		
		 <div class=" col-md-4">
                <label class="control-label">Anniversary</label>
				 <div class='input-group date' id='datetimepicker2'>
                <input  type=""  placeholder="Anniversary" class="form-control test" name="anniversary" id="Anniversary" label="anniversary" value="<?php echo $row->anniversary ?>"onkeypress="return myFunction();">
				
				<span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
              </span>
        </div>
		 </div>
         <div class=" col-md-4">
			   <label class="control-label">Address:</label>
    				<textarea  placeholder="Address" class="form-control test " name="address" id="address" rows="1" label="address"><?php echo $row->address ?></textarea>
        </div> 
    </div>
 </div>
 
 
 <div class="row">
     <div class="form-group">
         <div class=" col-md-4">
			   <label class="control-label">No.Of Placed Order</label>
				<input readonly type="text"  placeholder="No.of placed order" class="form-control test need" name="placed_order" id="placed_order" value="<?php echo $orders?>" label="No of placed order">
        </div> 
       
    <div class=" col-md-4">
         <label class="control-label">Amount Paid</label>
		<input readonly type="text"  placeholder="Amount Paid" class="form-control test need" name="amount_paid" id="amount_paid" value="<?php echo $paidAmount?>" label="amount_paid">
	</div>
	
	<div class=" col-md-4">
			<label class="control-label">Last Transaction</label>
			<input readonly type="text"  placeholder="Last Transaction" class="form-control test need" name="last_transaction" id="last_transaction" value="<?php echo $lastTrans ?>" label="last_transaction">
		</div>
	
	 </div>
 </div>
 
<div class="row">
    <div class="form-group">
     

        <div class="save_but">
			
			<button type="button" class="btn btn-default btn pull-right" id="cnbtn" onclick="addNewForm();" style="margin-left:5px;margin-top: 10px;">Cancel</button>
            <button type="button" class="btn btn-primary btn pull-right" id="btn" style="margin-right: 5px; margin-top: 10px;" onclick="validate();">Save</button>


        </div>
    </div>
</div> 





 
</form>

    </div>
</div>
<?php }
	}
?>

<!--link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css"-->
  
<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script-->
 <!--script src="https://code.jquery.com/jquery-1.12.4.js"></script-->
<script>
function myFunction(){
	return false;
}



function validate(){
	
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
				$("#mobile_error").html("Enter 10 digit mobile number");
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


  function check_if_exists(id) {
		
				//alert("hi"+id);	

                var mobile = $("#mobile").val();
				//alert(mobile);

                $.ajax(
                    {
                        type:"post",
                        async:"true",
                        url: "<?php echo base_url();?>Customer_cont/customer_exists",
                        data:{ mobile:mobile,
								id:id},
                        success:function(response)
                        {
							//alert(response);
                            //console.log(response);
                            if (response >0 ) 
                            {
                                $('#phoneno_error').text("customer exists");
                                $('#btn').prop('disabled',true);
                            }
                            else 
                            {
                                $('#phoneno_error').text(" ");
                               $('#btn').prop('disabled',false);
                                
                            }  
                        }
                    });
            
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

 $('#Dob').datepicker({

  dateFormat: "yy-mm-dd",
  maxDate: new Date(date)

 });
});   */
 </script>



<script type='text/javascript'>
/*$(document).ready(function(){
 var v = new Date();
var y=v.getFullYear();
var y2=y-10;
var m=v.getMonth();
var d=v.getDate();
var date=y2+"-"+m+"-"+d;

 $('#Anniversary').datepicker({

  dateFormat: "yy-mm-dd",
  maxDate: new Date(date)

 });
// $( function() {
// $( "#datepicker" ).datepicker();
// dateFormat: "yyyy-mm-dd"
}); */
    
 </script>
 
        
