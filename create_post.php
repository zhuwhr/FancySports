<?php include "connectdb.php";?>
<!DOCTYPE html>
<html>

<head>
<title>Createpost</title>
<link href="css/site.css" rel="stylesheet">
</head>

<body>

<nav id="nav01"></nav>

<div id="main">
  <h1>FancySports</h1> 
  <h2>Make Progress Today!</h2>

<?php
include "function.php";
$u_id = $title = $visibility = $description = $location = "";
$title_error = "";
$visibility_error = "";
$description_error = "";
$location_error = $upload_error = "";
$iserr = 0;

$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp"));

$city = $geo["geoplugin_city"];
$region = $geo["geoplugin_regionName"];
$country = $geo["geoplugin_countryName"];
$longitude = $geo["geoplugin_longitude"];
$latitude = $geo["geoplugin_latitude"];
$location = $city.$region.$country.$longitude.$latitude;

$dir = "upload/"; //create一个new folder 叫 upload, 但必须与photo.php, photo.html 同级
$tmp_name = $_FILES['upload_file']['tmp_name'];
$actual_name = $_FILES['upload_file']['name'];
$size =  $_FILES['upload_file']['size'];
$type =  $_FILES['upload_file']['type'];
$root = getcwd();
move_uploaded_file($tmp_name, $dir.$actual_name); //把上传的照片存到 upload folder 里

// show uploaded photo
$url = $dir.$actual_name;
echo $url;
// echo $_SESSION["title"];
echo "<img src=\"".$url."\">"; //显示上传了的照片。


 if(empty($_POST["title"]))
 {
 	$iserr = 1;
 	$title_error = "post title is empty";
 } else {
	$title = test_input($_POST["title"]);
 }

 if(empty($_POST["visibility"]))
 {
 	$iserr = 1;
 	$visibility_error_error = "visibility is empty";
 } else {
	$visibility = test_input($_POST["visibility"]);
 }

 if(empty($_POST["description"]))
 {
 	$iserr = 1;
 	$description_error = "description is empty";
 } else {
	$description = test_input($_POST["description"]);
 } 

 if(!empty($_POST["location"]))
 {
	$location = test_input($_POST["location"]);
 }
  if(empty($url))
  {
  	$iserr = 1;
  	$upload_error = "the upload file is empty";
  }
  else {
	 $url = test_input($url);
  }

if($iserr == 0 && isset($_POST["title"]))
{
	if ($stmt = $mysqli->prepare( "select title from post where title = ? and u_id = ?"))
	{
		$stmt->bind_param("si", $_POST["title"],$_SESSION["u_id"]);
		$stmt->execute();
		$stmt->bind_result($title);
		if($stmt->fetch())
		{
			echo "The title has exist in your account , please choose another name.<br>";
			echo " you will be redirected in 1 seconds or click <a href = \"create_post.php\">here</a>. <br>";
			header("refresh:1; create_post.php");
			$stmt->close();
		}
		else
		{
			$stmt->close();
			if($stmt = $mysqli->prepare("insert into post(title, u_id, visibility, description, location, url) value(?,?,?,?,?,?)"))
			{
				$stmt->bind_param("siisss",$_POST["title"],$_SESSION["u_id"],$_POST["visibility"], $_POST["description"], $location, $url);
				$stmt->execute();
				echo "you have successully created a post named".$title."<br>";
				echo "you will be redirected in 1 second or click <a href = \"mypost.php\">here</a>";
				header("refresh:1; mypost.php");

			}
		}
	}

}
?>

<form method = "post" action = "create_post.php" enctype="multipart/form-data">
<p>title</p>
<input type = "text" name = "title" value = "" placeholder= "Put your tilte here!">
<br>
<p>Visibility</p>
<input type = "text" name = "visibility" value = "" placeholder = "visibility here">
<br>
<p>description</p>
<input type = "text" name = "description" value = "" placeholder="leave your description here">
<br>
<p>Location</p>
<input type = "text" name = "location" value = "" placeholder="Enter or the current location">
<br>

	<?php
	echo"My current location";
	echo"<br></br>";
	// $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp"));

	// $city = $geo["geoplugin_city"];
	// $region = $geo["geoplugin_regionName"];
	// $country = $geo["geoplugin_countryName"];
	// $longitude = $geo["geoplugin_longitude"];
	// $latitude = $geo["geoplugin_latitude"];

	echo "City: ".$city."<br>";
	echo "Region: ".$region."<br>";
	echo "Country: ".$country."<br>";
	echo "Longtitude: ".$longitude."<br>";
	echo "Latitude: ".$latitude."<br>";
	?>
	<br>
	<a href="map.html"> View it on map</a>

	<input name="upload_file" type="file" size="200">

<input type = "submit" name = "submit" value = "create post">
</form>







<footer id="foot01"></footer>
</div>

<script src="script.js"></script>

</body>
</html> 