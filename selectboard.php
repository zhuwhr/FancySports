<?php include "connectdb.php";


if(isset($_SESSION["user_name"])){
	if ($stmt2 = $mysqli->prepare("SELECT distinct b_id, b_name FROM Board WHERE  u_id = ?"))
	{
				
		$stmt2->bind_param("i", $_SESSION["u_id"]);
		$stmt2->execute();
		$stmt2->bind_result($bid,$bname);
?>

<form action="repin.php" method="post">
<select name="repinbid">
<?php
		
		while ($stmt2->fetch()){
			
			echo "<option value=\"".$bid."\">".$bname."</option>";
		}


	$stmt2->close();
	}
?>
</select>
	
<input type="submit" name="submit" value="submit" />
</form>

<?php
}else{
	echo "Please login first";
}
?>
 