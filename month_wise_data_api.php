<?php 

include '../../connection.php';

$rsticketcount=mysql_query("SELECT MONTHNAME(`systemdatetime`) AS Month,Ceil(sum(length(`message`))/160) FROM `sms_logs` where `sname` !='Admin' and mobileno !='0'  and mobileno !='' and `SMSCResponse` NOT LIKE '%fail%'group by date_format(`systemdatetime`,'%M-%Y') order by Date(`systemdatetime`)");
$data = array();
	while ($rowdata = mysql_fetch_row($rsticketcount))
	{
	   $background_colors = array('#FF0F00', '#FF6600', '#FF9E01', '#FCD202', '#F8FF01','#B0DE09','#04D215','#0D8ECF','#0D52D1','#2A0CD0','#8A0CCF','#754DEB','#DDDDDD');	
	   $count = count($background_colors) - 1;
	   $i = rand(0, $count);
	   $rand_background = $background_colors[$i];

	    $month =$rowdata[0];
		$count= $rowdata[1];
          
		$data[] =array("month"=>$month,"count"=> $count,"color"=> $rand_background);
	}

	$months=array('April','May','June','July','August','September','October','November','December','January','February','March');
		$counts=array('0','0','0','0','0','0','0','0','0','0','0','0');
		   $colors = array('#FF0F00', '#FF6600', '#FF9E01', '#FCD202', '#F8FF01','#B0DE09','#04D215','#0D8ECF','#0D52D1','#2A0CD0','#8A0CCF','#754DEB','#DDDDDD');	
$extra = array();
  for ($i=0; $i <sizeof($months) ; $i++) 
  { 
            $month= $months[$i];
            $count= $counts[$i];

             $cnt = count($colors) - 1;
	   $j = rand(0, $cnt);
	   $color = $colors[$j];

            $sample = array();
		foreach ($data as $key => $value) {
			if ($value['month'] == $month) {
					$sample = array("month"=>$value['month'],"count"=> $value['count'],"color"=> $value['color']);			
					break;
				}else{
					$sample = array("month"=>$month,"count"=> $count,"color"=> $color);
			}
		}

  		$extra[] =$sample;

  }
	echo json_encode($extra);

?>