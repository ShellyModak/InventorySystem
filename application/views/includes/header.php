<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="<?php echo IMGURL?>assets/images/favicon.png">

    <title>Inventory System</title>

    <!--Core CSS -->

    <link href="<?php echo IMGURL?>assets/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo IMGURL?>assets/css/bootstrap-reset.css" rel="stylesheet">
    <link href="<?php echo IMGURL?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    
    
     

    <link rel="stylesheet" href="<?php echo IMGURL?>assets/css/jquery.steps.css?1">
    <link href="<?php echo IMGURL?>assets/js/ion.rangeSlider-1.8.2/css/ion.rangeSlider.css" rel="stylesheet" />
    <link href="<?php echo IMGURL?>assets/js/ion.rangeSlider-1.8.2/css/ion.rangeSlider.skinFlat.css" rel="stylesheet"/>

    <!--clock css-->
     <link href="<?php echo IMGURL?>assets/js/css3clock/css/style.css" rel="stylesheet">

    <!--responsive table-->
    <link href="<?php echo IMGURL?>assets/css/table-responsive.css" rel="stylesheet" />
   
    <link href="<?php echo IMGURL?>assets/js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
    <link href="<?php echo IMGURL?>assets/js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo IMGURL?>assets/js/data-tables/DT_bootstrap.css" />
     <!--iCheck-->
     <link href="<?php echo IMGURL?>assets/js/iCheck/skins/minimal/green.css" rel="stylesheet">
      <link href="<?php echo IMGURL?>assets/js/iCheck/skins/square/green.css" rel="stylesheet">
    <link href="<?php echo IMGURL?>assets/js/iCheck/skins/flat/green.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="<?php echo IMGURL?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo IMGURL?>assets/css/style-responsive.css" rel="stylesheet" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="<?php echo IMGURL?>assets/css/bootstrap-datetimepicker.css" />
</head>

<body>

<section id="container" >
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">

    <a href="<?php echo base_url();?>/Dashboard" class="logo">
        <!--img src="<?php echo IMGURL?>assets/images/logo.png" alt=""-->
		<?php
		$id= $this->session->userdata('StoreId');
		$userid=$this->session->userdata('id');
		$whereArr=array('id'=>$userid);
		$admin=$this->Common_model->getAllDataWithMultipleWhere('Admin',$whereArr,'id');
		
		//echo "<pre>";print_r($admin);die;
		$where=array('storeId'=>$id);
		$store=$this->Common_model->getAllDataWithMultipleWhere('store',$where,'id');
		echo $store['result'][0]->name."(". $store['result'][0]->storeId.")";
		echo "<br>";
		if($admin['result'][0]->isSuperAdmin==1){
			echo "(Super Admin)";
		}
		if($admin['result'][0]->isSuperAdmin==0){
			echo "(Sub Admin)";
		}
		//echo "<pre>";print_r($store);die;
		//echo $id;die;
		
		?>
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->


<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
       
        <!-- user login dropdown start-->
        <li class="dropdown">
            <?php 
                $id= $this->session->userdata('id');
                //$res=$this->NewModel->fetch_data_name_user($id,'Admin');
           $whereArr=array('id'=>$id);
        $res=$this->Common_model->getAllDataWithMultipleWhere('Admin',$whereArr,'id');
                //echo $this->db->last_query();
                //echo"<pre>";
               // print_r($res);
                ?>
            <?php foreach($res['result'] as $row1){?>
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <?php
            if($row1->image==""){ 
                              
            ?>
            <img alt="" src="<?php echo IMGURL?>assets/thumbnail_new/nullimage.png" >
 
            <?php
              }
              else{
              ?>
                <img alt="" src="<?php echo IMGURL."assets/thumbnail_new/".$row1->image; ?> ">
                <?php  
            }
            ?> 
                
                
                <span class="username"><?php echo $row1->Name; }?> </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="<?php echo base_url(); ?>Dashboard/profile"><i class=" fa fa-suitcase"></i>Profile</a></li>
               
                <li><a href="<?php echo base_url(); ?>Dashboard/Logout"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
        
    </ul>
    <!--search & user info end-->
</div>
</header>