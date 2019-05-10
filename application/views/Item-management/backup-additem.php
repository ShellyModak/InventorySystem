
<section id="main-content">
        <section class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Add New item
                            <button type="button" class="btn btn-primary btn pull-right" onclick="location.href='<?php echo base_url(); ?>Item_cont/index'">Back</button></header>
         
                       
                        
                        
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form"  action="<?php echo base_url(); ?>Item_cont/insertItem" method="post" id="updt" enctype="multipart/form-data">
                                <div class="form-group">
                                <input type="hidden" name="mode" value="updateDetails">
                                    <label class="control-label">Enter item Name</label>    
                                    <input  type="text"  placeholder="Item Name" class="form-control test" name="itemname" id="item" label="Item" onblur="check_if_exists();">
                            <span id="name_error" style="color: red"></span><br>
        
                                    
        
    
        <label class="control-label">Enter Raw Material</label>        
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
              <label class="control-label">Material</label>
            <select name="fld_label1[]" class=" form-control material_test"  id="fld_label<?php echo $nxtCount;?>" label="Unit" >
            <option value="" >Select</option>
         <?php 
                foreach($material['result'] as $row): 
                if($row->status != 2){ ?>
              <option value="<?php echo $row->material_id?>"><?php echo $row->material_name?></option> 
         <?php  }     
            endforeach;?>
               
                  </select>
                  <span id="unit_error" style="color: red"></span><br>
              </div>
              <div class="col-lg-3">
              <label class="control-label">Unit</label>
            <select name="fld_label2[]" class=" form-control unit_test"  id="fld_label<?php echo $nxtCount;?>" label="Unit" >
            <option value="" >Select</option>
         <?php 
                foreach($unit['result'] as $row): 
                 if($row->status != 2){ ?>
              <option value="<?php echo $row->unit_id?>"><?php echo $row->unit_name?></option> 
         <?php   }    
            endforeach;?>
               
                  </select>
                  <span id="unit_error" style="color: red"></span><br>
              </div>
              
              <div class="col-lg-3">
                   <label>Quantity <span style="color: red;">*</span>:</label>
                   <input  type="number"class="form-control qty_test" id="fld_label<?php echo $nxtCount;?>" name="fld_label3[]" label="Field Label" >
               </div>
               
               <?php
               //if($productSeacrhOptionArr['num_row'] == $nxtCount)
               //{
               ?>
               <div class="col-lg-2" style="margin-top: 3.0%;" id="actionBtn_<?php echo $nxtCount;?>">
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
          </div>
                <label class="control-label">Enter Tax</label>    
                 <input  type="text"  placeholder="Tax" class="form-control test" name="tax" id="tax" label="tax" onblur="check_if_exists();">
                <span id="tax_error" style="color: red"></span><br>
                                    
                        <label class="control-label">Mode of price</label>            
                        <label for="chkYes">
                            <input type="radio" id="chkYes" name="chkPassPort" value=1 onchange="fetch_value('<?php echo $nxtCount;?>');"/>
                                Automated
                        </label>
                        <label for="chkNo">
                            <input type="radio" id="chkNo" name="chkPassPort" value=0 >
                                Manual
                        </label>
                            <hr />
                <div id="dvyesshow" style="display: none">
                        <label class="control-label">Automated price</label> 
                <input type="text" class="form-control" id="automatedNumber" name="automatedNumber1" readonly/>
                </div>
                <div id="dvnoshow" style="display: none">
                       <label class="control-label">Manual price</label> 
                <input type="text" class="form-control " id="manualNumber" name="automatedNumber" />
                </div>
                
               
                                           
                    <label class="control-label">Status</label>
               <select class="form-control " id="status" name="status" label="status"   data-max-options="1">
                    <option value="1" >Active</option>
                   <option value="0">Inactive</option>
                   </select>
                      <span id="status_error" style="color: red"></span><br>
        
                                    <center> <button type="submit" class="btn btn-primary" id="btn">Save</button></center>                  
       
                        
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


function fetch_value(nxtCount){

    if ($("#chkYes").is(":checked")) {
     
         var myarray = [];
         var myarray1 = [];
         var myarray2 = [];
  $(".material_test").each(function()
     {
      var material= $(this).val();
      //alert(material);
       myarray.push(material);
        });
         console.log(myarray); 
    $(".unit_test").each(function()
     {
      var unit= $(this).val();
        myarray1.push(unit);
        }); 
         console.log(myarray1); 
        
    $(".qty_test").each(function()
    {
    var qty= $(this).val();
    
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
        manual_price=total_price+parseFloat(tax);
        final_manual_price=manual_price.toFixed(2);
      //alert(final_manual_price);
        $('input[id="automatedNumber"]').val(final_manual_price);    

                
    
    }
    
    
}





</script>
<script type="text/javascript">
    $(function () {
        $("input[name='chkPassPort']").click(function () {
            if ($("#chkYes").is(":checked")) {
                $("#dvyesshow").show();
            }
            else{
                $("#dvyesshow").hide();
            }
            if ($("#chkNo").is(":checked")) {
                $("#dvnoshow").show();
            }
            else{
                $("#dvnoshow").hide();
            }
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
	 }
}

//function validate_frm()
//{
//    var has_error=0;
//	$('.need').each(function(){
//        element_id = $(this).attr('id');
//        element_value = $(this).val();
//        element_label = $(this).attr('label');
//        error_div = $("#"+element_id+"_error");
//        //alert(element_id);
//        if (element_value.search(/\S/)==-1)
//        {
//          has_error++;
//          error_div.html(element_label+' is required.');
//		 // alert(element_id);
//        }
//        else
//        {
//            error_div.html('');
//        }
//    });
//    if (has_error>0)
//    {
//       return false;
//	   //alert('error');
//    }
//    else
//    {
//		$('#overlay_main').show();
//		$('#loading_img').show();
//		//alert('not error');
//        document.subcat_frm.submit();
//    }
//}

function go_reset()
{
    window.location.href="<?php echo base_url();?>index.php/Subcategory_cont/add_categories";
}	  
</script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/css/bootstrap-select.min.css">
   
                <?php              

            
            