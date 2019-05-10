                        <?php
                        foreach($item['result'] as $item){ ?>
                        
 <div class="panel-body">
    <div>
        <form role="form"  action="<?php echo base_url(); ?>Item_cont/updateitem/<?php echo $item->item_id ; ?>" method="post" id="updt" enctype="multipart/form-data" onsubmit=" return validateForm();">
            <div class="row">
                <div class="form-group">
                    <div class=" col-md-6">
                                    <input type="hidden" name="mode" value="updateDetails">
                                    <label class="control-label">Enter item Name<span style="color: red;">*</span></label>    
                                    <input  type="text"  placeholder="Item Name" class="form-control test" name="itemname" id="item" label="Item" maxlength="20" value="<?php echo $item->item_name ?>" onblur="check_if_exists();">
                                    <span id="name_error" style="color: red"></span><br>
                    </div>
                    <div class=" col-md-6">                        
                                    <label class="control-label">Status</label>
                                    <select class="form-control " id="status" name="status" label="status"   data-max-options="1">
                                        <option value="1" <?php if($item->status==1) echo 'selected';?>>Active</option>
                                         <option value="0" <?php if($item->status==0) echo 'selected';?>>Inactive</option>
                                    </select>
                                    <span id="status_error" style="color: red"></span><br>
                    </div>
                    <!--div class=" col-md-4">                  
                                    <label class="control-label">Enter Tax</label>    
                                    <input  type="text"  placeholder="Tax" class="form-control tax_test" name="tax" id="tax" label="tax"  min=0 onblur="check_tax();" value="<?php echo $item->tax ?>">
                                    <span id="tax_error" style="color: red"></span><br>
                    </div-->
                </div>
            </div>
                         
                         
                         
                                   
<label class="control-label">Enter Raw Material<span style="color: red;">*</span></label><br>
        <div class="row">
            <div class="form-group">
            <p id="addMoreHtml_error" style="color: red;"></p>
                <div id="addMoreHtml" class="test">
                    <?php

                    if($item_material['num_row'] > 0)
                    {

                        $nxtCount = 1;
                    foreach($item_material['result'] as $row1)
                            { ?>
                    <div class="form-group col-lg-12 srchFlds test" id="div_<?php echo $nxtCount;?>">
                    <div class="col-lg-4">
                        <label class="control-label">Material</label>
                        <select name="fld_label1[]" class=" form-control material_test"  id="fld_label<?php echo $nxtCount;?>" label="Unit" onchange="dependable_unit(this);">
                            <option value="" >Select</option>
                                 <?php 
                                        foreach($material['result'] as $row): 
                                        if($row->status != 2 && $row->quantity != 0.00 && $row->avg_price != 0.00 ){
                                        ?>
                                      <option value="<?php echo $row->material_id?>"<?php if($row->material_id==$row1->material_id){?> selected <?php } ?>><?php echo $row->material_name?></option> 


                                 <?php  }     
                                        endforeach;?>
                        </select>
                        <span id="material_error" style="color: red"></span><br>
                    </div>
                <div class="col-lg-4">
                        <label class="control-label">Unit</label>
                        <select name="fld_label2[]" class=" form-control unit_test"  id="fld_label<?php echo $nxtCount;?>" label="Unit" onchange=" fetch_value();"  >
                            <option value="" >Select</option>
         
                        </select>
                        <span id="unit_error" style="color: red"></span><br>
                </div>
                <div class="col-lg-4">
                       <label>Quantity <span style="color: red;">*</span>:</label>
                       <input  type="number"class="form-control qty_test" id="fld_label<?php echo $nxtCount;?>" name="fld_label3[]" min=1 label="Field Label" value="<?php echo $row1->quantity?>" onblur="check(this);">
                      <span id="qty_error" style="color: red"></span><br>
               </div>
               <?php
               //if($productSeacrhOptionArr['num_row'] == $nxtCount)
               //{
               ?>
               <div class="col-lg-2" style="margin-top: 1.0%;" id="actionBtn_<?php echo $nxtCount;?>">
                    <?php
                    //if($nxtCount == 1)
                    if($item_material['num_row'] == $nxtCount)
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
         
        <?php
          $nxtCount++;
          }
     }
     ?>
                    </div>
                </div>
            </div>

 <div class="row">
     <div class="form-group">
              <div class=" col-md-3">   
                  <label class="control-label">Old price <?php if($item->price_mode==1){echo " (Automated price)";} else {echo " (Manual Price)";} ?></label>            
                <input type="text" class="form-control" id="oldprice" name="oldprice" placeholder="price" value="<?php echo $item->price;  ?>" readonly/>
            <span id="oldprice_error" style="color: red"></span><br>
             </div>           
            <div class=" col-md-3">              
                        <label class="control-label">Calculate new price</label>            
                        <div for="chkYes">
                            <input type="radio" id="chkYes" name="chkPassPort" value=1 onchange="fetch_value();" checked/>
                                Automated
                        </div>
                        <div for="chkNo">
                            <input type="radio" id="chkNo" name="chkPassPort" value=0 >
                                Manual
                        </div>
                    <span id="price_error" style="color: red"></span><br>
             </div>  
          <div class=" col-md-3">           
             
                <div id="dvyesshow" >
                        <label class="control-label">price</label> 
                <input type="text" class="form-control" id="automatedNumber" name="automatedNumber1" placeholder="price" readonly/>
                </div>
                <!--div id="dvnoshow" style="display: none">
                       <label class="control-label">Manual price</label> 
                <input type="text" class="form-control " id="manualNumber" name="automatedNumber" />
                </div-->
         </div>
         <div class="col-md-3">
                    <button type="button" class="btn btn-default btn pull-right" id="btn" onclick="addNewForm('')" style="margin-left:5px;margin-top: 25px;">Cancel</button>
                    <button type="submit" class="btn btn-primary btn pull-right" id="btn" style="margin-right: 5px;    margin-top: 25px;
                    ">Save</button>
        </div>
    </div>
</div>
  <!--div class="row">
            <div class="form-group">
                <div class="save_but">
                    <button type="button" class="btn btn-default btn pull-right" id="btn" onclick="addNewForm('')" style="margin-left:5px">Cancel</button>
                    <button type="submit" class="btn btn-primary btn pull-right" id="btn" style="margin-right: 5px;
 ">Save</button>
            </div>
        </div>
    </div-->    
       
                        <?php }?>
                                
                                </form>
                                </div>
                               
                               
                        </div>
                    

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script>

 function dependable_unit(current_this){
      
//    $(".material_test").each(function()
//     {
      var material= $(current_this).val(); 
        //alert(material);exit();
    if(material != '')
  {
            $.ajax({
            url:"<?php echo base_url(); ?>Item_cont/fetch_unit",
            method:"POST",
            data:{material:material},
            success:function(data)
            {
           
                $(current_this).parents('.srchFlds').find('.unit_test').html(data);
                // $("#chkYes").prop("checked",false);
            }
           });
          }

    }
    $(document).ready(function() {
            //  alert(1);  
        
     $(".material_test").each(function(){
            var current_this=this;
         var material=$(this).val();
           // alert(material);
       $.ajax({
            url:"<?php echo base_url(); ?>Item_cont/fetch_unit1",
            method:"POST",
            data:{material:material},
            success:function(data)
            {
           
                $(current_this).parents('.srchFlds').find('.unit_test').html(data);
                // $("#chkYes").prop("checked",false);
                 
            }
           });
     });
       setTimeout(function(){
           fetch_value();
       },3000)    
               
               
                imager=0;
                chk=0;
                
            
     });
    function check(current_this){
     var qty=$(current_this).val();
     if(qty<0){
    
      alert('Please enter a positive quantity');
      $(current_this).parents('.srchFlds').find('.qty_test').val('1');
     }
         else if(qty==0){
        alert('Please enter a valid quantity');
       $(current_this).parents('.srchFlds').find('.qty_test').val('1');
          }
         fetch_value();  
    }
    
    function check_tax(){
     var tax=$('.tax_test').val();
     if(tax<0){
    
      alert('Please enter a positive value');
      $('.tax_test').val('');
     }
      fetch_value();   
    }

