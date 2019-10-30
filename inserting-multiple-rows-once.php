<?php 

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

if (!function_exists('connection')) { 

include_once '../connection.php';

 $conn = connection();

}

$data = $_REQUEST;

//test request data
$decode = $data;
$h = fopen('project.txt','w');
fwrite($h,json_encode($decode));
fclose($h);
//end of test request data


$query = "INSERT INTO `table`(`field_1`,`field_2`, `field_3`) VALUES ";

$query2 = '';

for ($i=0; $i < sizeof($decode['task']['proj_id']); $i++) { 

	$val_1 = $decode['val_1'];

	$val_2 = $decode['val_2'];

	$val_3 = $decode['val_3'];

$query2 .= " ('$val_1','$val_2','$val_3'),";

}//end of for 

$trimed_query = trim($query2,',');

$full_query=  $query ."". $trimed_query;



$fire = mysqli_query($conn,$full_query);



if (mysqli_affected_rows($conn) > 0) {

	echo json_encode(array('status'=>true,'info'=>'Your task updated successfully'));

}else{

	echo json_encode(array('status'=>false,'info'=>'Your task did not updated please try again'));

}



 ?>