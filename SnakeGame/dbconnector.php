<?php
$mysql_hostname = "localhost";
//my-uofu-cs4540     

$mysql_user = "TA_Application";
$mysql_password = "626638918";
$mysql_database = "SnakeGame";
 

 $db = new PDO ( "mysql:host=$mysql_hostname;dbname=$mysql_dbname;charset=utf8", $mysql_user, $mysql_password );
 $db->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

 $db->setAttribute ( PDO::ATTR_EMULATE_PREPARES, false );


// $bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("db connect error");
// mysql_select_db($mysql_database, $bd) or die("db connect error");
?>