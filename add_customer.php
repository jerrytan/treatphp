<?php
require_once('db_connect.php'); 

//$customer_name  = 'name';
$customer_name= $_POST['name'];

//$customer_phone = 'phone';
$customer_phone = $_POST['phone'];

//$customer_age = '40';
$customer_age= $_POST['age'];

//$customer_sex = 'male';
$customer_sex = $_POST['sex'];

//$customer_address = 'beijing/beijing';
$customer_address = $_POST['address'];

//$customer_comment = 'a nice man';
$customer_comment = $_POST['comment'];

//$employee_id = '55';
$employee_id = $_POST['eid'];

$customer_id = $_POST['cid'];


$customer_created_time = date('Y-m-d H:i:s');

if ($customer_id ==null) {
    $sql = 'insert into customer(name,age,phone,sex,address,created_time,employee_id,comment) values ("'.$customer_name.'","'
           .$customer_age.'","'.$customer_phone.'","'.$customer_sex.'","'.$customer_address.
	      '","'.$customer_created_time.'","'.$employee_id.'","'.$customer_comment.'")';
}
else {
	$sql = 'update customer set name ="'.$customer_name.'", age = "'.$customer_age.'", phone ="'.$customer_phone.'", sex = "'.$customer_sex.
	       '", address = "'.$customer_address.'", comment="'.$customer_comment.'", modified_time ="'.$customer_created_time.'" where id='.$customer_id;
	
}
//echo $sql;

if (!mysql_query($sql,$conn)) {
    die('Error: ' . mysql_error());
}

if ($customer_id ==null) {

	$sql = 'select id from customer where name ="'.$customer_name.'" and phone = "'.$customer_phone.'"'
		.' and created_time = "'.$customer_created_time.'"';
	$res = mysql_query($sql,$conn)
		or die('Error:' . mysql_error());
	$row = mysql_fetch_row($res);
	$id = $row[0];
}
else {
	$id = $customer_id;
}


$result = array('Status'=>'OK','Message'=>'1 record added','cid'=>$id);
echo json_encode($result);

mysql_close($conn);
?>
