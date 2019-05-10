 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
<section id="main-content">
       <section class="wrapper">
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
                  if($this->session->userdata('msg') !='')
           {
              ?>               
              <div class="alert alert-success message">
                  <center><strong>Success! </strong><span class=""><?php echo $this->session->userdata('msg'); ?></span> </center>
               </div>
              <?php
            $this->session->unset_userdata('msg');
          } 
              ?>


<div class="dataTables_filter" id="editable-sample_filter">

    
<input type="text" id="datepicker" required="" placeholder="mm/dd/yyyy" onchange="searchFunction();" >
    
                  
</div>

<section class="panel">
                   
  <div class="panel-body">   
      
      
    <div class="adv-table">
        <h1><?php echo date('d-M-Y'); ?></h1>
             <table  class="display table table-bordered table-striped" id="dynamic-table">
                <thead>
                   <tr>
                                   
                            <th class="numeric">Raw Material</th>
                            <th class="numeric">In Stock</th>
                            <th class="numeric">Avg Price</th>
                            <th class="numeric">Action</th>
                               

                            
                                    
                    </tr>
                </thead>
                <tbody>                 
                    <?php  
                            foreach ($listing['result'] as $row)  
                            {
                            $whereArr=array('unit_id'=>$row->unit_id);
                            $unit_name =$this->Common_model->getAllDataWithMultipleWhere('UnitType',$whereArr,'unit_id');?>
                         <tr> 
                             
                                <td><?php echo ucfirst($row->material_name);?></td> 
                                <td><?php if($row->quantity)echo $row->quantity." ".ucfirst($unit_name['result'][0]->unit_name);
                                    else echo "0"." ".ucfirst($unit_name['result'][0]->unit_name);?></td> 
                                 <td><?php echo "Rs ".$row->avg_price;?></td> 
                                <td> <a data-toggle="modal" href="#myModal<?php echo $row->material_id;?> "><button type="button" class="btn btn-primary" >Add</button></a></td>

                           </tr>  
                                  

                        
                       
                 
                
                        <?php
                            }
                            ?>                           
                 </tbody>
                   </table>        
             
       
    
                        </div>
                    </div>
                    </section>
                </div>
           </div>
            <?php  foreach ($listing['result'] as $row)  {?>
         
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal<?php echo $row->material_id;?>" class="modal fade">
              <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                           
          <?php      $whereArr=array('material_id'=>$row->material_id);
              
                 $rawmaterial_name=$this->Common_model->getAllDataWithMultipleWhere('RawMaterial',$whereArr,'material_id'); ?>
                           
                            <h4 class="modal-title"><center><?php echo Ucfirst($rawmaterial_name['result'][0]->material_name);?></center></h4>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title"></h4>
                        </div>
             <?php    
    if($row->vendor_id=="")
    {?>
        <div class="modal-body">
            <a href='<?php echo base_url(); ?>Material_cont/edit/<?php echo $row->material_id;?>' ><button type="button" class="btn btn-primary btn-block" >Add Vendor First</button></a>
        </div>
        
   <?php }
     else{ ?>             
                <form id="checkbox<?php echo $row->material_id;?>" method="post" action="<?php echo base_url();?>Inventorymanagement/add_rawmaterial/"> 
                            
                            
                      <div class="modal-body">
                      
                     
                                 

                          
                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <?php
                            $whereArr=array('unit_id'=>$row->unit_id);
                            $unit_name =$this->Common_model->getAllDataWithMultipleWhere('UnitType',$whereArr,'unit_id');?>
                                   
                            <th class="numeric">Vendor </th>
                            <th class="numeric">Quantity( <?php echo ucfirst($unit_name['result'][0]->unit_name);?> )</th>
                            <th class="numeric">Total Price</th>
                               

                            
                                    
                        </tr>
                    </thead>
                 
                    
    <tbody>   
             
      <?php             
   
            $array=explode(",",$row->vendor_id);  
            foreach($array as $value){
                                           
            $whereArr=array('id'=>$value);
            $vendor_name =$this->Common_model->getAllDataWithMultipleWhere('vendorType',$whereArr,'id');
            if($vendor_name['result'][0]->status==1){
                                            
                                            
                                            
             ?>  
                            <tr class="priceQuantityTable_<?php echo $row->material_id;?>"> 
                                <td><?php echo ucfirst($vendor_name['result'][0]->name." ");?><input class="checkbox checkbox-inline checkbox-primary checkbox-sm styled checkbox_box" style="height: 20px;width: 20px;" type="checkbox" id="box" name="box[]" value="<?php echo $value;?>">
                                    <span id="box_error_<?php echo $row->material_id;?>_<?php echo $value;?>" style="color:red"></span></td> 
                                
                                <td><input class="form-control round-input text input_quantity" type="number"  id="quantity" name="quantity[]" min="1" ><span id="quantityvalue_error_<?php echo $row->material_id;?>_<?php echo $value;?>" style="color:red"></span></td> 
                                
                                <td> <input class="form-control round-input text input_price" type="number"  id="price" name="price[]" min="1"><span id="price_error_<?php echo $row->material_id;?>_<?php echo $value;?>" style="color:red"></span></td>
                                
                                  <input class="form-control round-input" type="hidden"  id="unit" name="unit" value="<?php echo $row->unit_id;?>">
                                <input class="form-control round-input " type="hidden"  id="materialid" name="materialid" value="<?php echo $row->material_id;?>">
                                <input class="form-control round-input " type="hidden"   name="date" value="<?php echo  date('d-m-Y h:ia'); ?>">

                           </tr> 
             
                                <?php     }
                                        } ?>
                                    
                        </tbody>
                                  
                </table>
                          
                          
                          
                        
                          
                           
                      </div>
                     
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button" >Cancel</button>
                          <button class="btn btn-success" type="button" onclick="valiadation(<?php echo $row->material_id;?>);" >Save</button>
                      </div>
                    </form>
                          <?php  }?>
                  </div>
              </div>
          </div> 
   
         <?php
            }
         ?>     
    </section>
