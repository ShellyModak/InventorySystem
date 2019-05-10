
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
                             if($listing['result'][0]->image==""){ 
                              
                             ?>
                              <img id="blah" src="<?php echo IMGURL?>assets/thumbnail_new/nullimage.png" alt=""/>
                             <?php
                              }
                              else{
                              ?>
                               <img src="<?php echo IMGURL?>assets/thumbnail_new/<?php echo $listing['result'][0]->image; ?>" alt=""/>
                               <?php  
                                }
                                ?>
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="profile-desk">
                               <h1><?php echo $listing['result'][0]->Name; ?></h1>
                               <?php
                                  $deg_id=$listing['result'][0]->designation_id;
                                   $whereArr=array('id'=>$deg_id);
                                  $designation=$this->Common_model->getAllDataWithMultipleWhere('designation',$whereArr,'id');     ?>

                                    <span class="text-muted"><?php echo $designation['result'][0]->designation; ?></span><br>
                                    
                               
                                <div class="profile-statistics">
                                Email Id :  <?php echo $listing['result'][0]->email; ?> <br>
                                Phone Number :  <?php echo $listing['result'][0]->phoneno; ?> <br>
                                Address :  <?php echo $listing['result'][0]->address; ?> <br>
                                
                               </div>
                               <p><br>
                                  <?php echo $listing['result'][0]->details; ?>
                               </p>
                              
                                <button type="submit" class="btn btn-primary" id="btn" onclick="editForm('<?php echo $listing['result'][0]->id;?>');">Edit Profile</button>
                           </div>
                       </div>
                       <div class="col-md-3">
                           <div class="profile-statistics">
                             <h1><?php echo $listing['result'][0]->salary; ?></h1>
                               <p>Salary</p>
                               <h1><?php echo $listing['result'][0]->bdate; ?></h1>
                               <p>Date Of Birth</p>
                               
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
                            <li>
                                <a data-toggle="tab" href="#job-history">
                                    Change Password
                                </a>
                            </li>
                          
                            
                        </ul>
                    </header>
                    <div class="panel-body">
                        <div class="tab-content tasi-tab">
                            <div id="overview" class="tab-pane active">
                                <div class="row">
                                    <div class="col-md-8">
                                        
                                          <div class="timeline-messages">
                                            <h3>Activity</h3>
                                            <?php
                                             $uid= $this->session->userdata('id');
                                             $whereArray = array('type'=>'1','user_id'=>$uid);
                                              $designation=$this->Common_model->getAllDataWithMultipleWhere('activity',$whereArray,'id','ASC');
                                                
                                                // echo $designation['result'][0]->message;
                                                // echo $designation['result'][0]->date;
                                                $num=$designation['num_row'];
                                                for($i=0;$i<$num;$i++){
                                                
                                             ?>  
                                            <div class="msg-time-chat">
                                                <div class="message-body msg-in">
                                                    <span class="arrow"></span>

                                                    <div class="text">
                                                        <div class="first">
                                                             <?php echo $designation['result'][$i]->date; ?>
                                                        </div>
                                                        <?php
                                                            if($designation['result'][$i]->purpose==1){
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
                                                            <?php echo $designation['result'][$i]->message; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                                 }
                                                 ?>
                                        </div>
                                       <!--  <br><br>
                                        <center>
                                        <div class="btn-group">
                                    <button type="button" class="btn btn-success btn pull-right" onclick="loadmore(3);"><i class="fa fa-refresh"></i> Load More</button>
                                        </div></center> -->
                                         
                                        </div> 
                                   
                                </div>
                            </div>
                            <div id="job-history" class="tab-pane ">
                                <div class="row">
                                    <div class="col-md-12">
                                     <br><br>
                                        <div class="timeline-messages">
                                       
                                            <h3> Change Password</h3>
                                             </div><br><br>
                                             <form role="form" method="post" id="frmnew" class="form-horizontal" action="<?php echo base_url(); ?>Dashboard/cngpassword/<?php echo $listing['result'][0]->id; ?>">

                                           <div class="form-group">
                                            <label class="col-lg-2 control-label">Old Password<span style="color: red;">*</span>:</label>
                                            <div class="col-lg-6">
                                                <input type="password" id="oldpass" name="oldpass" autocomplete="off" placeholder="Old Password" id="c-name" class="form-control">
                                                <span id="oldpass_error" style="color: red"></span>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-lg-2 control-label">New Password<span style="color: red;">*</span>:</label>
                                            <div class="col-lg-6">
                                                <input type="password" id="newpass" name="newpass" autocomplete="off" placeholder="New Password" id="lives-in" label="New Password" class="form-control">
                                                <span id="newpass_error" style="color: red"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Confirm Password<span style="color: red;">*</span>:</label>
                                            <div class="col-lg-6">
                                                <input type="password" id="cnmpass" name="cnmpass" autocomplete="off" placeholder="Confirm Password" class="form-control">
                                                <span id="cnmpass_error" style="color: red"></span>
                                            </div>
                                        </div>
                                        <center>
                                        <div class="form-group">
       

                                        <div class="save_but">
        
         
                          
                                <button type="button" class="btn btn-primary" id="btn" onclick="newvalidate(<?php echo $listing['result'][0]->originalPassword; ?>);" style="margin: 10px;">Save</button>
                                <button type="button" class="btn btn-default" id="cnbtn" onclick="location.href='<?php echo base_url(); ?>Dashboard/profile'" style="margin: 10px;">Cancel</button>

                                </div>
                                </div>  </center>
                                    </form>
                                      
                                       
                                    </div>
                                </div>
                            </div>
                           
                           
                        </div>
                    </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
        </section>
    </section>
    <!--main content end-->



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
// var page=0;
// $(document).ready(function(){
    
//         loadmore(3); 
// });        
function loadmore(page1){
page=page+page1;
 
alert(page);
    $.ajax({
        url:"<?php echo base_url();?>Dashboard/loadmore",
        method:"POST",
        data:{'page':page},
        success:function(response)
        {   
          $('#overview').html(response);          
        }
      });
    }

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
      var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
      var yyyy = today.getFullYear();
      var yyyy2=yyyy-10;
      today = mm + '/' + dd + '/' + yyyy2;
        $('#datetimepicker2').datetimepicker({
          format: 'DD/MM/YYYY'
        });
       
  }
   });
   // document.frm.newedit.focus();
}
</script>

<script>
function newvalidate(pass){
               
        error_count=0;
        
        var opass=$("#oldpass").val(); 
        if(opass==""){
            $("#oldpass_error").html("Please enter your old password");
             error_count++;
        }
        else if(opass!=pass){
             $("#oldpass_error").html("Your old password does not match");
             error_count++;
        }
        else{
            $("#oldpass_error").html("");
        
        var npass=$("#newpass").val(); 
        if(npass==""){
            $("#newpass_error").html("Please enter new password");
             error_count++;
        }
        else{
            $("#newpass_error").html("");
        }
        var cpass=$("#cnmpass").val(); 
        if(cpass==""){
            $("#cnmpass_error").html("Please confirm your password");
             error_count++;
        }
        else if(npass!=cpass){
             $("#cnmpass_error").html("Confirm password does not match with new password");
             error_count++;
        }
        else{
            $("#cnmpass_error").html("");
        }
    }
  if(error_count==0){
     $('#frmnew').submit();
    }         
}


</script>
