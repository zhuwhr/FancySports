<?php include "connectdb.php";

$followbid = $_GET["bid"];
//echo $friendid;

if(isset($_SESSION["user_name"])){
	if ($stmt1 = $mysqli->prepare("SELECT u_id FROM Follow WHERE u_id = ? AND b_id = ?"))
	{
		$stmt1->bind_param("ii", $_SESSION["u_id"],$followbid);
		$stmt1->execute();
		$stmt1->bind_result($a);
		
		if(!$stmt1->fetch()){ 
		
	
	if ($stmt = $mysqli->prepare("INSERT INTO `NewPictureShare`.`Follow` (`u_id`, `b_id`) VALUES (?, ?)"))
	{
		$stmt->bind_param("ii", $_SESSION["u_id"],$followbid);
		$stmt->execute();
		//$stmt->bind_result();
		
		//if(!$stmt->fetch()){ echo "noting fetched";}
		//echo $_SESSION["u_id"];
		//echo $followbid;
		echo "You followed this board";
		echo "<br>";
		
		$stmt->close();
		
		//header( "refresh: 1; index.php");
	}else{
		echo "query failed";
	}
	
	}else{
		echo "You already followed this board";
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