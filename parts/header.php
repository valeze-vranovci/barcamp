<?php
include 'C:\xampp\htdocs\barcampS4\inc\dbconn.php'; 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Barcamp</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rezl="stylesheet">
	<link rel="stylesheet" type="text/css" href="languages.min.css">

<link href="ihover/ihover.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="style.css">
	
 <link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="css/owl.theme.css">
	<!-- Start WOWSlider.com HEAD section -->
<link rel="stylesheet" type="text/css" href="engine1/style.css" />
<script type="text/javascript" src="engine1/jquery.js"></script>
<!-- End WOWSlider.com HEAD section -->
<link rel="stylesheet" href="css/jquery-ui.min.css">
        <link rel="stylesheet" href="css/jquery.timepicker.css">

<script type="text/javascript">
       $(function() {
               $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" }).val();
       });

   </script> 

</head>
<body>
	<header id="header">
		<nav class="navbar navbar-fixed-top navbar-right">
		<div class="container-fluid">
			<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#my-navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php"><img src="images/logo.png" ></a>
			</div>

			<div class="collapse navbar-collapse" id="my-navbar">
				<ul class="nav navbar-nav">
					<li><a href="about.php">About</a></li>
					<li><a href="schedule.php">Schedule</a></li>
					<li><a href="speakers.php">Speakers</a></li>
					<li><a href="testimonials.php">Testimonials</a></li>
					<li><a href="sponsors.php">Sponsors</a></li>
					 <li>
              <a href="">
              <h6><span class="lang-xs" lang="sq"></span></h6></a>
            </li>
            <li>
              <a href="">
              <h6><span class="lang-xs" lang="en"></span></h6>
              </a>
            </li>
					<li>
                             <?php 
                            if(!isset($_SESSION['user_session'])){
                             	echo '<a></a>'; 
                            } else { 
                                echo '<a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;</a>';
                            	} 
                            ?>
                        </li>

			
			</div>
		</div>
		</nav>
	</header>