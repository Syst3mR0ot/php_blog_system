<?php require_once("include/functions.php"); ?>
<?php
session_start();
$_SESSION=array();
if(isset($_COOKIE[session_name()]))
{
session_destroy();
redirect_to("../test/user_login.php?logout=1");
?>