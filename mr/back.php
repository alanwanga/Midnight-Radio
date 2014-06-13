<?
session_start();
include("mysqlInc.php");
if(isset($_POST['regist']) && $_POST['regist'] == '註冊')
{
	$acc = $_POST['acc'];
	$pwd = $_POST['pwd'];
	$pwd2 = $_POST['pwd2'];
	$acc = preg_replace("/[^A-Za-z0-9]/","", $acc);
	$pwd = preg_replace("/[^A-Za-z0-9]/","", $pwd);
	$pwd2 = preg_replace("/[^A-Za-z0-9]/","", $pwd2);
	if($acc == NULL || $pwd == NULL || $pwd2 == NULL)
	{
		echo '<script>alert("尚未填完");</script>';
	}
	else
	{
		$sql = "SELECT acc FROM user where acc = '$acc'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		if($row['acc'] != null)
		{
			echo '<script>alert("帳號已存在");</script>';
		}
		else
		{
			if($pwd != $pwd2)
			{
				echo '<script>alert("兩次密碼不相符");</script>';
			}
			else
			{				
				$pwd = md5($pwd);
				$sql = "INSERT INTO user (acc, pwd) VALUES ('$acc', '$pwd')";
				mysql_query($sql);
				$_SESSION['acc'] = $acc;
			}
		}
	}
}
elseif(isset($_POST['login']) && $_POST['login'] == '登入')
{
	$acc = $_POST['acc'];
	$pwd = $_POST['pwd'];
	$acc = preg_replace("/[^A-Za-z0-9]/","", $acc);
	$pwd = preg_replace("/[^A-Za-z0-9]/","", $pwd);
	if($acc == NULL || $pwd == NULL)
	{
		echo '<script>alert("尚未填完");</script>';
	}
	else
	{
		$sql = "SELECT acc, pwd FROM user where acc = '$acc'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		if($row['pwd'] != md5($pwd))
		{
			echo '<script>alert("密碼錯誤");</script>';	
		}
		else
		{
			$_SESSION['acc'] = $row['acc'];
		}
	}
}
elseif(isset($_POST['change']) && $_POST['change'] == '修改')
{
	$acc = $_SESSION["acc"];
	$pwd0 = $_POST['pwd0'];
	$pwd = $_POST['pwd'];
	$pwd2 = $_POST['pwd2'];
	$pwd0 = preg_replace("/[^A-Za-z0-9]/","", $pwd0);
	$pwd = preg_replace("/[^A-Za-z0-9]/","", $pwd);
	$pwd2 = preg_replace("/[^A-Za-z0-9]/","", $pwd2);
	if($pwd0 == NULL || $pwd == NULL || $pwd2 == NULL)
	{
		echo '<script>alert("尚未填完");</script>';
	}
	else
	{
		$sql = "SELECT pwd FROM user where acc = '$acc'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		if($row['pwd'] != md5($pwd0))
		{
			echo '<script>alert("原密碼錯誤");</script>';
		}
		else
		{
			if($pwd != $pwd2)
			{
				echo '<script>alert("兩次新密碼不相符");</script>';
			}
			else
			{				
				$pwd = md5($pwd);
				$sql = "UPDATE user SET pwd = '$pwd' WHERE acc = '$acc'";
				mysql_query($sql);
				echo '<script>alert("密碼已修改");</script>';
			}
		}
	}
}
echo '<meta http-equiv=REFRESH CONTENT=0;url=index.php>';
?>