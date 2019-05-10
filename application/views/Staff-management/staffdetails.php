
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-md-12">
             <?php if($this->session->userdata('success_msg') !=''){?>
                   <div class="alert alert-success message">
                  <strong>Success! </strong><span class=""><?php echo $this->session->userdata('success_msg'); ?></span> 
                  </div>
                  <?php
                    $this->session->unset_userdata('success_msg');
                   }?>
                <section class="panel">
                    <div id="profile" class="panel-body profile-information">
                        <div class="col-md-3">
                           <div class="profile-pic text-center">
                              <?php
                             if($staff_details['result'][0]->image==""){ 
                              
                             ?>
                              <img id="blah" src="<?php echo IMGURL?>assets/thumbnail_new/nullimage.png" alt=""/>
                             <?php
                              }
                              else{
                              ?>
                               <img src="<?php echo IMGURL?>assets/thumbnail_new/<?php echo $staff_details['result'][0]->image; ?>" alt=""/>
                               <?php  
                                }
                                ?>
                           </div>
                       </div>
                       
                       <div class="col-md-6">
                           <div class="profile-desk">
                               <h1><?php echo ucfirst($staff_details['result'][0]->staff_name); ?></h1>
                               <?php
                                  $post_id=$staff_details['result'][0]->post_id;
                                   $whereArr=array('post_id'=>$post_id);
                                  $post=$this->Common_model->getAllDataWithMultipleWhere('staff_post',$whereArr,'post_id');     ?>
                               <span class="text-muted"><?php echo $post['result'][0]->post_name; ?></span><br>
                                <div class="profile-statistics">
                                Date of Birth :  <?php echo $staff_details['result'][0]->date_of_birth; ?> <br>
                                Address :  <?php echo $staff_details['result'][0]->address; ?> <br>
                                
                               </div>
                               
                                <!--button type="submit" class="btn btn-primary" id="btn" onclick="editForm('<?php //echo $listing['result'][0]->id;?>');">Edit Profile</button-->
                           </div>
                       </div>
                       <div class="col-md-3">
                           <div class="profile-statistics">
                             <h1><?php echo $staff_details['result'][0]->salary; ?></h1>
                               <p>Salary</p>
                               <h1><?php echo $staff_details['result'][0]->date_of_joining; ?></h1>
                               <p>Date Of Joining</p>
                               <ul>
                                   <li>
                                       <a href="#">
                                           <i class="fa fa-facebook"></i>
                                       </a>
                                   </li>
                                   <li class="active">
                                       <a href="#">
                                           <i class="fa fa-twitter"></i>
                                       </a>
                                   </li>
                                   <li>
                                       <a href="#">
                                           <i class="fa fa-google-plus"></i>
                                       </a>
                                   </li>
                               </ul>
                           </div>
                       </div>
                    </div>
                </section>
            </div>
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading tab-bg-dark-navy-blue">
                        <ul class="nav nav-tabs nav-justified ">
                            <li class="active">
                                <a data-toggle="tab" href="#overview">
                                    Job History
                                </a>
                            </li>
                            
                            
                        </ul>
                    </header>
                    <div class="panel-body">
                        <div class="tab-content tasi-tab">
                            <div id="overview" class="tab-pane active">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="recent-act">
                                         <div class="timeline-messages">
                                            <h3>Activity</h3>
                                            <?php
                                                
                                                // echo $designation['result'][0]->message;
                                                // echo $designation['result'][0]->date;
                                                $num=$activity_details['num_row'];
                                                for($i=0;$i<$num;$i++){
                                                
                                             ?>  
                                            <div class="msg-time-chat">
                                                <div class="message-body msg-in">
                                                    <span class="arrow"></span>

                                                    <div class="text">
                                                        <div class="first">
                                                             <?php echo $activity_details['result'][$i]->date; ?>
                                                        </div>
                                                        <?php
                                                            if($activity_details['result'][$i]->purpose==1){
                                                        ?>
                                                       <div class="second bg-red">
                                                        <?php
                                                         }
                                                         else{
                                                         ?>
                                                          <div class="second bg-purple">
                                                         <?php
                                                         }
                                                         ?>
                                                            <?php echo $activity_details['result'][$i]->message; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                                 }
                                                 ?>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--div id="job-history" class="tab-pane ">
                                <div class="row">
                                    <div class="col-md-12">
                                     <div class="position-center">
                                        <div class="timeline-messages">
                                            <h3> Change Password</h3>
                                             <!--form role="form" method="post" id="frm" class="form-horizontal" action="<?php //echo base_url(); ?>Dashboard/cngpassword/<?php //echo $listing['result'][0]->id; ?>">

                                           <div class="form-group">
                                            <label class="col-lg-2 control-label">Old Password</label>
                                            <div class="col-lg-6">
                                                <input type="text" id="oldpass" name="oldpass" placeholder="Old Password" id="c-name" class="form-control">
                                                <span id="oldpass_error" style="color: red"></span>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-lg-2 control-label">New Password</label>
                                            <div class="col-lg-6">
                                                <input type="text" id="newpass" name="newpass" placeholder="New Password" id="lives-in" class="form-control">
                                                <span id="newpass_error" style="color: red"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Confirm Password</label>
                                            <div class="col-lg-6">
                                                <input type="text" id="cnmpass" name="cnmpass" placeholder="Confirm Password" class="form-control">
                                                <span id="cnmpass_error" style="color: red"></span>
                                            </div>
                                        </div>
                                        <center>
                                        <div class="form-group">
       

                                        <div class="save_but">
        
         
        
                                <button type="submit" class="btn btn-primary" id="btn" onclick="validate(<?php// echo $listing['result'][0]->id;?>);" style="margin: 10px;">Save</button>
                                <button type="button" class="btn btn-default" id="cnbtn" onclick="location.href='<?php// echo base_url(); ?>Dashboard/profile'" style="margin: 10px;">Cancel</button>

                                </div>
                                </div>  </center>
                                    </form>

                                           
                                        
                                            
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div-->
                           
                           
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
        </section>
    </section>
    <!--main content end-->


</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
function editForm(id)
{ 
$.ajax({
  url:"<?php echo base_url();?>Dashboard/customer_type_edit",   
  data:{id:id},
  type:"POST",            
  dataType:"text",
  async: false,
  success:function(response)
  {   
      $('#profile').html(response);
       
       
  }
   });
   // document.frm.newedit.focus();
}


</script>
