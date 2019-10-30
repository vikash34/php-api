<?php 

include '../../connection.php';


$currentdate1=date("Y-m-d");

//USING SUM AND IF CONDITION 
$rsticketcount_1=mysql_query("SELECT distinct `cm`.`MasterClass`,SUM(IF( `a`.`attendance`='P', 1,0)), SUM(IF( `a`.`attendance` !='P', 1,0)) FROM `attendance` as `a` left join `class_master` as `cm` on (`a`.`sclass`=`cm`.`class`) where `sclass` in (select distinct`class`  from `class_master` ) and `a`.`attendancedate`='$currentdate1' GROUP BY `cm`.`MasterClass`");


//USING COUNT AND WHEN
$rsticketcount=mysql_query("SELECT distinct `cm`.`MasterClass`,COUNT(CASE WHEN `a`.`attendance`='P'THEN 1 END ), COUNT(CASE WHEN `a`.`attendance` !='P'THEN 1 END ) FROM `attendance` as `a` left join `class_master` as `cm` on (`a`.`sclass`=`cm`.`class`) where `sclass` in (select distinct`class`  from `class_master` ) and `a`.`attendancedate`='$currentdate1' GROUP BY `cm`.`MasterClass`");


	while ($rowdata = mysql_fetch_row($rsticketcount))
	{

	   $background_colors = array('#FF0F00', '#FF6600', '#FF9E01', '#FCD202', '#F8FF01','#B0DE09','#04D215','#0D8ECF','#0D52D1','#2A0CD0','#8A0CCF','#754DEB');	
	   $count = count($background_colors) - 1;
	   $i = rand(0, $count);
	   $rand_background = $background_colors[$i];

	   $background_colors1 = array('#FF0F00', '#FF6600', '#FF9E01', '#FCD202', '#F8FF01','#B0DE09','#04D215','#0D8ECF','#0D52D1','#2A0CD0','#8A0CCF','#754DEB');	
	   $count1 = count($background_colors1) - 1;
	   $i1 = rand(0, $count1);
	   $rand_background1 = $background_colors1[$i1];

	    $CLASS = $rowdata[0];
		$Present= $rowdata[1];
		$Absent= $rowdata[2];


		$data[] =array("Class"=>$CLASS,"Present"=> $Present,"Absent"=> $Absent,"color"=> $rand_background,"color1"=> $rand_background1);
	}
	
	echo json_encode($data);

?>