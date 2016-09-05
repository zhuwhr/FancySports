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
  <h2>Look! How popular you are!</h2>

<?php include "connectdb.php";


if(isset($_SESSION["user_name"])){
	if ($stmt = $mysqli->prepare("(select u_id,user_name from User, Friend where from_user = ? and u_id = to_user and yes = 1)union
								(select u_id,user_name from User, Friend where from_user = u_id and to_user = ? and yes = 1)"))
	{
		$stmt->bind_param("ii", $_SESSION["u_id"],$_SESSION["u_id"]);
		$stmt->execute();
		$stmt->bind_result($u_id,$user_name);
		
		//if(!$stmt->fetch()){ echo "noting fetched";}
		echo "Friend list: <br>";
		while ($stmt->fetch())
		{
			echo $u_id." ".$user_name;
			echo '					<a href="unfriend.php?noid=';
			echo $u_id;
			echo '">Unfriend</a>';
			echo '<a href = "message.php?rid='.$u_id.'"> Send Message</a>';
			echo "<br>";
		}
		$stmt->close();
	}else{
		echo "query failed";
	}
	
	if ($stmt = $mysqli->prepare("select u_id,user_name from User, Friend where to_user = ? and u_id = from_user and yes = 0"))
	{
		$stmt->bind_param("i", $_SESSION["u_id"]);
		$stmt->execute();
		$stmt->bind_result($u_id,$user_name);
		
		//if(!$stmt->fetch()){ echo "noting fetched";}
		echo "Friend request: <br>";
		while ($stmt->fetch())
		{
			echo $u_id." ".$user_name;
			echo '					<a href="acceptrequest.php?yesid=';
			echo $u_id;
			echo '">Accept</a>';
			echo "<br>";
			
		}
		$stmt->close();
	}else{
		echo "query failed";
	}
	
}else{
	echo 'Please log first. Click <a href = "loginpage.php">here</a><br>';
	
}

if (isset($_SESSION['u_id'])) {
	$sender_name = $content = '';
	if ($stmt = $mysqli->prepare("select sender_name, content from Message where receive_id = ?")) {
		$stmt->bind_param("i", $_SESSION["u_id"]);
		$stmt->execute();
		$stmt->bind_result($sender_name, $content);
		while ($stmt->fetch()) {
			echo 'Your friend '.$sender_name.' sends you a message: '.$content.'.';
			}
		}
		$stmt->close();
}
?>

<footer id="foot01"></footer>
</div>

<script src="script.js"></script>

</body>
</html> 


