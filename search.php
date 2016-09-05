<?php include "connectdb.php";
$u_id = 0;
$user_name = "";

if($stmt = $mysqli->prepare("select u_id, user_name from User where user_name like ?"))
	{
		if($stmt->bind_param("s",$_POST["keyword"]))
		{
			echo "";
		};
		if($stmt->execute())
		{
			echo "";
		};
		if($stmt->bind_result($u_id,$user_name))
		{
			echo "";
		};
		while($stmt->fetch())
		{
			echo '<br />';
			echo '<a href="friend_profile.php?u_id=';
			echo htmlspecialchars($u_id);
			echo "\" target=_blank>$user_name</a>";
			echo '<br />';
			echo '<a href="request.php?u_id=';
			echo htmlspecialchars($u_id);
			echo "\" target=_blank>request</a >";
			echo '<br />';
		}
	}

if($stmt = $mysqli->prepare("select title from post where title like ?"))
	{
		$title = '';
		if($stmt->bind_param("s",$_POST["keywordpost"]))
		{
			echo "";
		};
		if($stmt->execute())
		{
			echo "";
		};
		if($stmt->bind_result($title))
		{
			echo "";
		};
		while($stmt->fetch())
		{
			
		echo '<a href="mypost_view.php?title='.htmlspecialchars($title)."\" target=_blank>$title</a>  ";	

		}
	}
	
?>



<html>
	<title>search</title>
	
	<body>
		<form action = "search.php" method = "post">
			<input type = "text" name = "keyword" value = "" placeholder="search people">
			<input type = "submit" name = "submit" value = "submit">
		</form>
		<form action = "search.php" method = "post">
			<input type = "text" name = "keywordpost" value = "" placeholder="search post">
			<input type = "submit" name = "submit" value = "submit">
		</form>
	</body>
	
</html>