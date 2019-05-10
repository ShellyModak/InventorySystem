<!--main content start-->
<section id="main-content">
        <section class="wrapper">

       <!-- page start-->
               <?php
            if($this->session->userdata('error_msg') !='')
            {
                ?>
                
                <div class="alert alert-danger message">
                  <center><strong>Sorry! </strong><?php echo $this->session->userdata('error_msg'); ?><span id="error_msg" class=""></span></center>
                </div>
                <?php
                 $this->session->unset_userdata('error_msg');
            }
                   if($this->session->userdata('success_msg') !='')
            {
               ?>               
               <div class="alert alert-success message">
                   <center><strong>Success! </strong><span class=""><?php echo $this->session->userdata('success_msg'); ?></span> </center>
                </div>
               <?php
             $this->session->unset_userdata('success_msg');
           } 
               ?>
     <div class="row">
         <div class="col-sm-12">
       <!-- page start-->
               <section class="panel">
                   <header class="panel-heading">
                      Staff
                       <span class="tools pull-right">
                           <a href="javascript:;" class="fa fa-chevron-down"></a>
                           <a href="javascript:;" class="fa fa-cog"></a>
                           <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                   </header>
                   <div class="panel-body">
                    
                       <div id="content"></div>
    
                   </div>
                
             </section>
           
    </div>
         
         
         
           <div class="col-sm-12">
               <section class="panel">
                   <header class="panel-heading">
                       Staff Details
                      <span class="tools pull-right">
                           <a href="javascript:;" class="fa fa-chevron-down"></a>
                           <a href="javascript:;" class="fa fa-cog"></a>
                           <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                   </header>
                   <div class="panel-body">
                   <div class="adv-table">
                       
                   <table  class="display table table-bordered table-striped" id="dynamic-table">
                   <thead>
                   <tr>
                                   <th class="numeric">Staff Name</th>
                                    <th class="numeric">Staff post</th>
                                    <th class="numeric">Address</th>
                                    <th class="numeric">Date of birth</th>
                                    <th class="numeric">Date of joining</th>
                       
                                    <th class="numeric">Salary</th>
                                    <th class="numeric">Status</th>
                       
                                    <th class="numeric">Option</th>
                                   
                                    
                                </tr>
                                </thead>
                                <tbody>
                                   
                                    <?php  
                                    
                                    
   // if($vendor['num_row']>0 && $vendor['result'][0]->status!=2){
          if(count($listing)>0){
              
           //  echo"<pre>";
             // print_r($listing);die;
         foreach ($listing['result'] as $row)  
         { 
                $whereorderTypeArray = array('post_id' => $row->post_id);
                $postDtlsArr = $this->Common_model->getAllDataWithMultipleWhere('staff_post',$whereorderTypeArray,'post_id');

             
             if($row->status==1 || $row->status==0){
            ?>
                <tr> 
               <td><?php echo ucfirst($row->staff_name);?></td> 
                <td><?php echo ucfirst($postDtlsArr['result'][0]->post_name);?></td>
                    <td><?php echo ucfirst($row->address);?></td> 
                    <td><?php echo ucfirst($row->date_of_birth);?></td> 
                    <td><?php echo ucfirst($row->date_of_joining);?></td>
                    <td><?php echo ucfirst($row->salary);?></td>  
                    <td>
                                        <?php
                                    //echo $reviewDtls->status ;
                                        if($row->status == 1)
                                        {
                                        ?>
                                        <span style="cursor:pointer;float:center" title="Active Material" onclick="changeStauts('<?php echo $row->staff_id;?>', 0);">Active
                                           <i class="fa fa-check-circle"></i>
                                        </span>
                                        <?php
                                        } 
                                        else
                                        {
                                        ?>
                                        <span style="cursor:pointer;float:center" title="Inactive Material" onclick="changeStauts('<?php echo $row->staff_id;?>', 1);">Inactive
                                          <i class="fa fa-ban"></i>
                                        </span>
                                        <?php
                                        }
                                        ?>
                                    </td>
           
          
                    
                    
                    <td>
                       <i class="fa fa-edit" aria-hidden="true" onclick="editForm('<?php echo $row->staff_id;?>');"></i>        
                    
                     <i class="fa fa-trash-o" aria-hidden="true" onclick="deleteUnit('<?php echo $row->staff_id;?>');"></i>
                        
                        
                        <a href="<?php echo base_url();?>Staff_cont/showdetails/<?php echo $row->staff_id;?>"title="View Details"  target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    </td>
                 
            </tr> 
        <?php }
             
                           
         }
          }
                                    
         ?>
                            
                                </tbody>
                   <tfoot>
                   </tfoot>
                   </table>
                       
                   </div>
                   </div>
                
             </section>
    </div>
