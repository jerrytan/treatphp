<?php

$db_host = 'localhost';
$db_user = 'treat';
$db_pwd = 'treat123';
$database = 'treat';

$conn= mysql_connect($db_host, $db_user, $db_pwd);
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");

if (!$conn) {
    die("Can't connect to database");
}
else {
    //echo 'Connected successfully';
}

if (!mysql_select_db($database,$conn)) {
    die("Can't select database");
}


?>
