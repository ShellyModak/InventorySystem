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

      <form class="form-signin" action="<?php echo base_url();?>Login/user_login" method="post" id="login">
        <h2 class="form-signin-heading">Admin sign in</h2>
        <div class="login-wrap">
            <div class="user-login-info">
                <input type="text" class="form-control test" placeholder="Store Name" name="storename" id="storename" label="storename" value="<?php if ($this->input->cookie('storename')) { echo $this->input->cookie('storename'); } ?>"  autofocus>
                
                <input type="password" class="form-control test" placeholder="Password" name="psw" id="psw" label="Password" value="<?php if ($this->input->cookie('psw')) { echo $this->input->cookie('psw'); } ?>" >
            </div>
            <label class="checkbox">
                <input type="checkbox"  name="remember_me" id="remember_me" value= "1" <?php if($this->input->cookie('remember_me')){?> checked <?php } ?>> Remember me
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
                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                          <button class="btn btn-success" type="button">Submit</button>
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
