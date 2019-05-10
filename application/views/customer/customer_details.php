<!--main content start-->

<section id="main-content">
        <section class="wrapper">
<div class="row">
           <div class="col-lg-12">
       <!-- page start-->
               <?php
            if($this->session->userdata('error_msg') !='')
            {
                ?>
                
                <div class="alert alert-danger message" id="errorMsg">
                  <center><strong>Sorry! </strong><?php echo $this->session->userdata('error_msg'); ?><span id="error_msg" class=""></span></center>
                </div>
                <?php
                 $this->session->unset_userdata('error_msg');
            }
        if($this->session->userdata('success_msg') !='')
            {
               ?>               
               <div class="alert alert-success message" id="successMsg">
                   <center><strong>Success! </strong><span class=""><?php echo $this->session->userdata('success_msg'); ?></span> </center>
                </div>
               <?php
             $this->session->unset_userdata('success_msg');
           } 
               ?>
    
    <section class="panel">
                   <header class="panel-heading" id="header">
                      
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
   <!-- <div class="container">
  <h2>Simple Collapsible</h2>
  <p>Click on the button to toggle between showing and hiding content.</p>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Simple collapsible</button>
  <div id="demo" class="collapse">
    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
  </div>
</div>  -->
         <section  id="see" class="panel">
                   <header class="panel-heading">
                    <a style="color:#45948e;">  Customer Event List For This Month </a>
                       <span class="tools pull-right">
                           <a href="javascript:;" class="fa fa-chevron-up" data-toggle="collapse" data-target="#demo"></a>
                           
                        </span>
                   </header>

                   <div class="panel-body">

                   <?php
                    if($value==1){
                      ?>
                        <div id="event"></div>
                    <?php  
                    }
                    else{
                   ?>
                    <div id="demo" class="collapse">
                       <div id="event"></div>
                    </div>
                    <?php
                  }
                  ?>
                   </div>
                
             </section>
    
    
    </div>

<!-- new section-->
<div class="col-lg-12">
       <!-- page start-->
       
                  <section class="panel">
                   <header class="panel-heading">
                       Customer Details
                       <span class="tools pull-right">
                           <a href="javascript:;" class="fa fa-chevron-down"></a>
                           
                        </span>
                   </header>

                   <div class="panel-body">
                    
                   <div class="adv-table">
                       
                   <table  class="display table table-bordered table-striped" id="dynamic-table">
                   <thead>
                   <tr>
                                  <th class="numeric">Customer Name</th>
                                  <th class="numeric">Phone</th>
                                  <th class="numeric">Customer Type</th>
                                  <th class="numeric">Date Of Birth</th>
                                  <th class="numeric">Anniversary</th>
                                  <th class="numeric">Option</th>
				
                                    
                 </tr>
                </thead>
                <tbody>
                                   
                                    <?php  
                                   // echo "<pre>";print_r($details);die;
                                    
			 if($details['num_row']>0){
			    foreach ($details['result'] as $row)  
			   {
				//echo "<pre>";print_r($row);die;
				if($row->customer_type!=0){
					 $whereArr = array('id' => $row->customer_type,
							   'status'=>1);
					  $customerType = $this->Common_model->getAllDataWithMultipleWhere('customer_type',$whereArr,'id');
				}else{
					$customerType=array('num_row'=>0);
				}
				//echo "<pre>";print_r($customerType);die;
			if($row->store_id!=''){
			 ?>
			 <tr> 
			 <td><?php echo ucfirst($row->customer_name);?></td> 
			  <td><?php
				 if($row->customer_phone!='')
					 echo ucfirst($row->customer_phone);
				else
					echo "NA";?></td>  
				 <td>
                                        <?php
                                    //echo $reviewDtls->status ;
					//if(!empty($customerType))
                                        if($customerType['num_row']>0)
                                        {
					    echo ucfirst($customerType['result'][0]->name);
					}else{
					     echo ("NA");
					}
                                        ?>
				</td>
           
          <td><?php if($row->DOB==0){echo"";}else{echo $row->DOB;}?> </td>
                    <td><?php if($row->anniversary==0){echo"";}else{echo $row->anniversary;}?> </td>
                    
                    <td>
                     <i class="fa fa-edit" aria-hidden="true" style= "cursor:pointer" onclick="editCustomer('<?php echo $row->customer_id;?>');"></i>
                     <i class="fa fa-trash-o" aria-hidden="true" style= "cursor:pointer" onclick="deleteCustomer('<?php echo $row->customer_id;?>');"></i>
		    <a   class="fa fa-eye icon"  aria-hidden="true" style= "cursor:pointer" onclick="moredetails('<?php echo $row->customer_id;?>');" target="_blank"></a>
                    </td>
		    
		
         </tr> 
        <?php }
             
                           
         }
          
    }
         ?>
                            
                                </tbody>
                   <tfoot>
                   </tfoot>
                       
                   </table>
                       <form method="post" id="import_form" enctype="multipart/form-data">
      <input type="file" name="file" id="file" required accept=".xls, .xlsx"/>
                      <br />
   <input type="submit" name="import" class="btn btn-primary btn pull-left" value="Import"/>
   </form>
                       
                   </div>
                   </div>
                
             </section>
       
       
       
       
       
       
       
               
           
    </div>
