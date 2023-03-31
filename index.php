<?php
require_once("include/functions.php");
require_once("include/connection.php");
if (isset($_GET['line'])) {
			$sel_position = $_GET['line'];
		} else {
			$sel_position = NULL;
		}
$sel_line = get_line_by_position($sel_position);

include("include/header.php");
?>
<?php
echo "<div id='wb_Text2' style='position:absolute;left:267px;top:102px;width:448px;height:623px;z-index:6' align='left'>";


 // get row by using position number
 $get_content=mysql_query("SELECT * FROM content ORDER BY position ASC", $connection);
 /*get rows by using id Number
  $get_content=mysql_query("SELECT * FROM content WHERE id=$get_id", $connection);*/
if(!$get_content)
			{
    die("database query failed: " . mysql_error());
			}
while($row=mysql_fetch_array($get_content))
		{
echo "<font style='font-size:19px' color='#FF8000' face='Wingdings'>n</font>
<font style='font-size:8px' color='#FF6600' face='Wingdings'> </font>
<font style='font-size:16px' color='#000000' face='Tahoma'><b><a href='readnews.php?line=" . urlencode($row['position']). "'>" . strip_tags($row['subject']) . "</a></b></font><br>
<font style='font-size:13px' color='#000000' face='Tahoma'>" . strip_tags($row['content']) . "<br></font>
<font style='font-size:13px' color='#000000' face='Tahoma'>_____________________________________________________________<br><br>";
		}


echo"</div>";


?>

<?php require("include/footer.php");?>