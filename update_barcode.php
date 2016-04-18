<?php

require_once('db_connect.php'); 

$employee_id = $_POST['eid'];
$barcode   = $_POST['code']; 
//$barcode   = "000030003103"; 
//$customer_id = "30";

//000030003100,000030003101,000030003102,000030003103
$customer_id = (int)substr($barcode,0,6);
$treat_id = (int)substr($barcode,6,4);
$status = substr($barcode,10,2);
$sql ='';

switch($status) {
	case '00':
		$code_type = "customer_barcode";
        $sql = null;
		break;
	
	case '01':
		$code_type = "step1_barcode";
		$sql = 'update treat_record set step1_employee_id = '.$employee_id.' , step1_finish_time = now() where treat_id ='.$treat_id.'';
		break;
	
	case '02':
		$code_type = "step2_barcode";
		$sql = 'update treat_record set step2_employee_id = '.$employee_id.' , step2_finish_time = now() where treat_id ='.$treat_id.'';
		break;
		
	case '03':
		$code_type = "step3_barcode";
		$sql = 'update treat_record set step3_employee_id = '.$employee_id.' , step3_finish_time = now() where treat_id ='.$treat_id.'';
		break;
	
	case '04':
		$code_type = "step4_barcode";
		$sql = 'update treat_record set step4_employee_id = '.$employee_id.' , step4_finish_time = now() where treat_id ='.$treat_id.'';
		break;
	
	case '05':
		$code_type = "step5_barcode";
		$sql = 'update treat_record set step5_employee_id = '.$employee_id.' , step5_finish_time = now() where treat_id ='.$treat_id.'';
		break;
		
	case '06':
		$code_type = "step6_barcode";
		$sql = 'update treat_record set step6_employee_id = '.$employee_id.' , step6_finish_time = now() where treat_id ='.$treat_id.'';
		break;
		
	case '10':
		$code_type = "blood_barcode";
		$sql = 'update treat_record set blood_employee_id = '.$employee_id.' , blood_receive_time = now() where treat_id ='.$treat_id.'';
		break;
	
	case '11':
		$code_type = "drug1_barcode";
		$sql = 'update treat_record set drug1_employee_id = '.$employee_id.' , drug1_distribute_time = now() where treat_id ='.$treat_id.'';
		break;
	
	case '12':
		$code_type = "drug2_barcode";
		$sql = 'update treat_record set drug2_employee_id = '.$employee_id.' , drug2_distribute_time = now() where treat_id ='.$treat_id.'';
		break;
		
	case '13':
		$code_type = "drug3_barcode";
    	$sql = 'update treat_record set drug3_employee_id = '.$employee_id.' , drug3_distribute_time = now() where treat_id ='.$treat_id.'';
		break;
	
	case '14':
		$code_type = "drug4_barcode";
    	$sql = 'update treat_record set drug4_employee_id = '.$employee_id.' , drug4_distribute_time = now() where treat_id ='.$treat_id.'';
		break;
	
	case '15':
		$code_type = "drug5_barcode";
    	$sql = 'update treat_record set drug5_employee_id = '.$employee_id.' , drug5_distribute_time = now() where treat_id ='.$treat_id.'';
		break;
		
	case '16':
		$code_type = "drug6_barcode";
    	$sql = 'update treat_record set drug6_employee_id = '.$employee_id.' , drug6_distribute_time = now() where treat_id ='.$treat_id.'';
		break;
}


//echo $sql;
if ($sql !=null) {
	if (!mysql_query($sql,$conn)) {
    		die('Error: ' . mysql_error());
	}
}

$result = array('Status'=>'OK','Message'=>'barcode is updated','CodeType'=>$code_type);
echo json_encode($result);
?>
