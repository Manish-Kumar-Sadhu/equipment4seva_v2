<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
        <title>Equipment4Seva<?php  if($title){ echo " | ".$title;} ?></title>
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" integrity="" crossorigin="anonymous">  
    <link href="<?php echo base_url();?>assets/css/sweetalert.min.css" rel="stylesheet" integrity="" crossorigin="anonymous">  
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" >
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/selectize.css" >
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/youseelogo.css" media='screen,print'>
  
    <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>

    <style>
       .navbar
        {
            background-color: #f8f8f8;
            border:1px solid #e7e7e7;
        }
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <!-- <link href="sticky-footer-navbar.css" rel="stylesheet"> -->
  </head>
  <body class="d-flex flex-column h-100">
    <header>
  <!-- Fixed navbar -->

  <nav class="navbar navbar-expand-md navbar-light   justify-content-between">
    <a class="navbar-brand" href="<?php echo $yousee_website->value; ?>" target="_blank"><span style="position:absolute;font-size:2.7em;left:5%;top:-18px" class="logo logo-yousee"></a>
    
    <a class="navbar-brand" href="<?php echo base_url();?>" > 
    <span style="position:absolute;left:10%;top:10px">Equipment4Seva</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
      <?php 
        $logged_in=$this->session->userdata('logged_in');
      if($logged_in) { ?>
      </ul>
      <ul class="navbar-nav navbar-right ">  
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo base_url();?>home" >Home <span class="sr-only">(current)</span></a>
        </li>
          <li class="nav-item">
             <a class="nav-link" href="#" style="text-decoration:none; color:black;"> <?php echo $logged_in['username']." | " ; ?></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" style="text-decoration:none; color:black;" ><i class="fa fa-gear"></i> Settings <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <a class="dropdown-item" href="<?php echo base_url()."home/change_password";?>"><i class="fa fa-edit"></i> Change Password</a>
              <a class="dropdown-item" href="<?php echo base_url();?>home/logout"><i class="fa fa-sign-out"></i> Logout</a>
            </ul>
          </li>
        <?php } else {?>
        </ul>
          <ul class="navbar-nav navbar-right">
            <li class="nav-item   <?php if(preg_match("^".base_url()."home/login^",current_url())){ echo " active";}?>">
              <a class="nav-link" href="<?php echo base_url()."home/login";?>" style="text-decoration:none; color:black;"><i class="fa fa-sign-in" style="color:black;"></i> Login</a>
            </li>
          </ul>
        <?php }?>
    </div>
  </nav>
</header>

