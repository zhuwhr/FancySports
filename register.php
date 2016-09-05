<?php include "connectdb.php";?>
<!DOCTYPE html>
<html>

<head>
<title>FancySports | Signup</title>
<link href="css/site.css" rel="stylesheet">
</head>

<body>

<nav id="nav01"></nav>

<div id="main">
  <h1>FancySports</h1>

<?php
include "function.php";
$user_name=$password=$Email="";
$user_name_error=$password_error="";
$iserr=0;
//echo "here";
if(isset($_SESSION["user_name"]))
{
  echo "here";	
  echo "you have already logged in.\n";
  echo "you will be redirected in 1 seconds. or click <a href = \"index.php\">here</a>.";
  header("refresh:1; index.php");
}
else
{
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
            $Email="";
        }
        else
        {
            $Email = test_input($_POST["Email"]);
        }
    }
   if($iserr==0&&isset($_POST["user_name"])&&isset($_POST["password"]))
  {
    if($stmt = $mysqli->prepare("select user_name from User where user_name = ?"))
    {
      //echo "here3";
        $stmt->bind_param("s", $_POST["user_name"]);
        $stmt->execute();
        $stmt->bind_result($user_name);
        if($stmt->fetch())
        {
            echo "This username has already existed.<br>\n";
            echo "you will be directed in 3 seconds or click <a href = \"register.php\">here</a>.";
            header("refresh: 3; register.php");
            $stmt->close();
        }
        else
        {
            $stmt->close();
            if($stmt = $mysqli->prepare("insert into User(user_name,password,Email) value(?,?,?)"))
            {
                $stmt->bind_param("sss",$_POST["user_name"],$_POST["password"],$_POST["Email"]);
                $stmt->execute();
                $stmt->close();
                echo "register successfully";
                echo "you will be redirected in 1 seconds or click <a href = \"login.php\">here </a>";
                header("refresh:1; login.php");
            }
        }
    }
  }     


	echo '<p>please type your information</p>';
	echo '<form method="post" action="register.php">';
	echo  'USER NAME:<input type="text" name = "user_name">';
     	echo     '<span >* <?php echo $user_name_error;?></span>';
	echo 'PASSWORD:<input type = "text" name = "password" >';
        echo  '<span >* <?php echo $password_error;?></span>';
	echo 'EMAIL:<input type = "text" name = "Email" >';
      	echo '<input type = "submit" name = "submit" value = "submit">';
	echo '</form>';

}
?>

<footer id="foot01"></footer>
</div>

<script src="script.js"></script>

</body>
</html> 














