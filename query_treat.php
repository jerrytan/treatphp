<?php

require_once('db_connect.php'); 

//$employee_id  = 55;
$treatment_id  = $_POST['tid'];


$sql = 'SELECT customer.id, customer.name,customer.age,customer.sex, customer.phone,customer.address,employee.name,employee.phone,
            treatment.start_date,treatment.end_date, treatment.hospital
                FROM customer, employee, treatment
                    WHERE customer.id = treatment.customer_id
                         AND employee.id = treatment.employee_id
                         AND treatment.id ="'.$treatment_id.'"';
	
//echo $sql;

$result = mysql_query($sql,$conn)
    or die('Error:' . mysql_error());
	
$num_rows = mysql_num_rows($result);
$i=0;
$notes= array();$note = array();
while($row=mysql_fetch_array($result))	{
	$note["customer.id"]=$row[0];
  	$note["customer.name"]=urlencode($row[1]);
    $note["customer.age"]=$row[2];
    $note["customer.sex"]=$row[3];

	$note["customer.phone"]=$row[4];
    $note["customer.address"]=urlencode($row[5]);
	$note["employee.name"]=urlencode($row[6]);
	$note["employee.phone"]=$row[7];
		
	$note["treatment.start_date"]=$row[8];
	$note["treatment.end_date"]=$row[9];
	$note["treatment.hospital"]=$row[10];
	
	$notes[$i++]=$note;
}

//echo urldecode(json_encode($notes));//转化成json之后再用urldecode解码为汉字
$result = array('Status'=>'OK','Count'=>$num_rows,
                'Treatment'=>$notes);
echo urldecode(json_encode($result));

mysql_close($conn);
?>
