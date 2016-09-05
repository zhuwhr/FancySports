<!DOCTYPE html>
<html>

<head>
<title>PictureSharre</title>
<link href="css/site.css" rel="stylesheet">
</head>

<body>

<nav id="nav01"></nav>

<div id="main">
  <h1>FancySports</h1>

<?php include "connectdb.php";

$unfriendid = $_GET["noid"];
//echo $friendid;

if(isset($_SESSION["user_name"])){
	if ($stmt = $mysqli->prepare("DELETE FROM `FancySportsLOL`.`Friend` WHERE (`friend`.`from_user` = ? AND `friend`.`to_user` = ?)or
																				(`friend`.`from_user` = ? AND `friend`.`to_user` = ?)"))
	{
		$stmt->bind_param("iiii", $unfriendid,$_SESSION["u_id"],$_SESSION["u_id"],$unfriendid);
		$stmt->execute();
		//$stmt->bind_result();
		
		//if(!$stmt->fetch()){ echo "noting fetched";}
		echo "You are now NOT friend with ";
		echo $unfriendid;
		echo "<break>";
		
		$stmt->close();
		
		header( "refresh: 1; friend.php");
	}else{
		echo "query failed";
	}
}
 

?>

<footer id="foot01"></footer>
</div>

<script src="script.js"></script>

</body>
</html> 