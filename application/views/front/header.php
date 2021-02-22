<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('public/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/css/style.css'); ?>">

    <title>CI Web Application- frontend</title>
  </head>
  <body>

     <header class="bg-light">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light pt-4 pb-4">
        <a class="navbar-brand" href="<?php echo base_url() ?>">CI Web Application</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse right-align" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo base_url() ?>">Home </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url().'Pages/about' ?>">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url().'Pages/services' ?>">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url().'Blog/index' ?>">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url().'Blog/categories' ?>">Categories</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('Pages/contact') ?>">Contact Us</a>
            </li>            
          </ul>         
        </div>
      </nav>
      </div> 
    </header>