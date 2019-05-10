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
                   <th class="numeric">Super Admin Name</th>
				   <th class="numeric">Store Name</th>
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
				//echo '<pre>';print_r($row);die;
			if($row->Name!=''){
			 ?>
			 <tr> 
			 <td><?php echo ucfirst($row->Name);?></td> 
			  <td><?php
				 if($row->storeId!=''){
				 $where=array('storeId'=>$row->storeId);
				 $storeName=$this->Common_model->getAllDataWithMultipleWhere('store',$where,'id');
				 //echo "<pre>";print_r($storeName);die;
					 echo ucfirst($storeName['result'][0]->name);
				 }
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

    $(document).ready(function(){
	
     addNewForm('');
}); 
function addNewForm(id)
{
          $.ajax({
                    url:"<?php echo base_url();?>SuperAdmin_cont/addsuperAdmin",   
                    data:{id:id},
                    type:"POST",            
                    dataType:"text",
                    async: false,
                    success:function(response)
                    {   
                        $('#content').html(response);
			   $('#header').html("Add Super Admin");
		      }
                                                 
                });
}

function editStore(id)
{
	//alert(id);
	 $.ajax({
                    url:"<?php echo base_url();?>SuperAdmin_cont/edit_superAdmin",   
                    data:{id:id},
                    type:"POST",            
                    dataType:"text",
                    async: false,
                    success:function(response)
                    {
				//$('#content').html("HI");
                        $('#content').html(response);
			   $('#password').hide();
			    window.scrollTo(500, 0);
                          //$('#header').html("Edit Super Admin");
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
</script>
