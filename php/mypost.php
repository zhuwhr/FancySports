<?php include "connectdb.php";?>
<!DOCTYPE html>
<html>

<head>
<title>Mypost</title>
<link href="css/site.css" rel="stylesheet">
</head>

<body>

<nav id="nav01"></nav>

<div id="main">
  <h1>FancySports</h1>
  <h2>See what you posted:</h2>
<a href = "create_post.php">create post</a>
<p>my post</p>
<br>
<?php 
$title = 0;
if ($stmt = $mysqli->prepare("select title from post where u_id = ? order by publishtime DESC"))
{
	$stmt->bind_param("i", $_SESSION["u_id"]);
	$stmt->execute();
	$stmt->bind_result($title);
	while($stmt->fetch())
	{
		echo '<a href="mypost_view.php?title='.htmlspecialchars($title)."\" target=_blank>$title</a>  ";	
	}
}
echo "<br>";
echo "this is your following <br>";

// if ($stmt = $mysqli->prepare("select title from post,Follow where post.title = post.u_id = ?"))
// {
// 	$stmt->bind_param("i", $_SESSION["u_id"]);
// 	$stmt->execute();
// 	$stmt->bind_result($title ,$title);
// 	while($stmt->fetch())
// 	{
// 		echo '<a href="post_view.php?title ='.htmlspecialchars($title )."\" target=_blank>$title</a>  ";	
// 	}
// }
?>

<footer id="foot01"></footer>
</div>

<script src="script.js"></script>

</body>
</html> 