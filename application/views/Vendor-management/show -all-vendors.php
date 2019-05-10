33


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



</style>
<section id="main-content">
        <section class="wrapper">
            
<div class="row">
    
    <?php
            if($this->session->userdata('err_msg') !='')
            {
                ?>
                <button type="button" class="btn btn-primary btn pull-right " onclick="addNewForm('');" >Add new Vendor</button>
                <div class="alert alert-danger message">
                  <center><strong>Sorry! </strong><?php echo $this->session->userdata('err_msg'); ?><span id="err_msg" class=""></span></center>
                </div>
                <?php
                 $this->session->unset_userdata('err_msg');
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
           <div class="col-sm-12">
       <!-- page start-->
               
               <section class="panel">
                   <header class="panel-heading" id="header">
                    
                       
                   </header>
                   <div class="panel-body">
                    
                       <div id="addForm"></div>
    
                   </div>
                
             </section>
               
    </div>

<div class="col-sm-12">
     
    
               <section class="panel">
                   <header class="panel-heading">
                       Vendor Details
                       
                   </header>
<!--                    <button type="button" class="btn btn-primary btn pull-right " onclick="addNewForm('');" >Add new Vendor</button>-->
                   <div class="panel-body">
                       <div class="adv-table">
                       
                   <table  class="display table table-bordered table-striped" id="dynamic-table">
                   <thead>
                   <tr>
                                   
                                    <th class="numeric">Vendor Id</th>
                                    <th class="numeric">Name</th>
                                    
                                    <th class="numeric">Material</th>
                                       <th class="numeric">Status</th>
                                    <th class="numeric">Action</th>
                                    
                                    
                                    
                                </tr>
                                </thead>
                                <tbody>
                                    <?php  
                               
          if(count($listing)>0){
             //echo"<pre>";
             // print_r($listing);
         foreach ($listing['result'] as $row)  
         { 
             
             
             $rawmaterial=array();
            
             $data=$this->Common_model->find_in_set('RawMaterial',$row->id);
             if($data['num_row']>0)
             {
                    
                    foreach($data['result'] as $raw)
                    {
                      array_push($rawmaterial,ucfirst($raw->material_name));
                     
                    }
                $rawmaterial = implode(",",$rawmaterial); 
             }
             else
             {
                 $rawmaterial="";
             }
             

            ?>
                <tr> 
                <td><?php echo $row->id;?></td> 
                <td><?php echo ucfirst($row->name);?></td> 
                
                <td><?php echo $rawmaterial;?>
                
                
                    <button type="button" class="btn btn-primary" onclick="call_modal('<?php echo $row->id;?>')" style="float: right;" >+</button></td>
                    
<!--                    modal-->
                     <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog" id="modal_response">
                  
              </div>
          </div>

                    
                    
                    
                    
                <td>    
                 <?php
           
                if($row->status == 1)
                {
                ?>
                <span style="cursor:pointer;float:center" title="Active Review" onclick="changeStatus('<?php echo  $row->id;?>', 0);">Active
                   <i class="fa fa-check-circle"></i>
                </span>
                <?php
                } 
                else
                {
                ?>
                <span style="cursor:pointer;float:center" title="Inactive Review" onclick="changeStatus('<?php echo  $row->id;?>', 1);">Inactive
                  <i class="fa fa-ban"></i>
                </span>
                <?php
                }
                ?>    
                    </td>
                      
                             
                   
            
                    
            
                    
                    
                    
          <td>
              
                <a href='<?php echo base_url(); ?>Billingmanagement/showbill/<?php echo $row->id;?>' ><i class="fa fa-money"></i></a>
             
               
                  <i class="fa fa-trash-o" aria-hidden="true" onclick="del('<?php echo  $row->id;?>')"></i>  
              
              <i class="fa fa-edit" onclick="addNewForm('<?php echo $row->id ;?>')"></i>
             </td>   
       
                        
            </tr> 
        <?php }
          }
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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    addNewForm('');
});
    
    
    
    
  function addNewForm(id)
     {
          if(id=="")
          var text="Add Vendor";
         else
          var text="Edit Vendor";
         
          $.ajax({
                    url:"<?php echo base_url();?>Vendormanagement/addForm",   
                    data:{id:id},
                    type:"POST",            
                    dataType:"text",
                    async: false,
                    success:function(response)
                    {   
                        $('#addForm').html(response);
                         $('#header').html(text);
                          window.scrollTo(500, 0);

                    }
                                                 
                                      
                                        
                });
     }
        
    
function changeStatus(id,status)
{
    
    var confirmstatus=confirm('Are you sure you want to change status');
    if(confirmstatus)
    {
        location.href="<?php echo base_url(); ?>Vendormanagement/profile?id="+id+"&m=s&status="+status;
    }
}
    
    
function del(id)
{
    
    var del=confirm('Are you sure you want to delete');
    if(del)
    {
        location.href="<?php echo base_url(); ?>Vendormanagement/profile?id="+id+"&m=d";
    }
}
    
 
function checkbox()  
    {  
           
                    
                     $('#checkbox').submit(); 
            
    
}
    
    
    
function call_modal(vendor_id)  
    {  
        
        
        $.ajax({
                    url:"<?php echo base_url();?>Vendormanagement/show_material",   
                    data:{vendor_id:vendor_id},
                    type:"POST",            
                    dataType:"text",
                    async: false,
                    success:function(response)
                    {    
                         $("#myModal").modal('show');
                        $("#modal_response").html(response); 
                        
                    }
                                                 
                                      
                                        
                });
            
          
         
           
    
}
    
    

        function validateForm(){


		       		 var v1=0;
		        	$(".test").each(function()
		       		 {
			        	var elementvalue= $(this).val();
			       		var elementid=$(this).attr('id');
			        	var elementlabel=$(this).attr('label');
			       		if(elementvalue.search(/\S/) ==-1)
			       		 {
                             if(elementid=="name"||elementid=="phoneno")
                            {
			        		
			        		$("#"+ elementid+"_error").html(elementlabel+" is needed");
							v1++;
                            }
			        	
			        		
			        	

			        	}
                        
                        else if(elementid=="email")
			        	{
				        	var pattern=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
				        	if(!pattern.test(elementvalue)){ 

				        		$("#"+ elementid+"_error").html("Correct email is needed");
				        		v1++;
				        	}
				        	
						}
                        
                        else if(elementid=="phoneno")
			        	{
				        	var pattern=/^[0-9]+$/;
				        	
				        	
				        	if(!pattern.test(elementvalue) || (elementvalue.length!=10) )
				        	{ 

				        		$("#phoneno_error").html("Correct phonenumber is needed");
				        		v1++;
				        	}

				        	else 
								{
									$("#phoneno_error").html("");
								}



						} 
                        
                        
                        
                        
                        
                        
                        
                       	else 
								{
									$("#"+ elementid+"_error").html("");
								}
                        


		        });
		        	

		        	



		        	


		        	



					return (v1 === 0)?true:false;


		        	// alert(v1);
		        	// if(v1===0){
		        	// 	$("#myform").submit();
		        	// }


		        

}
    
function searchValues()
{
   var search=$('#search').val(); 
   var search= search.charAt(0).toUpperCase() + search.slice(1);
   $('.underLine > .line').each(function(){
            
            var currentLiText = $(this).text();
          var showCurrentLi = currentLiText.indexOf(search) !== -1;
         $(this).toggle(showCurrentLi); 
             
            
        });     
     
    
}

  
    
    </script>