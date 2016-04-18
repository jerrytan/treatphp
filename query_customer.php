<?php

require_once('db_connect.php'); 

//$employee_id  = 55;
$employee_id  = $_POST['eid'];


$sql = 'SELECT `id` , `name` , `age` , `phone` , `address` , `created_time` , `sex` , `comment` , `employee_id`
		FROM `customer` WHERE employee_id ='.$employee_id;
	
//echo $sql;

$result = mysql_query($sql,$conn)
    or die('Error:' . mysql_error());
	
$num_rows = mysql_num_rows($result);
$i=0;
$notes= array();$note = array();
while($row=mysql_fetch_array($result))	{
	$note["id"]=$row['id'];
  	$note["name"]=urlencode($row['name']);
    $note["age"]=$row['age'];
	$note["phone"]=$row['phone'];
    $note["address"]=urlencode($row['address']);
	$note["created_time"]=$row['created_time'];
  	$note["comment"]=urlencode($row['comment']);
    $note["sex"]=$row['sex'];
	$note["employee_id"]=$row['employee_id'];
    $notes[$i++]=$note;
}

//echo urldecode(json_encode($notes));//转化成json之后再用urldecode解码为汉字
$result = array('Status'=>'OK','Count'=>$num_rows,
                'Customer'=>$notes);
echo urldecode(json_encode($result));

mysql_close($conn);
?>
