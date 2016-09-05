<?php include "connectdb.php"; ?>
<!DOCTYPE html>
<html>

<head>
<title>Login</title>
<link href="css/site.css" rel="stylesheet">
</head>

<body>

<nav id="nav01"></nav>

<div id="main">
  <h1>FancySports</h1> 
  <h2>Make Progress Today!!!</h2>

<?php 
  //$_SESSION["user_name"] = '1';
  
if(isset($_SESSION["user_name"]))
{
  echo "you have successfully login \n";
  echo "you will be redirected in 1 seconds or click <a href = \"index.php\">here</a>. \n";
  header( "refresh: 1; index.php");
  
}
else
{
  if(isset($_POST["user_name"])&&isset($_POST["password"]))
  {   //echo "we are here1";
      $stmt=$mysqli->prepare( "select u_id, user_name,password from User where user_name = ? and password = ?" );
    
      //echo "we are here2";

      $stmt->bind_param("ss",$_POST["user_name"],$_POST["password"]);
      $stmt->execute();
      $stmt->bind_result($u_id,$user_name,$password);
      echo $u_id;
      if($stmt->fetch())
      {
        //echo "we are here3";
        $_SESSION["u_id"]=$u_id;
        echo "$u_id";
        $_SESSION["user_name"]= $user_name;
        $_SESSION["password"] = $password;
        $_SESSION["REMOTE_ADDR"] = $_SERVER["REMOTE_ADDR"];
        echo "login successfully \n";
        echo "you will be redirected in 1 seconds or click <a href=\"index.php\">here</a>.\n";
        header("refresh:1; index.php");
      }
      else
      {
        //echo "we are here4";
        sleep(1);
        echo "your username and password are not correct.\n";
        echo "click <a href = \"login.php\">here</a> to log in.\n";
        header("refresh:1;login.php");
      }
      $stmt->close();
      $mysqli->close();
  }
  else
  {
    //echo "we are here5";
    echo "enter you username , password below.\n";
    echo '<form action= "login.php" method="post">';
    echo '<input type="text" name="user_name" value=""><br>';
    echo '<input type="text" name="password" value=""><br>';
    echo '<input type="submit" name="submit" value="submit"><br>';
    echo '</form>';

  }
}

?>
  
<footer id="foot01"></footer>
</div>

<script src="script.js"></script>

</body>
</html> 

