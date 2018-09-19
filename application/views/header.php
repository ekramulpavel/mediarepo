<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login Form</title>
     <!--link the bootstrap css file-->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <?php
    $this->load->library('session');
    $logged_in = $this->session->userData('logged_in');
     if ($logged_in==TRUE) {
       $this->load->helper('url');
         redirect('user/index');
     }
     ?>
     <style type="text/css">

     .colbox {
          margin-left: 20px;
          margin-right: 20px;
     }

     body.h-100{
       height: 100vh !important;
     }

     </style>

</head>
<body class="bg-light h-100">
