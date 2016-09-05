<!DOCTYPE html>
<html>

<head>
<title>FancySports</title>
<link href="css/site.css" rel="stylesheet">
</head>

<body>

<nav id="nav01"></nav>
<script src="script.js"></script>


<div id="main">
  <h1>FancySports</h1>
  <h2>WELCOME!!!!!!</h2>
  
  
  <p>Weclome   <?php include "connectdb.php"; if(isset($_SESSION["user_name"])) { echo $_SESSION["user_name"];} ?></p> 
  <p>See the world at PictureShare</p>

<?php 

  // if(isset($_POST["user_name"]) && isset($_POST["password"]))
  // {   //echo "we are here1";
	$u_id = $title = $visibility = '';
      if ($stmt=$mysqli->prepare( "select title, u_id, visibility from post order by publishtime" )){
      // $stmt->bind_param("sii",$_POST["user_name"],$_POST["password"]);
      $stmt->execute();
      $stmt->bind_result($title,$u_id,$visibility);
      while ($stmt->fetch()) {
      	if ($visibility == 1) {
      		echo '<a href="mypost_view.php?title='.htmlspecialchars($title)."\" target=_blank>$title</a>  ";
	    } else if ($visibility == 2) {

	    	$mysqli2 = new mysqli("localhost","root","root");
			if (!$mysqli2) {
        	echo 'Unable to connect to database';
    		}
    		mysqli_select_db($mysqli2, 'FancySportsLOL');

	      	if ($stmt3 = $mysqli2->prepare(
	      			"select to_user from Friend where from_user = ? and to_user in (select to_user from Friend where from_user = ?)" )){
	      		$stmt3->bind_param("ii", $_SESSION['u_id'], $u_id);
	      		$stmt3->execute();
	      		if($stmt3->fetch()) {
	      			echo '<a href="mypost_view.php?title='.htmlspecialchars($title)."\" target=_blank>$title</a>  ";
	      		}
	      	}

	    } else if ($visibility == 3) {
	    	$mysqli3 = new mysqli("localhost","root","root");
			if (!$mysqli3) {
        	echo 'Unable to connect to database';
    		}
    		mysqli_select_db($mysqli3, 'FancySportsLOL');

	      	if ($stmt2 = $mysqli3->prepare("select * from Friend where from_user = ? and to_user = ?")) {
	      		$stmt2->bind_param("ii", $u_id, $_SESSION['u_id']);
	      		$stmt2->execute();
	      		if($stmt2->fetch()) {
	      			echo '<a href="mypost_view.php?title='.htmlspecialchars($title)."\" target=_blank>$title</a>  ";
	      		}
	      		$stmt2->close();
	      	  }
      		}
      }
	  $stmt->close();
	}
?>
  
  <!-- IN (select * from (select to_user from Friend where from_user = ?) and (select from_user from Friend where to_user = ?))" -->

  <!-- join () -->
    



<footer id="foot01"></footer>
</div>

<script src="script.js"></script>

</body>
</html> 