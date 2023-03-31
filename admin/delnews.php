<?php
require_once("../include/functions.php");
require_once("../include/connection.php");

		if(intval($_GET['line']==0))
		{
 		 redirect_to("../index.php");
		}

		$position=mysql_prep($_GET['line']);
		$query= "DELETE FROM content WHERE position ='{$position}' LIMIT 1";
		$result = mysql_query($query, $connection);
		if(mysql_affected_rows()==1)
		{			redirect_to("../index.php");		}else{echo "Deletion Process Faild";}

?>


<?php require("../include/footer.php");?>