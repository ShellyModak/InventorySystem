<!--main content start-->
<style>
fieldset.group  { 
 margin: 0; 
 padding: 0; 
 margin-bottom: 1.25em; 
 padding: .125em; 
} 

fieldset.group legend { 
 margin: 0; 
 padding: 0; 
 font-weight: bold; 
 margin-left: 20px; 
 font-size: 100%; 
 color: black; 
} 

ul.checkbox  { 
 margin: 0; 
 padding: 0; 
 margin-left: 20px; 
 list-style: none; 
} 

ul.checkbox li input { 
 margin-right: .25em; 
} 

ul.checkbox li { 
 border: 1px transparent solid; 
 display:inline-block;
 width:20em;
} 

ul.checkbox li label { 
 margin-left: ; 
} 



</style>

   <section id="main-content">
       <section class="wrapper">
       <!-- page start-->

       <div class="row">
           <div class="col-sm-12">
             <?php if($this->session->userdata('success_msg') !=''){?>
                   <div class="alert alert-success message" id="successMessage">
                  <strong>Success! </strong><span class=""><?php echo $this->session->userdata('success_msg'); ?></span> 
                  </div>
                  <?php
                    $this->session->unset_userdata('success_msg');
                   }?>
               

                  <section class="panel">
                   <header class="panel-heading" id="header">
                     
                       <span class="tools pull-right">
                           <a href="javascript:;" class="fa fa-chevron-down"></a>
                           <a href="javascript:;" class="fa fa-cog"></a>
                           <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                   </header>
                   <div class="panel-body">
                    
                       <div id="addForm"></div>
    
                   </div>
                
             </section>
           
           </div>
       <div class="col-sm-12">
           
               <section class="panel">
                   <header class="panel-heading">
                       Sub Admin Details
                       
                       <span class="tools pull-right">
                           <a href="javascript:;" class="fa fa-chevron-down"></a>
                           <a href="javascript:;" class="fa fa-cog"></a>
                           <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                   </header>
                  
                   <div class="panel-body">
                    <!-- <button type="button" class="btn btn-primary btn pull-right" onclick="location.href='<?php echo base_url(); ?>Adminmanagement/insertSubadmin'">Add new SubAdmin</button> -->
                   <div class="adv-table">
                       
                   <table  class="display table table-bordered table-striped" id="dynamic-table">
                   <thead>
                   <tr>
                                   
                                    <th class="numeric">Name</th>
                                  <!--  <th class="numeric">Email</th>-->
                                    <th class="numeric">Username</th>
                                   <!-- <th class="numeric">Store Access</th>-->
																																
                                    <th class="numeric">PhoneNo</th>
                                   <!-- <th class="numeric">Status</th>-->
                                   <!-- <th class="numeric">PageAccess</th>-->
                                    <th class="numeric">Option</th>
																																				
                                    
                                </tr>
                                </thead>
                                <tbody>
          <?php  
          if(!empty($listing['result'])){ // new added for not empty listing
          if(count($listing)>0){
             //echo"<pre>";
             // print_r($listing);
         foreach ($listing['result'] as $row)  
         { 
          //for store access name//
              $name=array();
              $storeaccess=$row->storeIdAccess;
              $newstorename=explode(",",$storeaccess);
														//echo "<pre>";print_r($newstorename);die;
              $total=count($newstorename);
            for($i=0;$i<$total;$i++){
              $storename=$newstorename[$i];
              $wherearr=array('id'=>$storename);
              $store_name=$this->Common_model->getAllDataWithMultipleWhere('store',$wherearr,'id');
														//echo "<pre>";print_r($store_name);die;
              if(!empty($store_name['result'])){
              array_push($name,$store_name['result'][0]->name."(".$store_name['result'][0]->storeId.")");
														//echo "<pre>";print_r($name);die;
            }
            }
            $newname=implode(",",$name);
            //echo $newname;die;
          if($row->status==1 || $row->status==0){
            ?>
                <tr>  
                <td style="color: black"><?php echo ucfirst($row->Name);?></td> 
             <!-- <td style="color: black"><?php echo ucfirst($row->email);?></td>-->
              <td style="color: black"><?php echo ($row->Store_name);?></td>
             <!-- <td style="color: black"><?php echo ucfirst($newname);?></td>-->
              <td style="color: black"><?php echo $row->phoneno;?></td> 
            <!-- <td><?php //echo $row->status;?></td> -->

             <!-- <td>
                                        <?php
                                    //echo $reviewDtls->status ;
                                        if($row->status == 1)
                                        {
                                        ?>
                                        <span style="cursor:pointer;float:center;color: black" title="Active Review" onclick="changeStauts('<?php echo $row->id;?>', 0);">Active
                                           <i class="fa fa-check-circle"></i>
                                        </span>
                                        <?php
                                        } 
                                        else
                                        {
                                        ?>
                                        <span style="cursor:pointer;float:center;color: black" title="Inactive Review" onclick="changeStauts('<?php echo $row->id;?>', 1);">Inactive
                                          <i class="fa fa-ban"></i>
                                        </span>
                                        <?php
                                        }
                                        ?>
                                    </td>  -->
         <!--   <td><?php echo $row->pageAccess;?></td>-->
          
        <td>
        <i class="fa fa-edit" style= "cursor:pointer" onclick="editForm(<?php echo $row->id ;?>);"></i>
        <!-- <a href="<?php echo base_url(); ?>Adminmanagement/editSubAdmin/<?php echo $row->id ;?>"><i class="fa fa-edit"></i>
        </a> -->
        <i class="fa fa-trash-o" style= "cursor:pointer" aria-hidden="true" onclick="deleteSubAdmin('<?php echo $row->id;?>');"></i>
                                        <?php
                                    //echo $reviewDtls->status ;
                                        if($row->status == 1)
                                        {
                                        ?>
                                           <i class="fa fa-check-circle" style= "cursor:pointer" onclick="changeStauts('<?php echo $row->id;?>', 0);"></i>
                                    
                                        <?php
                                        } 
                                        else
                                        {
                                        ?>
                                          <i class="fa fa-ban" style= "cursor:pointer" onclick="changeStauts('<?php echo $row->id;?>', 1);"></i>
                                      
                                        <?php
                                        }
                                        ?>
        </td>

<!--         <button type="button" class="btn btn-primary" onclick="location.href='<?php echo base_url(); ?>Adminmanagement/editSubAdmin/<?php echo $row->id ;?>'">Edit</button> -->
                    <!-- <button type="button" class="btn btn-primary" onclick="deleteSubAdmin('<?php echo $row->id;?>');">Delete</button></td> -->
             </tr> 
        <?php 
            }
          }
        }
      }
         ?>
                                
                                </tbody>
                   </table>
                   <form method="post" id="import_form" enctype="multipart/form-data">
      <input type="file" name="file" id="file" required accept=".xls, .xlsx"/></p>
                      <br />
   <input type="submit" name="import" value="Import"/>
   </form>
               <!-- <button type="button" class="btn btn-primary btn pull-left" onclick="import_data()">IMPORT</button> -->
                   <br>
                   
                   <button type="button" class="btn btn-primary btn pull-right" onclick="location.href='<?php echo base_url(); ?>Adminmanagement/excel'">Export As Excel</button>
                      
                   </div>
                   </div>
                   
               </section>
    </div>
    </div>
       <!-- page end-->
       </section>
   </section>
   <!--main content end-->
   <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script-->
   <script type="text/javascript">
   $(document).ready(function() {
    newform('');
				var email_error=0;
				var user_error=0;
				
				setTimeout(function() {
          $('#successMessage').fadeOut('fast');
      }, 1000); 
});
  $('#import_form').on('submit', function(event){
  event.preventDefault();
  $.ajax({
   url:"<?php echo base_url(); ?>Adminmanagement/import",
   method:"POST",
   data:new FormData(this),
   contentType:false,
   cache:false,
   processData:false,
   success:function(data){
    $('#file').val('');
    //load_data();
    alert(data);
   }
  })
 });

   function newform(id){
    {
      //alert(id);
          $.ajax({
                    url:"<?php echo base_url();?>Adminmanagement/addForm",   
                    data:{id:id},
                    type:"POST",            
                    dataType:"text",
                    async: false,
                    success:function(response)
                    {   
                        $('#addForm').html(response);
												$('#header').html("Add SubAdmin");
                         
                    }
                                                 
                                      
                                        
                });
     }
   }
   function editForm(id)
     {
          $.ajax({
                    url:"<?php echo base_url();?>Adminmanagement/edit",   
                    data:{id:id},
                    type:"POST",            
                    dataType:"text",
                    async: false,
                    success:function(response)
                    {   
                        $('#addForm').html(response);
																								 window.scrollTo(500, 0);
                          $('#header').html("Edit SubAdmin");
																										 email_error=0;
																										  user_error=0;
                         
                    }
                                                 
                                      
                                        
                });
     } 


   function deleteSubAdmin(id)
{
    if(confirm("Do you want to delete this unit?"))
    {
        window.location.href="<?php echo base_url();?>Adminmanagement/deleteData/"+id;
    }
}
   function changeStauts(id,status){
    
    var confirmstatus=confirm('Are you sure you want to change status');
    if(confirmstatus)
    {
        location.href="<?php echo base_url();?>Adminmanagement/changeStatusReview/"+id+"/"+status;
    }
  }