<!-- new section-->

</div>
    </section>
</section>
           

            

<script>
    $(document).ready(function(){
    
                imager=0;
                chk=0;
                 addNewForm('');
});
    
    const capitalizeFirstLetter = (string) => {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
    
     function validateForm(){  
        var validation_passed=true;
        ['staffname','post','dob','doj','salary'].map( function(field_id){
            var obj_field=$('#'+field_id);
            var value=$(obj_field).val();
            
            $(obj_field).parent('div').find('span.err').text("");
            
            if(value.search(/\S/)==-1){
                validation_passed=false;
                var label = $(obj_field).parent('div').find('label').text().replace('Enter','').replace('*','').trim();
                $(obj_field).parent('div').find('span.err').text(capitalizeFirstLetter(label)+' is needed');
             }
         })
         return validation_passed;  
    }
    
    
     function addNewForm(id)
     {
          $.ajax({
                    url:"<?php echo base_url();?>Staff_cont/addForm1",   
                    data:{id:id},
                    type:"POST",            
                    dataType:"text",
                    async: false,
                    success:function(response)
                    {   
                        $('#content').html(response);
                         
                    }
                                                 
                                      
                                        
                });
     }
   function editForm(id)
     {
          $.ajax({
                    url:"<?php echo base_url();?>Staff_cont/edit",   
                    data:{id:id},
                    type:"POST",            
                    dataType:"text",
                    async: false,
                    success:function(response)
                    {   
                        $('#content').html(response);
                         window.scrollTo(500, 0);
                    }
                                                 
                                      
                                        
                });
     } 
    function deleteUnit(id)
{
    if(confirm("Do you want to delete this material?"))
    {
        window.location.href="<?php echo base_url();?>Staff_cont/deleteUnit/"+id;
    }
}
function changeStauts(id,status)
{
    
    var confirmstatus=confirm('Are you sure you want to change status');
    if(confirmstatus)
    {
        location.href="<?php echo base_url();?>Staff_cont/changeStatusReview/"+id+"/"+status;
    }
}
    function check_if_exists() {

                var materialname = $("#material").val();

                $.ajax(
                    {
                        type:"post",
                        async:"true",
                        url: "<?php echo base_url(); ?>Material_cont/material_exists",
                        data:{ materialname:materialname},
                        success:function(response)
                        {
                            console.log(response);
                            if (response != 0 || response != '0'  ) 
                            { 
                                //alert('kkk');
                                 chk++;
                                $('#name_error').text("Material name exists");
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
       
//  function validateForm(){  
//                
//           // $("#btn").click(function(){
//                //alert("error");
//                var v1=0;
//               
//                    var UnitValue=$('#material').val();
//                    //var elementid=$(this).attr('id');
//                    var elementlabel=$('#material').attr('label');
//                    if(UnitValue.search(/\S/)==-1){
//                       // alert(elementid);
//                        v1++;
//                        $("#name_error").html(elementlabel+" is needed");
//                    }
//                else{
//                     $("#name_error").html("");
//                }  
//                
//                var DeptEntry = $("#unit option:selected").val();
//                     //alert(DeptEntry);
//                    if(DeptEntry == "")
//                    {
//                        v1++;
//                    $("#unit_error").html("Please select a unit");
//                    
//                    }
//                else{
//                    $("#unit_error").html("");
//                }
//                
//                var fields = $("input[name='vendor[]']").serializeArray(); 
//                if (fields.length === 0) 
//                    { 
//                         //v1++;
//                        $("#vendor_error").html("please select a vendor");
//                    return false;
//                    } 
//                else 
//                    { 
//                         $("#vendor_error").html("");
//                    }
//        if(v1==0 && chk==0){
//            $('#name_error').text(" ");
//                 //$("#updt").submit();
//                return true;
//             }
//            else{
//                 $('#name_error').text("Material name exists");
//                return false;
//            }
//                
//
//        
//       //});
//    }
            
   <!--main content end-->
</script>
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
  width:12em;
} 

ul.checkbox li label { 
  margin-left: ; 
} 



</style>