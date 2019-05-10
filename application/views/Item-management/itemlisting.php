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
                       Item Details
                       <span class="tools pull-right">
                           <a href="javascript:;" class="fa fa-chevron-down"></a>
                           <a href="javascript:;" class="fa fa-cog"></a>
                           <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                   </header>
                   <div class="panel-body">
                    <button type="button" class="btn btn-primary btn pull-right" onclick="location.href='<?php echo base_url(); ?>Item_cont/insertview'">Add new Item</button>
                   <div class="adv-table">
                       
                   <table  class="display table table-bordered table-striped" id="dynamic-table">
                   <thead>
                   <tr>
                                   <th class="numeric">Item Name</th>
                                    <th class="numeric">Item stock</th>
                                    <th class="numeric">Price</th>
                                    <th class="numeric">Status</th>
                       
                                    <th class="numeric">Option</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                   
                                    <?php  
    if($material['num_row']>0 && $material['result'][0]->status!=2){
          if(count($listing)>0){
//             echo"<pre>";
//              print_r($listing);
         foreach ($listing['result'] as $row)  
         { 
             if($row->status==1 || $row->status==0){
                
            ?>
                <tr> 
               <td><?php echo ucfirst($row->item_name);?></td> 
                <td><?php echo $row->stock;?></td> 
                    <td><?php echo $row->price;?></td>  
                    <td>
                                        <?php
                                    //echo $reviewDtls->status ;
                                        if($row->status == 1)
                                        {
                                        ?>
                                        <span style="cursor:pointer;float:center" title="Active Item" onclick="changeStauts('<?php echo $row->item_id;?>', 0);">Active
                                           <i class="fa fa-check-circle"></i>
                                        </span>
                                        <?php
                                        } 
                                        else
                                        {
                                        ?>
                                        <span style="cursor:pointer;float:center" title="Inactive Item" onclick="changeStauts('<?php echo $row->item_id;?>', 1);">Inactive
                                          <i class="fa fa-ban"></i>
                                        </span>
                                        <?php
                                        }
                                        ?>
                                    </td>
           
          
              
        <td><button type="button" class="btn btn-primary" onclick="location.href='<?php echo base_url(); ?>Item_cont/edit/<?php echo $row->item_id ;?>'">Edit</button>
                    <button type="button" class="btn btn-primary" onclick="deleteUnit('<?php echo $row->item_id;?>');">Delete</button></td>
            </tr> 
        <?php }
             
                           
         }
          }
    }
                                    else{
                                       // echo "1";
                                    //$var="confirm";
                                 echo "<script>alert('Please add material first');
                                location.href='".base_url()."Material_cont';
                                    
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
       </div>

                  
       <!-- page end-->
       </section>
   </section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    function deleteUnit(id)
{
    if(confirm("Do you want to delete this item?"))
    {
        window.location.href="<?php echo base_url();?>item_cont/deleteUnit/"+id;
    }
}
function changeStauts(id,status)
{
    
    var confirmstatus=confirm('Are you sure you want to change status');
    if(confirmstatus)
    {
        location.href="<?php echo base_url();?>item_cont/changeStatusReview/"+id+"/"+status;
    }
}
    
       
    </script>
   <!--main content end-->