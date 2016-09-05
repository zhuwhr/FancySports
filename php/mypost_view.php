<?php include "connectdb.php" ?>

<!DOCTYPE html>
<html>

<head>
<title>Post <?php echo $_SESSION["title"] ?></title>
<link href="css/site.css" rel="stylesheet">
</head>

<body>

<nav id="nav01"></nav>

<!---->
<!--<div id="main">-->
<!--	<div >-->
<!--       <h1>please select picture</h1>-->
<!--	</div>-->
<!--     <form action="upload_multimedia.php" method="post" enctype="multipart/form-data">-->
<!--                 <div >-->
<!--                 <input name="upload_file" type="file" size="200">-->
<!--                 <input name="Submit" type="submit" value="submit">-->
<!--                 </div>-->
<!--	 </form>-->


 <p>display posts</p>

<?php
if(isset($_GET['title'])){
	$title = $_GET["title"];
	$_SESSION['title'] = $title;
}else{
	$title = $_SESSION['title'];
}

$i = 0;



if(!empty($_POST["newcomments"])) {

	if ($stmt = $mysqli->prepare("insert into Comments(u_id, title, content) values (?,?,?)")) {
		$stmt->bind_param("iss", $_SESSION['u_id'], $_SESSION['title'], $_POST['newcomments']);
		$stmt->execute();
		// $stmt->close();
		echo "Thanks for your comments!";
	}
}

if(!empty($_POST["like"])) {

	if ($stmt = $mysqli->prepare("insert into LikePost(u_id, title) values (?,?)")) {
		$stmt->bind_param("is", $_SESSION['u_id'], $_SESSION['title']);
		$stmt->execute();
		// $stmt->close();
		echo "Thanks for your like!";
	}
}

if(!empty($_POST["dislike"])) {

	if ($stmt = $mysqli->prepare(" delete from LikePost where u_id = ? and title = ?")) {
		$stmt->bind_param("is", $_SESSION['u_id'], $_SESSION['title']);
		$stmt->execute();
		// $stmt->close();
		echo "What!!!";
	}
}


//echo "session".$_SESSION["b_id"];




if ($stmt = $mysqli->prepare("select title, description, location, visibility, url from post where title = ? order by publishtime DESC"))
{
	$stmt->bind_param("s",$title);
	$stmt->execute();
	$stmt->bind_result($title, $description, $location, $visibility, $url);
	while($stmt->fetch())
	{
		$i=$i+1;
		echo "<br>";
		echo $title;
		echo $description;
		echo $location;
		echo $visibility;
		if (!empty($url)) {
			echo "<img src=\"" . $url . "\">";
			//显示上传了的照片。
		}
		echo "<br>";
	}
	if($i==0)
		echo "you have no post right now.";
	
}

if ($stmt = $mysqli->prepare("select User.user_name, Comments.content from User, Comments,post where post.title = ? and post.title = Comments.title and Comments.u_id = User.u_id"))
	{
	$user_name = $content = '';
	$stmt->bind_param("s",$title);
	$stmt->execute();
	$stmt->bind_result($user_name, $content);
	while($stmt->fetch())
	{
		$i=$i+1;
		 echo "<img class = \"resize\" src=\"".$url."\">";
		echo "<br>";
		echo $user_name;
		echo $content;
		echo "<br>";
	}
	if($i==0)
		echo "you have no post right now.";
	}

?>
<!--<p>display photos repined in the board</p>-->

<?php
$title = $url ="";
$p_id = $b_id = 0;
//echo "here";
//if ($stmt = $mysqli->prepare("select Picture.title, Picture.url from Picture, Repin where Repin.p_id = Picture.p_id and Picture.b_id = ?"))
//
//{
//	//echo "here1";
//	$stmt->bind_param("i",$_SESSION["b_id"]);
//	$stmt->execute();
//	$stmt->bind_result($title,$url);
//	while($stmt->fetch())
//	{
//		$i=$i+1;
//		echo "<img class = \"resize\" src=\"".$url."\">";
//		echo "<br>";
//		echo $title;
//		echo "<br>";
//	}
//	if($i==0)
//		echo "you have no picture pinned right now.";
//
//}
	echo '<p>please type your comments:</p>';
	echo '<form method="post" action="mypost_view.php">';
	echo 'Comments: <input type = "text" name = "newcomments" >';
      	echo '<input type = "submit" name = "submit" value = "submit">';
	echo '</form>';

	if ($stmt = $mysqli->prepare("select * from LikePost where u_id = ? and title = ?")){
		$stmt->bind_param("is", $_SESSION["u_id"], $_SESSION["title"]);
		$stmt->execute();
		if ($stmt->fetch()){
			echo '<form method="post" action="mypost_view.php">';
      		echo '<input type = "submit" name = "dislike" value = "dislike">';
			echo '</form>';
		} else {
			echo '<form method="post" action="mypost_view.php">';
      		echo '<input type = "submit" name = "like" value = "like">';
			echo '</form>';

		}
	}

?>

<footer id="foot01"></footer>
</div>

<script src="script.js"></script>

</body>
</html> 

