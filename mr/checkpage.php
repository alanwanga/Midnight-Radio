<?php
	session_start();
    include("mysqlInc.php");

    
    function showData($row,$i){
        $passi="pass".$i;
        $deli="del".$i;
        $showi="show".$i;
        $closei="close".$i;
        $temp_singer = htmlspecialchars($row['temp_song_singer']);
        $temp_songname = htmlspecialchars($row['temp_song_name']);
        $temp_songpicpath = $row['temp_song_picpath'];
        $temp_songfilepath = $row['temp_song_filepath'];
        $temp_songlyrics=htmlspecialchars($row['temp_song_lyrics']);
        $temp_songlyrics = str_replace("\n", "<br/>", $temp_songlyrics);
		$extension = strtolower(end(explode(".", $temp_songpicpath )));
        echo "<hr><table border=\"0\" bgcolor=\"#FFFFFF\"><tr>";
        echo "<td width=\"1000px\">歌手: ".$temp_singer."</br></br></td>";
        echo "<td width=\"1000px\">歌名: ".$temp_songname."</br></br></td>";
        echo  "<form action=\"checkpage.php\" method=\"post\">";
      // if($_SESSION['id']==$_GET['wallid'])
	//	{
			echo "<td width=\"1000px\"><input type=\"submit\" class=\"but\"  name=\"$passi\" value=\"通過\"><input type=\"submit\" class=\"but\"  name=\"$deli\" value=\"不通過\"></td>";
	//	}
		if($extension=="jpg"||$extension=="png")
		{
			echo '<tr><td width=\"1000px\"><p align="center"><img  src="'.$temp_songpicpath.'" height="100"  /></p></td>';
		}
		else
			echo "<tr><td width=\"1000px\">圖片路徑: ".$temp_songpicpath."</br></br></td>";
        echo '<td width=\"1000px\"><audio src="'.$temp_songfilepath.'" controls></audio></td></tr>';
        echo "<tr><td colspan=\"3\" width=\"3000px\">歌詞";
        if($_POST["show".$i]!=NULL)
            echo "<input type=\"submit\" class=\"but\" name=\"$closei\" value=\"關閉\"></br><br/>".$temp_songlyrics."</td></tr>";
        else
            echo "<input type=\"submit\" class=\"but\" name=\"$showi\" value=\"開啓\"></br><br/></td></tr>";
        echo "</form></table>";
    }
    
    ?>

<html>
<head>
<style>
textarea{vertical-align:top}
p {font-family: DFKai-sb; font-size: 36px;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body bgcolor="#404040">
<center><font color="#fff" size="7" face="DFKai-sb"><b>管理後台</b></font>
<a href="index.php"><input type="button" value="Back" /></a>
</center>

<?php
	if($_SESSION['acc'] != root)
	{
		echo '<meta http-equiv=REFRESH CONTENT=0;url=index.php>';
		return;
	}
    $sql = 'SELECT * from templist';
    $result = mysql_query($sql);
    $i=0;
   
    while($row = mysql_fetch_array($result)){
        if($_POST["pass".$i]!=NULL)
		{
            $row[4]=str_replace("'", "\'", $row[4]);
            $sql = "INSERT INTO songlist (song_singer,song_name,song_pic_path,song_file_path,song_lyrics) VALUES ('$row[0]', '$row[1]','$row[2]','$row[3]','$row[4]')";
            mysql_query($sql);
            $sql="DELETE from templist where temp_song_singer='$row[0]' AND temp_song_name='$row[1]' AND temp_song_picpath='$row[2]' AND temp_song_filepath='$row[3]' AND temp_song_lyrics='$row[4]' AND temp_song_ID='$row[5]'";  //redelete
			mysql_query($sql);
            echo  '<meta http-equiv=REFRESH CONTENT=0;url=checkpage.php>';
        }
        if($_POST["del".$i]!=NULL)
		{
            $row[4]=str_replace("'", "\'", $row[4]);
            $sql="DELETE from templist where temp_song_singer='$row[0]' AND temp_song_name='$row[1]' AND temp_song_picpath='$row[2]' AND temp_song_filepath='$row[3]' AND temp_song_lyrics='$row[4]' AND temp_song_ID='$row[5]'";  //delete
			mysql_query($sql);
            echo "<script type='text/javascript'>alert('$sql');</script>";
           echo  '<meta http-equiv=REFRESH CONTENT=0;url=checkpage.php>';
        }
        showData($row,$i);
        $i++;
    }
    ?>

</body></html>