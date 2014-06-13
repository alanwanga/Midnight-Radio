<?
include("mysqlInc.php");

// Use fopen function to open a file
$file = fopen("queue", "r");
$linenum=0;
// Calculate total line number
while(!feof($file))
{
	fgets($file);
	$linenum++;
}
fclose($file);

$file = fopen("queue", "r");
$now_id = -1;
if($linenum > 1)
{
	$value = fgets($file);
	//print "The value of this line is " . $value . <br>";
	$data = explode("@", $value);
	$now_id = $data[0];
}
fclose($file);
 
$type = $_GET['type'];
if($type == 1) //img
{
	$sql = "SELECT song_pic_path FROM songlist where song_ID = '$now_id'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	echo '<img src='.$row['song_pic_path'].' height='.$_GET['height'].'>")';
}
elseif($type == 2) // title
{
	$sql = "SELECT * FROM songlist where song_ID = '$now_id'";
	//$sql = "SELECT * FROM songlist where song_ID = 4";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$song_name = $row['song_name'];
	$song_singer = $row['song_singer'] ;
	if($song_name != NULL)
	{
		echo '<h1>'.$song_singer.' - '.$song_name.'</h1>';
	}
	else
	{
		echo '<h1>Not playing, please order some music.</h1>';
	}
}
elseif($type == 3) // lyrics
{
	$sql = "SELECT song_lyrics FROM songlist where song_ID = '$now_id'";
	//$sql = "SELECT song_lyrics FROM songlist where song_ID = 4";
	
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	
	$lyrics=htmlspecialchars($row['song_lyrics']);
	$lyrics = str_replace("\n", "<br/>", $lyrics);
	$lines = substr_count($lyrics, '<br/>');;
	$output = explode("<br/>",$lyrics);
	
	echo '<div class="lyrics1">'; // 1~23
	for($j=1,$i=1 ; $j<=21 && $i<=$lines+1 ; $i++,$j++)
		echo $output[$i-1].'<br/>';
	echo '</div>';
	
	echo '<div class="lyrics2">';  //23~54
	for($j=1 ; $j<=21 && $i<=$lines+1 ; $i++,$j++)
		echo $output[$i-1].'<br/>';
	echo '</div>';
	
	echo '<div class="lyrics3">'; //54~75 
	for($j=1 ; $j<=21 && $i<=$lines+1 ; $i++,$j++)
		echo $output[$i-1].'<br/>';
	echo '</div>';
	
	echo '<div class="lyrics4">'; //75~88
	for($j=1 ; $j<=21 && $i<=$lines+1 ; $i++,$j++)
		echo $output[$i-1].'<br/>';
	echo '</div>';
}
elseif($type == 4)
{
	$file = fopen("queue", "r");
	if($linenum > 1)
	{
		for($i = 0; $i < $linenum - 1; $i++)
		{
			$value = fgets($file);
			$data = explode("@", $value);
			if($i == 0)
			{
				echo '<li><p>&nbsp;&nbsp;'.$data[1].' ( now playing ...)</p></li>';
			}
			elseif($i < 5)
			{
				echo '<li><p>&nbsp;&nbsp;'.$data[1].'</p></li>';
			}
			else
			{
				$last = $linenum - 1 - $i;
				echo '<li><p>&nbsp;&nbsp;( '.$last.' more ...)</p></li>';
				break;
			}
		}
	}
	else
	{
		echo '<li><p>&nbsp;&nbsp;Empty</p></li>';
	}
	fclose($file);
}
?>