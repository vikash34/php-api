<?php
//data sanitize
$app_name = filter_var ( $post['app_name'], FILTER_SANITIZE_STRING);
trim(filter_var ( $post['user_EmpId'], FILTER_SANITIZE_STRING)," ");

//return with function

function component_type_info($conn)
{

$string = "SELECT `type`FROM `master_salary_components_type` WHERE 1";
$query = mysqli_query($conn,$string);
if ($query) {
	while ($row = mysqli_fetch_assoc($query)) {
		$data[] = $row;
	}
	return json_encode($data);
}
}

//array withinn an array

   $ssqlStudent="SELECT distinct `sname`,`sclass`,`srollno`,`sadmission`,`sfathername` FROM `student_master`";
    $rsStudent= mysql_query($ssqlStudent);
  while ($row = mysql_fetch_assoc($rsStudent)) {
    $data[] = $row;
}
  echo  json_encode(array("status"=>true,'info'=>$data));


  //combinne_array with array_merge

function master_employee($conn)
{
     if (isset($_POST['EmpId'])) 
   {
$EmpId = $_POST['EmpId'];
$plant_search = $_POST['plant_search'];


$q2 = mysqli_query($conn,"SELECT `me`.`emp_id`,`me`.`emp_name`,`me`.`emp_type`,`me`.`emp_designation`,`md`.`department_name`,`me`.`plant_code` FROM  `master_employee` as `me` left join `master_department` as `md` on (`md`.`department_code`=`me`.`emp_dept`) WHERE `me`.`emp_id` = '$EmpId' and `me`.`status`='Active' ");
$count = mysqli_num_rows($q2);
if ($count > 0) 
{
	
	while ($row = mysqli_fetch_assoc($q2)) 
	{

	    $data['EmployeeData']['emp_id'] = $row['emp_id'];
	     $data['EmployeeData']['emp_name'] = $row['emp_name'];
	    $data['EmployeeData']['emp_type'] = $row['emp_type'];
	    $data['EmployeeData']['emp_designation']  = $row['emp_designation'];
	    $data['EmployeeData']['emp_dept'] = $row['department_name'];
	    $plant_code = $row['plant_code'];

	}
 }
$q3 = mysqli_query($conn,"SELECT * FROM  `salary_employee_components` WHERE `emp_id` = '$EmpId' and  `status`='Active' and `c_id` IN (SELECT  `c_id` from `master_salary_components` where `status`='Active' and `c_type` IN ('Earning','Variable') )");
$count2 = mysqli_num_rows($q3);
if ($count2 > 0) 
{
	
	while ($row1 = mysqli_fetch_assoc($q3)) 
	{

		   $data1['earning'][]=$row1;
	}
	
}
else
{
	 $data1['earning'][]=array();
}
$q4 = mysqli_query($conn,"SELECT * FROM  `salary_employee_components` WHERE `emp_id` = '$EmpId' and  `status`='Active' and `c_id` IN (SELECT  `c_id` from `master_salary_components` where `status`='Active' and `c_type` IN ('Deduction') )");
$count3 = mysqli_num_rows($q4);
if ($count3 > 0) 
{
	
	while ($row2 = mysqli_fetch_assoc($q4)) 
	{

		   $data2['deduction'][]=$row2;
	

	}
	
}
else
{ 
	$data2['deduction'][]=array();

}
$q_component = mysqli_query($conn,"SELECT `c_id`,`c_name`,`c_desc` FROM  `master_salary_components` WHERE `status` = 'Active' and `c_type` IN ('Earning','Variable') and `plant_code`='$plant_code'");
$c_count = mysqli_num_rows($q_component);
if ($c_count > 0) 
{
	
	while ($row_component = mysqli_fetch_assoc($q_component)) 
	{

		$data3['earningComponents'][] = $row_component;

	}
 }
 else
{
	 $data3['earningComponents'][]=array();
}
$q_component1 = mysqli_query($conn,"SELECT `c_id`,`c_name`,`c_desc` FROM  `master_salary_components` WHERE `status` = 'Active' and `c_type` IN ('Deduction') and `plant_code`='$plant_code'");
$c_count1 = mysqli_num_rows($q_component1);
if ($c_count1 > 0) 
{
	
	while ($row_component1 = mysqli_fetch_assoc($q_component1)) 
	{

		$data4['deductionComponents'][] = $row_component1;

	}
 }
 else
{
	 $data4['deductionComponents'][]=array();
}

 $OverallData=array_merge($data,$data1,$data2,$data3,$data4);

	echo json_encode($OverallData);

}//select data for employee
}//function select data from master_employee


switch ($_POST) {


	case isset($_POST['addcountryid'])  && isset($_POST['addstatename']) && isset($_POST['addstatestatus']):

		salary_component_info($conn);

		break;

	case isset($_POST['add_c_name'])  && isset($_POST['add_c_desc']) && isset($_POST['add_c_type']):

		add_salary_component($conn);

		break;


	default: 

		# code...

		break;

}

?>

?>