//==============================validations for add subadmin===============================//
function check() {
   
        var username=$('#user_name').val().trim();
     
								if(username!=''){
        $.ajax({
            type:'post',
             url: '<?php echo base_url();?>Adminmanagement/username_check',
            data: { username:username},
  success: function (response){
    //alert(response);
    if (response>0) {
					user_error=1;
    $('#user_name_error').text("Username already exists");
    $('#user_name_error').css('color','red');
    $('#btn').prop('disabled',true);
    }else{
						user_error=0;
        $('#user_name_error').text('');
       $('#btn').prop('disabled',false); 
    }
  }
});
	}else{
									$('#btn').prop('disabled',false);
								}
 
 }
				
				
      function check_email(errorcount){
       var email=$('#email_address').val();
							var err2 = errorcount;
							
							if(err2==0){
							
       if(email!=''){
								
        $.ajax({
            type:'post',
             url: '<?php echo base_url();?>Adminmanagement/email_check',
            data: { email:email},
  success: function (response){
    //alert(response);
    if (response>0) {
					email_error=1;
    $('#email_address_error').text("Email already exists");
    $('#email_address_error').css('color','red');
    $('#btn').prop('disabled',true);
    }else{
								email_error=0;
        $('#email_address_error').text('');
       $('#btn').prop('disabled',false); 
    }
  }
});
      }else{
        //$('#email_address_error').text('');
        $('#btn').prop('disabled',false);
      }
    }
						}


 function checknumber(){
            var phone=$('#phoneno').val();
        if(isNaN(phone)){
           alert('Please enter number');
            $('#phoneno').val('');
        }
    }
     
					
					
					
						function validate_frm(){
				var err1 = 0;
					var v1=0;
					var	email=$('#email_address').val();
					var mobile=$('#phoneno').val();
									
		        	$(".test").each(function()
		       		 {
			        	var elementvalue= $(this).val();
												//alert(elementvalue);
			       		var elementid=$(this).attr('id');
												//alert(elementid);
			        	var elementlabel=$(this).attr('label');
												//alert(elementlabel);
												
												
					//alert(fields);
			       		if(elementvalue.search(/\S/) ==-1)
			       		 {
																	//alert(elementid);
                             if(elementid=="name"||elementid=="email_address"||elementid=="user_name"||elementid=="password")
                            {
																																$("#"+elementid+"_error").html(elementlabel+" is needed");
																																v1++;
                            }
																												
													}else{
														$("#"+elementid+"_error").html("");
													}
													
              });            
													
            if(email!="")
			        	{
														var pat=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
														if(!pat.test(email)){ 
															$('#email_address_error').text("Email not correct");
															$('#email_address_error').css('color','red');
															v1++;
															err1++;
														}
														else{
																		$('#email_address_error').text("");
														}
														
												}
                        
            if(mobile!="")
			        	{
				        	if (mobile.length!=10) 
																	{ 
																					$("#phoneno_error").html("Correct phonenumber is needed");
																					v1++;
																 	}
															else 
															{
																				$("#phoneno_error").html("");
																}
												} 
                     
                      
									
											if($("input[name='pageaccess[]']").serializeArray().length===0){
													$("#pageaccess_title_error").html("Page Access is needed");
													//alert('error');
													v1++;
											}else{
													$("#pageaccess_title_error").html("");
											}
											
						
											check();
											check_email(err1);
											if(user_error==1){
												v1++;
											}
											if(email_error==1){
												v1++;
											}
								if(v1==0){
            $('#updt').submit();
         }
}

