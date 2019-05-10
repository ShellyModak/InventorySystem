<style>
	.a{
		width: 16em !important;
	}
	.b{
		width: 14em !important;
	}
	.c{
		width:12em !important;
	}
	.d{
		width: 10em !important;
	}
	.e{
		width: 8em !important;
	}
</style>
<?php //$classnew;
  $where=array('status'=>'1');
  $val=$this->Common_model->getAllDataWithMultipleWhere('sidepanel',$where,'id');
  //$val=$this->Common_model->leftpaneldata();
  $col1=6;$col2=4;
  $data=$val['num_row'];
  //echo $data;die;
  $mod1=$data%$col1;
  $mod2=$data%$col2;
  $row1=round(($data/$col1)+1);
  $row2=round(($data/$col2)+1);
  $last_row1=$col1-$mod1;
  $last_row2=$col2-$mod2;
  $percentage1=round((($last_row1/$col1)*100));
  $percentage2=round((($last_row2/$col2)*100));
  if($percentage1>$percentage2){
	$row=$row1;
  }else{
	$row=$row2;
  }
  //$test=round($data/$row);
  //echo $test;die;
  //echo $row;die;
  //echo $percentage1;echo "<br>";
  //echo $percentage2;die;
  //echo $last_row1;echo "<br>";
 // echo $last_row2;die;
  //echo $row1;echo "<br>";
 // echo $row2;die;
  /*echo $mod1;echo "<br>";
  echo $mod2;die;*/
?>
 <div class="panel-body">
     <div class="">
        <form role="form"  action="<?php echo base_url(); ?>Adminmanagement/insertdata" method="post" id="updt" enctype="multipart/form-data">
             <input type="hidden" name="mode" value="updateDetails">
			<div class="row">
                               <div class="form-group col-lg-4">
									  <label class="control-label">Sub Admin Name<span style="color: red;">*</span></label>
                                      <input  type="text" style="color: black" placeholder="Sub Admin Name" class="form-control test" name="subadminName" id="name" label="Name">
                                      <span id="name_error" style="color: red"></span><br>
                                </div>
                               <div class="form-group col-lg-4">
                                      <label class="control-label">Email<span style="color: red;">*</span></label>
                                      <input  type="text" style="color: black" placeholder="Email Address" class="form-control test" name="email" id="email_address" label="Email address" onblur="check_email(0)">
	                                  <span id="email_address_error" style="color: red"></span><br>
                                </div>
								<div class="form-group col-lg-4">
                                          <label class="control-label">Phone No</label>
                                          <input  type="text" style="color: black" placeholder="Phoneno" class="form-control test" name="phoneno" id="phoneno"  onkeyup="checknumber()" label="Phoneno">
                                          <span id="phoneno_error" style="color: red"></span><br>
                               </div>
                
                <div class="clearfix"/>

                
                            <div class="form-group col-lg-4">
                                    <label class="control-label">UserName<span style="color: red;">*</span></label>
                                     <input  type="text" style="color: black" placeholder="Username" onblur="check()" class="form-control test" name="username"  id="user_name" label="Username" autocomplete="false">
                                    <span id="user_name_error" style="color: red"></span><br>
                             </div>
                            <div class="form-group col-lg-4">
                                    <label class="control-label">Password <span style="color: red;">*</span></label>
                                    <input  type="password" style="color: black" placeholder="Password" class="form-control test" name="password" id="password" label="Password" autocomplete="false">
									<input type="checkbox" id="view_pass" value="View" onclick="edit_showHidePassword()">Show Password
                                    <span id="password_error" style="color: red"></span><br>
                             </div>
							 <div class="form-group col-lg-4">
								 <label class="control-label">Status</label>
								 <select class="form-control " style="color: black" id="status" name="status" label="Status"   data-max-options="1">
									  <option value="1">Active</option>
									   <option value="0">Inactive</option>
								</select>
							</div>
                     </div>
	  <hr>
             <!--new added-->
                    <div class="row">
                        <div class="form-group col-lg-12">
								 <label class="control-label">Page Access <span style="color: red;">*</span></label><br>
								 <fieldset class="group">     
									 <ul class="checkbox underLine">      
										 <?php
										  $id= $this->session->userdata('id');
											 $where=array('status'=>'1',
														   'mandatory'=>0);
											  $val=$this->Common_model->getAllDataWithMultipleWhere('sidepanel',$where,'id','ASC');
										 
											  //echo "<pre>";print_r($val);die;
											  if(!empty($val)){
												foreach($val['result'] as $value){ //echo "<pre>"; print_r($value);
												?>
											<?php if($row==5){?>
												<li class="line <?php echo 'a'?>"><input  type="checkbox" value="<?php echo $value->id?>" id="pageaccess_title" name="pageaccess[]" label="pageaccess_title" ><?php echo " ".ucfirst($value->name);?></li>
											<?php } ?>
											
											<?php if($row==4){?>
												<li class="line <?php echo 'b'?>"><input  type="checkbox" value="<?php echo $value->id?>" id="pageaccess_title" name="pageaccess[]" label="pageaccess_title" ><?php echo " ".ucfirst($value->name);?></li>
											<?php } ?>
											
											<?php if($row==3){?>
												<li class="line <?php echo 'c'?>"><input  type="checkbox" value="<?php echo $value->id?>" id="pageaccess_title" name="pageaccess[]" label="pageaccess_title" ><?php echo " ".ucfirst($value->name);?></li>
											<?php } ?>
											
											<?php if($row==2){?>
												<li class="line <?php echo 'd'?>"><input  type="checkbox" value="<?php echo $value->id?>" id="pageaccess_title" name="pageaccess[]" label="pageaccess_title" ><?php echo " ".ucfirst($value->name);?></li>
											<?php } ?>
											
											<?php if($row==1){?>
												<li class="line <?php echo 'e'?>"><input  type="checkbox" value="<?php echo $value->id?>" id="pageaccess_title" name="pageaccess[]" label="pageaccess_title" ><?php echo " ".ucfirst($value->name);?></li>
											<?php } ?>
										<?php   }
										       }?>
								 </ul>
                                </fieldset>
								<span id="pageaccess_title_error" style="color: red"></span><br>
							</div>
