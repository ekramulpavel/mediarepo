<!DOCTYPE html>
<?php
$this->load->library('session');
$name=$this->session->userData('name');
$user_type = $this->session->userData('user_type');
$logged_in = $this->session->userData('logged_in');
// $profile_image_location =  $_SESSION["profile_image_location"];
// var_dump($profile_image_location);

?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>File Storage</title>

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/dist/css/adminlte.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
  <!-- Generic page styles -->


  <!-- blueimp Gallery styles -->
  <link rel="stylesheet" href="https://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
  <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery.fileupload.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery.fileupload-ui.css">
  <!-- CSS adjustments for browsers with JavaScript disabled -->
  <noscript><link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery.fileupload-noscript.css"></noscript>
  <noscript><link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery.fileupload-ui-noscript.css"></noscript>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="<?php echo base_url();?>assets/css/font-wso2.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/dataTables.listView.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->



  <!-- ============================================================== for Social media part=============================-->


  <!-- Social Share Kit CSS -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/social-share-kit.css">



  <!-- ==================================================================================================================== -->

  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">


</head>
<body class="hold-transition sidebar-mini ">
  <div class="wrapper">



    <!-- Navbar -->
    <nav class="main-header navbar fixed-top navbar-expand bg-light navbar-light border-bottom m-0 ">
      <!-- Left navbar links d-lg-none d-md-block -->
      <ul class=" navbar-nav">
        <li class="nav-item">
          <a class="nav-link d-flex" data-widget="pushmenu" href="#">
            <i class="fas fa-bars align-self-center"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->





    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar bg-light h-100 border-right"  style="top: 57px;">
      <!-- Brand Logo -->
      <!-- <a href="<?php //echo site_url('user'); ?>" class="brand-link">
      <img src="<?php //echo base_url();?>/assets/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
      <span class="brand-text font-weight-light" style="color: #000;">File Storage</span>
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <!-- <div class="image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div> -->

      <div class="pull-left image">
        <img class="rounded-circle" src="http://localhost/mediarepo/images/52eabf633ca6414e60a7677b0b917d92-male-avatar-maker.jpg" alt="User Image"> 
                                        <!--<?=site_url();?>profile/get_Image-->
      </div>

      <div class="p-image">
        <i class="mt-2 d-flex justify-content-center fa fa-camera upload-button"></i>
        <input class="file-upload" type="file" action="<?=site_url();?>profile/insert_user"/>
      </div>

      <br>

      <div class="info d-flex justify-content-center">
        <a href="<?php echo  ($user_type=='super')?site_url('user'):site_url('user/my_file'); ?>" class="d-block" style="color: #000; text-transform: uppercase;font-size: 24px; letter-spacing: 2px; margin-top: -24px; text-"><?=$name?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
        with font-awesome or any other icon font library -->

        <?php
        if($user_type=='super'){
          ?>
          <li class="nav-item ">
            <a href="<?php echo site_url('redirect/user_list'); ?>" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>
                User List
              </p>
            </a>
          </li>
        <?php } ?>

        <li class="nav-item ">
          <a href="<?php echo site_url('user/my_file'); ?>" class="nav-link">
            <i class="nav-icon far fa-file"></i>
            <p>My Files </p>
          </a>
        </li>


        <li class="nav-item ">
          <a href="<?php echo site_url('user/all_file'); ?>" class="nav-link">
            <i class="nav-icon far fa-file"></i>
            <p>All Files </p>
          </a>
        </li>
      </ul>



      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item ">
          <a href="" data-toggle="modal" data-target="#InsertFormModal" class="nav-link">
            <i class="nav-icon fas fa-user-edit"></i>
            <p>User Profile </p>
          </a>
        </li>

        <li class="nav-item ">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cog"></i>
            <p>Settings </p>
          </a>
        </li>

        <li class="nav-item ">
          <a href="<?php  echo site_url('login/logout'); ?>" class="nav-link">
            <i class="nav-icon fas fa-lock"></i>
            <p>Logout </p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->



  </div>
  <!-- /.sidebar -->
</aside>

<!-- Modal HTML Markup -->
<div id="InsertFormModal" class="modal fade">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title">Insert User Information</h1>
      </div>
      <div class="modal-body">                    <!-- form start -->

        <form id="insert-user-form" class="form-horizontal needs-validation" action="<?= site_url();?>profile/insert_user" method="post" enctype="multipart/form-data" novalidate>

          <fieldset>
            <!-- <legend class="text-center">User Registration</legend> -->
            <input id="insert_txt_user_id" name="insert_txt_user_id" type="hidden" value="<?=$_SESSION['id']?>"/>

            <div class="form-group">
              <div class="row">
                <div class="col-12">
                  <label for="insert_txt_name" class="control-label">Full Name</label>
                  <input class="form-control" id="insert_txt_name" name="insert_txt_name" required placeholder="Name" type="text" value="" />
                </div>
              </div>
            </div>
            <!-- User phone number -->
            <div class="form-group">
              <div class="row">
                <div class="col-12">
                  <label for="insert_txt_phone" class="control-label">Phone Number</label>
                  <input class="form-control" id="insert_txt_phone" name="insert_txt_phone" required placeholder="Phone" value="" type="Number"/>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-12">
                  <label for="insert_txt_name" class="control-label">Profile Picture </label>
                   <input class='form-control' id='insert_image' name='insert_image' type='file' value=""><br>
                </div>
              </div>
            </div>

            <!-- User Social Media -->
            <div class="form-group">
              <div class="row">
                <div class="col-12">
                  <label for="insert_txt_phone" class="control-label">Social Media:</label>
                  <div class="container">
                    <a href="https://www.facebook.com/login/" class="ssk ssk-text ssk-facebook">Show Facebook Profile</a>
                    <a href="https://twitter.com/login" class="ssk ssk-text ssk-twitter">Show Twitter Profile</a>
                    <a href="https://accounts.google.com/signin/v2/identifier?hl=en-US&flowName=GlifWebSignIn&flowEntry=ServiceLogin" class="ssk ssk-text ssk-google-plus">Show Google Profile</a>
                    <a href="https://www.linkedin.com/uas/login" class="ssk ssk-text ssk-linkedin">Show LinkedIn Profile</a>
                    <a href="https://www.pinterest.com/login/" class="ssk ssk-text ssk-pinterest">Show Pinterest Profile</a>

                  </div>
                </div>
              </div>


              <br>
              <!-- sigup button -->
              <div class="form-group">
                <div class="row">
                  <div class="col-12">
                    <input id="btn_insert" name="btn_insert" type="submit" class="btn btn-primary" value="Update" />

                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </fieldset>
            <?php //echo form_close(); ?>

          </form>

          <!-- form end -->
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <!-- Modal -->
