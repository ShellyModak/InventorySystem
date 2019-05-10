 <section id="main-content">
        <section class="wrapper">
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
           <div class="col-lg-12">
       <!-- page start-->
                  
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
    
    
    
    
    </div>
<!-- new section-->
<div class="col-lg-12">
       <!-- page start-->
       
                  <section class="panel">
                   <header class="panel-heading">
                       Store Details
                       <span class="tools pull-right">
                           <a href="javascript:;" class="fa fa-chevron-down"></a>
                           <a href="javascript:;" class="fa fa-cog"></a>
                           <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                   </header>
                   <div class="panel-body">
                   <div class="adv-table">
                       
                   <table  class="display table table-bordered table-striped" id="dynamic-table">
                   <thead>
                   <tr>
                   <th class="numeric">Store Name</th>
				   <th class="numeric">Phone</th>
				   <th class="numeric">Store Id</th>
				   <th class="numeric">Address</th>
				    <th class="numeric">Option</th>
                                    
                 </tr>
                </thead>
                <tbody>
                                   
                                    <?php  
                                   //echo "<pre>";print_r($details);die;
                                    
			 if($details['num_row']>0){
			    foreach ($details['result'] as $row)  
			   {
				
			if($row->storeId!=''){
			 ?>
			 <tr> 
			 <td><?php echo ucfirst($row->name);?></td> 
			  <td><?php
				 if($row->phoneNumber!='')
					 echo ucfirst($row->phoneNumber);
				else
					echo "NA";?></td>
			  <td><?php echo $row->storeId?></td>
			  
				 <td><?php
					if($row->address!='')
						 echo ucfirst($row->address);
					else
						echo "NA";?>
				</td>
				
          
                    
                    
                    <td>
                     <i class="fa fa-edit" aria-hidden="true" style= "cursor:pointer" onclick="editStore('<?php echo $row->id;?>');"></i>
                     <i class="fa fa-trash-o" aria-hidden="true" style= "cursor:pointer" onclick="deleteStore('<?php echo $row->id;?>');"></i>
                    </td>
         </tr> 
        <?php }
             
                           
         }
          
    }
	
                                    /*else{
                                       // echo "1";
                                    //$var="confirm";
                                 echo "<script>alert('Please add customer first');
                                location.href='".base_url()."Customer_cont';
                                    
                                 </script>";
                                        
                                        
                                    }*/
         ?>
                            
                                </tbody>
                   <tfoot>
                   </tfoot>
                   </table>
                       
                   </div>
                   </div>
                
             </section>
       
       
       
       
       
       
       
               
           
    </div>
</div>
    </section>
</section>
 
 
           

            
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
	var emailArry= [];
	var manupulate=0;
    $(document).ready(function(){
	
     addNewForm('');
     
    

}); 
     function addNewForm(id)
     {
          $.ajax({
                    url:"<?php echo base_url();?>Owner_store/addstore",   
                    data:{id:id},
                    type:"POST",            
                    dataType:"text",
                    async: false,
                    success:function(response)
                    {   
                        $('#content').html(response);
			   $('#header').html("Add Store");
			   addMore('add', 0);
		      }
                                                 
                });
     }
     
