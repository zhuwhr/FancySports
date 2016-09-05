<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
<title>Logout</title>
<link href="css/site.css" rel="stylesheet">
</head>

<body>

<nav id="nav01"></nav>

<div id="main">
  <h1>FancySports</h1>
  <h2>See you next time!</h2>

<?php
	session_destroy();
	echo "you are logged out.<br>";
	echo "you will be redirected in 3 seconds or click <a href = \"login.php\"> here </a>";
	header("refresh:3; login.php")
?>
</htlm>


<footer id="foot01"></footer>
</div>

<script src="script.js"></script>

</body>
</html> 