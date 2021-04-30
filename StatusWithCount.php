<?php

public function GetProjectStatusCount(){
	
		$query 	= $this->db->query("SELECT distinct `cps`.`project_status` as name, count(*) as `y`,`cp`.`project_status` as id from `CPD_Project` as `cp` left join `CTC_Project_Status_M` as `cps` on (`cp`.`project_status`=`cps`.`proj_status_id`) where `cp`.`status`=1 group by `cp`.`project_status`");
		$res  	=  $query->result();
	
        return $res;
	}

?>
