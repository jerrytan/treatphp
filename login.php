<?php

require_once('db_connect.php'); 

//$employee_name  = 'test';
$employee_name  = $_POST['name'];
if(empty($employee_name)) {
  die('Error: name is empty');
}

//$employee_phone = '123';
$employee_phone = $_POST['phone'];
if (empty($employee_phone)) {
  die('Error: phone is empty');
}

//$employee_phone = 'abcd1234';
$employee_password = $_POST['passwd'];
if (empty($employee_password)) {
  die('Error: passwd is empty');
}


$sql = 'select id from employee where name ="'.$employee_name.'" and phone = "'.$employee_phone.'" and password = "'.$employee_password.'"';

$res = mysql_query($sql,$conn);
$row = mysql_fetch_row($res);
if ($row != null) {
	$id = $row[0];
    $result = array('Status'=>'OK','Message'=>'1 record get','eid'=>$id);
}
else {
	$result = array('Status'=>'fail','Message'=>'not found','eid'=>$id);
}
echo json_encode($result);

mysql_close($conn);
?>
