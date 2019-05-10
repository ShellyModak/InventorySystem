
<section id="main-content">
        <section class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Add New order
                            <button type="button" class="btn btn-primary btn pull-right" onclick="location.href='<?php echo base_url(); ?>ItemStockManagement/index'">Back</button></header>
         
                       
                        
                        
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form"  action="<?php echo base_url(); ?>ItemStockManagement/insertOrder" method="post" id="updt" enctype="multipart/form-data">
                                <div class="form-group">
                                <input type="hidden" name="mode" value="updateDetails">
                                <!--<input type="hidden" name="cus_id" id="cus_id">-->
                                
                                <input type="hidden" name="orderdate" id="orderdate" value="<?php echo date('d-m-Y')?>">
                                    <label class="control-label">Phone No</label>
                              <input  type="text" style="color: black" placeholder="phoneno" class="form-control test" name="phoneno" id="phoneno"  label="phoneno" onkeyup="checknumber()" onblur="namexists()">
                                    <span id="phoneno_error" style="color: red"></span><br>

                                    <label class="control-label">Customer Name <span style="color: red;"></span></label>
                                    <input  type="text" style="color: black" placeholder="Customer Name" class="form-control test" name="customerName" id="name" label="Name">
                                    <span id="name_error" style="color: red"></span><br>
                                <label class="control-label">Address</label>
                                <textarea class="form-control" name="address" id="address" rows="4" value=""></textarea>
                                  <span id="details_error" style="color:red"></span><br>
                                    <!-- <label class="control-label">Enter item Name</label>    
                                    <input  type="text"  placeholder="Item Name" class="form-control test" name="itemname" id="item" label="Item" onblur="check_if_exists();">
                            <span id="name_error" style="color: red"></span><br>
         -->
                                    
        
    
        <label class="control-label">Select Item</label> 
        <input type="hidden" name="nxtcount" id="nxtcount" value="1">      
        <div id="addMoreHtml" class="test">
     <?php
     $lableVal = '';
     $subCategoryId = $this->uri->segment(3);