function fetch_value(nxtCount){

    if ($("#chkYes").is(":checked")) {
     
         var myarray = [];
         var myarray1 = [];
         var myarray2 = [];
  $(".material_test").each(function()
     {
      var material= $(this).val();
      //alert(material);
      if(material != "")
       myarray.push(material);
        });
         console.log(myarray); 
    $(".unit_test").each(function()
     {
      var unit= $(this).val();
        if(unit != "")
        myarray1.push(unit);
        }); 
         console.log(myarray1); 
        
    $(".qty_test").each(function()
    {
    var qty= $(this).val();
    if(qty != "")
     myarray2.push(qty);
       
       });  
         console.log(myarray2); 
       
        
        var tax= $("#tax").val();
       // alert(tax);
        var price;
        var total_price=0;
        var manual_price=0;
        var final_manual_price=0;
        for(i=0;i<myarray.length;i++){
            
            
            $.ajax({
						 url: '<?php echo base_url();?>Item_cont/calculate',
						 type: 'POST',
						 data: {'material_id' : myarray[i],'unit_id' : myarray1[i],'quantity' : myarray2[i]},
						 async: false,
						 success: function(response){
							 // $('#addMoreHtml').append(response);
							  if (response > 0)
							  {
                                  price=parseFloat(response);
                                  //console.log(price);
								   //$('#manualNumber').html('');
							  }
							  else
							  {
                                  //alert(1);
								   //$('#actionBtn_'+c).html('');
							  }
						 }
					});
            total_price=total_price+price;
            
        }
//       if(tax!="")
//        {
//            tax=parseFloat(tax);
//            total_price=total_price+tax;
//        }
       // alert(total_price);
        if(isNaN(total_price)){
            // alert("Please enter some raw material and then calculate");
             $('input[id="automatedNumber"]').val('0'); 
            
        }
        //alert(total_price);
        else{
        
        
            
        final_manual_price=parseFloat(total_price).toFixed(2);
     // alert(final_manual_price);
    $('input[id="automatedNumber"]').val(final_manual_price);     

                
    
    }
    
    
}
}





