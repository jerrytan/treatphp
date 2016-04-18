<?php

require_once('db_connect.php'); 

$treatment_id  = $_POST['tid'];
//$treatment_id  = 116;


$sql = 'SELECT customer_id 
                FROM  treatment
                    WHERE id = "'.$treatment_id.'"';
	
//echo $sql;

$result = mysql_query($sql,$conn)
    or die('Error:' . mysql_error());
$row = mysql_fetch_array($result);
$customer_id = $row[0];

$sql = "select treat_id, customer_barcode, step1_barcode,step2_barcode,step3_barcode,step4_barcode,step5_barcode,step6_barcode,"
               ."blood_barcode, drug1_barcode,drug2_barcode,drug3_barcode,drug4_barcode,drug5_barcode,drug6_barcode "
			   ." from treat_record where treat_id =  ".$treatment_id;
$result = mysql_query($sql,$conn)
    or die('Error:' . mysql_error());
$row = mysql_fetch_array($result);

$customer_barcode = $row['customer_barcode'];
$step1_barcode = $row['step1_barcode'];
$step2_barcode = $row['step2_barcode'];
$step3_barcode = $row['step3_barcode'];
$step4_barcode = $row['step4_barcode'];
$step5_barcode = $row['step5_barcode'];
$step6_barcode = $row['step6_barcode'];


$blood_barcode =$row['blood_barcode'];
$drug1_barcode =$row['drug1_barcode'];
$drug2_barcode =$row['drug2_barcode'];
$drug3_barcode =$row['drug3_barcode'];
$drug4_barcode =$row['drug4_barcode'];
$drug5_barcode =$row['drug5_barcode'];
$drug6_barcode =$row['drug6_barcode'];


$result = array('Status'=>'OK','Message'=>'barcode is ready','barcode'=>array('Customer'=>$customer_barcode, 
  'Step1'=>$step1_barcode,'Step2'=>$step2_barcode,'Step3'=>$step3_barcode,'Step4'=>$step4_barcode,'Step5'=>$step5_barcode,'Step6'=>$step6_barcode,
  'Blood'=>$blood_barcode,
  'Drug1'=>$drug1_barcode,'Drug2'=>$drug2_barcode,'Drug3'=>$drug3_barcode,'Drug4'=>$drug4_barcode,'Drug5'=>$drug5_barcode,'Drug6'=>$drug6_barcode));
echo json_encode($result);

mysql_close($conn);
?>