<!--for store names-->
<hr>
                <!--div class="form-group col-lg-12">
                <label class="control-label">Store Access <span style="color: red;">*</span></label><br>
				<fieldset class="group">     
				<ul class="checkbox underLine">      
                <?php
				/*$where=array('status'=>'1');
				$val=$this->Common_model->getAllDataWithMultipleWhere('store',$where,'id','ASC');
				if(!empty($val)){
                foreach($val['result'] as $value){?>
				<?php if($row==5){?>
                  <li class="line <?php echo 'a'?>"><input  type="checkbox" value="<?php echo $value->id?>" id="storename_title" name="storename[]" label="storename_title"><?php echo " ".ucfirst($value->name)." ".ucfirst('('.$value->storeId.')')?> </li>
                 <?php } ?>
				
				<?php if($row==4){?>
                  <li class="line <?php echo 'b'?>"><input  type="checkbox" value="<?php echo $value->id?>" id="storename_title" name="storename[]" label="storename_title"><?php echo " ".ucfirst($value->name)." ".ucfirst('('.$value->storeId.')')?> </li>
                 <?php } ?>
				 
				 <?php if($row==3){?>
                  <li class="line <?php echo 'c'?>"><input  type="checkbox" value="<?php echo $value->id?>" id="storename_title" name="storename[]" label="storename_title"><?php echo " ".ucfirst($value->name)." ".ucfirst('('.$value->storeId.')')?> </li>
                 <?php } ?>
				 
				 <?php if($row==2){?>
                  <li class="line <?php echo 'd'?>"><input  type="checkbox" value="<?php echo $value->id?>" id="storename_title" name="storename[]" label="storename_title"><?php echo " ".ucfirst($value->name)." ".ucfirst('('.$value->storeId.')')?> </li>
                 <?php } ?>
				 
				  <?php if($row==1){?>
                  <li class="line <?php echo 'e'?>"><input  type="checkbox" value="<?php echo $value->id?>" id="storename_title" name="storename[]" label="storename_title"><?php echo " ".ucfirst($value->name)." ".ucfirst('('.$value->storeId.')')?> </li>
                 <?php } ?>
				 
                    <?php 
                }
				}*/
                ?>
                   
               </ul>
                         </fieldset>
								 
                         </div>
				<span id="storename_title_error" style="color: red"></span><br>
                    </div-->
                                

                                    
                    <!--end for store-->                  
        <div class="row">
            <div class="form-group">
                <div class="save_but">
                    <button type="button" class="btn btn-default btn pull-right" id="cnbtn" onclick="newform();" style="margin-left:5px">Cancel</button>
                    <button type="button" class="btn btn-primary btn pull-right" id="btn" style="margin-right: 5px;" onclick="validate_frm();">Save</button>
                </div>
            </div>
        </div>                             
                            <!--<center> <button type="submit" class="btn btn-primary" id="btn">Submit</button></center>-->                             
                                </form>
                                </div>
                                </div>