</script>
<script type="text/javascript">
     $(function () {
        $("input[name='chkPassPort']").click(function () {
            if ($("#chkNo").is(":checked")) {
                //$("#dvyesshow").show();
                 $("#automatedNumber").attr("readonly", false);
                $("#tax").attr("readonly", true);
               // $("#tax").val("");
                
                 $("#automatedNumber").val("");
               //$("#chkYes").prop("checked",false);
            }
            else{
//                $("#dvyesshow").show();
                $("#tax").attr("readonly", false);
               $("#automatedNumber").attr("readonly", true);
            //    $("#automatedNumber").val("");
////                $("#chkYes").prop("checked",false);
            }
           // $("#chkYes").prop("checked",checked);
//             if ($("#chkNo").is(":checked")) {
//            $("#dvyesshow").show();
//            $("#automatedNumber").attr("readonly", false);
//            }
//            else{
//                $("#dvyesshow").hide();
//            }
        });
    });
    
    
    
    
</script>
       
<script>
//$(document).ready(function(){
//	  addMore('add', 0);
//});
var labelValArr = []; 
function addMore(flag, count)
{
	 var hasFld = $('.srchFlds').length;
	 var prevCount = parseInt(hasFld) - 1;
	  
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
						 url: '<?php echo base_url();?>Item_cont/generateField',
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
         fetch_value();
	 }
}



               
             function validateForm(){     
            //$("#btn").click(function(){
                //alert("error");
                var v1=0;
               
                    var UnitValue=$('#item').val();
                    //var elementid=$(this).attr('id');
                    var elementlabel=$('#item').attr('label');
                    if(UnitValue.search(/\S/)==-1){
                       // alert(elementid);
                        v1++;
                        $("#name_error").html(elementlabel+" is needed");
                    }
                else{
                     $("#name_error").html("");
                } 
                $(".material_test").each(function()
                    {
                     var material=$(this).val();
                    if(material==''){
                        
                         v1++;
                    // $('#material_error').html('Plesae select an material');
                        $(this).parents('.srchFlds').find('#material_error').html('Plesae select an material');
                        
                    }
                else{
                     $(this).parents('.srchFlds').find('#material_error').html("");
                    }
                });
               
                $(".unit_test").each(function()
                    {
                    var unit=$(this).val();
                if(unit==''){
                     v1++;
                     //$('#unit_error').html('Plesae select an unit');
                    $(this).parents('.srchFlds').find('#unit_error').html('Plesae select an unit');
                       
                    }
                else{
                     $(this).parents('.srchFlds').find('#unit_error').html("");
                    }
                });
               
                $(".qty_test").each(function()
                    {
                    var qty=$(this).val();
                if(qty==''){
                     v1++;
                     //$('#qty_error').html('Plesae select an quantity');
                    $(this).parents('.srchFlds').find('#qty_error').html('Plesae select an quantity');
                    }
                else{
                      $(this).parents('.srchFlds').find('#qty_error').html("");
                    }
                   });              
                
                if($('input[type=radio][name=chkPassPort]:checked').length == 0)
                      {
                        $("#price_error").html("Please select a mode of price");
                         return false;
                      }
                      else
                      {
                           $("#price_error").html("");
                      }   
                
                
        if(v1==0 && chk==0){
            $('#name_error').text(" ");
                 //$("#updt").submit();
            return true;

             }
            else{
//$('#name_error').text("Item name exists");
                return false;
           }
                

        
        //});
   // });
            
            
 
           
           function check_if_exists() {

                var itemname = $("#item").val();

                $.ajax(
                    {
                        type:"post",
                        async:"true",
                        url: "<?php echo base_url(); ?>item_cont/item_exists",
                        data:{ itemname:itemname},
                        success:function(response)
                        {
                            console.log(response);
                            if (response != 0 || response != '0'  ) 
                            { 
                                //alert('kkk');
                                 chk++;
                                $('#name_error').text("Item name exists");
                                //$('#btn').prop('disabled',true);
                            }
                            else 
                            {
                                //alert('kk');
                                chk=0;
                                $('#name_error').text(" ");
                               
                                
                            }  
                        }
                    });
            
           }
     </script>   




<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/css/bootstrap-select.min.css">
   
                

            
            