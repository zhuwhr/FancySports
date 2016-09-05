<?php include "connectdb.php";

$mfriendid = $_GET["uid"];
//echo $friendid;

if(isset($_SESSION["user_name"])){
	if ($stmt1 = $mysqli->prepare("SELECT from_user FROM Friend WHERE from_user = ? AND to_user = ?"))
	{
		$stmt1->bind_param("ii", $_SESSION["u_id"],$mfriendid);
		$stmt1->execute();
		$stmt1->bind_result($a);
		
		if(!$stmt1->fetch()){ 
		
	
	if ($stmt = $mysqli->prepare("INSERT INTO `NewPictureShare`.`Friend` (`from_user`, `to_user`, yes) VALUES (?, ?, 0)"))
	{
		$stmt->bind_param("ii", $_SESSION["u_id"],$mfriendid);
		$stmt->execute();
		//$stmt->bind_result();
		
		//if(!$stmt->fetch()){ echo "noting fetched";}
		//echo $_SESSION["u_id"];
		//echo $followbid;
		echo "Request sent";
		echo "<br>";
		
		$stmt->close();
		
		//header( "refresh: 1; index.php");
	}else{
		echo "query failed";
	}
	
	}else{
		echo "You already sent the request";
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