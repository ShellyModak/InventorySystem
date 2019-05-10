
<section id="main-content">
        <section class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Edit Unit Type
                            <button type="button" class="btn btn-primary btn pull-right" onclick="location.href='<?php echo base_url(); ?>Unit_cont/index'">Back</button>
                        </header>
                        
                     <?php    foreach ($edit as $row)  
                        { 

                        ?>
                      <div class="panel-body">
                            <div class="position-center">
                                <form role="form"  action="<?php echo base_url(); ?>Unit_cont/updateUnit/<?php echo $row->unit_id ; ?>" method="post" id="updt" enctype="multipart/form-data">
                                <div class="form-group">
                                <input type="hidden" name="mode" value="updateDetails">
                                     <label class="control-label">Enter New Unit Name</label> 
                                    <input  type="text" placeholder="Unit Name" id="unit" value="<?php echo $row->unit_name ?>"class="form-control test" name="unitname" id="name" label="Name"  onblur="check_if_exists();">
                            <span id="name_error" style="color: red"></span><br>
                                    
            
               <label class="control-label">Status</label>
               <select class="form-control " id="status" name="status" label="status"   data-max-options="1">
                     <option value="1" <?php if($row->status==1) echo 'selected';?>>Active</option>
                   <option value="0" <?php if($row->status==0) echo 'selected';?>>Inactive</option>
                  </select>
                      <span id="status_error" style="color: red"></span><br>
        
<?php } ?>
               
  
        
        
                                    <center> <button type="button" class="btn btn-primary" id="btn">Save</button></center>                  
                                    
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
              chk=0;
            $("#btn").click(function(){
                var v1=0;
                 
                    var UnitValue=$('#unit').val();
                    //var elementid=$(this).attr('id');
                    var elementlabel=$('#unit').attr('label');
                    if(UnitValue.search(/\S/)==-1){
                       // alert(elementid);
                        v1++;
                        $("#name_error").html(elementlabel+" is needed");
                    }
                else{
                     $("#name_error").html("");
                }
                if(v1==0 && chk==0){
                    $('#name_error').text(" ");
           $( "#updt" ).submit();
       }
            else{
                   $('#name_error').text("unit name exists");
            }
                
        
                  });
    });
     function check_if_exists() {

                var unitname = $("#unit").val();

                $.ajax(
                    {
                        type:"post",
                        async:"true",
                        url: "<?php echo base_url(); ?>Unit_cont/filename_exists",
                        data:{ unitname:unitname},
                        success:function(response)
                        {
                            console.log(response);
                            if (response != 0 || response != '0'  ) 
                            { 
                                //alert('kkk');
                                 chk++;
                                $('#name_error').text("unit name exists");
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
            