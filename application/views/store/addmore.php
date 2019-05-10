<?php
//echo "<pre>";print_r($count);die;
$nxtCount = $count + 1;?>


		<div class="form-group col-lg-12 srchFlds" id="div_<?php echo $nxtCount?>">
		  <div class="form-group col-lg-3">
	          <label class="control-label">Super Admin Name<span style="color: red;">*</span></label>
              <input  type="text" style="color: black" placeholder="Super Admin Name" class="form-control test1" name="Super_admin_name[]" id="Super_admin_name<?php echo $nxtCount?>" label="Super_admin_name">
              <span id="Super_admin_name<?php echo $nxtCount?>_error" style="color: red"></span><br>
	       </div>
		 <div class="form-group col-lg-3">
	              <label class="control-label">Super Admin Email<span style="color: red;">*</span></label>
                  <input  type="text" style="color: black" placeholder="Super Admin Email" class="form-control test1 email<?php echo $nxtCount?>" name="super_admin_email[]" id="super_admin_email<?php echo $nxtCount?>" label="super_admin_email" onblur="checkEmail(<?php echo $nxtCount;?>);">
                  <span id="super_admin_email<?php echo $nxtCount?>_error" class="riyaerror" style="color: red"></span><br>
	     </div>
			 <div class="form-group col-lg-3">
	            <label class="control-label">Super Admin password<span style="color: red;">*</span></label>
                <input  type="password" style="color: black" placeholder="Super Admin Password" class="form-control test1" name="super_admin_password[]" id="super_admin_password<?php echo $nxtCount?>" label="super_admin_password">
                <span id="super_admin_password<?php echo $nxtCount?>_error" style="color: red"></span><br>
	        </div>
			 
			<div class="col-lg-2" style="margin-top: 2.5%;" id="actionBtn_<?php echo $nxtCount;?>">
			  <input type="button" class="btn btn-success" value="+" onclick="addMore('add', '<?php echo $nxtCount;?>');">
				<?php
				if($nxtCount > 1)
				{
				?>
				<input type="button" class="btn btn-default" value="-" onclick="addMore('remove', '<?php echo $nxtCount;?>');">
				<?php
				}
				?>
			</div>
	 </div>