<?
include("mysqlInc.php");
function popnext()
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
    $file = fopen("queue", "r");
    fgets($file);
    $value = "";
	if($linenum > 2)
    {
        for ($i = 0; $i < $linenum - 1; $i++) {
            $value = $value.fgets($file);
        }
    }
	fclose($file);
    $file = fopen("queue", "w");
    fwrite($file, $value);
    fclose($file);
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
#mask, #sound {
position:absolute;
left:0;
}

#sound {
top:20;
width:400;
float: left;
position: relative;
}

#mask {
background: rgba(225, 225, 225, 0);
width:270;
height:50;
top:20;
z-index:999;
}

#onlinecounter
{
top: 20;
left: 20;
position: relative;
float: left;
}
</style>
</head>
<body style="background-color:transparents">
<div id="mask"></div>
<?
$file = fopen("timer", "r");
$time = fgets($file);
$now = time();
$diff = $now - $time;
fclose($file);

if($_GET['nxt'] != null && $diff > 120)
{
	$file = fopen("timer", "w");
	fwrite($file, $now);
	fclose($file);
	$diff = 0;
	popnext();
	echo '<meta http-equiv=REFRESH CONTENT=0;url=player.php>';
	return;
}
else
{
	$file = fopen("queue", "r");
	$value = fgets($file);
	$data = explode("@", $value);
	$id = $data[0];
	$sql = "SELECT song_file_path FROM songlist where song_ID = '$id'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$filepath = $row['song_file_path'];
	fclose($file);
	if($filepath == null)
	{
		echo '<meta http-equiv=REFRESH CONTENT=10;url=player.php>';
	}
}
?>
<audio id="sound" src="<?echo $filepath;?>" type="audio/mp3" controls autoplay onended="myend()"></audio>
<script type="text/javascript">
	var myAudio = document.getElementById("sound");
	var musicStartTime = <?echo $diff;?>;
	myAudio.volume = 0.5;
	myAudio.addEventListener('canplaythrough', function() { 
		this.currentTime = musicStartTime;
	});
	function myend()
	{
		document.location.href="player.php?nxt=1";
	}
</script>
<div id="onlinecounter" align="right"><script id="_waurw1">var _wau = _wau || []; _wau.push(["classic", "qc2ufn6qdkna", "rw1"]);
(function() {var s=document.createElement("script"); s.async=true;
s.src="http://widgets.amung.us/classic.js";
document.getElementsByTagName("head")[0].appendChild(s);
})();</script></div>
</body>
</html>