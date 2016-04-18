<?php

require_once('db_connect.php'); 

/*
$customer_id  = 123;
$employee_id = 321;
$treat_hospital = "beijing";
$treat_start_date = date('Y-m-d H:i:s',strtotime('2015-10-1'));
$treat_end_date = date('Y-m-d H:i:s',strtotime('2016-10-1'));
$treatment_id = 137;
*/

$customer_id  = $_POST['cid'];
$employee_id = $_POST['eid'];
$treatment_id = $_POST['tid'];
$treat_hospital = $_POST['hospital'];
$treat_start_date = date('Y-m-d H:i:s',strtotime($_POST['start']));
$treat_end_date = date('Y-m-d H:i:s',strtotime($_POST['end']));




$treat_created_time = date('Y-m-d H:i:s');

if ($treatment_id ==null) {
    $sql = 'insert into treatment(customer_id,employee_id,start_date,end_date,status,created_time,hospital) values ('.$customer_id.','
           .$employee_id.',"'.$treat_start_date.'","'.$treat_end_date.'","initial created","'.
	       $treat_created_time.'","'.$treat_hospital.'")';
	if (!mysql_query($sql,$conn)) {
		die('Error: ' . mysql_error());
	}
	$sql = 'select id from treatment where customer_id = "'.$customer_id.'" and employee_id ="'.$employee_id.
	       '" and start_date="'.$treat_start_date.'" and end_date = "'.$treat_end_date.'" and created_time ="'.$treat_created_time.'"';
	//echo $sql;
	$res = mysql_query($sql,$conn);
	$row = mysql_fetch_array($res);
	$treatment_id = $row[0];
	
}
else {
	$sql = 'update treatment set start_date ="'.$treat_start_date.'", end_date = "'.$treat_end_date.'", hospital ="'.$treat_hospital.'" where id='.$treatment_id;
	//echo $sql;
	if (!mysql_query($sql,$conn)) {
		die('Error: ' . mysql_error());
	}
}


$barcode_prefix = sprintf('%05d',$customer_id).sprintf('%05d',$treatment_id);
$customer_barcode = $barcode_prefix."00";
$step1_barcode = $barcode_prefix."01";
$step2_barcode = $barcode_prefix."02";
$step3_barcode = $barcode_prefix."03";

$step4_barcode = $barcode_prefix."04";
$step5_barcode = $barcode_prefix."05";
$step6_barcode = $barcode_prefix."06";

$blood_barcode =$barcode_prefix."10";
$drug1_barcode =$barcode_prefix."11";
$drug2_barcode =$barcode_prefix."12";
$drug3_barcode =$barcode_prefix."13";

$drug4_barcode =$barcode_prefix."14";
$drug5_barcode =$barcode_prefix."15";
$drug6_barcode =$barcode_prefix."16";

$insert_sql = 'insert into treat_record 
    (treat_id,customer_barcode,step1_barcode,step2_barcode,step3_barcode,step4_barcode,step5_barcode,step6_barcode,
	 blood_barcode, drug1_barcode,drug2_barcode,drug3_barcode,drug4_barcode,drug5_barcode,drug6_barcode) values ('
		.$treatment_id.',"'.$customer_barcode.'","'.
		$step1_barcode.'","'.$step2_barcode.'","'.$step3_barcode.'","'.$step4_barcode.'","'.$step5_barcode.'","'.$step6_barcode.'","'.
		$blood_barcode.'","'.
		$drug1_barcode.'","'.$drug2_barcode.'","'.$drug3_barcode.'","'.$drug4_barcode.'","'.$drug5_barcode.'","'.$drug6_barcode.'")';
	
//echo $insert_sql;
	
if (!mysql_query($insert_sql,$conn)) {
    //echo('Error: ' . mysql_error());
}


$result = array('Status'=>'OK','Message'=>'1 record added','tid'=>$treatment_id);
echo json_encode($result);

mysql_close($conn);
?>
