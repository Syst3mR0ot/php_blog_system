<?php require_once("../include/functions.php");?>
<?php
$add_subject=mysql_prep($_POST['subject']);
$add_content=mysql_prep($_POST['content']);
$add_position=$_POST['position'];
require_once("../include/connection.php");
include("../include/header.php");
?>

<?php
echo "<div id='wb_Text2' style='position:absolute;left:267px;top:102px;width:448px;height:623px;z-index:6' align='left'>";
$query = "REPLACE INTO content(id, position, subject, content) VALUES (null, '$add_position', '$add_subject', '$add_content')";

mysql_query($query)or die("query faild" . mysql_error());
print "News Added Successfuly";
echo"</div>";
?>

<?php require("include/footer.php");?>
