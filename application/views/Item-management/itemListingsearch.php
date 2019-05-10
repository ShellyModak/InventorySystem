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
                    Item
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
                       Item Details
                      <span class="tools pull-right">
                           <a href="javascript:;" class="fa fa-chevron-down"></a>
                           <a href="javascript:;" class="fa fa-cog"></a>
                           <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                   </header>
                   <div class="panel-body">
                   <div class="adv-table">
                       
                  
                      
                       <input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="65000" />
                    <p id="price_show">1000 - 65000</p>
                     <!--input id="price_range" type="text" name="price_range" value="" /-->
     <div class="row"> 
         <div class="col-sm-2">
    <select name="search" class=" form-control search_test"  id="search" label="search"  onchange='search_row();' >
         <option value="" >Select</option>
        
         <?php 
            foreach($listing['result'] as $row): 
            if($row->status != 2){ ?>
              <option value="<?php echo $row->item_id?>"><?php echo $row->item_name?></option> 
         <?php }      
        endforeach;?>
               
    </select>
     </div> 
         
    </div>
                       <div id="replace">
                          <table  class="display table table-bordered table-striped" id="dynamic-table">        
                       
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
                       </div>
                       
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
     addNewForm('');
        
        $('#price_range').slider({
        range:true,
        min:1000,
        max:65000,
        values:[1000,65000],
        step:500,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
           // filter_data(1);
        }

    });


});
    
   function search_row(){
        
        var iten_name=$('#search').val();
       
        $.ajax({
            url:"<?php echo base_url(); ?>Item_cont/loadRecord/",
            method:"POST",
            dataType:"text",
             async: false,
            data:{iten_name:iten_name},
            success:function(response)
            {
//                $('.filter_data').html(data.product_list);
                //alert($('#replace').length);
                $('#replace').html(response);
            },
            error:function(error)
            {
                alert("error");
            }
        })
//        window.location.href="<?php echo base_url();?>Item_cont/loadRecord/"+iten_name;
        
    }

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