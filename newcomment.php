<?php include "connectdb.php";?>
<?php


$u_id = $p_id = 0;
$content = "";
if($stmt = $mysqli->prepare("insert into Comments(u_id,p_id,content) value(?,?,?)"))
{
	echo "here";
	echo $_SESSION["u_id"];
	echo $_SESSION["p_id"];
	echo $_POST["content"];
	$stmt->bind_param("iis",$_SESSION["u_id"],$_SESSION["p_id"],$_POST["content"]);
	if($stmt->execute()){echo "comment success"; header("refresh:1;index.php");};
	while($stmt->fetch());
	$stmt->close();
}
?>


