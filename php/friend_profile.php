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
  <h2>HEYYYYYYYYY!</h2>

<?php include "connectdb.php";

$user_name = $password = $Email = "";
$isErr = 0;

if ($stmt = $mysqli->prepare("select user_name,  Email from User where u_id=?")){
	$stmt->bind_param("i", $_GET["u_id"]);
	$stmt->execute();
	$stmt->bind_result($user_name,$Email);
	if ($stmt->fetch())
	{
	}
	$stmt->close();
}
?>



<p> NAME     <?php echo $user_name;?> </p>
<p> EMAIL      <?php echo $Email;?> </p>





<footer id="foot01"></footer>
</div>

<script src="script.js"></script>

</body>
</html>
