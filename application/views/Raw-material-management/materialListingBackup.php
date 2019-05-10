<!--
<style>
	.a{
		width: 16em !important;
	}
	.b{
		width: 14em !important;
	}
	.c{
		width:12em !important;
	}
	.d{
		width: 10em !important;
	}
	.e{
		width: 8em !important;
	}
</style>main content start
-->
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
               <div class="alert alert-success message" id="successMessage">
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
                     Add Raw Material
                       <span class="tools pull-right">
                           <a href="javascript:;" class="fa fa-chevron-down"></a>
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
                       Raw Material Details
                      <span class="tools pull-right">
                           <a href="javascript:;" class="fa fa-chevron-down"></a>
                        </span>
                   </header>
                   <div class="panel-body">
                   <div class="adv-table">
                       
                   <table  class="display table table-bordered table-striped" id="dynamic-table">
                   <thead>
                   <tr>
                                   <th class="numeric">Material Name</th>
                                    <th class="numeric">Unit Name</th>
                                    <th class="numeric">Vendor Name</th>
                                    <th class="numeric">Status</th>
                       
                                    <th class="numeric">Option</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                   
                                    <?php  
                                    
                                    
    if($vendor['num_row']>0 && $vendor['result'][0]->status!=2){
          if(count($listing)>0){
              
           //  echo"<pre>";
             // print_r($listing);die;
         foreach ($listing['result'] as $row)  
         { 
                $whereorderTypeArray = array('unit_id' => $row->unit_id);
                $unitDtlsArr = $this->Common_model->getAllDataWithMultipleWhere('UnitType',$whereorderTypeArray,'unit_id');
//             echo"<pre>";
//             print_r($unitDtlsArr);die;
             $arry=explode(",",$row->vendor_id);
             $vendor_data=$this->NewModel->fetch_data_vendor($arry,'vendorType');
             // print_r($vendor_data);die;
             $vendor=array();
            foreach($vendor_data as $vendor_rec){
               
                if($vendor_rec->status != 2){
            array_push($vendor, $vendor_rec->name);
                }
         }
        $vendor_string=implode(",",$vendor);
             
             if($row->status==1 || $row->status==0){
            ?>
                <tr> 
               <td><?php echo ucfirst($row->material_name);?></td> 
                <td><?php echo ucfirst($unitDtlsArr['result'][0]->unit_name);?></td>
                    <td><?php echo $vendor_string ;?></td> 
                    <td>
                                        <?php
                                    //echo $reviewDtls->status ;
                                        if($row->status == 1)
                                        {
                                        ?>
                                        <span style="cursor:pointer;float:center" title="Active Material" onclick="changeStauts('<?php echo $row->material_id;?>', 0);">Active
                                           <i class="fa fa-check-circle"></i>
                                        </span>
                                        <?php
                                        } 
                                        else
                                        {
                                        ?>
                                        <span style="cursor:pointer;float:center" title="Inactive Material" onclick="changeStauts('<?php echo $row->material_id;?>', 1);">Inactive
                                          <i class="fa fa-ban"></i>
                                        </span>
                                        <?php
                                        }
                                        ?>
                                    </td>
           
          
                    
                    
                    <td>
                       <i class="fa fa-edit" aria-hidden="true" onclick="editForm('<?php echo $row->material_id;?>');"></i>        
                    
                     <i class="fa fa-trash-o" aria-hidden="true" onclick="deleteUnit('<?php echo $row->material_id;?>');"></i>
                    </td>
                
                                        
                    
                    
            </tr> 
        <?php }
             
                           
         }
          }
    }
                                    else{
                                       // echo "1";
                                    //$var="confirm";
                                 echo "<script>alert('Please add vendor first');
                                location.href='".base_url()."Vendormanagement';
                                    
                                 </script>";
                                        
                                        
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
           

            
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
    
    <?php if($this->uri->segment(3)!=""){?>
        editForm('<?php echo $this->uri->segment(3);?>');
        <?php }
        else { ?>
                imager=0;
                chk=0;
                 addNewForm('');
<?php } ?>
         setTimeout(function() {
          $('#successMessage').fadeOut('fast');
      }, 1000); 
});
    
    
     function addNewForm(id)
     {
          $.ajax({
                    url:"<?php echo base_url();?>Material_cont/addForm",   
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
                    url:"<?php echo base_url();?>Material_cont/edit",   
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
        window.location.href="<?php echo base_url();?>Material_cont/deleteUnit/"+id;
    }
}
function changeStauts(id,status)
{
    
    var confirmstatus=confirm('Are you sure you want to change status');
    if(confirmstatus)
    {
        location.href="<?php echo base_url();?>Material_cont/changeStatusReview/"+id+"/"+status;
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
       
  function validateForm(){  
                
           // $("#btn").click(function(){
                //alert("error");
                var v1=0;
               
                    var UnitValue=$('#material').val();
                    //var elementid=$(this).attr('id');
                    var elementlabel=$('#material').attr('label');
                    if(UnitValue.search(/\S/)==-1){
                       // alert(elementid);
                        v1++;
                        $("#name_error").html(elementlabel+" is needed");
                    }
                else{
                     $("#name_error").html("");
                }  
                
                var DeptEntry = $("#unit option:selected").val();
                     //alert(DeptEntry);
                    if(DeptEntry == "")
                    {
                        v1++;
                    $("#unit_error").html("Please select a unit");
                    
                    }
                else{
                    $("#unit_error").html("");
                }
                
                var fields = $("input[name='vendor[]']").serializeArray(); 
                if (fields.length === 0) 
                    { 
                         //v1++;
                        $("#vendor_error").html("Please select a vendor");
                    return false;
                    } 
                else 
                    { 
                         $("#vendor_error").html("");
                    }
        if(v1==0 && chk==0){
            $('#name_error').text(" ");
             //$("#unit_error").html("");
                 //$("#updt").submit();
                return true;
             }
            else{
                 $('#name_error').html("Material name exists");
                 $('#name_error').html("Material name exists");
                return false;
            }
                

        
       //});
    }
            
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