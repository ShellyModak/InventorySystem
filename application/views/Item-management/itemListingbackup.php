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
                   Add Item
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
                       Item Details
                      <span class="tools pull-right">
                           <a href="javascript:;" class="fa fa-chevron-down"></a>
                        </span>
                   </header>
                   <div class="panel-body">
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
           
          
              
                    
                    <td>
                       <i class="fa fa-edit" aria-hidden="true" onclick="editForm('<?php echo $row->item_id;?>');"></i>        
                    
                     <i class="fa fa-trash-o" aria-hidden="true" onclick="deleteUnit('<?php echo $row->item_id;?>');"></i>
                    </td>
            </tr> 
        <?php }
             
                           
         }
          }
    }
                                    else{
                                       // echo "1";
                                    //$var="confirm";
                                 echo "<script>alert('Please add material first');
                                location.href='".base_url()."Material_cont/show';
                                    
                                 </script>";
                                        
                                        
                                    }
         ?>
                            
                                </tbody>
                   <tfoot>
                   </tfoot>
                       
                        <button type="button" class="btn btn-primary btn pull-right" onclick="location.href='<?php echo base_url(); ?>Material_cont/excel1'">Export data</button>
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
   imager=0;
    chk=0;
        setTimeout(function() {
          $('#successMessage').fadeOut('fast');
      }, 1000); 
     addNewForm('');

});
    
    
     function addNewForm(id)
     {
          $.ajax({
                    url:"<?php echo base_url();?>Item_cont/addForm1",   
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
                    url:"<?php echo base_url();?>Item_cont/edit",   
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