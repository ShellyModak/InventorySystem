<table id="example" class="table table-striped table-bordered example_cbd_table" cellspacing="0" width="100%">      
                       
                       <!--div class="dataTables_filter" id="editable-sample_filter">
                                        <input type="text" class="form-control" name="search" id="search" placeholder='search for something'  value=" <?php //echo $search ; ?>">
                        <!--button type="button" class="btn btn-round btn-primary" name='submit' value='Search'  onclick='search_row();'>Search</button>                
                                    </div-->
                   <thead>
                   <tr>
                                   <th class="numeric">Item Name</th>
                                    <th class="numeric">Item stock</th>
                                    <th class="numeric">Tax</th>
                                    <th class="numeric">Price with tax</th>
                                   
                                    <th class="numeric">Status</th>
                       
                                    <th class="numeric">Option</th>
                                    
                                </tr>
                                </thead>
                               
                                <tbody id="mytable">
                                 
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

                     <td><?php echo $row->tax;?></td> 
                    <td><?php echo $row->final_price;?></td>
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
                                location.href='".base_url()."Material_cont';
                                    
                                 </script>";
                                        
                                        
                                    }
         ?>
                              
                                </tbody>
                            
                   <tfoot>
                   </tfoot>
                   </table>
                 <div class="row">
                        <div class="col-lg-6" style="float: right">
                         <div class="dataTables_paginate paging_bootstrap pagination active hover">
                           
                              <ul class="pagination" >
                                 <div id="myDIV">   
                              <?php

                               $pagLink = "";  
                                for ($i=1; $i<=$totalPage; $i++) {  
                               //  $pagLink .= "<li class='active hover'><a class='active hover' href='".base_url()."Offerzone/index?page=".$i."'>".$i."</a></li>";  
                                  $pagLink .="<li class=' pagination_link' id='".$i."'>".$i."</li>";
                    };  
                   echo $pagLink; 
                    ?>
                                  </div>           
                </ul>
            
        </div>
    </div>
</div>


<style>
ul.pagination {
    display: inline-block;
    padding: 0;
    margin: 0;
}

ul.pagination li {display: inline;}

ul.pagination li  {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
}

ul.pagination li.active {
    background-color: #4CAF50;
    color: white;
    border: 1px solid #4CAF50;
}

ul.pagination li:hover:not(.active) {background-color: #ddd;}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
// Add active class to the current button (highlight it)
var header = document.getElementById("myDIV");
var btns = header.getElementsByClassName("pagination_link");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  if (current.length > 0) { 
    current[0].className = current[0].className.replace(" active", "");
  }
  this.className += " active";
  });
}
</script>