</div>
    </section>
</section>
           
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">    
    $(document).ready(function() {
      <?php $month=date('m');
            $year=date('Y');
      ?>
      // matchMonth('<?php echo $month;?>');   
      activity('<?php echo $month;?>','<?php echo $year;?>');
    });
    
    
    
     $('#import_form').on('submit', function(event){
  event.preventDefault();
  $.ajax({
   url:"<?php echo base_url(); ?>Customer_cont/import",
   method:"POST",
   data:new FormData(this),
   contentType:false,
   cache:false,
   processData:false,
   success:function(data){
    $('#file').val('');
    //load_data();
    alert(data);
 window.location.reload();
   }
  })
 });
    function open_popup(cusid,month_name,dob,flg){
     // alert("hi in popup");
      // var cusid=document.getElementById("my-selector").dataset.value;
       $.ajax({
                    url:"<?php echo base_url();?>Customer_cont/showCupon",   
                    data:{cusid:cusid,month_name:month_name,dob:dob,flg:flg},
                    type:"POST",            
                    dataType:"text",
                    async: false,
                    success:function(response)
                    {    
                         $("#myModal").modal('show');
                        $("#modal_response").html(response); 
                       // alert('hi');
                        
                    }
                                                 
                                      
                                        
                });
    }
function popupsubmit()  
    {  
    
                var error_count=0;
               // $('#frm').submit(); 
                var amount=$("#offervalue").val();   
                if(amount==""){
                    $("#offervalue_error").html("Offervalue is needed !!!");
                     error_count++;
                    
                 }
                 else if(amount<1){
                  $("#offervalue_error").html("Please enter a valid amount !!!");
                     error_count++;
                 }
                  else{
                     var amountReg = /^[0-9]+(\.[0-9]{2})?$/;
                     if(amountReg.test(amount)){
                       $("#offervalue_error").html("");
                     }
                     else{
                         $("#offervalue_error").html("Please enter a valid amount !!!");
                          error_count++;
                     } 
                  }
                if(error_count==0){
                      
                     $('#form_content').submit(); 
               }      
            
    
}
</script>            
            
<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script-->
<script>
    $(document).ready(function(){
     
     addNewForm('');
     eventnoti(1);
     setTimeout(function() {
          $('#successMsg').fadeOut('fast');
      }, 1000);
     
      setTimeout(function() {
          $('#errorMsg').fadeOut('fast');
      }, 1000);

});
    
 // function load_data(page){
    
 //       $.ajax({
 //         url:"<?php echo base_url();?>Customer_cont/event",
 //         method:"POST",
 //         data:{'page':page},
 //         success:function(response)
 //         {   
 //             $('#event').html(response);          
 //         }
 //       })
 //    }


     function addNewForm(id)
     {
          $.ajax({
                    url:"<?php echo base_url();?>Customer_cont/addForm",   
                    data:{id:id},
                    type:"POST",            
                    dataType:"text",
                    async: false,
                    success:function(response)
                    {   
                        $('#content').html(response);
			 $('#header').html("Add Customer");
			 
			var today = new Date();
                        //var today1 = new Date();
                      
                        var dd = String(today.getDate()).padStart(2, '0');
                        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                        var yyyy = today.getFullYear();
                        //var yyyy2=yyyy-10;
                        //alert(yyyy2);
                        today = mm + '/' + dd + '/' + yyyy;
                        //alert(today);

                        //today1 = mm + '/' + dd + '/' + yyyy;
                       
                        $('#datetimepicker2').datetimepicker({
                          format: 'DD/MM/YYYY',
                          maxDate: today
                        });

                        $('#datetimepicker3').datetimepicker({
                          format: 'DD/MM/YYYY',
                          maxDate: today
                        });
			
                         
                    }
                                                 
                });
     }