var labelValArr = [];
function addMore(flag, count)
{
	 emailArry= [];v1=0;
	var pat=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
	for(i=1;i<=count;i++)
	{
		var email=$(".email"+i).val();
		if((pat.test(email)) && (email!=="") )
		{
			 emailArry.push(email);
		}
		else
		{
		
			 $("#super_admin_email"+count+"_error").html("Email is not correct");
			 v1++;
		}
	
	 
	}
	//alert(emailArry);
	
	if(flag=="add" && manupulate==0)
	{	
			
		$(".test1").each(function()
		{
		      var elementvalue= $(this).val();
		      //alert(elementvalue);
		      var elementid=$(this).attr('id');
		      //alert(elementid);
		      var elementlabel=$(this).attr('label');
		    
			if(elementlabel!="super_admin_email")
			{
				     if(elementvalue.search(/\S/) ==-1)
					{
					  
					   $("#"+elementid+"_error").html(elementlabel+" is needed");
					   v1++;
					  //alert('needed');
				     
				      
					}
				    else
					{
					   $("#"+elementid+"_error").html("");	
					}
			}		
			
		});
		     
	}
	
	
	
	
	
	
        var hasFld = $('.srchFlds').length;
	
        var prevCount = parseInt(hasFld) - 1;
	 //alert(prevCount);
        $('#addMoreHtml_error').html('');
        if (flag == 'add' && v1==0 && manupulate==0)
        {
	  /*var prevFld_label = $('#fld_label'+prevCount).val();
	  var fld_label = $('#fld_label'+count).val();
	  var fld_type = $('#fld_type'+count).val();*/
	   $.ajax({
		url: '<?php echo base_url();?>Owner_store/generateField',
		type: 'POST',
		data: {'count' : count},
		async: false,
		success: function(response){
			        $('#addMoreHtml').append(response);
			        if (hasFld > 1)
			        {
					$('#actionBtn_'+count+' input:nth-child(1)').remove();
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
		manupulate=0;
			if (hasFld == count || hasFld == 2)
			{
			    var actnHtml = '<input type="button" class="btn btn-success" value="+" onclick="addMore(\'add\', \''+prevCount+'\');">&nbsp;';
			    $('#actionBtn_'+prevCount).prepend(actnHtml);
                     }
			
			$('#addMoreHtml_error').html('');
			$('#div_'+count).remove();
	  }
}

function checkEmail(count)
{
	$('#super_admin_email'+count+'_error').html('');
	var count=count;
	var arrayLength=emailArry.length;
	arrayLength=arrayLength+1;
	if(manupulate==1)
	{
		//alert(manupulate+"manupulate");
		// alert(arrayLength+"length");
		for(i=1;i<=arrayLength;i++)
		{
			//alert(i+"i");
			var email=$(".email"+i).val();
			//alert(email+"email");
			if(emailArry.includes(email))
			{
				
				var index=emailArry.indexOf(email);
				index=index+1;
				//alert(index+"index"+i+"i");
				if(index!=i)
				manupulate=1;
				
			}
			else
			manupulate=0;
		}
	}
	else
	manupulate=0;
		
		
		
		var storeId=$('#storeId').val();
		//alert(storeId);
		//alert(email);
		var email=$(".email"+count).val();
		var pat=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
		if (typeof storeId !== 'undefined')
		{
			//manupulate=0;
			if(storeId!='')
			{
			              //alert(count+"before ajax");	
					$.ajax({
						
					  type:'post',
					  url: '<?php echo base_url();?>Owner_store/email_check',
					  data: { email:email,
						   storeId:storeId},
						   
					  success: function (response){
					  //alert(count);
					  if (response>0){
						//alert(count);
						manupulate=1;
					   $('#super_admin_email'+count+'_error').html('Email already exist');
					   // $('#btn').prop('disabled',true);
					   }else{
						
						// $(".riyaerror").html("");
						//$('#btn').prop('disabled',false);
					  }
					 }
					});
			}
		}
	   if(email!="" && (pat.test(email) ))
		{
			//alert("hiii");
			//manupulate=0;
			if(emailArry.includes(email))
			{
				var index=emailArry.indexOf(email);
				index=index+1;
				if(index!=count)
				{
					manupulate=1;
					//alert(manupulate);
					$('#super_admin_email'+count+'_error').html('You have already chosen this item');
					    //$('#btn').prop('disabled',true);
				}else{
					//alert(manupulate);
				    $('#super_admin_email'+count+'_error').html('');
				     //$('#btn').prop('disabled',false);
				}
			}
			else
			{
				//alert(manupulate);
				nxtcount=count-1;
				emailArry[nxtcount] =email;
				//$('#btn').prop('disabled',false);
			}
			
		}
		else
		{
			$('#super_admin_email'+count+'_error').html('Enter valid email');	
		}
	}

     
     function editStore(id)
     {
	//alert(id);
	 $.ajax({
                    url:"<?php echo base_url();?>Owner_store/edit_store",   
                    data:{id:id},
                    type:"POST",            
                    dataType:"text",
                    async: false,
                    success:function(response)
                    {   
                        $('#content').html(response);
			    window.scrollTo(500, 0);
                          $('#header').html("Edit Store");
			     addMore('add', 0);
                    }
                                                 
                });
	 
     }
     
     function deleteStore(id)
     {
	//alert(id);
	var del=confirm('Are you sure you want to delete');
	if(del)
	{
		 location.href="<?php echo base_url(); ?>Owner_store/delete_store/"+id;
	 }
	 
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
                                $('#phoneno_error').text("customer exists");
                                $('#btn').prop('disabled',true);
                            }
                            else 
                            {
                                $('#phoneno_error').text(" ");
                               $('#btn').prop('disabled',false);
                                
                            }  
                        }
                    });
            
           }
	   
	   
function validate_frm(){
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
		$('#phoneno_error').html('Mobile number is needed');
		 error++;
	}
	 if(phoneno!=''){
         if(phoneno.length!=10){
            $('#phoneno_error').html('Please insert a 10 digit mobile number');
            error++;
         }
        }
	
	if(error==0  && manupulate==0){
		alert('Hi');
            $('#updt').submit();
         }
}



       
    </script>
   <!--main content end-->