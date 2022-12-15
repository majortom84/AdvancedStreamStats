<!DOCTYPE html>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<html>
	
	<head>
		
		<!-- Google Tag Manager -->
		<!-- End Google Tag Manager -->
		
		<title><?php echo $title ?></title>

		<html lang="en-US">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Thomas Ward">
		<meta name="keywords" content="Advanced Stream Stats">
		<meta name="description" content="Advanced Stream Stats">
		<link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/favicon-16x16.png" sizes="16x16" />
		<!-- <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"> -->
		
		<!-- Open Grapgh Data (metadata) -->
		<meta property="og:image" content="<?php echo base_url(); ?>/assets/images/logo.png" />
		<meta property="og:description" content="Advanced Stream Stats" />
		<meta property="og:title" content="<?php echo $title ?>" />
		<meta property="og:url" content="<?php echo base_url(); ?>" />
		<meta property="og:type" content="website" />
		<meta property="og:site_name" content="<?php echo base_url(); ?>"/>
		<!-- End Open Grapgh Data (metadata) -->
		
		<!-- CSS and Fonts -->
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="/assets/foundation-6.5.1/css/foundation.min.css">
	    <link rel="stylesheet" type="text/css" href="/assets/foundation-6.5.1/css/app.css">
	    <!-- End CSS -->
	    <!-- Fonts -->
		<link rel="stylesheet" type="text/css" href="/assets/fontawesome-free-6.2.0/css/all.min.css">
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Rubik+Mono+One">
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed">
		<!-- End Fonts -->
		<!-- End CSS and Fonts -->

		<!-- load foundation Jquery -->
		<script src="/assets/foundation-6.5.1/js/vendor/jquery-3.3.1.min.js"></script>
		<!-- End load foundation Jquery -->
		

		
	</head>



	<body>
		
		<!-- Google Tag Manager (noscript) -->
			
		<!-- End Google Tag Manager (noscript) -->

		<!-- Hamburger menu -->
		<div class="title-bar" data-responsive-toggle="main-nav" data-hide-for="medium">
			<button role="button" aria-label="mobile menu button" class="button_container" id="toggle">
				<span class="top"></span>
				<span class="middle"></span>
				<span class="bottom"></span>
			</button>
			<div class="menu-text logo"><a href="<?php echo base_url(); ?>"><span>Advanced</span>StreamStats</a></div>
		</div>
    <!-- End Hamburger menu -->
    
    <!-- Overlay of menu items for hamburger -->
    <div id="overlay-id-mobile-menu" class="overlay-class-mobile-menu">
        <nav class="overlay-menu">
            <ul>
            <li><a class="<?php echo activate_menu('LogOut'); ?>" href="/users/LogOut">Log Out</a></li>
            <li><a class="<?php echo activate_menu('addStudent'); ?>" href="/Dashboard">Dashboard</a></li>
            <li><a class="<?php echo activate_menu('account'); ?>" href="/users/account">My Account</a></li>
            </ul>
        </nav>
    </div>
    <!-- end of menu items for hamburger -->
		
		<div class="top-bar menu-padding-0" id="main-nav">
		  
		  <div class="top-bar-left">
		    <ul class="dropdown menu" >
		      <li class="menu-text logo"><a href="<?php echo base_url(); ?>"><span>Data</span>Binder</a></li>
		    </ul>
		  </div>
		  
		  <div class="top-bar-right">
		    <ul class="dropdown menu">
				<li class="<?php echo activate_menu('LogOut'); ?>"><a href="/users/LogOut">Log Out</a></li>
				<li><a class="<?php echo activate_menu('addStudent'); ?>" href="/Dashboard">Dashboard</a></li>
				<li class="<?php echo activate_menu('account'); ?>"><a href="/users/account">My Account</a></li>
<!--
		      <li><input type="search" placeholder="Search"></li>
		      <li><button type="button" class="button">Search</button></li>
-->
		    </ul>
		  </div>
		  
		</div>
		
		
