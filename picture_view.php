<!DOCTYPE html>
<html>
	
<head>
<title>FancySports </title>
<link href="css/site.css" rel="stylesheet">
</head>

<body>

<nav id="nav01"></nav>

<div id="main">
  <h1>FancySports</h1>

<?php include "connectdb.php";
if(isset($_GET["p_id"])){
$pid = $_GET["p_id"];
$_SESSION["p_id"] = $pid;}
$uid = $title = $url = $user_name = '';


if(isset($_SESSION["user_name"])){
	if ($stmt = $mysqli->prepare("SELECT User.u_id, post.title, url, user_name FROM User, MultiMedia, post
								  WHERE MultiMedia.p_id = ? AND MultiMedia.title = post.title AND User.u_id = post.u_id "))
	{
		$stmt->bind_param("i", $pid);
		$stmt->execute();
		$stmt->bind_result($uid,$title,$url,$user_name);
		if($stmt->fetch()){
			//echo $url;
			//echo "<br>";
?>
	<br>
	<a href="like.php/?pid=<?php echo $pid; ?>">Like</a>
	<a href="follow.php/?bid=<?php echo $title; ?>">follow  <?php echo $title; ?></a>
	<a href="makefriend.php/?uid=<?php echo $uid; ?>">make friends with <?php echo $user_name; ?></a>

	<br>
	<img class="resize" src="<?php echo $url; ?>"  alt=""></div>
	<br>
	
	<form action = "newcomment.php" method = "post">
	<p>comment</p>
	<input type = "text" name = "content" value = "good">
	<input type = "submit" name = "submit" value = "submit">
	</form>
		
			
<?php
	
	include 'commentdisplay.php';		
		}
		
	}else{
		echo "query failed";
	}
}else{
	echo "Please log in first";
}
   
?>
	


  

