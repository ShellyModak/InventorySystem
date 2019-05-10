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
		
		 //$test=round($data/$row);
  //echo $test;die;
  //echo $row;die;
  //echo $percentage1;echo "<br>";
  //echo $percentage2;die;
  //echo $last_row1;echo "<br>";
 // echo $last_row2;die;
  //echo $row1;echo "<br>";
 // echo $row2;die;
  //echo $mod1;echo "<br>";
  //echo $mod2;die;
  if($percentage1>$percentage2){
	$row=$row1;
  }else{
	$row=$row2;
  }
		//echo $row;die;
?>
					
					
							
							<?php $id=$this->input->post('id');
        $whereArrayLogin = array('id'=>$id);
    $data=$this->Common_model->getAllDataWithMultipleWhere('Admin',$whereArrayLogin,'id');
//echo "<pre>";print_r($data);die;
        ?>
         <div class="panel-body">
         <div class="">
         <form role="form"  action="<?php echo base_url();?>Adminmanagement/updateSubAdmin" method="post" id="updt" enctype="multipart/form-data">
              <div class="form-group">
              <?php if(!empty($data['result'])){?>
              <input type = 'hidden' id="userid" name='id' value="<?php echo $data['result'][0]->id;?>">
              <input type="hidden" id="mode_article" name="mode_article" value="update_article"/>
																		<div class="row">
                      <div class="form-group col-lg-4">
                            <label class="control-label">Sub Admin Name<span style="color: red;">*</span></label> 
                             <input  type="text" style="color: black" placeholder="Sub Admin Name" value="<?php echo $data['result'][0]->Name; ?>"class="form-control test" name="subadminName" id="name" label="name">
                              <span id="name_error" style="color: red"></span><br>
                      </div>
                       <div class="form-group col-lg-4">
                                <label class="control-label">Email<span style="color: red;">*</span></label> 
                                <input  type="text" style="color: black" placeholder="Email" onblur="edit_check_email()" value="<?php echo $data['result'][0]->email;?>"class="form-control test" name="subadminEmail" id="email" label="email">
                                <span id="email_error" style="color: red"></span><br>
                        </div>
						<div class="form-group col-lg-4">
                                <label class="control-label">Phone No</label>
                                <input  type="text" style="color: black" value="<?php echo $data['result'][0]->phoneno;?>" placeholder="phoneno" class="form-control test" name="phoneno" label="phoneno" id="phoneno" onkeyup="edit_checknumber()">
                                <span id="phoneno_error" style="color: red"></span><br>
                        </div>
					</div>
			 <div class="row">
                  <div class="form-group col-lg-4">
                       <label class="control-label">UserName<span style="color: red;">*</span></label> 
                        <input  type="text" style="color: black" placeholder="Username" value="<?php echo $data['result'][0]->Store_name;?>"class="form-control test" name="username" id="username" label="username" onblur="edit_check()">
                         <span id="username_error" style="color: red"></span><br>
                    </div>
                     <div class="form-group col-lg-4">
                                <label class="control-label">Password<span style="color: red;">*</span> </label> 
                                <input  type="password" style="color: black" placeholder="Password" value="<?php echo $data['result'][0]->originalPassword;?>"class="form-control test" name="password" id="password" label="password">
                                <!--span id="password_error" style="color: red"></span><br-->
							    <!--input type="button" class="btn btn-primary " id="view_pass" value="View" onclick="edit_showHidePassword()"><br><br-->
								<input type="checkbox" id="view_pass" value="View" onclick="edit_showHidePassword()">Show Password
								<!--a class="fa fa-eye icon"  aria-hidden="true" style= "cursor:pointer" id="view_pass" value="View" onclick="edit_showHidePassword();"></a-->
																												
                      </div>
							<div class="form-group col-lg-4">
                                <label class="control-label">Status</label> 
							    <select class="form-control " style="color: black" id="status" name="status" label="status"   data-max-options="1">
								 <option value="0" <?php if($data['result'][0]->status==0) echo 'selected';?>>Inactive</option>
								<option value="1" <?php if($data['result'][0]->status==1) echo 'selected';?>>Active</option></select><br>
							</div>
                </div>

                                <!-- <input  type="text"  value="<?php //echo $subadmin_data['result'][0]->status; ?>"class="form-control test" name="subadminStatus" id="status" label="Status"> -->       
        
            <!--new added-->
												
												<hr>
												
            <div class="row">
            <div class="form-group col-lg-12">
            <label class="control-label">Page Access<span style="color: red;">*</span></label> 
            <fieldset class="group">     
           <ul class="checkbox underLine">      
        <?php 
        $wherearr=array('id'=>$id);
        $value['page']=$this->Common_model->getAllDataWithMultipleWhere('Admin',$wherearr,'id');
        //echo "<pre>";print_r($value);die;
		$where=array('status'=>'1',
					'mandatory'=>0);
		//$val=$this->Common_model->getAllDataWithMultipleWhere('sidepanel',$where,'id','ASC');
        $value['management_name']=$this->Common_model->getAllDataWithMultipleWhere('sidepanel',$where,'id','ASC');
        //echo "<pre>";print_r($value['management_name']);//die;
        $userpageaccess=$value['page']['result'][0]->pageAccess;
        //print_r($userpageaccess);die;
        $userpage=explode(',',$userpageaccess);
        //print_r($userpage);die;
        foreach($value['management_name']['result'] as $val){?>
                    
           <?php if($row==5){?>
            <li class="line <?php echo 'a'?>"><input type="checkbox"  name="pageaccess[]"  value=" <?php echo $val->id?>"<?php if (in_array($val->id,$userpage)){?> checked="checked" <?php } ?>><?php echo " ".ucfirst($val->name)?></li>
												<?php } ?>
												
												<?php if($row==4){?>
            <li class="line <?php echo 'b'?>"><input type="checkbox"  name="pageaccess[]"  value=" <?php echo $val->id?>"<?php if (in_array($val->id,$userpage)){?> checked="checked" <?php } ?>><?php echo " ".ucfirst($val->name)?></li>
												<?php } ?>
												
														<?php if($row==3){?>
            <li class="line <?php echo 'c'?>"><input type="checkbox"  name="pageaccess[]"  value=" <?php echo $val->id?>"<?php if (in_array($val->id,$userpage)){?> checked="checked" <?php } ?>><?php echo " ".ucfirst($val->name)?></li>
												<?php } ?>
												
														<?php if($row==2){?>
            <li class="line <?php echo 'd'?>"><input type="checkbox"  name="pageaccess[]"  value=" <?php echo $val->id?>"<?php if (in_array($val->id,$userpage)){?> checked="checked" <?php } ?>><?php echo " ".ucfirst($val->name)?></li>
												<?php } ?>
												
														<?php if($row==1){?>
            <li class="line <?php echo 'e'?>"><input type="checkbox"  name="pageaccess[]"  value=" <?php echo $val->id?>"<?php if (in_array($val->id,$userpage)){?> checked="checked" <?php } ?>><?php echo " ".ucfirst($val->name)?></li>
												<?php } ?>
                 
                                    <?php 
                                      }
                                    ?>
               </ul>
            </fieldset>
			<span id="pageaccess_title_error" style="color: red"></span><br>
            </div>
		</div>
<!--for store name-->
<hr>
 <!--div class="row">
            <div class="form-group col-lg-12">
            <label class="control-label">Store Name<span style="color: red;">*</span></label> 
            <fieldset class="group">     
           <ul class="checkbox underLine">      
        <?php 
        /*$wherearr=array('id'=>$id);

        $value['store']=$this->Common_model->getAllDataWithMultipleWhere('Admin',$wherearr,'id');
        //echo "<pre>";print_r($value['store']);die;
		$where=array('status'=>'1');
        //$value['store_name']=$this->Common_model->fetchAllData('store','id','ASC');
		$value['store_name']=$this->Common_model->getAllDataWithMultipleWhere('store',$where,'id','ASC');
        //echo "<pre>";print_r($value['store_name']);die;
        $userstoreaccess=$value['store']['result'][0]->storeIdAccess;
        //print_r($userstoreaccess);die;
        $userstore=explode(',',$userstoreaccess);
        //print_r($userstore);die;
        foreach($value['store_name']['result'] as $val){
            //echo $val->name;die;
            ?>
                    
           <?php if($row==5){?>
            <li class="line <?php echo 'a'?>"><input type="checkbox"  name="storename[]"  value=" <?php echo $val->id?>"<?php if(in_array($val->id,$userstore)){?> checked="checked" <?php } ?>><?php echo " ".ucfirst($val->name)." ".ucfirst('('.$val->storeId.')')?>  </li>    
            <?php } ?>
            
												 <?php if($row==4){?>
            <li class="line <?php echo 'b'?>"><input type="checkbox"  name="storename[]"  value=" <?php echo $val->id?>"<?php if(in_array($val->id,$userstore)){?> checked="checked" <?php } ?>><?php echo " ".ucfirst($val->name)." ".ucfirst('('.$val->storeId.')')?>  </li>    
            <?php } ?>
												
														 <?php if($row==3){?>
            <li class="line <?php echo 'c'?>"><input type="checkbox"  name="storename[]"  value=" <?php echo $val->id?>"<?php if(in_array($val->id,$userstore)){?> checked="checked" <?php } ?>><?php echo " ".ucfirst($val->name)." ".ucfirst('('.$val->storeId.')')?>  </li>    
            <?php } ?>
												
													 <?php if($row==2){?>
            <li class="line <?php echo 'd'?>"><input type="checkbox"  name="storename[]"  value=" <?php echo $val->id?>"<?php if(in_array($val->id,$userstore)){?> checked="checked" <?php } ?>><?php echo " ".ucfirst($val->name)." ".ucfirst('('.$val->storeId.')')?>  </li>    
            <?php } ?>
												
														 <?php if($row==1){?>
            <li class="line <?php echo 'e'?>"><input type="checkbox"  name="storename[]"  value=" <?php echo $val->id?>"<?php if(in_array($val->id,$userstore)){?> checked="checked" <?php } ?>><?php echo " ".ucfirst($val->name)." ".ucfirst('('.$val->storeId.')')?>  </li>    
            <?php } ?>
                    
            
              
                                          <?php 
                                      }*/
                     ?>
                   
               </ul>
            </fieldset>
			<span id="storename_title_error" style="color: red"></span><br>
            </div>
        </div-->

                                    
        <!--end for store access-->  
                  
                  <div class="row">
            <div class="form-group">
                <div class="save_but">
                    <button type="button" class="btn btn-default btn pull-right" id="cnbtn" onclick="newform();" style="margin-left:5px">Cancel</button>
                    <button type="button" class="btn btn-primary btn pull-right" id="btn" style="margin-right: 5px;" onclick="edit_validate_frm();">Save</button>
                </div>
            </div>
        </div>   
                                   <!-- <center> <button type="submit" class="btn btn-primary" id="btn" id="btn">Save</button></center>-->                  
       
                        <?php }?>
                                    </div>
                                </form>
                                </div>
                               
                               
                        </div>