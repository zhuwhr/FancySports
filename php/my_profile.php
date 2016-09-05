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
  <h2>Want to edit your profile? Here you go!</h2>

<?php include "connectdb.php";

$user_name = $password = $Email = "";
$isErr = 0;

if ($stmt = $mysqli->prepare("select user_name, password, Email, team_preference from User where u_id=?")){
	$stmt->bind_param("i", $_SESSION["u_id"]);
	$stmt->execute();
	$stmt->bind_result($user_name,$password,$Email, $team);
	if ($stmt->fetch())
	{
	}
	$stmt->close();
}
?>

<html>
<body>
<p> NAME     <?php echo $user_name;?> </p>
<p> EMAIL      <?php echo $Email;?> </p>
<p> FAVORITE TEAM:      <?php echo $team;?> </p>
<form method="post" action="edit_profile.php?u_id=<?php echo $_GET["u_id"] ?>">
        <input type="submit" name="edit_profile" value="edit profile" style="bold;font-size:20px;">
 </form>
</body>
</html>


<footer id="foot01"></footer>
</div>

<script src="script.js"></script>

</body>
</html>