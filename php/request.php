<!DOCTYPE html>
<html>

<head>
<title>FancySports</title>
<link href="css/site.css" rel="stylesheet">
</head>

<body>

<nav id="nav01"></nav>

<div id="main">
  <h1>FancySports</h1>

<?php include "connectdb.php";

$friendid = $_GET["u_id"];
//echo $friendid;
echo $friendid;
echo $_SESSION["u_id"];
$defaultState = 0;
if(isset($_SESSION["user_name"])){
	if($stmt = $mysqli->prepare("select * from Friend where from_user = ? and to_user = ?")){
		$stmt->bind_param("ii", $_SESSION["u_id"],$friendid);
		$stmt->execute();
		echo "wat";
		if(!$stmt->fetch()){
			echo "wat1";
			if ($stmt = $mysqli->prepare("insert into Friend(from_user,to_user,yes) value(?,?,?)"))
			{
				$stmt->bind_param("iii", $_SESSION["u_id"],$friendid,$defaultState);
				$stmt->execute();
				//$stmt->bind_result();
				
				if(!$stmt->fetch()){ 
				echo "You are requesting friends with ";
				echo $friendid;
				echo "<break>";
				
				$stmt->close();

				if ($stmt = $mysqli->prepare("insert into Friend(to_user,from_user,yes) value(?,?,?)")){
				$stmt->bind_param("iii", $_SESSION["u_id"],$friendid,$defaultState);
				$stmt->execute();
				$stmt->close();
				}
				
				header( "refresh: 1; friend.php");
				}else{
					echo "fails";
				}
			}else{
				echo "query failed";
			}
		}else{
			echo "<br />";
			echo "you have requested before";
		}
	}
	
}
 

?>

<footer id="foot01"></footer>
</div>

<script src="script.js"></script>

</body>
</html> 