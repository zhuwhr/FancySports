<?php include "connectdb.php";?>
<?php
// $user_name = $content = "";
// if($stmt = $mysqli->prepare("select User.user_name, Comments.content from Comments,User where Comments.u_id = User.u_id and Comments.p_id = ?"))
//  {
// 	$stmt->bind_param("i",$_POST["p_id"]);
// 	$stmt->execute();
// 	$stmt->bind_result($user_name,$content);
// 	if($stmt->fetch())
// 	{
// 		echo $user_name." : ".$content;
// 	}
// }

$u_id = $p_id = 0;
$content = "";
if($stmt = $mysqli->prepare("insert into Comments(u_id,p_id,content) value(?,?,?)"))
{
	echo "here";
	echo $_POST["u_id"];
	echo $_POST["p_id"];
	echo $_POST["content"];
	$stmt->bind_param("iis",$_POST["u_id"],$_POST["p_id"],$_POST["content"]);
	$stmt->execute();
	while($stmt->fetch());
	$stmt->close();
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>comments</title>
</head>
<body>
<!-- <form action ="comments.php" method = "post">
<input type = "submit" name = "p_id" value = 1>
</form> -->
<form action = "comments.php" method = "post">

<input type = "number" name = "u_id" value = 1>
<input type = "number" name = "p_id" value = 1>
<input type = "text" name = "content" value = "good">
<input type = "submit" name = "submit" value = "submit">
</form>

</body>
</html>