//==============================================end for validation add subadmin==================//

//========================================validations for edit subadmin=============================//
function edit_showHidePassword(){
          var button_val=$('#view_pass').val();
            if(button_val == 'View')
            {
                $('#view_pass').val('Hide');
                //$('#password').val(password);
                $('#password').attr("type","text");
            }
            if(button_val == 'Hide')
            {
                $('#view_pass').val('View');
                $('#password').attr("type", "password");
            }
     }

     function edit_checknumber(){
            var phone=$('#phoneno').val();
        if(isNaN(phone)){
           alert('Please enter number');
           var phone=$('#phoneno').val();
           var phn=phone.slice(0,-1);
            $('#phoneno').val(phn);
        }
    }

    function edit_check() {
        var id= $('#userid').val();
        var username=$('#username').val().trim();
								if(username!=''){
        $.ajax({
            type:'post',
             url: '<?php echo base_url();?>Adminmanagement/username_checking',
            data: { id:id, username:username},
  success: function (response){
   
    if (response>0) {
					user_error=1;
    $('#username_error').text("Username already exists");
    $('#username_error').css('color','red');
    $('#btn').prop('disabled',true);
    }else{
							user_error=0;
        $('#username_error').text('');
       $('#btn').prop('disabled',false);
    }
  }
});
			}else{
				$('#btn').prop('disabled',false);
			}
		
    }

     function edit_check_email(){
       var email=$('#email').val();
       var id= $('#userid').val();
       //alert(email);
       if(email!=''){
        $.ajax({
            type:'post',
             url: '<?php echo base_url();?>Adminmanagement/email_checking',
            data: { id:id, email:email},
  success: function (response){
    //alert(response);
    if (response>0) {
        //alert(response);
								email_error=1;
    $('#email_error').text("Email already exists");
    $('#email_error').css('color','red');
    $('#btn').prop('disabled',true);
    }else{
						   email_error=0;
        $('#email_error').text('');
       $('#btn').prop('disabled',false);
    }
  }
});
      }else{
        //$('#email_error').text('');
        $('#btn').prop('disabled',false);
      }
    }


					
