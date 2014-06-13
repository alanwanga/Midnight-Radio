<?
$file = fopen("cContent", "r");
$str = null;
if($file != NULL)
{
	while(!feof($file))
	{
		$str = $str.fgets($file);
	}
}
fclose($file);
echo $str;
?>