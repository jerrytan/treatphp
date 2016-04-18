<?php

require_once('db_connect.php'); 
$treat_id   = $_POST['tid']; 
//$treat_id   = 91;



$sql = "select step1_employee_id, step1_finish_time, step2_employee_id, step2_finish_time, step3_employee_id, step3_finish_time, \n"
	       . " step4_employee_id, step4_finish_time, step5_employee_id, step5_finish_time, step6_employee_id, step6_finish_time, \n"
		   . " drug1_employee_id, drug1_distribute_time, drug2_employee_id, drug2_distribute_time,drug3_employee_id, drug3_distribute_time, \n"
		   . " drug4_employee_id, drug4_distribute_time, drug5_employee_id, drug5_distribute_time,drug6_employee_id, drug6_distribute_time, \n"    
           . " blood_employee_id, blood_receive_time, customer.name as cname ,customer.phone as cphone ,employee.name as ename ,employee.phone as ephone,start_date,end_date,hospital \n"
           . " from treat_record, treatment, customer,employee where treat_record.treat_id = treatment.id and treatment.customer_id = customer.id and treatment.employee_id = employee.id and treat_id=  ".$treat_id;
//echo $sql;

$result = mysql_query($sql,$conn)
    or die('Error:' . mysql_error());
$row = mysql_fetch_array($result);



$sql1 = 'select name from employee where id = '.$row['step1_employee_id'];
$res1 = mysql_query($sql1,$conn);
$row1 = mysql_fetch_array($res1);
$step1_employee_name = $row1[0];

$sql1 = 'select name from employee where id = '.$row['step2_employee_id'];
$res1 = mysql_query($sql1,$conn);
$row1 = mysql_fetch_array($res1);
$step2_employee_name = $row1[0];

$sql1 = 'select name from employee where id = '.$row['step3_employee_id'];
$res1 = mysql_query($sql1,$conn);
$row1 = mysql_fetch_array($res1);
$step3_employee_name = $row1[0];

$sql1 = 'select name from employee where id = '.$row['step4_employee_id'];
$res1 = mysql_query($sql1,$conn);
$row1 = mysql_fetch_array($res1);
$step4_employee_name = $row1[0];

$sql1 = 'select name from employee where id = '.$row['step5_employee_id'];
$res1 = mysql_query($sql1,$conn);
$row1 = mysql_fetch_array($res1);
$step5_employee_name = $row1[0];

$sql1 = 'select name from employee where id = '.$row['step6_employee_id'];
$res1 = mysql_query($sql1,$conn);
$row1 = mysql_fetch_array($res1);
$step6_employee_name = $row1[0];

$sql1 = 'select name from employee where id = '.$row['drug1_employee_id'];
$res1 = mysql_query($sql1,$conn);
$row1 = mysql_fetch_array($res1);
$drug1_employee_name = $row1[0];

$sql1 = 'select name from employee where id = '.$row['drug2_employee_id'];
$res1 = mysql_query($sql1,$conn);
$row1 = mysql_fetch_array($res1);
$drug2_employee_name = $row1[0];

$sql1 = 'select name from employee where id = '.$row['drug3_employee_id'];
$res1 = mysql_query($sql1,$conn);
$row1 = mysql_fetch_array($res1);
$drug3_employee_name = $row1[0];

$sql1 = 'select name from employee where id = '.$row['drug4_employee_id'];
$res1 = mysql_query($sql1,$conn);
$row1 = mysql_fetch_array($res1);
$drug4_employee_name = $row1[0];

$sql1 = 'select name from employee where id = '.$row['drug5_employee_id'];
$res1 = mysql_query($sql1,$conn);
$row1 = mysql_fetch_array($res1);
$drug5_employee_name = $row1[0];

$sql1 = 'select name from employee where id = '.$row['drug6_employee_id'];
$res1 = mysql_query($sql1,$conn);
$row1 = mysql_fetch_array($res1);
$drug6_employee_name = $row1[0];


$sql1 = 'select name from employee where id = '.$row['blood_employee_id'];
$res1 = mysql_query($sql1,$conn);
$row1 = mysql_fetch_array($res1);
$blood_employee_name = $row1[0];


	
$note["treatment.start_date"]=date_format(date_create($row[8]),'Y-m-d');
$note["treatment.end_date"]=date_format(date_create($row[9]),'Y-m-d');




$result = array('Status'=>'OK','Message'=>'Info is ready','History'=>array('step1_employee'=>$step1_employee_name, 
  'step1_finish_time'=>$row['step1_finish_time'],'step2_employee'=>$step2_employee_name,'step2_finish_time'=>$row['step2_finish_time'],'step3_employee'=>$step3_employee_name,'step3_finish_time'=>$row['step3_finish_time'],
  'step4_employee'=>$step4_employee_name, 'step4_finish_time'=>$row['step4_finish_time'],'step5_employee'=>$step5_employee_name,'step5_finish_time'=>$row['step5_finish_time'],'step6_employee'=>$step6_employee_name,'step6_finish_time'=>$row['step6_finish_time'],
  'blood_employee'=>$blood_employee_name,'blood_receive_time'=>$row['blood_receive_time'],'drug1_employee'=>$drug1_employee_name,'drug1_distribute_time'=>$row['drug1_distribute_time'],
  'drug2_employee'=>$drug2_employee_name,'drug2_distribute_time'=>$row['drug2_distribute_time'],'drug3_employee'=>$drug3_employee_name,'drug3_distribute_time'=>$row['drug3_distribute_time'],
  'drug4_employee'=>$drug4_employee_name,'drug4_distribute_time'=>$row['drug4_distribute_time'],'drug5_employee'=>$drug5_employee_name,'drug5_distribute_time'=>$row['drug5_distribute_time'],'drug6_employee'=>$drug6_employee_name,'drug6_distribute_time'=>$row['drug6_distribute_time'],
  'customer.name'=>$row['cname'],'customer.phone'=>$row['cphone'],'employee.name'=>$row['ename'],'employee.phone'=>$row['ephone'],'start_date'=>date_format(date_create($row['start_date']),'Y-m-d'),'end_date'=>date_format(date_create($row['end_date']),'Y-m-d'),'hospital'=>$row['hospital']
  ));
  
echo json_encode($result);

mysql_close($conn);

?>
