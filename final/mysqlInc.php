<?php
 
$db_server = "localhost";
$db_user = "root";
$db_passwd = "mr123";
$db_name = "final";
 
if(!@mysql_connect($db_server, $db_user, $db_passwd)){
        die("�L�k���Ʈw�s�u");
}
 
mysql_query("SET NAMES utf8");
 
if(!@mysql_select_db($db_name)){
        die("�L�k�ϥθ�Ʈw");
}
 
?>