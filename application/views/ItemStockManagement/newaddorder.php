<style>
fieldset.group  { 
  margin: 0; 
  padding: 0; 
  margin-bottom: 1.25em; 
  padding: .125em; 
} 

fieldset.group legend { 
  margin: 0; 
  padding: 0; 
  font-weight: bold; 
  margin-left: 20px; 
  font-size: 100%; 
  color: black; 
} 

    .li{
      list-style: none;  
    }
    
ul.checkbox  { 
  margin: 0; 
  padding: 0; 
  margin-left: 20px; 
  list-style: none; 
} 

ul.checkbox li input { 
  margin-right: .25em; 
} 

ul.checkbox li { 
  border: 1px transparent solid; 
  display:inline-block;
  width:12em;
} 

ul.checkbox li label { 
  margin-left: ; 
}
/*
    .content{
            height: 900px;

    }
*/
    
        
    

</style>

 <?php
                                               
    $whereArray = array('status'=>'1','store_id'=>$this->session->userdata('StoreId'));        
    $itemData=$this->Common_model->getAllDataWithMultipleWhere('Item',$whereArray,'item_id');
    if($itemData['num_row']>0)
    {
?>

<section id="main-content">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">
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

                        <div id="wizard">
                            
                            <h2>Select Items</h2>
                            
                                  <section id="wizard-p-0" role="tabpanel" aria-labelledby="wizard-h-0" class="body current" aria-hidden="false" style="overflow-y: scroll;">
                                <form>
                                   <div class="row">
                                        <div class="form-group col-lg-3" >
                                    <label class="control-label">Items</label>      
                              </div>
                                         <div class="form-group  col-lg-4">
                            <label class="control-label">Stock</label>
                              </div>
                                         <div class="form-group  col-lg-5" >
                            <label class="control-label">Price</label>
                              </div>
                                   </div>        
                 <?php
                                               
                foreach($itemData['result'] as $value)
                {?>   
                        <div class="parent">
                         
                           <div class="row value">
                                <div class="form-group col-lg-3 ">
                                   <fieldset class="group"> 

                                       <ul class="checkbox  underLine">   
                                            <li class="li">
                                        <input  id="checkbox" type="checkbox"  name="checkbox[]"  value="<?php echo $value->item_id;?>" <?php if($value->stock==0) echo "disabled";?>/>
                                                
                                        <label class="lebel" for="cb1"><?php echo $value->item_name;?></label>
                                           </li> 
                                        </ul>
                                    </fieldset>                               
                                </div>
                                <div class="form-group  col-lg-4" >

                                                    <div class="col-lg-4" style="padding-left: none;">
                                                        <input type="text" class="form-control stock"  value="<?php echo $value->stock;?>" readonly>
                                                    </div>
                                        </div>
                                <div class="form-group  col-lg-5" >
                                 <div class="col-lg-5" style="padding-left: none;">
                                                <input type="text" class="form-control price"    value="<?php echo $value->price;?>" readonly>
                                            </div>
                                </div>
                          </div>
                             
                        </div>
              <?php 
                }
                ?>
                         <span id="checkbox_error" style="color: red"></span><br> 
                    </form>
                            </section>
                            <h2>Item Details</h2>
                            <section id="wizard-p-0" role="tabpanel" aria-labelledby="wizard-h-0" class="body current" aria-hidden="false" style="overflow-y: scroll;">

                               <div id="addMoreHtml" class="test">
                                </div>
                                 <label id="totalPrice"></label>
                            </section>
                            
                         
                             <h2>Customer Details</h2>
                          <section id="wizard-p-0" role="tabpanel" aria-labelledby="wizard-h-0" class="body current" aria-hidden="false" style="overflow-y: scroll;">

                                <form class="form-horizontal">
                                 <div class="profile-desk">
                                 <div class="row">
                                 <label class="col-lg-2 control-label">Phone Number</label>
                                    <div class="form-group col-lg-4">
                                        
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control" id="phone" placeholder="Phone" onblur="getName(this.value);">
                                             <span id="Phone_error" style="color: red"></span>
                                        </div>
                                         
                                    </div>
                                    <label class="col-lg-4 control-label">Name</label>
                                     <div class="form-group col-lg-4">
                                        
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control" id="name" placeholder="Name">
                                             <span id="name_error" style="color: red"></span>
                                         </div>
                                       
                                    </div>
                                     
                                     
                                     
                                     
                                </div>
                                 <div class="row">
                                 <label class="col-lg-2 control-label">Total Price</label>    
                             <div class="form-group col-lg-3">
                                        
                                        <div class="col-lg-10">
                                           <input type="text" class="form-control"  id="price" placeholder="Price" readonly>
                                        </div>
                                    </div>
                                    <label class="col-lg-3 control-label">Discount</label>
                                      <div class="form-group col-lg-3">
                                        
                                        <div class="col-lg-10">
                                           <input type="text" class="form-control"  id="discountAmount" readonly>
                                        </div>
                                          
                                          
                                    </div>
                                     
                                     <label class="col-lg-3 control-label">Overall Price</label>
                                     <div class="form-group col-lg-3">
                                        
                                        <div class="col-lg-10">
                                           <input type="text" class="form-control"  id="cost" placeholder="Price" readonly>
                                        </div>
                                          
                                          
                                    </div>
                                  </div> 
                                     <hr>
                                 
                                       <div class="row">
                                          <div class="form-group col-lg-12">
                                              <div class="col-lg-4">
                                                  <!--label class="control-label">Customer type</label-->
                                              <div class="row">
                                     <input type="radio" name="gender" value="male" style="float: left!important;margin-left: 20px;"><span style="margin-left:5px;"> Gold</span>
                                     </div>
                                     <div class="row">
                                     <input type="radio" name="gender" value="male" style="float: left!important;margin-left: 20px;"><span style="margin-left:5px;"> Platinum</span>
                                     </div>
                                    <div class="row">
                                     <input type="radio" name="gender" value="male" style="float: left!important;margin-left: 20px;"><span style="margin-left:5px;"> Silver</span>
                                     </div> 
                                              </div>
                                              
                                               <div class="col-lg-4">
                                              
                                              
                                                  <div class="row">
                                                  <input type="radio"  name="gender" value="male"style="float: left!important;margin-left: 20px;"><span style="margin-left:5px;"><i class="fa fa-tag"></i>Rs.4 on min purchase of Rs.2000</span>
                                                   </div>
                                              
                                               <div class="row">
                                                <input type="radio" name="gender" value="female"style="float: left!important;margin-left: 20px;"><span style="margin-left:5px;"> <i class="fa fa-tag" ></i>Rs.10 on min purchase of Rs.500</span>
                                           </div>
                                               <div class="row">
                                                   <input type="radio"  name="gender" value="other"style="float: left!important;margin-left: 20px;"><span style="margin-left:5px;"> <i class="fa fa-tag"></i>Rs.10 on min purchase of Rs.3000</span>
                                              </div>
                                                      
                                              </div>
                                              
                                              
                                              <div class="col-lg-4">
                                              
                                              
                                                  <div class="row">
                                                    <label class="control-label">Enter Cupon Code</label>
                                                  <input type="text" class="form-control" id="name"  placeholder="Name">
                                                   </div>
                                              
                                               
                                                      
                                              </div>
                                              
                                              
                                           </div>
                                          </div> 
                                     
                                     
                                     
                                    </div>
                                </form>
                            </section>
                            
                            
                            
                            <h2>Order Summary</h2>
                            <section id="wizard-p-0" role="tabpanel" aria-labelledby="wizard-h-0" class="body current" aria-hidden="false" style="overflow-y: scroll;">
                            <h6><center>Order Summary</center></h6><br>   
                                
                                 <div class="padding">
                    <div class="table-responsive table-responsive_custom">
                        <table id="example" class="table table-striped table-bordered example_cbd_table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Itemname</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                  
                                </tr>
                            </thead>
                            <tbody id="insert">

                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                    <div>
                    <br>
                    <span>Price : </span><label class="" id="original"></label><br>
                    <span>Discount Given : </span><label class="" id="discount"></label><br>
                    <span>Overall Price : </span><label class="" id="overall"></label>
                    </div>
                            </section>
                        </div>
                    </div>
                </section>
            </div>
            </div>
    </section>
   <?php }
    else{
          echo "<script>alert('Please add item first');
                    location.href='".base_url()."Item_cont';
                </script>";
        }
    ?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  
   var manupulate=0;  
    var checkingArry=[];
 var  itemArray=[];
  
    
