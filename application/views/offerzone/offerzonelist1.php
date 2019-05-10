<style type="text/css">

/*.pagination {
  display: inline-block;
}

.pagination {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
}

.pagination{
  background-color: #4CAF50;
  color: white;
}*/

/*.pagination a:hover:not(.active) {background-color: #ddd;}*/

 .pagination a:hover

{
border:1px solid #52bfea;
color: #52bfea;
background-color: #52bfea;
}
.pagination a:active{
  background-color: #52bfea;
}
/*.pagination a:hover:not(.active) {background-color: #4CAF50;}*/
</style>
<section id="main-content">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">
         <div class="col-sm-12">
       <!-- page start-->
     <!--   <?php  echo 'hi';echo $this->session->userdata('success_msg');?> -->
       <?php if($this->session->userdata('success_msg') !=''){
            // echo $this->session->userdata('success_msg');die;
        ?>

                   <div class="alert alert-success message" id="successMessage">
                  <center><strong>Success! </strong><span class=""><?php echo $this->session->userdata('success_msg'); ?></span> </center>
                  </div>
                  <?php
                    $this->session->unset_userdata('success_msg');
                   }?>
               <section class="panel">
                   <header class="panel-heading">
                      Offer zone
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
                        Responsive table
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>
                    <div class="panel-body" id="pagination_data">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                <tr>
                                    <th>Serial No.</th>
                                    <th>Offer Type</th>
                                  
                                    <th>Minimum Amount</th>
                                    <th>Offer Purpose</th>
                                  
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                                </thead>
                             <tbody>
                                <?php
                                  $count=0;

                              foreach ($listing['result'] as $type)  
                              { 
                                // echo "<pre>";
                                // print_r($type);
                               
                              if($type->status != 2){
                                 $count++;
                                if($type->offer_type==2){
                                  $offer="%";
                                }
                                else{
                                  $offer="Amount";
                                }

                             ?> 
                                <tr>
                                    <td><?php echo $count?></td>
                                   <?php 
                                    if($type->offer_type==2){ 
                                ?>
                                    <td><?php echo $type->amount;echo "% ";if($type->min_amount>0){ echo "on min purchase of "; echo "Rs."; echo $type->min_amount;}?></td>
                                <?php
                                    }
                                    else{  $discount="Rs.";
                                ?>     
                                    <td><?php echo $discount; echo $type->amount;if($type->min_amount>0){ echo " on min purchase of "; echo "Rs."; echo $type->min_amount;}?></td> 
                                <?php
                                    }
                                ?>    
                                    
                                    <td><?php echo "Rs. "; echo $type->min_amount;?></td>  
                                    <td><?php echo "Rs. "; echo $type->offer_purpose;?></td>  
                                    
                                    <td>
                                <?php
                                    //echo $reviewDtls->status ;
                                    if($type->status == 1)
                                    {
                                    ?>
                                      Active <i class="fa fa-check-circle" style="cursor: pointer;" onclick="changeStauts('<?php echo $type->id;?>', 0);"></i>
                                
                                    <?php
                                    } 
                                    else
                                    {
                                    ?>
                                     Deactive <i class="fa fa-ban" style="cursor: pointer;" onclick="changeStauts('<?php echo $type->id;?>', 1);"></i>
                                  
                                    <?php
                                    }
                                    ?>
                                    </td> 
                                    <td>
                                    <i class="fa fa-edit" style="cursor: pointer;" aria-hidden="true" onclick="editForm('<?php echo $type->id;?>');"></i>                    
                    
                                    <i class="fa fa-trash-o" style="cursor: pointer;" aria-hidden="true" onclick="deleteUnit('<?php echo $type->id;?>');"></i>
                                    </td>
                                    <?php
                                   }
                                     }
                                    ?>            
                                    </tr>
                                </tbody> 
                            </table>

                       <div class="row">
                        <div class="col-lg-6" style="float: right;">
                         <div class="dataTables_paginate paging_bootstrap pagination active hover">
                            <div class='pagination'>
                              <ul>

                              <?php

                               $pagLink = "";  
                                for ($i=1; $i<=$totalPage; $i++) {  
                                 $pagLink .= "<li class='active hover'><a class='active hover' href='".base_url()."Offerzone/index?page=".$i."'>".$i."</a></li>";  
                    };  
                   echo $pagLink; 
                    ?>

                </ul>
            </div>
        </div>
    </div>
</div>

                        </section>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
        </section>
    </section>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
       
      setTimeout(function() {
          $('#successMessage').fadeOut('fast');
      }, 10000); 

     addNewForm("");

     // function load_data(page){
     //    $.ajax({
     //      url:"Offerzone.php/index",
     //      method:"POST",
     //      data:{page:page},
     //      success:function(response)
     //      {   
     //              $('#pagination_data').html(response);
                   
     //      }
     //    });
     // }

});
    
    
 function addNewForm(id)
 {
           $.ajax({
              url:"<?php echo base_url();?>Offerzone/offerzone_add",   
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
  url:"<?php echo base_url();?>Offerzone/offerzone_edit",   
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
   // document.frm.newedit.focus();
}


function deleteUnit(id)
{
    if(confirm("Do you want to delete this Customer type?"))
    {
        window.location.href="<?php echo base_url();?>Offerzone/deleteUnit/"+id;
    }
}


function changeStauts(id,status){
    
    var confirmstatus=confirm('Are you sure you want to change status');
    if(confirmstatus)
    {
        location.href="<?php echo base_url();?>Offerzone/changeStatusReview/"+id+"/"+status;
    }
  }
    
       
    </script> 