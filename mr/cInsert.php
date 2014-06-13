<?
include("mysqlInc.php");
session_start();
$acc=$_SESSION['acc'];
$sql = "SELECT id FROM user where acc = '$acc'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$colors = array('#000000','#ff0000','#0000cd','#006400','#800080','#8b4513');
$fondColor = $colors[ $row['id']%6];
if( $_POST["msg"] != NULL)
{
	$fp = fopen("cContent","a+");
	$inputStr = htmlspecialchars($_POST["msg"]);
	date_default_timezone_set('Asia/Taipei');
	$str = '('.date('Y-m-d H:i:s').') ';
	if(preg_match("#^http(s)?://[a-z0-9-_.]+\.[a-z0-9-_.]{2,4}#i",$inputStr))
	{ 
		$str = $str.'<font color='.$fondColor.'">'.$_SESSION["acc"].': <a target="_blank" href="'.$inputStr.'" style="color:blue;">'.$inputStr.'</a></font><br/>';
	}
	else
	{	
		$str = $str.'<font color='.$fondColor.'">'.$_SESSION["acc"].': '.$inputStr.'</font><br/>';
	}
	fwrite($fp, $str);
	fclose($fp);	
}
?>