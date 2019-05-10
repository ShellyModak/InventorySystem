
<section id="main-content">
        <section class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Add New Raw Material
                            <button type="button" class="btn btn-primary btn pull-right" onclick="location.href='<?php echo base_url(); ?>Material_cont/index'">Back</button></header>
         
                       
                        
                        
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form"  action="<?php echo base_url(); ?>Material_cont/insert_material" method="post" id="updt" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group">
                        <div class=" col-md-4">
                                <input type="hidden" name="mode" value="updateDetails">
                                    <label class="control-label">Enter Raw Material Name<span style="color: red;">*</span></label>    
                                    <input  type="text"  placeholder="Material Name" class="form-control test" name="materialname" id="material" label="Material" onblur="check_if_exists();">
                            <span id="name_error" style="color: red"></span><br>
                        </div>          
 <div class=" col-md-3">
         <label class="control-label">Enter Unit<span style="color: red;">*</span></label>
        <select name="unit" class=" form-control unit_test"  id="unit" label="Unit" >
         <option value="" >Select</option>
         <?php 
            foreach($unit['result'] as $row): 
            if($row->status != 2){ ?>
              <option value="<?php echo $row->unit_id?>"><?php echo $row->unit_name?></option> 
         <?php }      
        endforeach;?>
               
    </select>
    <span id="unit_error" style="color: red"></span><br>
 </div>    
<div class=" col-md-10">
     <label class="control-label">Select Vendor<span style="color: red;">*</span></label>
     <div class="icheck ">
            <div class="flat-green single-row">
                 <div class="radio row">
                                <?php 
            foreach($vendor['result'] as $row):
                if($row->status != 2 ) { ?>
             <div class="form-group col-md-4">
                 <label class="custom-control custom-checkbox ad_prd_lbl">
                    
             <input type="checkbox" value="<?php echo $row->id?>" name=vendor[] class="test_vendor"  label=Vendor  ><?php echo $row->name?>
                     </label>
                </div> 
                                           <?php 
                                       }
                        endforeach;  ?>
                    </div>
             </div>
     </div>
                 <span id="vendor_error" style="color: red"></span><br>
 </div>
    
     </div>
 </div>
 <div class="row">
     <div class="form-group">
         <div class=" col-md-3">
                    <label class="control-label">Status</label>
               <select class="form-control " id="status" name="status" label="status"   data-max-options="1">
                    <option value="1" >Active</option>
                   <option value="0">Inactive</option></select>
                   
                      <span id="status_error" style="color: red"></span><br>
        </div> 
        <div class=" col-md-4">
                             <label class="control-label">Note</label>
                               
                             <textarea class="form-control test"  name="note" rows="6" value=""></textarea>
                    <span id="note" style="color: red"></span><br>
               
         </div>
        
                                                  
       
                        
                                    </div>
                                    </div>
 <div class="row">
     <div class="form-group">
         <div class=" col-md-6">
             <center><button type="button" class="btn btn-primary" id="btn">Save</button> </center>
         </div>
     </div>
</div>
                                    
                                </form>
                                </div>
                               
                               
                        </div>
                    </section>
            </div>
            </div>
    </section>
            </section>


     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                imager=0;
                chk=0;
            $("#btn").click(function(){
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
                        $("#vendor_error").html("please select a vendor");
                    return false;
                    } 
                else 
                    { 
                         $("#vendor_error").html("");
                    }
        if(v1==0 && chk==0){
            $('#name_error').text(" ");
                 $("#updt").submit();

             }
            else{
                 $('#name_error').text("Material name exists");
            }
                

        
        });
    });
            
            
 
           
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
     </script>   
   
                <?php   
                    
                    
            
            