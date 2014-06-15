<!DOCTYPE html>
<!-- saved from url=(0042)http://getbootstrap.com/examples/carousel/ -->
<?php
session_start();
$acc = $_SESSION['acc'];
$logout = $_GET['logout'];
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

	<style type="text/css">
		.lyrics1 {
			margin-top: 80px !important;
			margin-left: 50px !important;
			float: left !important;
			color: #fff;
			font-size: 16px;
			font-family: MingLiU;
		}
		.lyrics2, .lyrics3, .lyrics4 {
			margin-top: 80px !important;
			margin-left: 50px !important;
			float: left !important;
			color: #fff;
			font-size: 16px;
			font-family: MingLiU;
		}
		
		.cFrame {
			margin-top: 150px !important;
			margin-left: 50px !important;
		}
	</style>
	
	<script type="text/javascript">
	// Popup window code
		function newPopup(url) {
			popupWindow = window.open (
				url,'order','height=600,width=800,left=10,top=10,resizable=yes,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=yes')
		}
	</script>
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
                <li><a href="JavaScript:newPopup('order.php')">Order Music</a></li>
	            <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Queue<b class="caret"></b></a>
					<ul class="dropdown-menu mydm" id="song_queue">
					</ul>
				</li>
				<?php
					if($_SESSION['acc']==null)
					{
						echo '<li><a href="#" rel="popuprel3" class="popup">Register</a></li>';
						echo '<li><a href="#" rel="popuprel2" class="popup">Login</a></li>';
					}
					elseif($_SESSION['acc'] == "root" || $_SESSION['acc'] == "ponyu")
					{
						echo
							'<li class="dropdown">',
								'<a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Hi, '.$_SESSION['acc'].'</b><b class="caret"></b></a>',
								'<ul class="dropdown-menu">',
									'<li><a href=index.php?logout=1>登出</a></li>',
									'<li><a href=# rel="popuprel4" class="popup">修改密碼</a></li>',
									'<li class="divider"></li>',
									'<li><a href=checkpage.php>管理後台</a></li>',
								'</ul>',
							'<li>';
					}
					else
					{
						echo
							'<li class="dropdown">',
								'<a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Hi, '.$_SESSION['acc'].'</b><b class="caret"></b></a>',
								'<ul class="dropdown-menu">',
									'<li><a href=index.php?logout=1>登出</a></li>',
									'<li class="divider"></li>',
									'<li><a href=# rel="popuprel4" class="popup">修改密碼</a></li>',
								'</ul>',
							'<li>';
					}
				?>
				<li><a href="about.php">About Us</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" ></li>
        <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="2" ></li>
      </ol>
      <div class="carousel-inner">
        <div class="item"> <!-- Lyrics -->

          <div class="container">
			
			<div id="song_lyrics">
			</div>
			<div class="carousel-caption" id="song_title">		
            </div>
          </div>
        </div>
        <div class="item active"> <!-- Player & Image -->

          <div class="container">
            <div id="song_img"></div>
			<div class="carousel-caption">
             <iframe src="player.php" width="520" height="80" scrolling="no" frameborder="0"  allowtransparency="true"> </iframe>
            </div>
          </div>
        </div>
        <div class="item"> <!-- Chatroom -->
          <div class="container">
			
			<div class="cFrame">
              <iframe src="cFrame.php" width="1200" height="470" scrolling="no" frameborder="0"  allowtransparency="true"></iframe>
            </div>
	
			<!-- <div class="carousel-caption"></div> -->
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="http://getbootstrap.com/examples/carousel/#myCarousel" data-slide="prev" id="prev">
	  <span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="http://getbootstrap.com/examples/carousel/#myCarousel" data-slide="next" id="next">
	  <span class="glyphicon glyphicon-chevron-right"></span></a>
    
	
	</div><!-- /.carousel -->
	
	<div class="popupBOX" id="popuprel2">
		<div class="close"></div>
		<div id="intabdiv2">
			<h2>Log-in</h2>
		</div>
		<form action="back.php" method="post">
			<input class="textInput" name="acc" type="text" placeholder="Account"/><br><br>
			<input class="textInput" name="pwd" type="password" placeholder="Password"/><br><br>
			<input id="logOKbtn" class="btn btn-lg btn-primary" type="submit" name="login" value="登入" />
		</form>
	</div>
	
	<div class="popupBOX" id="popuprel3">
		<div class="close"></div>
		<div id="intabdiv3">
			<h2>Register</h2>
		</div>
		<form action="back.php" method="post">
			<input class="textInput" name="acc" type="text" placeholder="Account"/><br><br>
			<input class="textInput" name="pwd" type="password" placeholder="Password"/><br><br>
			<input class="textInput" name="pwd2" type="password" placeholder="Check Password"/><br><br>
			<input id="logOKbtn" class="btn btn-lg btn-primary" type="submit" name="regist" value="註冊" />
		</form>
	</div>
	
	<div class="popupBOX" id="popuprel4">
		<div class="close"></div>
		<div id="intabdiv3">
			<h2>修改密碼</h2>
		</div>
		<form action="back.php" method="post">
			<input class="textInput" name="pwd0" type="password" placeholder="Old password"/><br><br>
			<input class="textInput" name="pwd1" type="password" placeholder="New password"/><br><br>
			<input class="textInput" name="pwd2" type="password" placeholder="Check password"/><br><br>
			<input id="logOKbtn" class="btn btn-lg btn-primary" type="submit" name="change" value="修改" />
		</form>
	</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<div id="fade"></div>

	<script src="./Carousel Template for Bootstrap_files/jquery.min.js"></script>
	<script src="./Carousel Template for Bootstrap_files/bootstrap.min.js"></script>
    <script src="./Carousel Template for Bootstrap_files/docs.min.js"></script>
	<script type="text/javascript" src="./Carousel Template for Bootstrap_files/script.js"></script>
	<script>
	/*$(document).keydown(function(e) {
		if(e.keyCode == 39) {  
			 $('a.carousel-control.right').trigger('click');
		}
		if(e.keyCode == 37) {
			$('a.carousel-control.left').trigger('click');
		}
	});*/
	
	$(document).ready(function() {
		$.ajaxSetup({ cache: false });
		setInterval(function() {
			$('#song_img').load('show.php?type=1&height=' + screen.availHeight);
			}, 5000); 
	});
	
	$(document).ready(function() {
		$.ajaxSetup({ cache: false });
		setInterval(function() {
			$('#song_title').load('show.php?type=2');
			}, 5000); 
	});
	
	$(document).ready(function() {
		$.ajaxSetup({ cache: false });
		setInterval(function() {
			$('#song_lyrics').load('show.php?type=3');
			}, 5000); 
	});
	
	$(document).ready(function() {
		$.ajaxSetup({ cache: false });
		setInterval(function() {
			$('#song_queue').load('show.php?type=4');
			}, 5000); 
	});
	
	$('#song_img').load('show.php?type=1&height=' + screen.availHeight);
	$('#song_title').load('show.php?type=2');
	$('#song_lyrics').load('show.php?type=3');
	$('#song_queue').load('show.php?type=4');
	
	$(document).keydown(function(e)
	{
		if(e.keyCode == 39 || e.which==39)
		{  
			$('a.carousel-control.right').trigger('click');
		}
		if(e.keyCode == 37 || e.which==37)
		{
			$('a.carousel-control.left').trigger('click');
		}
	});	
</script>
</body>
</html>