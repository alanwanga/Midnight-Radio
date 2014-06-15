<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
textarea{vertical-align:top}
.textInput{
	position:relative;
	border: 1px solid #A9A9A9 ;
	font-size: 20px;
	border-radius: 5px;
	background: rgba(255,255,255,1);
	height:40px;
	width:350px;
}
.myta{
	font-size: 18px;
	border-radius: 7px;
}

.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 999px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

</style>
</head>
<body>
<?
session_start();
include("mysqlInc.php");
$acc = $_SESSION['acc'];
if($acc == NULL)
{
	$message = "Please login to upload your music.";
	echo "<script type='text/javascript'>alert('$message');</script>";
	echo "<script type='text/javascript'>window.close();</script>";	
	return;
}
elseif($_GET['step'] == 1)
{
	echo
		'(1/3)<br><br>',
		'<form action="upload.php?step=2" method="post">',
		'&nbsp;&nbsp;Song Name<br /><input class="textInput" type="text" name="name"></input><br><br>',
		'&nbsp;&nbsp;Singer (optional)<br><input class="textInput" type="text" name="singer"></input><br><br>',
		'&nbsp;&nbsp;Lyrics (optional)<br><textarea class="myta" name="lyrics" cols="45" rows="10"></textarea><br>',
		'&nbsp;&nbsp;2000個字元以內<br><br>',
		
		'&nbsp;&nbsp;<input class="btn btn-primary" type="submit" value="下一步" />',
		
		'</form>';
}
elseif($_GET['step'] == 2)
{
	if($_POST['name'] != null)
	{
		$name = $_POST['name'];
		$singer = $_POST['singer'];
		if($singer==NULL)
		{
			$singer = "unknown";
		}
		$lyrics = $_POST['lyrics'];
		$len = strlen($lyrics);
		if($len > 2000)
		{
			//echo 'Lyrics Overflow !! ( total: '.$len.', which is longer than 2000)';
			echo '<script>alert("Lyrics Overflow !! ( total: '.$len.', which is longer than 2000)");</script>';
			echo '<meta http-equiv=REFRESH CONTENT=0;url=upload.php?step=1>';
			return;
		}
		$sql = "INSERT INTO templist (temp_song_name, temp_song_singer, temp_song_lyrics) VALUES ('$name', '$singer', '$lyrics')";
		mysql_query($sql);
		$id = mysql_insert_id();
		echo
			'(2/3)<br><br>',
			'<form action="upload.php?step=3" method="post" enctype="multipart/form-data">',
			'&nbsp;&nbsp;Upload MP3<br><br>',
			'&nbsp;&nbsp;<span class="btn btn-success btn-file">Choose your music file<input type="file" name="uploadFile"></span><br><br>',
			'<input type="hidden" name="id" value="'.$id.'">',
			'&nbsp;&nbsp;<input class="btn btn-primary" type="submit" value="下一步" />',
			'</form>';
	}
	else
	{
		echo '<script>alert("MP3 name is requred !!");</script>';
		echo '<meta http-equiv=REFRESH CONTENT=0;url=upload.php?step=1>';
	}
}
elseif($_GET['step'] == 3)
{
	if($_FILES["uploadFile"]["name"] != NULL)
	{
		$whiteList = array('mp3');
		$newDir = "./uploadFile/";
		$extension = strtolower(end(explode(".", $_FILES["uploadFile"]["name"])));
		if(in_array($extension, $whiteList))
		{
			$filePath = $newDir.time().".".$extension;
			move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $filePath);
			$id = $_POST['id'];
			$sql = "UPDATE templist SET temp_song_filepath = '$filePath' WHERE temp_song_ID = '$id'";
			mysql_query($sql);
			echo
				'(3/3)<br><br>',
				'<form action="upload.php?step=4" method="post" enctype="multipart/form-data">',
				'&nbsp;&nbsp;Upload Image (optional)<br><br>',
				'&nbsp;&nbsp;<span class="btn btn-success btn-file">Choose your image<input type="file" name="uploadFile"></span><br><br>',
				'<input type="hidden" name="id" value="'.$id.'">',
				'&nbsp;&nbsp;<input class="btn btn-primary" type="submit" value="完成" />',
				'</form>';
		}
		else
		{
			echo '<script>alert("Submit MP3 failed !!");</script>';
			echo '<meta http-equiv=REFRESH CONTENT=0;url=upload.php?step=1>';
		}
	}
	else
	{
		echo '<script>alert("Submit MP3 is requred !!");</script>';
		echo '<meta http-equiv=REFRESH CONTENT=0;url=upload.php?step=1>';
	}
}
elseif($_GET['step'] == 4)
{
	if($_FILES["uploadFile"]["name"] != NULL)
	{
		$whiteList = array('jpeg', 'jpg', 'png', 'gif');
		$newDir = "./uploadFile/";
		$extension = strtolower(end(explode(".", $_FILES["uploadFile"]["name"])));
		if(in_array($extension, $whiteList))
		{
			$filePath = $newDir.time().".".$extension;
			move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $filePath);
			$id = $_POST['id'];
			$sql = "UPDATE templist SET temp_song_picpath = '$filePath' WHERE temp_song_ID = '$id'";
			mysql_query($sql);
			echo '<script>alert("新歌已送交管理員審合");</script>';
			echo "<script type='text/javascript'>window.close();</script>";
		}
		else
		{
			echo '<script>alert("Submit Image failed !!");</script>';
			echo '<meta http-equiv=REFRESH CONTENT=0;url=upload.php?step=1>';
		}
	}
	else
	{
		$filePath = "./img/default.jpg";
		$sql = "UPDATE templist SET temp_song_picpath = '$filePath' WHERE temp_song_ID = '$id'";
		mysql_query($sql);
		echo '<script>alert("新歌已送交管理員審合");</script>';
		echo "<script type='text/javascript'>window.close();</script>";
	}
}
else
{
	echo '<meta http-equiv=REFRESH CONTENT=0;url=upload.php?step=1>';
}
?>
</body>
</html>