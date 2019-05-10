<!--main content start-->
   <section id="main-content">
       <section class="wrapper">
       <!-- page start-->

       <div class="row">
           <div class="col-sm-12">
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
           
               <section class="panel">
                   <header class="panel-heading">
                       Unit Details
                       <span class="tools pull-right">
                           <a href="javascript:;" class="fa fa-chevron-down"></a>
                           <a href="javascript:;" class="fa fa-cog"></a>
                           <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                   </header>
                   <div class="panel-body">
                    <!--button type="button" class="btn btn-primary btn pull-right" onclick="location.href='<?php echo base_url(); ?>Unit_cont/insertview'">Add new Unit</button-->
                   <div class="adv-table">
                       
                   <table  class="display table table-bordered table-striped" id="dynamic-table">
                   <thead>
                   <tr>
                                   
                                    <th class="numeric">Unit Name</th>
                                    <th class="numeric">Status</th>
                       
                                    <!--th class="numeric">Option</th-->
                                    
                                </tr>
                                </thead>
                                <tbody>
                                   
                                    <?php  
          if(count($listing)>0){
             //echo"<pre>";
             // print_r($listing);
         foreach ($listing['result'] as $row)  
         { 
             
             if($row->status==1 || $row->status==0){
            ?>
                <tr>  
                <td><?php echo ucfirst($row->unit_name);?></td> 
                    <td>
                                        <?php
                                    //echo $reviewDtls->status ;
                                        if($row->status == 1)
                                        {
                                        ?>
                                        <span style="cursor:pointer;float:center" title="Active Unit" onclick="changeStauts('<?php echo $row->unit_id;?>', 0);">Active
                                           <i class="fa fa-check-circle"></i>
                                        </span>
                                        <?php
                                        } 
                                        else
                                        {
                                        ?>
                                        <span style="cursor:pointer;float:center" title="Inactive Unit" onclick="changeStauts('<?php echo $row->unit_id;?>', 1);">Inactive
                                          <i class="fa fa-ban"></i>
                                        </span>
                                        <?php
                                        }
                                        ?>
                                    </td>
           
          
              
        <!--td><button type="button" class="btn btn-primary" onclick="location.href='<?php //echo base_url(); ?>Unit_cont/edit/<?php//echo $row->unit_id ;?>'">Edit</button>
                    <button type="button" class="btn btn-primary" onclick="deleteUnit('<?php //echo $row->unit_id;?>');">Delete</button></td-->
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
       </div>

                  
       <!-- page end-->
       </section>
   </section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    function deleteUnit(id)
{
    if(confirm("Do you want to delete this unit?"))
    {
        window.location.href="<?php echo base_url();?>Unit_cont/deleteUnit/"+id;
    }
}
function changeStauts(id,status)
{
    
    var confirmstatus=confirm('Are you sure you want to change status');
    if(confirmstatus)
    {
        location.href="<?php echo base_url();?>Unit_cont/changeStatusReview/"+id+"/"+status;
    }
}
    
       
    </script>
   <!--main content end-->