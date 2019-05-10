


 <!-- <section id="main-content">
        <section class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Edit Customer Type 
                            
                            </header>  --> 

  <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
  
  <!--  <link href="<?php echo IMGURL?>assets/css/datepicker.min.css" rel="stylesheet" type="text/css">
    <script src="<?php echo IMGURL?>assets/js/datepicker.min.js"></script>
     <script src="<?php echo IMGURL?>assets/js/datepicker.en.js"></script> -->
     <style type="text/css">
      img{
  max-width:200px;
}
input[type=file]{
  width:100%;
padding:5px;
background:#1fb5ad;} 

     </style>  

      <section class="panel">  
       <div class="row">                    
       <form role="form" id="frm" name="frm" action="<?php echo base_url(); ?>Dashboard/updateprofile/<?php echo $listing['result'][0]->id; ?>" method="post" enctype="multipart/form-data">
         
    
       <div class="col-md-3">
          <div class="profile-pic text-center">
         <?php
         if($listing['result'][0]->image==""){ 
          
         ?>
          <img id="blah" src="<?php echo IMGURL?>assets/thumbnail_new/nullimage.png" alt=""/>
         <?php
          }
          else{
          ?>
          <img id="blah" src="<?php echo IMGURL?>assets/thumbnail_new/<?php echo $listing['result'][0]->image; ?>" alt=""/>
          <?php  
          }
          ?>
              
             
             
              <br><br>
              <input class="btn-default" id="file" name="file" type='file' onchange="return fileValidation()"/>
               <span id="file_error" style="color: red;"></span>
              </div>
           
              
           
             
       <br><br>

 </div> 
         
              
           <div class="col-md-6">      
              <div class="profile-desk">
            <label class="control-label">Name<span style="color: red;">*</span> :</label>   
            <input  type="text" placeholder="Name" class="form-control test need" name="name" id="name" value="<?php echo $listing['result'][0]->Name; ?>" label="Name" onblur="check_if_exists();">
    		<span id="name_error" style="color: red"></span><br>
    		
      <div class="row">
            <div class="form-group col-lg-6"> 
        			<label class="control-label">Designation<span style="color: red;">*</span>:</label> 
        			<select class="form-control selectpicker need" placeholder="Designation" id="designation" name="designation" label="Category" data-live-search-style="startsWith"  data-max-options="1">
              <option value="">Select value</option>
            <?php
            $table='designation';
            $designation=$this->Common_model->fetchAllData($table,'id');

            foreach($designation['result'] as $type)
            {
            ?>
                <option value="<?php echo $type->id;?>"<?php if($listing['result'][0]->designation_id == $type->id){ echo 'selected';} ?>><?php echo $type->designation;?></option>

            <?php 
            }
            ?> 
          </select>
          <span id="designation_error" style="color: red"></span><br>
           </div>      
            <div class="form-group col-lg-6">
                    <label class="control-label">Phone Number<span style="color: red;">*</span>:</label>
            <input  type="text"  placeholder="Phone Number" class="form-control test" name="phnumber" id="phnumber" value="<?php echo $listing['result'][0]->phoneno; ?>" label="Phone number" onblur="check_if_exists();">
                    <span id="phnumber_error" style="color: red"></span><br>    
           </div>         
           </div>   
            <div class="row">
                <div class=" col-md-6">
                            <input type="hidden" name="mode" value="updateDetails">
                            <input type="hidden" name="new1" id="new1" class="needy" value="<?php echo $listing['result'][0]->bdate; ?>">
                                <label class="control-label">Date Of Birth<span style="color: red;">*</span>:</label>
                                <div class='input-group date' id='datetimepicker2'>
                      
                                    <input type='text' placeholder="Date of Birth" class="form-control test" id="dob" name="dob" label="Date of birth" onchange="bdate();" value="<?php echo $listing['result'][0]->bdate; ?>"/>
                                <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                        
                        </div> 
                        <!-- <input type='text' class="datepicker-here" data-position="right top" /> -->
                        <span id="dob_error" style="color: red"></span><br>
                                    
                        </div>
              
                <div class="form-group col-lg-6"> 
                    <label class="control-label">Salary<span style="color: red;">*</span>:</label>    
                    <input  type="text" placeholder="Salary" class="form-control test need" name="salary" id="salary" value="<?php echo $listing['result'][0]->salary; ?>" label="Salary" onblur="check_if_exists();">
                    <span id="salary_error" style="color: red"></span><br>    
                </div>
          </div>
    				
           
     			
                   
                <label>Address<span style="color: red;">*</span>:</label>
                <textarea id="address" name="address" placeholder="Address" class="form-control ckeditor need" label="Admin details" rows="3"><?php echo $listing['result'][0]->address;?></textarea>
                <span id="address_error" style="color: red;"></span>  <br>
					
                  
                  
                  
             
                    <label>Details<span style="color: red;">*</span>:</label>
                <textarea id="adminDetails" name="adminDetails" placeholder="Admin Product" class="form-control ckeditor need" label="Admin details" rows="3"><?php echo $listing['result'][0]->details;?></textarea>
                <span id="adminDetails_error" style="color: red;"></span>
                    </div>
              <center>
     <div class="form-group">
       

         <div class="save_but">
        
         
        
            <button type="button" class="btn btn-primary" id="btn" onclick="validate(<?php echo $listing['result'][0]->id;?>);" style="margin: 10px;">Save</button>
             <button type="button" class="btn btn-default" id="cnbtn" onclick="location.href='<?php echo base_url(); ?>Dashboard/profile'" style="margin: 10px;">Cancel</button>

     </div>
</div>  
</center>
                
                  
</div>
</form>

                   <div class="col-md-3">
                           <div class="profile-statistics">
                               <h1><?php echo $listing['result'][0]->salary; ?></h1>
                               <p>Salary</p>
                               <h1><?php echo $listing['result'][0]->bdate; ?></h1>
                               <p>Date Of Birth</p>
                               
                           </div>
                       </div>
                  </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo IMGURL?>assets/bs3/js/bootstrap-datetimepicker.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>


function fileValidation(){
    var fileInput = document.getElementById('file');
    
    var filePath = fileInput.value;
   
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
      $("#file_error").html("Please upload file having extensions .jpeg/.jpg/.png/.gif only.");
       
        
        return false;
    }else{
        //Image preview
       
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };
            reader.readAsDataURL(fileInput.files[0]);
            $("#file_error").html("");
        }
    }
}
   
     function validate(uid){
              //alert('hlo');    
        error_count=0;
        $(".need").each(function () {
            // alert('hlo');
           $("#"+elementid+"_error").html("");

          var elementValue=$(this).val();
          var elementid=$(this).attr('id');
          var elementlabel=$(this).attr('label');
       // alert(elementid);
        //alert(elementValue); 

          if(elementValue.search(/\S/)==-1){
              $("#"+elementid+"_error").html(elementlabel+" is needed");
              error_count++;
          }
          else{
            $("#"+elementid+"_error").html("");
          } 
        });

        var phnmbr=$("#phnumber").val();   
        if(phnmbr==""){
            $("#phnumber_error").html("Phone number is needed");
            error_count++;
         }
         else{
            
           $.ajax({
              url:"<?php echo base_url();?>Dashboard/customer_type_duplicate_edit", 
              data: {'phnmbr':phnmbr,'uid':uid},
              type:"POST",            
              async:false,
              success:function(response)
              {   console.log(response);
                  if(response>0){
                      $("#phnumber_error").html("Phone number is already exist");
                      error_count++;
              }
              else{
                 $("#phnumber_error").html("");
                 
              }
            }
          });
        }
        var dob=$("#dob").val();
          
        if(dob==""){
            $("#dob_error").html("Date of birth is needed");
            error_count++;
         }
         else{
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
            var yyyy2=yyyy-10;
    
            var arr=dob.split("/");
            if(arr[2]>yyyy2){
              if(arr[1]>mm){
                if(arr[0]>dd){
                  
                  $("#dob_error").html("Please select a 10 years ago date from today!!");
                  error_count++;
                }
              }
            }
            else{
                  $("#dob_error").html("");
            }
         }
  
    if(error_count==0){
              $('#frm').submit();
      }            
  } 
//   $( function() {
// $( "#datepicker" ).datepicker();

// } );
</script> 
<script type='text/javascript'>
// $(document).ready(function(){

//   var year=$("#new1").val();
//   //alert(year);

    
//   var today = new Date();
//   var dd = String(today.getDate()).padStart(2, '0');
//   var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
//   var yyyy = today.getFullYear();
//   var yyyy2=yyyy-10;
//   today = mm + '/' + dd + '/' + yyyy2;
  
//   $('#datetimepicker2').datetimepicker({
    
//     format: 'DD/MM/YYYY',
    
//     //defaultDate:year
//      maxDate: today
//   });
//  // $('#datetimepicker2').datepicker("setDate", new Date(2008,9,03) );
// }); 
   
 </script> 
                    
     
