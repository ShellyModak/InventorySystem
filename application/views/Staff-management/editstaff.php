<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">  



<style type="text/css">
      img{
  max-width:200px;
}
input[type=file]{
  width:40%;
padding:5px;
background:#1fb5ad;
  margin-right: 150px;
  margin-left: 200px;} 

     </style>  
<?php    foreach ($staff['result'] as $row)  
                        { 
                        ?>
       <div class="panel-body">
     <div class="position-center">
         
        <form role="form"  action="<?php echo base_url(); ?>Staff_cont/updateStaff/<?php echo $row->staff_id ; ?>" method="post" id="updt" enctype="multipart/form-data" onsubmit=" return validateForm();">
                    <div class="row">
                     <div class="form-group">
                         
                         <div class="col-md-12" css="text-align:center">
                        
          <div class="profile-pic text-center">
         <?php
         if($row->image==""){ 
          
         ?>
          <img id="blah" src="<?php echo IMGURL?>assets/thumbnail_new/nullimage.png" alt=""/>
         <?php
          }
          else{
          ?>
          <img id="blah" src="<?php echo IMGURL?>assets/thumbnail_new/<?php echo $row->image; ?>" alt=""/>
          <?php  
          }
          ?>
              
             
             
              <br><br>
              <input class="btn-default" id="file" name="file" type='file' onchange="return fileValidation()"/>
               <span id="file_error" style="color: red;"></span>
             
            </div>
              
           
             
       <br><br>
                            
                            </div>
                        </div>
            </div>
                         
                    <div class="row">
                     <div class="form-group">
                        <div class=" col-md-6">
                                <input type="hidden" name="mode" value="updateDetails">
                                    <label class="control-label">Enter staff Name<span style="color: red;">*</span></label>    
                                    <input  type="text"  placeholder="Staff Name" class="form-control test" name="staffname" id="staffname" label="staffname" onblur="check_if_exists();" value="<?php echo $row->staff_name ?>">
                            <span id="name_error" style="color: red"></span><br>
                         </div>
                         
                        
                         <div class=" col-md-6"> 
                         <label class="control-label">Post</label>
                             
                             <select name="post" class=" form-control post_test"  id="post" label="Post" >
            <option value="" >Select</option>
                                 <?php 
                                 foreach($staff_post['result'] as $row1):?>
            
                <option  value="<?php echo $row1->post_id?>" <?php if($row1->post_id==$row->post_id){?> selected <?php } ?>><?php echo $row1->post_name?></option> 
     <?php   endforeach;?>
               
                </select>
                      <span id="post_error" style="color: red"></span><br>
                </div>
            </div>
            </div>
                                 
        <div class="row">
                     <div class="form-group">
                         
                         
                         
                        <div class=" col-md-6">
                                <input type="hidden" name="mode" value="updateDetails">
                                    <label class="control-label">Enter date of birth<span style="color: red;">*</span></label>    
                                    <input  type="text"  placeholder="Date of Birth" class="form-control test" name="dob" id="dob" label="dob" value="<?php echo $row->date_of_birth ?>"onblur="check_if_exists();" readonly>
                            <span id="dob_error" style="color: red"></span><br>
                         </div>
                         
                        <div class=" col-md-6">
                                <input type="hidden" name="mode" value="updateDetails">
                                    <label class="control-label">Enter date of joining<span style="color: red;">*</span></label>    
                                    <input  type="text"  placeholder="Date of joining" class="form-control test" name="doj" id="doj" label="doj" value="<?php echo $row->date_of_joining ?>"onblur="check_if_exists();" readonly>
                            <span id="doj_error" style="color: red"></span><br>
                         </div>
            </div>
            </div>
                                    
          <div class="row">
                     <div class="form-group">
                        <div class=" col-md-6">
                                <input type="hidden" name="mode" value="updateDetails">
                                    <label class="control-label">Enter address</label>    
                                     <textarea class="form-control test"  name="address" rows="2" value=""><?php echo $row->address ?></textarea>
                    <span id="note" style="color: red"></span><br>
                         </div>
                         
                        <div class=" col-md-6">
                                <input type="hidden" name="mode" value="updateDetails">
                                    <label class="control-label">Enter salary<span style="color: red;">*</span></label>    
                                    <input  type="number"  placeholder="Salary" class="form-control test" name="salary" id="salary" label="salary" value="<?php echo $row->salary ?>"onblur="check_if_exists();">
                            <span id="salary_error" style="color: red"></span><br>
                         </div>
            </div>
            </div>  
                                    
           <div class="row">
                     <div class="form-group">

                       <div class=" col-md-6"> 
                         <label class="control-label">Status</label>
              <select class="form-control " id="status" name="status" label="status"   data-max-options="1">
                    <option value="1" <?php if($row->status==1) echo 'selected';?>>Active</option>
                   <option value="0" <?php if($row->status==0) echo 'selected';?>>Inactive</option>
                   </select>
                      <span id="status_error" style="color: red"></span><br>
                </div>
            </div>
    </div>      
        
 <?php } ?> 
 
<div class="row">
     <div class="form-group">
       

         <div class="save_but">
        
         
         <button type="button" class="btn btn-default btn pull-right" id="btn" onclick="addNewForm('')" style="margin: 10px;">Cancel</button>
             <button type="submit" class="btn btn-primary btn pull-right" id="btn" style="margin: 10px;">Update</button>

         </div>
     </div>
</div>
                        
        </form>
    </div>
</div> 


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script>
$(document).ready(function(){
var v = new Date();
var y=v.getFullYear();
var y2=y-10;
var m=v.getMonth();
var d=v.getDate();
var date=y2+"-"+m+"-"+d;

initialize_date_picker('#dob', '', date);

var date=(y2+5)+"-"+m+"-"+d;
initialize_date_picker('#doj', '', date);
 
}); 
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
// function validateForm(){  
//           // $("#btn").click(function(){
//                //alert("error");
//                var v1=0;
//               
//                    var staffname=$('#staffname').val();
//                    if(staffname.search(/\S/)==-1){
//                       // alert(elementid);
//                        v1++;
//                        $("#name_error").html("staff name is needed");
//                    }
//                else{
//                     $("#name_error").html("");
//                } 
//                 
//                    var post=$('#post').val();
//                    if(post.search(/\S/)==-1){
//                       // alert(elementid);
//                        v1++;
//                        $("#post_error").html("post is needed");
//                    }
//                else{
//                     $("#post_error").html("");
//                } 
//             var dob=$('#dob').val();
//                    if(dob.search(/\S/)==-1){
//                       // alert(elementid);
//                        v1++;
//                        $("#dob_error").html("Date of birth is needed");
//                    }
//                else{
//                     $("#dob_error").html("");
//                } 
//              var doj=$('#doj').val();
//                    if(doj.search(/\S/)==-1){
//                       // alert(elementid);
//                        v1++;
//                        $("#doj_error").html("Date of joining is needed");
//                    }
//                else{
//                     $("#doj_error").html("");
//                } 
//                var salary=$('#salary').val();
//                   // alert(salary);
////                    if(salary.search(/\S/)==-1){
////                       // alert(elementid);
////                        v1++;
////                        $("#salary_error").html("Salary is needed");
////                    }
////                else{
////                     $("#salary_error").html("");
////                }     
//                    
//                   
//                
//        if(v1==0 && chk==0){
//            $('#name_error').text(" ");
//                // $("#updt").submit();
//                return true;
//             }
//            else{
//              //  $('#name_error').text("Item name exists");
//                return false;
//           }
//                
//                }
        
</script>