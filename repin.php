<?php

include "connectdb.php";

$repinbid = $_POST["repinbid"];
//echo $repinbid;

if(isset($_SESSION["user_name"])){
	//echo "here";
	if ($stmt1 = $mysqli->prepare("SELECT p_id FROM Repin WHERE p_id = ? AND b_id = ?"))
	{
		
		$stmt1->bind_param("ii",$_SESSION["p_id"],$repinbid);
		$stmt1->execute();
		$stmt1->bind_result($a);
		
		if(!$stmt1->fetch()){ 
		
	
	if ($stmt = $mysqli->prepare("INSERT INTO `NewPictureShare`.`Repin` (`p_id`, `b_id`) VALUES (?, ?)"))
	{
		$stmt->bind_param("ii", $_SESSION["p_id"],$repinbid);
		$stmt->execute();
		//$stmt->bind_result();
		
		//if(!$stmt->fetch()){ echo "noting fetched";}
		//echo $_SESSION["u_id"];
		//echo $followbid;
		echo "Repin success";
		echo "<br>";
		
		$stmt->close();
		
		//header( "refresh: 1; index.php");
	}else{
		echo "query failed";
	}
	
	}else{
		echo "You already repinned the picture to your board";
	}
		$stmt1->close();
	}
	}
 

?>

<button onclick="goBack()">Go Back</button>

<script>
function goBack() {
    window.history.back();
}
</script>