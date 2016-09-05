<?php
include 'mysqlconnect.php';

$select_query = "select p_id,url FROM Picture ORDER by p_id DESC";
$sql = mysql_query($select_query) or die(mysql_error());

while ($row = mysql_fetch_array($sql,MYSQL_BOTH)) {    
?>


				
				<a href="picture_view.php?p_id=<?php echo "$row[p_id]"; ?>" target=_blank><img class = "resize" src="<?php echo "$row[url]"; ?>" alt=""></a>
				


<?php
}
?>