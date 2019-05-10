<div class="panel-body">
<div class="">
<?php foreach ($details['result'] as $data){
//echo "<pre>";print_r($data);die;}
?>
<form role="form"  action="<?php echo base_url(); ?>Owner_store/update_store/<?php echo $data->id?>" method="post" id="updt" enctype="multipart/form-data">
  <input type="hidden" name="mode" value="updateDetails">
            <div class="row">
                <div class="form-group col-lg-3">
	        <label class="control-label">Store Name<span style="color: red;">*</span></label>
	        <input  type="text" style="color: black" placeholder="Store Name" class="form-control test" name="Store_name" id="Store_name" label="Store Name"  value="<?php echo $data->name?>">
	        <span id="Store_name_error" style="color: red"></span><br>
                 </div>
                <div class="form-group col-lg-3">
                        <label class="control-label">Mobile <span style="color: red;">*</span></label>
                        <input  type="number"  placeholder="Mobile" class="form-control test" name="Mobile" id="Mobile" label="Phone No." onblur="check_if_exists(<?php echo $data->id?>);" min="0" value="<?php echo $data->phoneNumber?>">
		     <span id="Mobile_error" style="color: red"></span><br>
                </div>
		   <div class="form-group col-lg-3">
	                   <label class="control-label">Address</label>
                             <textarea  placeholder="Store Address" class="form-control test" name="store_address" id="store_address" label="store_address"><?php echo $data->address?></textarea>
	                   <span id="address_error" style="color: red"></span><br>
	             </div>
            </div>
	<hr>
	<div class="row">
		<div class="form-group col-lg-12">
		<label class="control-label">Super Admin Name</label><br>
		<?php
		$where=array('storeId'=>$data->storeId);
		$adminData=$this->Common_model->getAllDataWithMultipleWhere('Admin',$where,'id');
		//echo "<pre>";print_r($adminData);die;
		if(!empty($adminData)){
		foreach($adminData['result'] as $value){
		//echo "<pre>";print_r($value);die;
		if($value->status==1)
		{?>
		<li class="line">
		<input  type="checkbox" value="<?php echo $value->id?>" id="super_admin_name" name="super_admin_name[]" label="super_admin_name" checked><?php echo " ".ucfirst($value->Name);?>
		</li>
		<?php }else if($value->status==3){?>
		<li class="line">
		<input  type="checkbox" value="<?php echo $value->id?>" id="super_admin_name" name="super_admin_name[]" label="super_admin_name"><?php echo " ".ucfirst($value->Name);?>
		</li>
		<?php }
		}
		}
		?>
		</div>
	</div>
	 <div class="row">
	    <div id="addMoreHtml">
	       <p id="addMoreHtml_error" style="color: red;"></p>
	      <label class="control-label">Enter Super Admin</label>
	   </div>
		
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
    
        $(".test1").each(function(){
         var elementvalue= $(this).val();
         //alert(elementvalue);
         var elementid=$(this).attr('id');
         //alert(elementid);
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
    
    
    
    
    
    $(".test").each(function(){
     var elementvalue= $(this).val();
      //alert(elementvalue);
     var elementid=$(this).attr('id');
   // alert(elementid);
    var elementlabel=$(this).attr('label');
    //alert(elementlabel);
    if(elementvalue.search(/\S/) ==-1)
    {
          if(elementid=="Store_name"||elementid=="Mobile"){
            $("#"+elementid+"_error").html(elementlabel+" is needed");
            v1++;
            //alert('needed');
          }
          else{
             $("#"+elementid+"_error").html(elementlabel+"");	
          }
    }
 });
  var mobile=$("#Mobile").val();  
if(mobile!=''){
  if(mobile.length!=10){
        $('#Mobile_error').html('Enter 10 digit mobile number');
        v1++;
    }else{
          $('#Mobile_error').html('');		
    }
  }
    //alert(v1);
if(v1==0 && manupulate==0){
    $('#updt').submit();	
}																																
                           																																

}

  function check_if_exists(id) {
		
				//alert("hi"+id);	

                var Mobile = $("#Mobile").val();
				//alert(mobile);

                $.ajax(
                    {
                        type:"post",
                        async:"true",
                        url: "<?php echo base_url();?>Owner_store/store_exists",
                        data:{ Mobile:Mobile,
			id:id},
                        success:function(response)
                        {
		        //alert(response);
                            //console.log(response);
                            if (response >0 ) 
                            {
                                $('#Mobile_error').text("store exists");
                                $('#btn').prop('disabled',true);
                            }
                            else 
                            {
                                $('#Mobile_error').text(" ");
                               $('#btn').prop('disabled',false);
                                
                            }  
                        }
                    });
            
           }


</script>   
