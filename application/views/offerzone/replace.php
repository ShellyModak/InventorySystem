
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
                               //  $pagLink .= "<li class='active hover'><a class='active hover' href='".base_url()."Offerzone/index?page=".$i."'>".$i."</a></li>";  
                                  $pagLink .="<span class='pagination_link' id='".$i."'>".$i."</span>";
                    };  
                   echo $pagLink; 
                    ?>

                </ul>
            </div>
        </div>
    </div>
</div>

                        </section>
                 