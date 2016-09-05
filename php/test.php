<?php include "connectdb.php";

	if ($stmt2 = $mysqli->prepare("SELECT distinct b_id, b_name FROM Board WHERE  u_id = 1"))
	{
				
		$stmt2->execute();
		$stmt2->bind_result($bid,$bname);
		
		if($stmt2->fetchall()){
			echo $bid;
			echo $bname;
		}
	}
?>