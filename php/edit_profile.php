<?php include "connectdb.php";?>

<!DOCTYPE html>
<html>

<head>
<title>Edit profile</title>
<link href="css/site.css" rel="stylesheet">
</head>

<body>

<nav id="nav01"></nav>

<div id="main">
  <h1>FancySports</h1>

<?php
include "function.php";
$user_name=$password=$Email=$firstname=$lastname=$gender=$age=$city_of_residence=$address=$team_preference="";
$user_name_error=$password_error="";
$iserr=0;
//echo "here";

  if(count($_POST)!=0)
    {
        if(empty($_POST["user_name"]))
        {
            $user_name_error="user name is required.";
            $iserr=1;
        }
       
        else
        {
            $user_name = test_input($_POST["user_name"]);
        }
         //echo "here1";
        if(empty($_POST["password"]))
        {
            $password_error="passwod is required.";
            $iserr=1;
        }
        else
        {
            $password = test_input($_POST["password"]);
        }
        if(empty($_POST["Email"]))
        {
            $Email='';
        }
        else
        {
            $Email = test_input($_POST["Email"]);
        }
        if(empty($_POST["firstname"]))
        {
            $firstname="";
        }
        else
        {
            $firstname = test_input($_POST["firstname"]);
        }
        if(empty($_POST["lastname"]))
        {
            $lastname="";
        }
        else
        {
            $lastname = test_input($_POST["lastname"]);
        }
        if(empty($_POST["gender"]))
        {
            $gender="";
        }
        else
        {
            $gender = test_input($_POST["gender"]);
        }
        $age = test_input($_POST["age"]);
        $city_of_residence = test_input($_POST["city_of_residence"]);
        $address = test_input($_POST["address"]);
        $team_preference = test_input($_POST["team_preference"]);

    }
   if($iserr==0 && isset($_POST["user_name"]) && isset($_POST["password"])){
    //check if username already exists in database
    //echo "here2";
    if ($stmt = $mysqli->prepare("update User set user_name=?, password=?,Email=?, firstname=?, lastname=?, gender=?, age=?, city_of_residence=?, address=?, team_preference=? where u_id=?")){
//        echo "here3";
    $stmt->bind_param("ssssssisssi", $_POST["user_name"],$_POST["password"],$_POST["Email"],$_POST["firstname"],$_POST["lastname"],$_POST["gender"],$_POST["age"], $_POST["city_of_residence"], $_POST["address"], $_POST["team_preference"], $_SESSION['u_id']);
    $stmt->execute();
//    echo "abc";
    $stmt->close();
    header("refresh: 1; my_profile.php");
    }

  
}
?>
<p>please type your information</p>
<form method="post" action="edit_profile.php">
USER NAME:<input type="text" name = "user_name"  >
          <span >* <?php echo $user_name_error;?></span>
<?php echo "<br>";?>
PASSWORD:<input type = "text" name = "password" >
          <span >* <?php echo $password_error;?></span>
    <?php echo "<br>";?>
    EMAIL:<input type = "text" name = "Email" >
    <?php echo "<br>";?>
    firstname:<input type = "text" name = "firstname" >
    <?php echo "<br>";?>
    lastname:<input type = "text" name = "lastname" >
    <?php echo "<br>";?>
    gender:<input type = "text" name = "gender" >
    <?php echo "<br>";?>
    age:<input type = "text" name = "age" >
    <?php echo "<br>";?>
    city_of_residence:<input type = "text" name = "city_of_residence" >
    <?php echo "<br>";?>
    address:<input type = "text" name = "address" >
    <?php echo "<br>";?>
    team_preference:<input type = "text" name = "team_preference" >
    <?php echo "<br>";?>

      <input type = "submit" name = "submit" value = "submit">
</form>


<footer id="foot01"></footer>
</div>

<script src="script.js"></script>

</body>
</html> 