</section>

<!--
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<!--<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->



<script type="text/javascript">
    
  $( document ).ready(function() {
    $('#datepicker').datepicker();
});
    
 function valiadation(modalId)
    
    {
                        var v1=0;     
                         $(".priceQuantityTable_"+modalId).each(function()
                        {
                                var checkBox = $(this).find("td:eq(0)").find(".checkbox_box").prop("checked");
                                var checkBoxValue = $(this).find("td:eq(0)").find(".checkbox_box").val();
                                var quantityValue = $(this).find("td:eq(1)").find(".input_quantity").val();
                                var priceValue = $(this).find("td:eq(2)").find(".input_price").val();
                                $("#box_error_"+modalId+'_'+checkBoxValue).html("");
                                $("#price_error_"+modalId+'_'+checkBoxValue).html("");
                                $("#quantityvalue_error_"+modalId+'_'+checkBoxValue).html("");
                              
                             
                                 
                             
                             
                         if(checkBox == true)
                        {
                                    
                                 
                                 if(quantityValue<1 && priceValue<1)
                                    {
                                     $("#quantityvalue_error_"+modalId+'_'+checkBoxValue).html("Please enter a positive number");

                                     $("#price_error_"+modalId+'_'+checkBoxValue).html("Please enter a positive number");
                                     v1++;
                                   }
                           
                                   else if(quantityValue<1)
                                     {
                                         $("#quantityvalue_error_"+modalId+'_'+checkBoxValue).html("Please enter a positive number");
                                          v1++;
                                     }
                             
                                     else if(priceValue<1)
                                     {
                                         $("#price_error_"+modalId+'_'+checkBoxValue).html("Please enter a positive number");
                                          v1++;
                                     }
                                          
                                       
                                      else if(quantityValue.search(/\S/) == -1 && priceValue.search(/\S/) == -1)
                                            {
                                                $("#quantityvalue_error_"+modalId+'_'+checkBoxValue).html("quantity is needed");
                                                $("#price_error_"+modalId+'_'+checkBoxValue).html("price is needed");
                                                v1++;
                                            }
                                            else if(quantityValue.search(/\S/) == -1)
                                            {
                                                 $("#price_error_"+modalId+'_'+checkBoxValue).html("");
                                                 $("#quantityvalue_error_"+modalId+'_'+checkBoxValue).html("quantity is needed");
                                                v1++;
                                            }
                                           else if(priceValue.search(/\S/) == -1)
                                           {
                                               $("#quantityvalue_error_"+modalId+'_'+checkBoxValue).html("");
                                               $("#price_error_"+modalId+'_'+checkBoxValue).html("price is needed");
                                               v1++;
                                           }
                                            else
                                            {
//                                                 $("#box_error_"+modalId+'_'+checkBoxValue).html("");
//                                                 $("#price_error_"+modalId+'_'+checkBoxValue).html("");
//                                                $("#quantityvalue_error_"+modalId+'_'+checkBoxValue).html("");
                                            }
                                }
                             
                                
                             
                                else 
                                {
                                    if(quantityValue.search(/\S/) != -1 || priceValue.search(/\S/) != -1)
                                    {
                                     $("#box_error_"+modalId+'_'+checkBoxValue).html("<br>Check first");
                                    v1++;
                                    }else{
                                        $("#price_error_"+modalId+'_'+checkBoxValue).html("");
                                        $("#quantityvalue_error_"+modalId+'_'+checkBoxValue).html("");
                                    }
                                }
                             
                             
                             
                             
                              

                        })
                       
                                         
                      if(v1==0){
                         $('#checkbox'+modalId).submit(); 
                      }                  
                                         
    

}
    
    

    
    
    
    
function searchFunction()
{
    var date=$('#datepicker').val();
    
    if(!/^\d{1,2}\/\d{1,2}\/\d{4}$/.test(date)){
  
    }
    else
    {
       
        
          $.ajax({
                    url:"<?php echo base_url();?>Inventorymanagement/search_by_date",   
                    data:{date:date},
                    type:"POST",            
                    dataType:"text",
                    async: false,
                    success:function(response)
                    {   
                        
                        if(response==1)
                            window.location.href='<?php echo base_url();?>Inventorymanagement/';
                        else 
                        $(".adv-table").html(response);               
                    }
                                                 
                                      
                                        
                });
        
        
        
        
    
    }
    
   
    
}    
    
    
    
    
    

    
    
    
    
    
    

</script>