function eventnoti(page)
{
 
  $.ajax({
    url:"<?php echo base_url();?>Customer_cont/event",   
    
    type:"POST",
    data:{'page':page},            
    dataType:"text",
    async: false,
    success:function(response)
    {   
        $('#event').html(response);

      } 
  });                   
} 
   $(document).on('click','.page',function()
     {
       // alert('hello');
       var page=$(this).attr("id");
       // if (typeof(page2) == "undefined"){
       //   if (typeof(page) != "undefined"){
       //         page2=page;
       //   }      
       // }
       // //page2=page;
       //  var page1 = $(this).attr("data-value");
       //  // var v=$("li").hasClass("active");
       //   alert(page2+"hi");
       //   alert(page+"hello");
       //    alert(page1+"abc");
       // if(page1 == "prev") {
       //     page=page2-1;
       //     page2=page;
       // } 
       // if(page1 == "next") {
       //     page=page2++;
       //     page2=page;
       // }   
       // alert(page+'===='+page1);

       //var index=$(this).attr("id");
       // if($(this).hasClass("data")){
       //   alert('hi');
        
       // }
       //var page1=page;
       //alert(page);
       // $(this).className += " active";
        // if($(this).attr('href') == '#Next') 
        // {
        //   alert(page1);
        //   page++;
        // }
        //alert(page);
        eventnoti(page);
     });

function editCustomer(id)
{
//alert(id);
$.ajax({
            url:"<?php echo base_url();?>Customer_cont/edit_customer",   
            data:{id:id},
            type:"POST",            
            dataType:"text",
            async: false,
            success:function(response)
            {   
                $('#content').html(response);
                window.scrollTo(500, 0);
                  $('#header').html("Edit Customer");
var today = new Date();
                //var today1 = new Date();
var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();
                //var yyyy2=yyyy-10;
                //today = dd + '/' + mm + '/' + yyyy2;
today = dd + '/' + mm + '/' + yyyy;

                $('#datetimepicker1').datetimepicker({
                  format: 'DD/MM/YYYY',
                  //maxDate: today
                });
                $('#datetimepicker2').datetimepicker({
                  format: 'DD/MM/YYYY',
                  //maxDate: today
                });
                $('#datetimepicker1').data("DateTimePicker").maxDate(today);
                $('#datetimepicker2').data("DateTimePicker").maxDate(today);
            }
                                         
        });

}
     
     function deleteCustomer(id)
     {
	//alert(id);
	var del=confirm('Are you sure you want to delete');
	if(del)
	{
		 location.href="<?php echo base_url(); ?>Customer_cont/delete_customer/"+id;
	 }
	 
     }
     
     function moredetails(id){
	//location.href="<?php echo base_url(); ?>Customer_cont/more_details/"+id;
	 window.open("<?php echo base_url(); ?>Customer_cont/more_details/"+id, '_blank');
     }
     
     
 
     
     
     

    function check_if_exists() {

                var mobile = $("#mobile").val();

                $.ajax(
                    {
                        type:"post",
                        async:"true",
                        url: "<?php echo base_url(); ?>Customer_cont/customer_exists",
                        data:{ mobile:mobile},
                        success:function(response)
                        {
                            //console.log(response);
                            if (response >0 ) 
                            {
                                $('#mobile_error').text("customer exists");
                                $('#btn').prop('disabled',true);
                            }
                            else 
                            {
                                $('#mobile_error').text(" ");
                               $('#btn').prop('disabled',false);
                                
                            }  
                        }
                    });
            
           }
	   
	   
/*function validate_frm(){
	//alert('Hi');
	$('#name_error').html('');
	
	var error=0;
	 var pregmatch = /^(\s)*[A-Za-z]+((\s)?((\'|\-|\.)?([A-Za-z])+))*(\s)*$/;

	 var name=$('#customer_name').val();
	  var phoneno=$('#mobile').val();
	 if(!pregmatch.test(name)){
            $('#name_error').html('Please insert a valid name');
            error++;
         }
	 if(phoneno==''){
		$('#phoneno_error').html('please enter your mobile number');
		 error++;
	}
	 if(phoneno!=''){
         if(phoneno.length!=10){
            $('#phoneno_error').html('Please insert a 10 digit mobile number');
            error++;
         }
        }
	
	if(error==0){
            $('#updt').submit();
         }
}*/


/*function validate_frm(){
	var error=0;
	alert(error);
	$(".test").each(function(){
		//alert('Hi');
		var elementvalue= $(this).val();
		alert(elementvalue);
		var elementid=$(this).attr('id');
		alert(elementid);
	       var elementlabel=$(this).attr('label');
		alert(elementlabel);
											
	});
}*/


       
    </script>
   <!--main content end-->