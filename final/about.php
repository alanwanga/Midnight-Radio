<!DOCTYPE html>
<!-- saved from url=(0042)http://getbootstrap.com/examples/carousel/ -->
<?php
session_start();
$acc = $_SESSION['acc'];
$logout = $_GET['logout'];
include("mysqlInc.php");
if($_GET['logout']!=NULL)
{
	session_destroy();
	echo '<meta http-equiv=REFRESH CONTENT=0;url=index.php>';
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="./img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="popup.css" />
	<script type="text/javascript" src="popup.js"></script>
	<title>Midnight Radio</title>

    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="carousel.css" rel="stylesheet" media="all">
	
	<style id="holderjs-style" type="text/css"></style>
	<style>
		.marketing {
			margin: 150px auto !important;
			z-index: 0;
			text-align: center;
		
		}
		.col-lg-4 {
			left: 120px !important;
			margin-left: 70px;
			margin-top: 30px;
		}
		body {
			background-color: #bbb;
			color: #000;
		}
	</style>
</head>
<!-- NAVBAR
================================================== -->
  <body>
	<div class="navbar-wrapper">
      <div class="container">
        <div class="navbar navbar-inverse navbar-static-top" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <a class="navbar-brand" href="index.php">Midnight Radio</a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li><a href="index.php">Back</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
	
	<div class="container marketing">	
	 <div class="row">
        <div class="col-lg-4">
		<img class="img-circle" alt="140x140" src="./img/tommy.jpg" style="width: 200px; height: 200px;">
		　<h2>張書桓</h2>
		  清大資工14級<br><br>
          <p><a class="btn btn-default" href="https://www.facebook.com/tommy.chang.351" role="button">Facebook »</a></p>
        </div><!-- /.col-lg-4 -->
        
		<div class="col-lg-4">
          <img class="img-circle" alt="140x140" src="./img/alan.jpg" style="width: 200px; height: 200px;">
          <h2>王道元</h2>
		  清大資工14級<br><br>
          <p><a class="btn btn-default" href="https://www.facebook.com/alanwanga" role="button">Facebook »</a></p>
        </div><!-- /.col-lg-4 -->
	  </div><!-- /.row -->
	  
	  <br><br>
	  
	 <div class="row">
        <div class="col-lg-4">
		<img class="img-circle" alt="140x140" src="./img/james.jpg" style="width: 200px; height: 200px;">
		　<h2>陳敬恒</h2>
		  清大電機14級<br><br>
          <p><a class="btn btn-default" href="https://www.facebook.com/profile.php?id=100000133163842" role="button">Facebook »</a></p>
        </div><!-- /.col-lg-4 -->
        
		<div class="col-lg-4">
          <img class="img-circle" alt="140x140" src="./img/eric.jpg" style="width: 200px; height: 200px;">
          <h2>邱名彰</h2>
		  清大電資15級<br><br>
          <p><a class="btn btn-default" href="https://www.facebook.com/eric.chiu.10" role="button">Facebook »</a></p>
        </div><!-- /.col-lg-4 -->
	  </div><!-- /.row -->
	 
	 </div>
	
	<script src="./Carousel Template for Bootstrap_files/jquery.min.js"></script>
	<script src="./Carousel Template for Bootstrap_files/bootstrap.min.js"></script>
    <script src="./Carousel Template for Bootstrap_files/docs.min.js"></script>
	<script type="text/javascript" src="./Carousel Template for Bootstrap_files/script.js"></script>

</body>
</html>