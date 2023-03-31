<?php
require_once("../include/session.php");
require_once("../include/functions.php");
confirm_logged_in();
//after make sure this user is authorized start the folwing code but if not go to login page
include("../include/header.php");
?>

<?php
echo "<div id='wb_Text2' style='position:absolute;left:267px;top:102px;width:448px;height:623px;z-index:6' align='left'>";
echo "<h2>Control Panel</h2>";
echo "Welcome " . $_SESSION['username'] . "</br>";
echo "<a href='../user_logout.php'>logout</a>";
echo "</div>";
?>

<?php require("../include/footer.php");?>