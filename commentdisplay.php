<?php include "connectdb.php";?>
<?php
 $user_name = $content = "";
 if($stmt = $mysqli->prepare("select User.user_name, Comments.content from Comments,User where Comments.u_id = User.u_id and Comments.p_id = ?"))
  {
 	$stmt->bind_param("i",$_SESSION["p_id"]);
 	$stmt->execute();
 	$stmt->bind_result($user_name,$content);
 	if($stmt->fetch())
 	{
 		echo $user_name." : ".$content; 	}
}
?>