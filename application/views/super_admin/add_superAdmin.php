<div class="panel-body">
<div class="">
<?php
$maxid=$this->Common_model->getMaxId('Admin','id');
//echo "<pre>";print_r($maxid);die;
$whereArr=array('isSuperAdmin'=>1,
	      'id'=>$maxid[0]->id);
$admin=$this->Common_model->getAllDataWithMultipleWhere('Admin',$whereArr,'id');
echo "<pre>";print_r($admin);die;
?>
<form role="form"  action="<?php echo base_url(); ?>Owner_store/insertData" method="post" id="updt" enctype="multipart/form-data">
  <input type="hidden" name="mode" value="updateDetails">
            <div class="row">
                <div class="form-group col-lg-3">
                      <label class="control-label">Store Name<span style="color: red;">*</span></label>
                      <input  type="text" style="color: black" placeholder="Store Name" class="form-control test" name="Store_name" id="Store_name" label="Store Name">
                      <span id="Store_name_error" style="color: red"></span><br>
                 </div>
                <div class="form-group col-lg-3">
                       <label class="control-label">Mobile <span style="color: red;">*</span></label>
                       <input  type="number"  placeholder="Mobile" class="form-control test" name="Mobile" id="Mobile" label="Phone No." onblur="check_if_exists();" min="0">
                       <span id="Mobile_error" style="color: red"></span><br>
                </div>
              <div class="form-group col-lg-3">
                     <label class="control-label">Address</label>
                    <textarea  placeholder="Store Address" class="form-control test" name="store_address" id="store_address" label="store_address"></textarea>
              </div>
      </div>
	  
         <div class="row">

	<div class="col-md-3">
		<input type="hidden" name='emailarr' id='emailarr'>
             <button type="button" class="btn btn-default btn pull-right" id="cnbtn" onclick="addNewForm();" style="margin-left:5px;margin-top: 25px;">Cancel</button>
             <button type="button" class="btn btn-primary btn pull-right" id="btn" onclick="validate_form();" style="margin-right: 5px;margin-top: 25px;">Save</button>
        </div>
     </div>
	
	


   

</form>
</div>
</div>


<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script-->
<script>

/*$(document).ready(function(){
	  
});*/
$( document ).ready(function() {
    alert("Hi");
});
 





function validate_form(){
//alert('HI');
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
    //alert(elementid);
    var elementlabel=$(this).attr('label');
    //alert(elementlabel);
    if(elementvalue.search(/\S/) ==-1)
    {
          if(elementid=="Store_name"||elementid=="Mobile"){
            $("#"+elementid+"_error").html(elementlabel+" is needed");
            v1++;
            //alert('needed');
          }
         
    } else{
             $("#"+elementid+"_error").html("");	
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
	//alert(v1);	
    $('#updt').submit();	
}																																
                            
															

	
}




   function check_if_exists() {
	//alert('Hi');
                var Mobile = $("#Mobile").val();
	//alert(Mobile);
                $.ajax(
                    {
                        type:"post",
                        async:"true",
                        url: "<?php echo base_url(); ?>Owner_store/store_exists",
                        data:{ Mobile:Mobile},
                        success:function(response)
                        {
                            //console.log(response);
							//alert(response);
                            if (response >0 ) 
                            {
                                $('#Mobile_error').text("Store exists");
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