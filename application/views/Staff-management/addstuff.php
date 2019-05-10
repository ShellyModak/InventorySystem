
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">        
                        
                        
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form"  action="<?php echo base_url(); ?>Staff_cont/insertStaff" method="post" id="updt" enctype="multipart/form-data" onsubmit="return validateForm();">
                <div class="row">
                     <div class="form-group">
                        <div class=" col-md-6">
                                <input type="hidden" name="mode" value="updateDetails">
                                    <label class="control-label">Enter staff Name<span style="color: red;">*</span></label>    
                                    <input  type="text"  placeholder="Staff Name" class="form-control test" name="staffname" id="staffname" label="staffname" onblur="check_if_exists();">
                            <span id="name_error"class="err"  style="color: red"></span><br>
                         </div>
                         
                        
                         <div class=" col-md-6"> 
                         <label class="control-label">Post</label>
                             
                             <select name="post" class=" form-control post_test"  id="post" label="Post" >
            <option value="" >Select</option>
                                 <?php 
                                 foreach($staff_post['result'] as $row):?>
            
                    <option value="<?php echo $row->post_id?>"><?php echo $row->post_name?></option>    
     <?php   endforeach;?>
               
                </select>
                      <span id="post_error"class="err"  style="color: red"></span><br>
                </div>
            </div>
            </div>
                                 
        <div class="row">
                     <div class="form-group">
                        <div class=" col-md-6">
                                <input type="hidden" name="mode" value="updateDetails">
                                    <label class="control-label">Enter date of birth<span style="color: red;">*</span></label>     
                                    <input  type="text"  placeholder="Date of birth" class="form-control test" name="dob" id="dob" label="dob" onblur="check_if_exists();" readonly>
                           <span id="dob_error" class="err" style="color: red"></span><br>
                         </div>
        
                         
                        <div class=" col-md-6">
                                <input type="hidden" name="mode" value="updateDetails">
                                    <label class="control-label">Enter date of joining<span style="color: red;">*</span></label>    
                                    <input  type="text"  placeholder="Date of joining" class="form-control test" name="doj" id="doj" label="doj" onblur="check_if_exists();" readonly>
                            <span id="doj_error "class="err"  style="color: red"></span><br>
                         </div>
            </div>
            </div>
                                    
          <div class="row">
                     <div class="form-group">
                        <div class=" col-md-6">
                                <input type="hidden" name="mode" value="updateDetails">
                                    <label class="control-label">Enter address</label>    
                                     <textarea class="form-control test"  name="address" rows="2" value=""></textarea>
                    <span id="note" style="color: red"></span><br>
                         </div>
                         
                        <div class=" col-md-6">
                                <input type="hidden" name="mode" value="updateDetails">
                                    <label class="control-label">Enter salary<span style="color: red;">*</span></label>    
                                    <input  type="number"  placeholder="Salary" class="form-control test" name="salary" id="salary" label="salary" onblur="check_if_exists();">
                            <span id="salary_error"class="err"  style="color: red"></span><br>
                         </div>
            </div>
            </div>  
                                    
           <div class="row">
                     <div class="form-group">

                       <div class=" col-md-6"> 
                         <label class="control-label">Status</label>
               <select class="form-control " id="status" name="status" label="status"   data-max-options="1">
                    <option value="1" >Active</option>
                   <option value="0">Inactive</option>
                   
                   </select>
                      <span id="status_error" style="color: red"></span><br>
                </div>
            </div>
    </div>      
        
 
 
<div class="row">
     <div class="form-group">
       

         <div class="save_but">
        
         
         <button type="button" class="btn btn-default btn pull-right" id="btn" onclick="addNewForm('')" style="margin: 10px;">Cancel</button>
             <input type="submit" class="btn btn-primary btn pull-right" id="btn" style="margin: 10px;" value="Save">

         </div>
     </div>
</div>
                        
             </form>
        </div>
</div>



<script type='text/javascript'>
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
    
    
//    function initialize_date_picker(field_identifier, min_date,max_date,dateFormat){
//        
//        var params={}
//        
//        if(min_date!==undefined && min_date!="")
//            params.minDate= new Date(min_date)
//        
//        if(max_date!==undefined && max_date!="")
//            params.maxDate= new Date(max_date)
//        
//        params.dateFormat = (dateFormat!==undefined && dateFormat!="")?dateFormat:"yy-mm-dd"
//        
//        
//        $(field_identifier).datepicker(params);
//    }
    
 </script> 

 

<script>
    
   //$.function(){
   // alert(1);   
       
  // } 

  
//  
               
        
        //});
   
            
            
 
           
           function check_if_exists() {

                var itemname = $("#item").val();

                $.ajax(
                    {
                        type:"post",
                        async:"true",
                        url: "<?php echo base_url(); ?>item_cont/item_exists",
                        data:{ itemname:itemname},
                        success:function(response)
                        {
                            console.log(response);
                            if (response != 0 || response != '0'  ) 
                            { 
                                //alert('kkk');
                                 chk++;
                             //   $('#name_error').text("Item name exists");
                                //$('#btn').prop('disabled',true);
                            }
                            else 
                            {
                                //alert('kk');
                                chk=0;
                                $('#name_error').text(" ");
                               
                                
                            }  
                        }
                    });
            
           }
     </script>   

<!-- Latest compiled and minified CSS -->

   
                <?php              

            
            