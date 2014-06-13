<!DOCTYPE html>
<!-- saved from url=(0042)http://getbootstrap.com/examples/carousel/ -->
<?php
session_start();
include("mysqlInc.php");
$id = $_GET['id'];
if($id != null)
{
	// Use fopen function to open a file
    $file = fopen("queue", "r");
    $linenum = 0;
    // Calculate total line number
    while (!feof($file)) {
        fgets($file);
        $linenum++;
    }
    fclose($file);
	if($linenum < 2)
	{
		$file = fopen("timer", "w");
		fwrite($file, time());
		fclose($file);
	}
	$sql = "SELECT song_name FROM songlist where song_ID = '$id'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$str = $id."@".$row['song_name']."\n";
	$file = fopen("queue","a+");
	fwrite($file, $str);
	fclose($file);
	echo "<script>window.close();</script>";
	return;
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
    <link href="carousel_2.css" rel="stylesheet" media="all">
	<style id="holderjs-style" type="text/css"></style>
	
	<script type="text/javascript">
	// Popup window code
		function newPopup(url) {
			<?
			if($_SESSION['acc'] == null)
			{
				echo "alert('Please login to upload your music.');window.close();";
			}
			else
			{
				echo "popupWindow = window.open (url,'upload','height=600,width=400,left=10,top=10,resizable=yes,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=yes')";
			}
			?>
		}
	</script>
	
	
	<style type="text/css">
	.table-hover {
		margin: 100px auto !important;
		float: none !important;
		background-color: #d6d6d6 !important;
		width: 65%;
		font-size: 16px !important;
		border-radius: 4px;
		margin-bottom: 20px !important;
	}
	.backbtn {
		margin-left: 20px;
	}
	.col-md-12 {
		margin: 5px auto !important;
		margin-bottom: 50px !important;
	}
	</style>
</head>

<body>
	
	<div class="navbar-wrapper">
      <div class="container">

        <div class="navbar navbar-inverse navbar-static-top" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <a class="navbar-brand" href="order.php">Order Music</a>
            </div>
          </div>
        </div>
      </div>
    </div>
	
	    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel">
      <div class="carousel-inner" style="overflow:auto">
        <div class="item active">
          <div class="container">
				
				<?php	
					$file = fopen("queue", "r");
					$linenum=0;
					// Calculate total line number
					while (!feof($file)) {
						fgets($file);
						$linenum++;
					}
					fclose($file);
					$file = fopen("queue", "r");
					$now_id = -1;
					$arr[0] = -1;
					if($linenum > 1) {
						for ($i = 0; $i < $linenum - 1; $i++) {
							$value = fgets($file);
							//print "The value of this line is " . $value . <br>";
							$data = explode("@", $value);	
							$arr[$i + 1] = $data[0];
						}
					}
					fclose($file);
					
					$sql = "SELECT * FROM songlist ORDER BY 2 ASC";
					$result = mysql_query($sql);

					echo '<table class="table table-hover">';
					echo '<thead><tr>';
						echo '<th>Song Name</th>';
						echo '<th>Singer</th>';
						echo '<th>Lyrics</th>';
						
					echo '</tr></thead>';
					echo '<tbody>';
					while($row = mysql_fetch_array($result))
					{
						if($row['song_ID'] == -1)
						{
							continue;
						}
						echo '<tr><td>'.$row['song_name'].'</td>';
						echo '<td>'.$row['song_singer'].'</td>';
						if($row['song_lyrics'] != null)
						{
							echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;<font size="5">●</font></td>';
						}
						else
						{
							echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;<font size="5">○</font></td>';
						}
						if(in_array($row['song_ID'], $arr))
						{
							echo '<td align="right"><a href=# class="btn btn-info" disabled="disabled" role="button">Queuing</a></td>';
						}
						else
						{
							echo '<td align="right"><a href=order.php?id='.$row['song_ID'].' class="btn btn-info" role="button">Add</a></td>';
						}
					}
					echo '</tr></tbody>';
					echo '</table><br>';
				?>
				<div class="col-md-12 text-center">
					<a href="JavaScript:newPopup('upload.php?step=1')" class="btn btn-success btn-lg" role="button" id="uploadlink">Upload your own music</a>
				</div>	
          </div>
        </div>
      </div> 
	</div><!-- /.carousel -->
	<script src="./Carousel Template for Bootstrap_files/jquery.min.js"></script>
	<script src="./Carousel Template for Bootstrap_files/bootstrap.min.js"></script>
    <script src="./Carousel Template for Bootstrap_files/docs.min.js"></script>
	<script type="text/javascript" src="./Carousel Template for Bootstrap_files/script.js"></script>
</body>
</html>