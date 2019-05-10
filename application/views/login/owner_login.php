<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="<?php echo IMGURL?>assets/images/favicon.png">

    <title>Login</title>

    <!--Core CSS -->
    <link href="<?php echo IMGURL?>assets/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo IMGURL?>assets/css/bootstrap-reset.css" rel="stylesheet">
    <link href="<?php echo IMGURL?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="<?php echo IMGURL?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo IMGURL?>assets/css/style-responsive.css" rel="stylesheet" />

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body">
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
           
            ?>
    <div class="container">

      <form class="form-signin" action="<?php echo base_url();?>Owner/user_login" method="post" id="login">
        <h2 class="form-signin-heading">Owner sign in</h2>
        <div class="login-wrap">
            <div class="user-login-info">
                
                 
                
                
                <input type="text" class="form-control test" placeholder="Email" name="email" id="email" value="<?php if ($this->input->cookie('mail')) { echo $this->input->cookie("mail");}?>"  label="Email" >
                
               
                
                <input type="password" class="form-control test" placeholder="Password" name="psw" id="psw" label="Password" value="<?php if ($this->input->cookie('pswd')) { echo $this->input->cookie("pswd");}?>" >
            </div>
            
            <label class="checkbox">
                <input type="checkbox"  name="remember_me" id="remember_me" value= "1" <?php if ($this->input->cookie('remember_mew')) {?> checked <?php }?>> Remember me
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit" id="btn">Sign in</button>


        </div>
 </form>
          <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Forgot Password ?</h4>
                      </div>
                      <div class="modal-body">
                          <p>Enter your e-mail address below to reset your password.</p>
                           <input type="text" name="Email" onblur="email_check();" placeholder="Email" autocomplete="off" id="emailvalidation"  class="form-control placeholder-no-fix">
                        <span id="emailvalidation_error" style="color:red"></span><br>

                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" onclick="location.href='<?php echo base_url(); ?>Login/index'" type="button">Cancel</button>
                          <button id="btn_mod" class="btn btn-success" type="button" onclick="validateEmail();">Submit</button>
                      </div>
                  </div>
              </div>
          </div>
          <!-- modal -->

     

    </div>



    <!-- Placed js at the end of the document so the pages load faster -->

    <!--Core js-->
    <script src="<?php echo IMGURL?>assets/js/jquery.js"></script>
    <script src="<?php echo IMGURL?>assets/bs3/js/bootstrap.min.js"></script>

  </body>
</html>

<script>
	
	
	
	
	
	

    /*function validateEmail(){
			        	{
				        	var pattern= /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
                            var elementvalue=($('#emailvalidation').val());
									if(elementvalue==''){
										$("#emailvalidation_error").html("This Field Cannot be blank");
									}
								
										
									else if(!pattern.test(elementvalue)){
									$("#emailvalidation_error").html("Email pattern does not match");
								  }	
									
									else{
										$("#emailvalidation_error").html("");
                                     $.ajax({
                                            url:"<?php echo base_url();?>Login/email_validate",   
                                            data:{                  
                                                email:elementvalue
                                            },
                                            type:"POST",            
                                            dataType:"text",
                                            async: false,
                                            success:function(data)
                                            {
												//alert(data);
                                                if(data==1)
                                                {
													 //$("#emailvalidation_error").html("we have sent a mail for you");
                                                    alert("we have send a mail for you");
												 window.location.href="<?php echo base_url();?>Login/index";
												 //$('#btn_mod').prop('disabled',true);
                                                    $("#emailvalidation_error").html("");
                                                    
                                                }
                                                  else{
                                                       $("#emailvalidation_error").html("You have entered wrong email");
                                                  }     
                                                  
                                             }
                                                 
                                      
                                        
                                        });
						   }         
								       
								/*}
								}*/
						//}    
  }
</script>