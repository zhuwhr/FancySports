
<?php include "connectdb.php" ?>

<!DOCTYPE html>
<html>

<head>
    <title>Post <?php echo $_SESSION["title"] ?></title>
    <link href="css/site.css" rel="stylesheet">
</head>

<body>

<nav id="nav01"></nav>

<?php

$i = 0;
$content = $u_id = "";
if($_GET){
    $rid = $_GET['rid'];
    $_SESSION['rid'] = $rid;
}else{
    $rid = $_SESSION['rid'];
}

echo '<form method="post" action="message.php">';
echo 'Comments: <input type = "text" name = "message" >';
echo '<input type = "submit" name = "submit" value = "submit">';
echo '</form>';
if($_POST){
    if($stmt = $mysqli->prepare("insert into Message(send_id,receive_id,sender_name,content) value(?,?,?,?)")) {
        $stmt->bind_param("iiss",$_SESSION["u_id"], $_SESSION['rid'], $_SESSION['user_name'],$_POST["message"]);
        $stmt->execute();
        echo 'Your message has been sent.';
        $stmt->close();
    }
}

?>



<footer id="foot01"></footer>
</div>

<script src="script.js"></script>

</body>
</html>