function edit_validate_frm(){
//alert('HI');
    var v1=0;
				
    $(".test").each(function(){
     var elementvalue= $(this).val();
      //alert(elementvalue);
     var elementid=$(this).attr('id');
    //alert(elementid);
    var elementlabel=$(this).attr('label');
    //alert(elementlabel);
				
    if(elementvalue.search(/\S/) ==-1)
    {
          if(elementid=="name"||elementid=="email"||elementid=="username"||elementid=="password"){
            $("#"+elementid+"_error").html(elementlabel+" is needed");
            v1++;
            //alert('needed');
          }
         
    } else{
             $("#"+elementid+"_error").html("");	
          }
 });
  //var mobile=$("#Mobile").val();
			  var email=$('#email').val();
					var mobile=$('#phoneno').val();
if(mobile!=''){
  if(mobile.length!=10){
        $('#phoneno_error').html('Enter 10 digit mobile number');
        v1++;
    }else{
          $('#phoneno_error').html('');		
    }
  }
		
		if(email!="")
			    {
														var pat=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
														if(!pat.test(email)){ 
															$('#email_error').text("Email not correct");
															$('#email_error').css('color','red');
															v1++;
														}
														else{
																		$('#email_error').text("");
														}
														
							}
							
							//alert(v1);
							if($("input[name='pageaccess[]']").serializeArray().length===0){
													$("#pageaccess_title_error").html("Pageaccess is needed");
													//alert('error');
													v1++;
											}else{
													$("#pageaccess_title_error").html("");
											}
											
									
							//alert(v1);
							edit_check_email();
						edit_check();
							//alert("a"+a);alert("b"+b);
						
							
							//alert(v1);
							if(email_error==1){
								v1++;
							}
							if(user_error==1){
								v1++;
							}
		
   //alert(v1);
if(v1==0){
	//alert(v1);	
    $('#updt').submit();	
}																																
                            
															

	
}

					
//=====================================end for validation edit subadmin====================================//


</script>
<!-- <script type="text/javascript">
//new added
  $('#dynamic-table').dataTable({
      "order": [[ 0, "asc" ]],
  });
  //end for new added
  </script> -->
