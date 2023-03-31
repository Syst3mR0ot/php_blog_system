<?php
require_once("../include/connection.php");
include("../include/header.php");
?>

<?php
echo "<div id='wb_Text2' style='position:absolute;left:267px;top:102px;width:448px;height:623px;z-index:6' align='left'>";
echo "<h2>Add News</h2>
<form method ='POST' action ='../include/add_info.php'>
<b>News Head Line :</b> <input type ='text' name='subject'/> &nbsp;&nbsp;&nbsp;
<b>Position :</b><select name='position'>";
?>
<?php
for($get_id = 0; $get_id < 1 ; $get_id += 1)
 {
 // get row by using position number
 $get_content=mysql_query("SELECT * FROM content ORDER BY position ASC", $connection);
 /*get rows by using id Number
  $get_content=mysql_query("SELECT * FROM content WHERE id=$get_id", $connection);*/
	if(!$get_content)
			{
    die("database query failed: " . mysql_error());
			}
$row=mysql_num_rows($get_content);
	for($count=1; $count<=$row+1; $count++)
		{
	echo " <option value='{$count}'>{$count}</option>";
		}

 }
?>

<?php
echo "</select><br/>
<h4>News Content :</h4>
<textarea rows='8' cols='50' name='content'>
Add Your News Content Here...
</textarea></br>
<input type ='submit' value ='submit' />
</form>";
echo "</div>";
?>

<?php require("../include/footer.php");?>