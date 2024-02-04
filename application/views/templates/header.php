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
    <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/tippy-bundle.umd.min.js"></script>
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
      li {
        list-style-type: none;
      }
      .dropdown:hover>.dropdown-menu {
        display: block;
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
        <li class="dropdown">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" style="text-decoration:none; color:black;" > Reports <b class="caret"></b></a>
              <?php 
                foreach($functions as $f){
                  if($f->user_function=="summary_report") { ?>
                      <ul class="dropdown-menu"> 
                        <?php if($f->view) { ?>
                          <a class="dropdown-item" href="<?php echo base_url()."reports/summary_report";?>">Summary report</a>
                       <?php } ?>
                      </ul>   
                  <?php }
                }
              ?>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" style="text-decoration:none; color:black;" > Parties <b class="caret"></b></a>
              <?php 
                foreach($functions as $f){
                  if($f->user_function=="party") { ?>
                      <ul class="dropdown-menu"> <?php
                        if($f->add){ ?>
                          <a class="dropdown-item" href="<?php echo base_url()."parties/add";?>"><i class="fa fa-edit"></i> Add Party</a>
                        <?php } if($f->view) { ?>
                          <a class="dropdown-item" href="<?php echo base_url()."parties/";?>"><i class="fa fa-search" aria-hidden="true"></i> View Parties</a>
                       <?php } ?>
                      </ul>   
                  <?php }
                }
              ?>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" style="text-decoration:none; color:black;" > Locations <b class="caret"></b></a>
              <?php 
                foreach($functions as $f){
                  if($f->user_function=="location") { ?>
                      <ul class="dropdown-menu"> <?php
                        if($f->add){ ?>
                          <a class="dropdown-item" href="<?php echo base_url()."location/add";?>"><i class="fa fa-edit"></i> Add Location</a>
                        <?php }  if($f->view) { ?>
                          <a class="dropdown-item" href="<?php echo base_url()."location/";?>"><i class="fa fa-search" aria-hidden="true"></i> View locations</a>
                       <?php } ?>
                      </ul>   
                  <?php }
                }
              ?>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" style="text-decoration:none; color:black;" > Equipments <b class="caret"></b></a>
            <div class="dropdown-menu"> 
            <a class="dropdown-item" href="<?php echo base_url()."equipments/";?>"><i class="fa fa-search" aria-hidden="true"></i> Equipments</a>
              <?php 
                foreach($functions as $f){
                  if($f->user_function=="equipment") { 
                        if($f->add){ ?>
                          <a class="dropdown-item" href="<?php echo base_url()."equipments/add";?>"><i class="fa fa-edit"></i> Add Equipment</a>
                        <?php } ?>
                  <?php }
                }
              ?>
              </div>   
        </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" style="text-decoration:none; color:black;" ><?php echo $logged_in['first_name'].' '.$logged_in['last_name'].' | '.$logged_in['username'] ; ?><b class="caret"></b></a>
            <ul class="dropdown-menu">
              <a class="dropdown-item" href="<?php echo base_url()."home/change_password";?>"><i class="fa fa-edit"></i> Change Password</a>
              <a class="dropdown-item" href="<?php echo base_url();?>home/logout"><i class="fa fa-sign-out"></i> Logout</a>
            </ul>
          </li>
          <?php } else {?>
          </ul>
          <ul class="navbar-nav navbar-right">
            <!-- <li class="nav-item   <?php if(preg_match("^".base_url()."home/about^",current_url())){ echo " active";}?>">
              <a class="nav-link" id="equipments-data-tab" href="<?php echo base_url()."equipments";?>" style="text-decoration:none; color:black;"> Equipment</a>
            </li> -->
            <li class="nav-item   <?php if(preg_match("^".base_url()."home/login^",current_url())){ echo " active";}?>">
              <a class="nav-link" href="<?php echo base_url()."home/login";?>" style="text-decoration:none; color:black;"><i class="fa fa-sign-in" style="color:black;"></i> Login</a>
            </li>
          </ul>
        <?php }?>
    </div>
  </nav>
</header>

<script>
  tippy("#equipments-data-tab", {
    content: 'Equipments '
  })
</script>