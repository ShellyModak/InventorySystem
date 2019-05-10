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
                       
                  
                      
                      
                <!--input id="price_range" type="text" name="price_range" value="" /-->
     <div class="advance_out clearfix flex_advance_srch">
                    <div class="dropdown drp_dropdown" >
                            <button class="form-control-sm btn btn-primary" data-toggle="dropdown">Filter Item</button>
                            <div class="dropdown-menu">
                                      <div class= "col-sm-12"> 
                                        <select class="form-control getFname">
                                            <option>Select filter..</option>
                                            <option value="1">Item Name</option>
                                            <option value="2" >Item stock</option>
                                            <option value="3">Item price</option>
                                           
                                        </select>
                                        <br>
                                        <span class="availability">
                                           
                                            <select class="form-control  subfilter" id="subFilterName" style="display:none">
                                                <option value="">Select name</option>
                                                <?php 
                                                foreach($listing['result'] as $row): 
                                                if($row->status != 2){ ?>
                                                <option value="<?php echo $row->item_id?>"><?php echo $row->item_name?></option> 
                                                <?php }      
                                                endforeach;?>
                                            </select>
                                           <br>
                                            <select class="form-control  subfilter subFilterDate" id="subFilterstock" name="subFilterDate" style="display:none">
                                                <option value="">Select stock</option>
                                                 <option value="1">greater than</option>
                                                 <option value="2"> less than </option>
                                        
                                                 <option value="3">equal</option>
                                            </select>
                                            <select class="form-control  subfilter subFilterDate" id="subFilterPrice" name="subFilterDate" style="display:none">
                                                <option value="">Select price condition</option>
                                                 <option value="1">greater than</option>
                                                 <option value="2"> less than </option>
                                        
                                                 <option value="3">equal</option>
                                            </select>
                                            <input type="text" class="form-control  search-text subfilter" placeholder="" id="stock" style="display:none;" >
                                            <input type="text" class="form-control  search-text subfilter" placeholder="" id="price" style="display:none;" >
                                            <input type="button" class="form-control-sm btn btn-primary"  value="Add filter" id="add_filter" />
                                        </span>
                            </div>
                       
                        </div>
                     
                </div>
            </div>
                       <div class="dataTables_filter" id="editable-sample_filter">
                                        <input type="text" class="form-control  search-text"  name="search" id="search" placeholder='search for something' value="">                
                                    </div>
                       <div id="pagination_data">      
                          <table id="example" class="table table-striped table-bordered example_cbd_table" cellspacing="0" width="100%">      
                       
                       
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
        load_data(1);
        function load_data(page){
     // alert(page);
        $.ajax({
          url:"<?php echo base_url(); ?>Item_cont/pagination",
          method:"POST",
          data:{'page':page},
          success:function(response)
          {   
              $('#pagination_data').html(response);          
          },
            error:function(error)
            {
                alert("error");
            }
        })
     }

     $(document).on('click','.pagination_link',function()
      {
        var page=$(this).attr("id");
        ///////alert(page);
        load_data(page);
      });

  $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#mytable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        // createPagination(0);
    });
     
  });

//var header = document.getElementById("myDIV");
//var btns = header.getElementsByClassName("pagination_link");
//for (var i = 0; i < btns.length; i++) {
//  btns[i].addEventListener("click", function() {
//  var current = document.getElementsByClassName("active");
//  if (current.length > 0) { 
//    current[0].className = current[0].className.replace(" active", "");
//  }
//  this.className += " active";
//  });
//}

  $('[data-toggle="tooltip"]').tooltip();
                $('.dropdown-menu').on("click", function(e){
                $(this).next('select').toggle();
                e.stopPropagation();
                e.preventDefault();
                });

            $("select.getFname").change(function(){
               
                    $('.subfilter').css('display','none');
                var select_avail = $(".getFname option:selected").val();
                if(select_avail.search(/\S/) !=-1 ) {
                        select_avail = parseInt(select_avail);
                    $(".availability").show();
                    main_filter = select_avail;
                    switch(select_avail) {
                                        case 1:
                                            $("#subFilterName").css('display','block');
                                                $('.dropdown .datepicker-inline').css('display', 'none');
                                            break;
                                        case 2:
                                            $("#subFilterstock").css('display','block');
                                                $("#stock").css('display','block');
                                            $('.dropdown .datepicker-inline').css('display', 'none');
                                            break;
                                        case 3:
                                            $("#subFilterPrice").css('display','block');
                                            $("#price").css('display','block');
                                            
                                            $('.dropdown .datepicker-inline').css('display', 'none');
                                            break;
                                        case 4:
                                            $("#subFilterDate").css('display','block');
                                            break;
                                        default:
                                            break;
                        }
                }
                else {
                    $(".availability").hide();
                }
            });
     
        
   
 $("#add_filter").on("click", function() {
       // alert(1);
        var iten_name=$('#subFilterName').val();
      var iten_stock_condition=$('#subFilterstock').val();
      var iten_stock=$('#stock').val();
      
     // alert(iten_stock);
      var iten_price_condition=$('#subFilterPrice').val();
       var iten_price=$('#price').val();
      var search_item=$('#search').val();
       //alert(iten_name);
    //  alert(iten_stock);
    //  alert(iten_price);
      
      
        $.ajax({
            
            url:"<?php echo base_url(); ?>Item_cont/loadRecord/",
            method:"POST",
             async: false,
            data:{'iten_name':iten_name,'iten_stock_condition':iten_stock_condition,'iten_stock':iten_stock,'iten_price_condition':iten_price_condition,'iten_price':iten_price},
            success:function(response)
            {
//                $('.filter_data').html(data.product_list);
                //alert($('#replace').length);
                $('#pagination_data').html(response);
               // $(".dropdown-menu").hide();
               //  $(".change").hide();
               /// filter();
                
            },
            error:function(error)
            {
                alert("error");
            }
        })
//        window.location.href="<?php echo base_url();?>Item_cont/loadRecord/"+iten_name;
         $(".dropdown-menu").show();
//createPagination(0);
      
      
    });
   
});
//    function search_row(){
//        
//        var search_item=$('#search').val();
//        //window.location.href="<?php echo base_url();?>Item_cont/loadRecord"+search_item;
//        $.ajax({
//            url:"<?php echo base_url(); ?>Item_cont/index/",
//            method:"POST",
//             async: false,
//            data:{'search_item':search_item},
//            success:function(response)
//            {
////                $('.filter_data').html(data.product_list);
//                //alert($('#replace').length);
//                $('#replace').html(response);
//                $(".dropdown-menu").hide();
//               //  $(".change").hide();
//            },
//            error:function(error)
//            {
//                alert("error");
//            }
//        })
//    }
function search(){
        
        var search_item=$('#search').val();
        window.location.href="<?php echo base_url();?>Item_cont/index?search="+search_item;
        
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