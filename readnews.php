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
echo $sel_line['content'];
echo"</div>";

?>

<?php require("include/footer.php");?>