var phonenumber="";
var cost=""; 
var fullname="";    
 var originalprice=0;
var lastprice=0;
var discountAmount=0;   
function addMore(flag, count)
{
 
    var hasFld = $('.srchFlds').length;
    
  if($('.price_test'+count).val()=="" || $('.price_test'+count).val()==0 ||  $('.stock_test'+count).val()=="")
      { 
          manupulate=1;
      }
    
  if (flag == 'add' && manupulate==0)
	 {
			   $.ajax({
						 url: '<?php echo base_url();?>ItemStockManagement/generateField',
						 type: 'POST',
						 data: {'count' : count},
						 async: false,
						 success: function(response){
							  $('#addMoreHtml').append(response);
							  if (hasFld > 1)
							  {
								    var actnHtml = '<span> <i style="font-size:24px" class="fa" onclick="addMore(\'remove\',\''+count+'\');"></i></span>';
								 
								   $('#actionBtn_'+count).html(actnHtml);
							  }
							  else
							  {
								   $('#actionBtn_'+count).html('');
							  }
						 }
					});
		  
     }
	 else if (flag == 'remove')
	 {
         var prevCount=count-1;
         
       
         manupulate=0;
		  if (hasFld > 2 && hasFld == count)
		  {
              
			  var actnHtml = '<span> <i style="font-size: 25px;" class="fa" onclick="addMore(\'add\', \''+prevCount+'\');"></i></span> &nbsp;&nbsp; <span> <i style="font-size:24px" class="fa" onclick="addMore(\'remove\', \''+prevCount+'\');"></i></span>';
			   $('#actionBtn_'+prevCount).html(actnHtml);
			   
		  }
		  else if (hasFld == 2)
		  {
			   
                   
					//var fldIdArr = $(this).attr('id').split('_');					
					
				
					
						 var prevCount=count-1;
                         alert(prevCount);
              
						 var actnHtml = '<span> <i style="font-size: 25px;" class="fa" onclick="addMore(\'add\', \''+prevCount+'\');"></i></span> &nbsp;&nbsp';
						 $('#actionBtn_'+prevCount).html(actnHtml);
                    
			 
		  }
		  $('#addMoreHtml_error').html('');
		  $('#div_'+count).remove();
         
         checkingArry=[];   var totalPrice=0;
        $(".srchFlds").each(function()
                          
        {
           
            var itemId= $(this).parents('.parent').find("#fld_label1").val();
             var price= $(this).parents('.parent').find('#fld_label3').val();
             totalPrice=totalPrice+parseInt(price);
            
             checkingArry.push(itemId);
        })
         $('#totalPrice').text('TotalPrice Rs.'+totalPrice);
         
         
          $(".value").each(function()
             {
                    $(this).parents('.parent').find("#checkbox").prop("checked",false);
                 
                     var itemId= $(this).parents('.parent').find("#checkbox").val();
                      if(checkingArry.includes(itemId))
                      {
                         $(this).parents('.parent').find("#checkbox").prop("checked",true);
                      }
             })
         
          itemArray=[];
      
	 }
    
    manupulate=0;

}
    
    
    
    
    
    

    function next(object)
    {
        
      $('#discountAmount').val('');    
                    $('#cost').val('');
                    $('#name').val('');
       
         var myarray= [];
         
            $(".value").each(function()
             {
                    var checkBox = $(this).parents('.parent').find("#checkbox").prop("checked");
                    
                     if(checkBox == true)
                     {
                              var array= [];
                              var itemId= $(this).parents('.parent').find("#checkbox").val();
                              var stock=  $(this).parents('.parent').find('.stock').val();
                              var price= $(this).parents('.parent').find('.price').val();
                            
                              array.push(itemId);
                              array.push(stock);
                              array.push(price);
                           
                           myarray.push(array);
                           checkingArry.push(itemId);
                        
                     }
                
              
                   
                   
                    
                    
              
            });
            
            if (($("input[name='checkbox[]']").serializeArray()).length === 0)
            {
                $('#checkbox_error').html("You have't chosen anything");
            }
        else{
            $('#checkbox_error').html(" ");
        }
        
             $('#discountAmount').val('');    
                    $('#cost').val('');
                    $('#name').val('');
            if(myarray.length > 0)
            {
        
                    $.ajax({
                                url:"<?php echo base_url();?>ItemStockManagement/item",   
                                data:{array:myarray,itemArray:itemArray},
                                type:"POST",            
                                dataType:"text",
                                async: false,
                                success:function(response)
                                {
                                
                                $('#addMoreHtml').html(response);
                                   
                                        
                                }
                            });
                            var totalPrice=0;
                          $(".srchFlds").each(function()
                          {
                            var price= $(this).parents('.parent').find('#fld_label3').val();
                            totalPrice=totalPrice+parseInt(price);
                          })   
                          $('#totalPrice').text('TotalPrice Rs.'+totalPrice);
                            
                            object.click();
            }
           
          
           
            
    }
    
    
    function nextTwo(object)
    {
         var i=0;
        
        itemArray=[];
        
         $(".srchFlds").each(function()
                          
        {
             var array= [];
               var itemId= $(this).parents('.parent').find("#fld_label1").val();
                var stock=  $(this).parents('.parent').find('#fld_label2').val();
                var price= $(this).parents('.parent').find('#fld_label3').val();
                 var quantity= $(this).parents('.parent').find('#fld_label4').val();
                
                    var basePrice=price/quantity;
             
                              array.push(quantity);
                              array.push(itemId);
                              array.push(stock);
                              array.push(basePrice);
                            i++;
                            itemArray.push(array);
             
                           
                          
                           
         }) 
        if(itemArray.length > 0 && manupulate==0)
         {   
            var arrayLength = itemArray.length;
            var price=0;
              for (var i = 0; i < arrayLength; i++) 
              {
                  
                 price=Number(price)+Number(itemArray[i][3]*itemArray[i][0]);

              }
             final_manual_price=parseFloat(price).toFixed(2);
             originalprice=final_manual_price;

            $('#price').val(final_manual_price);
             
              object.click();
         }
        
        
       
         
    }
    
    function select(count,quantity,flag=0)
    
    {
         var itemId=$(".item_test"+count).val();
       
      
      if(itemId!="")
      {
        if(quantity=="")
        {
            if($(".qty_test"+count).val()=="")
            {
                var quantity=1;
                
            }
           
            else
            {
                 var quantity=$(".qty_test"+count).val();
            }
        }
        
       
        
           $('#item_error1').html('');
          $('#item_error'+count).html('');
            manupulate=0;
        
           if(checkingArry.includes(itemId) && flag==0)
              {
                  manupulate=1;
                  $('#item_error'+count).html('You have already chosen this item');
                  $('.price_test'+count).val('');
                  $('.stock_test'+count).val('');
                  $(".qty_test"+count).val('');
                  $('.price_per_unit_test'+count).val('');
                  
              } 
        
        
       
        
            checkingArry= [];var totalPrice=0;
             $(".srchFlds").each(function()

            {

                var itemId= $(this).parents('.parent').find("#fld_label1").val();
                
                 checkingArry.push(itemId);
            }) 
         
          
         $(".value").each(function()
             {
                    $(this).parents('.parent').find("#checkbox").prop("checked",false);
                 
                     var itemId= $(this).parents('.parent').find("#checkbox").val();
                      if(checkingArry.includes(itemId))
                      {
                         $(this).parents('.parent').find("#checkbox").prop("checked",true);
                      }
             })
        
    
        
        
       if(manupulate==0)
       {
        
          $.ajax({
                    url:"<?php echo base_url();?>ItemStockManagement/priceCalculate",   
                    data:{itemId:itemId,quantity:quantity},
                    type:"POST",            
                    dataType:"text",
                    async: false,
                    success:function(response)
                    {   

                        var responseArr = response.split('Arnab');
                           price=(responseArr[0]);
                           stock=(responseArr[1]);
                     final_manual_price=parseFloat(price).toFixed(2);   
                    $('.price_test'+count).val(final_manual_price);
                    $('.stock_test'+count).val(stock);
                    $(".qty_test"+count).val(quantity);
                    $('.price_per_unit_test'+count).val(parseFloat(final_manual_price/quantity).toFixed(2));
                   
                    }
                });
           
           
                          var totalPrice=0;
                          $(".srchFlds").each(function()
                          {
                            var price= $(this).parents('.parent').find('#fld_label3').val();
                             if(price!="")
                                totalPrice=totalPrice+parseInt(price);
                          })   
                          $('#totalPrice').text('TotalPrice Rs.'+totalPrice);
           
       }
        
       else
       {
       }
    }
    else
    {
        
           $('.price_test'+count).val('');
           $('.stock_test'+count).val('');
           $(".qty_test"+count).val('');
           $(".price_per_unit_test"+count).val('');
    }
}
    
    
    function selectTwo(quantity,count,flag)
    {
        
     var stock=parseInt($(".stock_test"+count).val());
        
       $("#qty_error"+count).html('');
   
    if($(".item_test"+count).val()=="")
    {
        $("#item_error"+count).html("Please insert an item first");
       
       
    }
   else if(parseInt(quantity)>stock)
    {
        var quantity="";
        var price=0;
        
        
      
        
      $(".price_per_unit_test"+count).val('');
        $(".qty_test"+count).val(quantity);
         $("#qty_error"+count).html(stock+' stock Present');
         $(".price_test"+count).val(price);
        
        manupulate=1;var totalPrice=0;
      $(".srchFlds").each(function()
      {
        var price= $(this).parents('.parent').find('#fld_label3').val();
        totalPrice=totalPrice+parseInt(price);
         
        }) 
        
      $('#totalPrice').text('TotalPrice Rs.'+totalPrice);

    }
     
    else if(quantity>0)
     {
           var flag=1;
        
           select(count,quantity,flag);
             
    }
   
   else{
       
    
           $("#qty_error"+count).html("Please insert positive number");
           $(".qty_test"+count).val('');
       
         $(".price_test"+count).val(0.00); 
       
        manupulate=1;
       var totalPrice=0;
       $(".srchFlds").each(function()
      {
        var price= $(this).parents('.parent').find('#fld_label3').val();
        totalPrice=totalPrice+parseInt(price);
        })   
      $('#totalPrice').text('TotalPrice Rs.'+totalPrice);
          
       
   }
      
   
    }
    
    
    
   
     function getName(phoneNumber)
    {
        
       var price=$('#price').val();
        
       $.ajax({
                    url:"<?php echo base_url();?>ItemStockManagement/check_name",   
                    data:{phoneNumber:phoneNumber,price:price},
                    type:"POST",            
                    dataType:"text",
                    async: false,
                    success:function(response)
                    {   

                        var responseArr = response.split('esolz');
                           name=(responseArr[0]);
                           price=(responseArr[1]);
                           discountAmount=(responseArr[2]);
                        
                        final_manual_price=parseFloat(price).toFixed(2);
                        lastprice=final_manual_price;
                     $('#discountAmount').val(discountAmount);    
                    $('#cost').val(final_manual_price);
                    $('#name').val(name);
                    
               
                   
                    }
                });
        
    }
   
    
    function nextThree(object)
    {
        
        $('#name_error').html(""); 
          $('#Phone_error').html("");    
          var i=0;
        
           
        
           phonenumber=$('#phone').val();
           cost=$('#cost').val();
       
           fullname=$('#name').val();
          var order=$('#order').val();
        
        	var pattern=/^[0-9]+$/;
        
         if(phonenumber=="" && fullname=="")
         {
             $('#Phone_error').html("Phonenumber can't blank");
               $('#name_error').html("Name can't blank"); 
             i++;
            
         }
        
        else if(phonenumber=="")  
         {
                $('#Phone_error').html("Phonenumber can't blank");  
             i++;
         }
        
       else  if(fullname=="")
         {
                $('#name_error').html("Name can't blank"); 
             i++;
         }
        
        else if(!pattern.test(phonenumber) || (phonenumber.length!=10) )
        {
             $('#Phone_error').html("Phonenumber is not correct");  
            i++;
        }
        else{}
        
        if(phonenumber!="" && cost!="" && fullname!="" && order!="" )
        {
           
           if(itemArray.length > 0)
            {
        
                    $.ajax({
                                url:"<?php echo base_url();?>ItemStockManagement/insertOrder",   
                                data:{array:itemArray},
                                type:"POST",            
                                dataType:"text",
                                async: false,
                                success:function(response)
                                {   
                               
                       
                                  $('#insert').html(response);
                                   // originaldiscountoverall
                                   $('#original').html('Rs. '+originalprice);   
                                   $('#discount').html(discountAmount);   
                                   $('#overall').html('Rs. '+lastprice);   
                                    
                                    //originalpricelastpricediscountAmount;                         
                                    
                               
                                }
                            });
               
        }
            
          
        }
        
        
        
         if(i==0)
        object.click();
       
    }
    
    
    function finish()
    {
       if(itemArray.length > 0)
            {
                  
                
                    $.ajax({
                                url:"<?php echo base_url();?>ItemStockManagement/placeOrder",   
                                data:{array:itemArray,phone:phonenumber,name:fullname,price:lastprice,originalprice:originalprice,discountAmount:discountAmount},
                                type:"POST",            
                                dataType:"text",
                                async: false,
                                success:function(response)
                                {   
                                    orderNo=response;
                                    if(response){
                                        window.location.href='http://esolz.co.in/lab4/fresher/InventorySystem/index.php/Orderdetails/viewOrderDetails/'+orderNo;
                                    }
                              
                               
                                }
                            });
               
        }
    }
    
    
    
   
    

    </script>
    