//     $wherefldTypeArrArry =array('subCategoryId' => $subCategoryId);
//     $productSeacrhOptionArr=$this->Common_model->getAllDataWithMultipleWhere('productSeacrhOption',$wherefldTypeArrArry,'productSeacrhOptionId','ASC');
//     
          $nxtCount = 1;
          ?>
          <div class="form-group col-lg-12 srchFlds test" id="div_<?php echo $nxtCount;?>">
          
               <div class="col-lg-3">
              <label class="control-label">Item</label>
            <select name="fld_label1[]" style="color: black" class=" form-control item_test" data-id="item_test-<?php echo $nxtCount; ?>" id="fld_label<?php echo $nxtCount;?>" label="Unit">

            <option value="" >Select</option>
         <?php 
                foreach($item['result'] as $row): 
                if($row->status != 2 && $row->stock !=0){?>
              <option value="<?php echo $row->item_id.'-'.$nxtCount?>"><?php echo ucfirst($row->item_name)?></option> 
         <?php  }     
            endforeach;?>
               
                  </select>
                  <span id="item_error" style="color: red"></span><br>
              </div>

                    <div class="col-lg-3">
                   <label>In Stock <span style="color: red;"></span>:</label>
                   <input  type="text" style="color: black" class="form-control stock_test<?php echo $nxtCount; ?> stock" id="fld_label<?php echo $nxtCount;?>" name="fld_label2[]" label="Field Label" readonly>
                   <span id="stk_error" style="color: red"></span><br>
               </div>
              
              <div class="col-lg-3">
                   <label>price (Rs.)<span style="color: red;"></span>:</label>
                   <input  type="text" style="color: black" class="form-control price_test<?php echo $nxtCount; ?> price"  id="fld_label<?php echo $nxtCount;?>" name="fld_label3[]" label="Field Label" readonly>
               </div>

              <div class="col-lg-3">
                   <label>Quantity <span style="color: red;"></span>:</label>            
      <input  type="number" style="color: black" class="form-control qty_test<?php echo $nxtCount; ?> qty" id="fld_label<?php echo $nxtCount;?>" name="fld_label4[]" label="Field Label" onkeyup="checknegative(this);" value="1" min="1" max="" onblur="amountcal()">
    
                   <span id="qty_error" style="color: red"></span><br>
               </div>
               <?php
               //if($productSeacrhOptionArr['num_row'] == $nxtCount)
               //{
               ?>
               <div class="col-lg-3" style="margin-top: 3.0%;" id="actionBtn_<?php echo $nxtCount;?>">
                    <?php
                    if($nxtCount == 1)
                    //if($productSeacrhOptionArr['num_row'] == $nxtCount)
                    {
                    ?>
                    <input type="button" class="btn btn-success" value="+" onclick="addMore('add', '<?php echo $nxtCount;?>');">
                    <!--<input type="button" class="btn btn-default" value="-" onclick="addMore('remove', '<?php echo $nxtCount;?>');">-->
                    <?php
                    }
                    else
                    {
                    ?>
                    <!--<input type="button" class="btn btn-success" value="+" onclick="addMore('add', '<?php echo $nxtCount;?>');">-->
                    <input type="button" class="btn btn-default" value="-" onclick="addMore('remove', '<?php echo $nxtCount;?>');">
                    <?php
                    }
                    ?>
               </div>
              
    </div>
               <?php
               //}
               ?>
          </div><br>
                
                
                <div >
                <label class="control-label">Total Amount (Rs.)</label> 
                <input type="text" style="color: black" class="form-control" id="manualNumber" placeholder="Total Amount" name="manualNumber" readonly/>
                <span id="total_error" style="color: red"></span>
                </div><br>
          
                <!-- <label class="control-label">Enter Tax</label>    
                 <input  type="text"  placeholder="Tax" class="form-control test" name="tax" id="tax" label="tax" onblur="check_if_exists();">
                <span id="tax_error" style="color: red"></span><br>
                                    
                        <label class="control-label">Mode of price</label>            
                        <label for="chkYes">
                            <input type="radio" id="chkYes" name="chkPassPort" onchange="fetch_value('<?php echo $nxtCount;?>');"/>
                                Manual
                        </label>
                        <label for="chkNo">
                            <input type="radio" id="chkNo" name="chkPassPort" />
                                Automated
                        </label>
                            <hr />
                <div id="dvyesshow" style="display: none">
                        <label class="control-label">Manual price</label> 
                <input type="text" class="form-control" id="manualNumber" name="manualNumber" readonly/>
                </div>
                <div id="dvnoshow" style="display: none">
                       <label class="control-label">Automated price</label> 
                <input type="text" class="form-control " id="automatedNumber" />
                </div>
                
               
                                           
                    <label class="control-label">Status</label>
               <select class="form-control " id="status" name="status" label="status"   data-max-options="1">
                    
                   <option value="0">Inactive</option>
                   <option value="1" >Active</option></select>
                      <span id="status_error" style="color: red"></span><br> -->
                      <!-- <input type="button" class="btn btn-primary " id="total" value="Calculate Total" onclick="fetch_value('<?php echo $nxtCount;?>');"> -->
        
      <center> <button type="button" class="btn btn-primary" id="btn" onclick="checkfields()">Save</button></center>                  
       
                        
                                    </div>
                                </form>
                                </div>
                               
                               
                        </div>
                    </section>
            </div>
            </div>
    </section>
            </section>


     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script>
//=========================for positive quantity checking===============================//
// $(".qty_test").keyup(function(){
//       //alert('hii');
//       //var qty=$('#quantity').val();
//       //alert(qty);
//     var currow=$(this).closest('tr');
//     var quantity=parseInt(currow.find('td:eq(2)').find('.test2').val());
//     if(quantity<0){
//       alert('Please enter a Positive quantity');
//       currow.find('td:eq(2)').find('.test2').val(0);

//     }
    //==================================end for positive quantity checking======================//
