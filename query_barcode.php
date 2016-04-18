<?php

require_once('db_connect.php'); 

$barcode   = $_POST['code']; 
//$barcode   = "000055009100"; 

//000030003100,000030003101,000030003102,000030003103
$customer_id = substr($barcode,0,6);
$treat_id = substr($barcode,6,4);
$status = substr($barcode,10,2);

switch($status) {
	case '00':
		$code_type = "customer_barcode";
		break;
	case '01':
		$code_type = "step1_barcode";
		break;
	case '02':
		$code_type = "step2_barcode";
		break;
	case '03':
		$code_type = "step3_barcode";
		break;
	case '04':
		$code_type = "step4_barcode";
		break;
	case '05':
		$code_type = "step5_barcode";
		break;
	case '06':
		$code_type = "step6_barcode";
		break;
	case '10':
		$code_type = "blood_barcode";
		break;
	case '11':
		$code_type = "drug1_barcode";
		break;
	case '12':
		$code_type = "drug2_barcode";
		break;
	case '13':
		$code_type = "drug3_barcode";
		break;
	case '14':
		$code_type = "drug4_barcode";
		break;
	case '15':
		$code_type = "drug5_barcode";
		break;
	case '16':
		$code_type = "drug6_barcode";
		break;
}


$sql = 'SELECT customer.name, customer.phone, treatment.start_date, treatment.end_date,customer.age,customer.sex
			FROM customer, treatment
				WHERE customer.id = treatment.customer_id
				AND treatment.id = '.$treat_id;
	
//echo $sql;

$result = mysql_query($sql,$conn)
    or die('Error:' . mysql_error());
$row = mysql_fetch_array($result);


$result = array('Status'=>'OK','Message'=>'barcode is ready','barcode'=>array('CustomerName'=>$row[0], 
  'CustomerPhone'=>$row[1],'Start'=>date_format(date_create($row[2]),'Y-m-d'),'End'=>date_format(date_create($row[3]),'Y-m-d'),'CodeType'=>$code_type,
  'CustomerAge'=>$row[4],'CustomerSex'=>$row[5]));
echo json_encode($result);

mysql_close($conn);

?>