function checkfields(){
  $('#name_error').html('');
  $('#phoneno_error').html('');
  $('#qty_error').html('');
  $('#item_error').html('');
  $('#total_error').html('');
  var error=0;
  var pregmatch = /^(\s)*[A-Za-z]+((\s)?((\'|\-|\.)?([A-Za-z])+))*(\s)*$/;
  var cus_name=$('#name').val();
  var cus_phn=$('#phoneno').val();
  var item=$('.item_test').val();
  var qty=$('.qty_test').val();
  var total=$("#manualNumber").val();
  var item;
  var stock;
  if(cus_name==''){
    $('#name_error').html('Please insert a valid name');
    error++;
  }
  if(!pregmatch.test(cus_name)){
      $('#name_error').html('Please insert a valid name');
      error++;
         }
  if(cus_phn==''){
    $('#phoneno_error').html('Please insert a phone number');
      error++;
  }
  if(cus_phn!=''){
    if(cus_phn.length!=10){
      $('#phoneno_error').html('Please insert a 10 digit mobile number');
      error++;
      }
  }
  //====================checking for item and quantity======================//
  $(".item_test").each(function()
                    {
                     var qty=$(this).val();
                    if(qty==''){
                        
                         error++;
                     //$('#item_error').html('Plesae select an item');
                  $(this).parents('.srchFlds').find('#item_error').html('Plesae select an item');
                        
                    }
                else{
                     //$("#item_error").html("");
                     $(this).parents('.srchFlds').find('#item_error').html("");
                    }
                });
  //new added
  

    //$(".qty_test").each(function()
      var nxt=1;
      $(".qty").each(function()
                    {
                     var item=$(this).val();
                     var stock=$('.stock_test'+nxt).val();
                     //alert(item);
                     //alert(stock);
                     //alert(stock);
                     //alert(item);
                     nxt++;
                    if(item==''){
                        
                         error++;
                     //$('#qty_error').html('Please enter a quantity');
                     $(this).parents('.srchFlds').find('#qty_error').html('Please enter a quantity');    
                    }
                    else if(item > stock){
                      alert('hii');
                      error++;
                     $(this).parents('.srchFlds').find('#qty_error').html('Please enter a quantity less than the stock');

                    }
                else{
                     //$("#qty_error").html("");
                     //$(this).parents('.srchFlds').find('');
                     $(this).parents('.srchFlds').find('#qty_error').html("");
                    }
                });

  //============================end for item and quantity=======================//
  // $(".stock").each(function()
  //                   {
  //                    //var item=$(this).val();
  //                    stock=$(this).val();
  //                   // if(stock==''){
                        
  //                   //      error++;
  //                   //  //$('#qty_error').html('Please enter a quantity');
  //                   //  $(this).parents('.srchFlds').find('#qty_error').html('Please enter a quantity');
                        
  //                   }
  //               // else{
  //               //      //$("#qty_error").html("");
  //               //      //$(this).parents('.srchFlds').find('');
  //               //     }
  //               });
  // if(item<stock){
  //   alert('hii');
  // }

 //  if(item==''){
 //    $('#item_error').html('Plesae select an item');
 //    error++;
 //  }
 // if(qty==''){
 //    $('#qty_error').html('Please enter a quantity');
 //    error++;
 //  }
  if(total==''){
    $('#total_error').html('Please press the CALCULATE TOTAL button to find the Total Price');
    error++;
  }
  //alert(error);exit();
  if(error==0){
            $('#updt').submit();
         }

}
function namexists(){
  var phn=$('#phoneno').val();
  //alert(phn);
    if(phn !=''){
    if(phn.length==10){
    $.ajax({
      url:"<?php echo base_url(); ?>ItemStockManagement/check_name",
   method:"POST",
   //data:{item : myarray[i]},
   data:{phn : phn},
   success:function(item)
   {

    var customerName=JSON.parse(item);
    console.log(customerName);
    var cus_num_row=customerName.item.num_row;
    console.log(cus_num_row);
    if(cus_num_row!=0){
      var customer=customerName.item.result[0].customer_name;
      if( typeof customer !== undefined){
      var name=customerName.item.result[0].customer_name;
      $('#name').val(name);
      } 
    }else{
      $('#name').val('');
    }
    // var customer=customerName.item.result[0].customer_name;
    // //var cus_num_row=customerName.item.num_row;
    // //console.log(cus_num_row);

    // if( typeof customer !== undefined){
    // var name=customerName.item.result[0].customer_name;
    // $('#name').val(name);
    // } 
  }
  });
  }else{
    alert('please enter a 10 digit mobile number');
    $('#phoneno').val('');
  }
}
}
//for phone number
//===================Number check=====================test//
  //$(document).on('keypress','.isNumberKey',function(evt)
//   $(document).on('keypress','.test',function(evt){
//    var charCode = (evt.which) ? evt.which : evt.keyCode;
//    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
//        {
//            return false;
//        }
//        else
//        {
//            return true;
//        }
// });
function checknumber(){
            var phone=$('#phoneno').val();
        if(isNaN(phone)){
           alert('Please enter number');
            $('#phoneno').val('');
        }
    }

$(document).ready(function(){
// $('.item_test').change(function(){
$(document).on('change','.item_test',function(){
    var item= $(this).val();
    //alert(item);
    var itemsplit= item.split('-');
    var itemid=itemsplit[0];
    var nxtcountid=itemsplit[1];
    //alert(nxtcountid);
    $('#nxtcount').val(nxtcountid);
    var myarray = [];
  //alert(1);exit()
    var nxt=$("#nxtcount").val();

  $.ajax({
   url:"<?php echo base_url(); ?>ItemStockManagement/fetch_data",
   method:"POST",
   //data:{item : myarray[i]},
   data:{item : itemid},
   async: false,
   success:function(item)
   {
    var stock=JSON.parse(item);
    console.log(stock);
    console.log(stock.item.result[0].stock);
    console.log(stock.item.result[0].price);
    var instock=stock.item.result[0].stock;
    var price=stock.item.result[0].price;

      $('.stock_test'+nxt).val(instock);
     $('.price_test'+nxt).val(price);
     $('.qty_test'+nxt).attr('max',instock);
    //$("input[type='number']").prop('max',10);
    }
  });
//}
  //===============================new added for calculation w.r.t onchange==============================//
        var myarray = [];
         var myarray1 = [];
        var myarray2 = [];
         var myarray3 = [];
  $(".item_test").each(function()
     {
      var item= $(this).val();
      var itemsplit= item.split('-');
      var itemid=itemsplit[0];
      //alert(material);
       //myarray.push(item);
      myarray.push(itemid);
        });
         console.log(myarray); 
    $(".stock").each(function()
     {
      var stock= $(this).val();
        myarray1.push(stock);
        }); 
         console.log(myarray1); 
        
    $(".price").each(function()
     {
      var price= $(this).val();
        myarray2.push(price);
        }); 
         console.log(myarray2);

    //$(".qty_test").each(function()
    $(".qty").each(function()
    {
    var qty= $(this).val();
    
     myarray3.push(qty);
       
       });  
         console.log(myarray3); 
       
        var total_price=0;

        for(i=0;i<myarray.length;i++){
            $.ajax({
             url: '<?php echo base_url();?>ItemStockManagement/calculate',
             type: 'POST',
             data: {'item_id' : myarray[i],'stock' : myarray1[i],'price' : myarray2[i],'quantity' : myarray3[i]},
             async: false,
             success: function(response){
                if (response)
                {
                                  price=parseFloat(response);
                }
                else
                {
                                  //alert(1);myarray[i],'stock' : myarray1[i],'price' : myarray2[i],
      
                }
             }
          });
            total_price=total_price+price;
            
        }
        final_manual_price=total_price.toFixed(2);
        $('input[name="manualNumber"]').val(final_manual_price); 
  //===============================end for calculation w.r.t onchange=====================================//

 // }//end loop
});
});

  //===============================new added for calculation w.r.t onchange==============================//
  function amountcal(){
        var myarray = [];
         var myarray1 = [];
        var myarray2 = [];
         var myarray3 = [];
  $(".item_test").each(function()
     {
      var item= $(this).val();
      var itemsplit= item.split('-');
      var itemid=itemsplit[0];
      //alert(material);
       //myarray.push(item);
      myarray.push(itemid);
        });
         console.log(myarray); 
    $(".stock").each(function()
     {
      var stock= $(this).val();
        myarray1.push(stock);
        }); 
         console.log(myarray1); 
        
    $(".price").each(function()
     {
      var price= $(this).val();
        myarray2.push(price);
        }); 
         console.log(myarray2);

    //$(".qty_test").each(function()
      $(".qty").each(function()
    {
    var qty= $(this).val();
    
     myarray3.push(qty);
       
       });  
         console.log(myarray3); 
       
        var total_price=0;

        for(i=0;i<myarray.length;i++){
            $.ajax({
             url: '<?php echo base_url();?>ItemStockManagement/calculate',
             type: 'POST',
             data: {'item_id' : myarray[i],'stock' : myarray1[i],'price' : myarray2[i],'quantity' : myarray3[i]},
             async: false,
             success: function(response){
                if (response)
                {
                                  price=parseFloat(response);
                }
                else
                {
                                  //alert(1);myarray[i],'stock' : myarray1[i],'price' : myarray2[i],
      
                }
             }
          });
            total_price=total_price+price;
            
        }
        final_manual_price=total_price.toFixed(2);
        $('input[name="manualNumber"]').val(final_manual_price); 
  //===============================end for calculation w.r.t onchange=====================================//
}
 // }//end loop
//});
// /});
//==========================end for onblur=====================================//

function checknegative(current_this){

     var qty=$(current_this).val();
     if(qty<0){
    
      alert('please enter a positive quantity');
      //$(current_this).parents('.srchFlds').find('.qty_test').val('');
      $(current_this).parents('.srchFlds').find('.qty').val(1);
      
     }
       //   else if(qty==0){
       //  alert('please enter a valid quantity');
       // //$(current_this).parents('.srchFlds').find('.qty_test').val('');
       // $(current_this).parents('.srchFlds').find('.qty').val(1);
       //    }
}

//
// function fetch_value(nxtCount){

//     //if ($("#chkYes").is(":checked")) {
     
//          var myarray = [];
//          var myarray1 = [];
//          var myarray2 = [];
//          var myarray3 = [];
//   $(".item_test").each(function()
//      {
//       var item= $(this).val();
//       //alert(material);
//        myarray.push(item);
//         });
//          console.log(myarray); 
//     $(".stock").each(function()
//      {
//       var stock= $(this).val();
//         myarray1.push(stock);
//         }); 
//          console.log(myarray1); 
        
//     $(".price").each(function()
//      {
//       var price= $(this).val();
//         myarray2.push(price);
//         }); 
//          console.log(myarray2);

//     $(".qty_test").each(function()
//     {
//     var qty= $(this).val();
    
//      myarray3.push(qty);
       
//        });  
//          console.log(myarray3); 
       
//         var total_price=0;

//         for(i=0;i<myarray.length;i++){
//             $.ajax({
// 						 url: '<?php echo base_url();?>ItemStockManagement/calculate',
// 						 type: 'POST',
// 						 data: {'item_id' : myarray[i],'stock' : myarray1[i],'price' : myarray2[i],'quantity' : myarray3[i]},
// 						 async: false,
// 						 success: function(response){
// 							  if (response)
// 							  {
//                                   price=parseFloat(response);
// 							  }
// 							  else
// 							  {
//                                   //alert(1);
			
// 							  }
// 						 }
// 					});
//             total_price=total_price+price;
            
//         }
//         final_manual_price=total_price.toFixed(2);
//         $('input[name="manualNumber"]').val(final_manual_price);    
//     }
    
</script>      
<script>
//$(document).ready(function(){
//	  addMore('add', 0);
//});
var labelValArr = [];
function addMore(flag, count)
{
  $('#qty_error').html('');
  $('#item_error').html('');
  var item=$('.item_test').val();
  //new added for quantity field//
  var qty=$('.qty_test').val();
  //if(qty==''){
    //$('#qty_error').html('please enter a quantity');
   if(item==''){
    $('#item_error').html('Plesae select an item');
  }
  else if(qty==''){
    $('#qty_error').html('Please enter a quantity');
  }else{
        $('#qty_error').html('');
        $('#item_error').html('');

  //end for quantity field//
	 var hasFld = $('.srchFlds').length;
	 var prevCount = parseInt(hasFld) - 1;
	 var nxt=$("#nxtcount").val();
 
	 $('#addMoreHtml_error').html('');
	 if (flag == 'add')
	 {
        
		  var prevFld_label = $('#fld_label'+prevCount).val();
		  var fld_label = $('#fld_label'+count).val();
         
		  //var fld_type = $('#fld_type'+count).val();
		  
		  //alert(labelValArr+'======= '+fld_label);
		  
		  if (hasFld > 0 && fld_label!=undefined && (fld_label.search(/\S/) == -1))
		  {
			   $('#addMoreHtml_error').html('All fields are mandatory');
		  }
		//  else if (hasFld > 1 && fld_label.search(/\S/) != -1 && $.inArray(fld_label, labelValArr))
		//  {
		//	   $('#addMoreHtml_error').html('Search label must be unique.');
		//  }
		  else
		  {
			   //labelValArr.push(fld_label);
			   $.ajax({
						 url: '<?php echo base_url();?>ItemStockManagement/generateField',
						 type: 'POST',
						 data: {'count' : count},
						 async: false,
						 success: function(response){
							  $('#addMoreHtml').append(response);
							  if (hasFld > 1)
							  {
								   var actnHtml = '<input type="button" class="btn btn-default" value="-" onclick="addMore(\'remove\', \''+count+'\');">';
								   //$('#actionBtn_'+count+' input:nth-child(1)').remove();
								   $('#actionBtn_'+count).html(actnHtml);
							  }
							  else
							  {
								   $('#actionBtn_'+count).html('');
							  }
						 }
					});
		  }
	 }
	 else if (flag == 'remove')
	 {
		  if (hasFld > 2 && hasFld == count)
		  {
			   var actnHtml = '<input type="button" class="btn btn-success" value="+" onclick="addMore(\'add\', \''+prevCount+'\');">&nbsp;<input type="button" class="btn btn-default" value="-" onclick="addMore(\'remove\', \''+prevCount+'\');">';
			   $('#actionBtn_'+prevCount).html(actnHtml);
			   
		  }
		  else if (hasFld == 2)
		  {
			   $('.srchFlds').each(function(){
					var fldIdArr = $(this).attr('id').split('_');					
					if (fldIdArr[1] != count)
					{
						 //alert(fldIdArr[1]);
						 prevCount = fldIdArr[1];
						 var actnHtml = '<input type="button" class="btn btn-success" value="+" onclick="addMore(\'add\', \''+prevCount+'\');">';
						 $('#actionBtn_'+prevCount).html(actnHtml);
                    }
			   });
		  }
		  $('#addMoreHtml_error').html('');
		  $('#div_'+count).remove();

      //=====================================================new added================================================//
      var myarray = [];
         var myarray1 = [];
        var myarray2 = [];
         var myarray3 = [];
  $(".item_test").each(function()
     {
      var item= $(this).val();
      var itemsplit= item.split('-');
      var itemid=itemsplit[0];
      //alert(material);
       //myarray.push(item);
      myarray.push(itemid);
        });
         console.log(myarray); 
    $(".stock").each(function()
     {
      var stock= $(this).val();
        myarray1.push(stock);
        }); 
         console.log(myarray1); 
        
    $(".price").each(function()
     {
      var price= $(this).val();
        myarray2.push(price);
        }); 
         console.log(myarray2);

    //$(".qty_test").each(function()
      $(".qty").each(function()
    {
    var qty= $(this).val();
    
     myarray3.push(qty);
       
       });  
         console.log(myarray3); 
       
        var total_price=0;

        for(i=0;i<myarray.length;i++){
            $.ajax({
             url: '<?php echo base_url();?>ItemStockManagement/calculate',
             type: 'POST',
             data: {'item_id' : myarray[i],'stock' : myarray1[i],'price' : myarray2[i],'quantity' : myarray3[i]},
             async: false,
             success: function(response){
                if (response)
                {
                                  price=parseFloat(response);
                }
                else
                {
                                  //alert(1);myarray[i],'stock' : myarray1[i],'price' : myarray2[i],
      
                }
             }
          });
            total_price=total_price+price;
            
        }
        final_manual_price=total_price.toFixed(2);
        $('input[name="manualNumber"]').val(final_manual_price);
      //=================================================end for new added=============================================//
	 }
}
}

</script>