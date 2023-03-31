<?php
require_once("../include/functions.php");
require_once("../include/connection.php");

// update code
			if (isset($_POST['submit'])) {
				$errors = array();
            // values validation code
			$required_fields = array('subject', 'content');
			foreach($required_fields as $fieldname) {
				if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
					$errors[] = $fieldname;
				}
			}
			$fields_with_lengths = array('subject' => 30, 'content'=> 300);
			foreach($fields_with_lengths as $fieldname => $maxlength ) {
				if (strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength) { $errors[] = $fieldname; }
			}
			// end of validation code

            // if no errors and code data is valid do the code below
			if (empty($errors))
			{

           		  	$position=mysql_prep($_GET['line']);
					$add_subject=mysql_prep($_POST['subject']);
					$add_content=mysql_prep($_POST['content']);
					$add_position=mysql_prep($_POST['position']);

                    $query = "UPDATE content SET
                    position = '{$add_position}',
                    subject = '{$add_subject}',
                    content = '{$add_content}'
                    WHERE position = {$add_position}";
                    $result = mysql_query($query, $connection);

	                if(mysql_affected_rows()==1)
                    {                    	$message= "Editing News Successfuly";
                    }else{                    	$message= "Editing News Faild";
                    	}
				}else{$message = "Check The Empty Fields"; }
		}
 //URL control and redirection
if (isset($_GET['line'])) {
			$sel_position = $_GET['line'];
		} else {
			$sel_position = NULL;
		}
		$sel_line = get_line_by_position($sel_position);
		if(intval($_GET['line']==0) || intval($_GET['line']!= $sel_line['position']))
		{
 		 redirect_to("../index.php");
		}


include("../include/header.php");
?>

<?php
// edit Form code
echo "<div id='wb_Text2' style='position:absolute;left:267px;top:102px;width:448px;height:623px;z-index:6' align='left'>";
echo $message;
echo "<h2>" . $sel_line['subject'] . "</h2>
<form method ='POST' action ='../admin/editnews.php?line=" . urlencode($sel_line['position']) . "'>
<b>News Head Line :</b> <input type ='text' name='subject' value='" . mysql_prep($sel_line['subject']) ."'/> &nbsp;&nbsp;&nbsp;

<b>Position :</b><select name='position'>";
 // get row by using position number
 $get_content=mysql_query("SELECT * FROM content ORDER BY position ASC", $connection);
 /* // get rows by using id Number
  $get_content=mysql_query("SELECT * FROM content WHERE id=$get_id", $connection);*/

$row=mysql_num_rows($get_content);
	for($count=1; $count<=$row+1; $count++)
		{

	echo "<option value=\"{$count}\"";
		if ($sel_line['position'] == $count)
				{
			echo " selected";
				}
			echo ">{$count}</option>";
		}

 echo"</select><br/>";

	/* // this code below show position number in editing page and position number + 1 in position menu.

	for($count=1; $count<=$sel_line['position']+1; $count++)
		{

		echo "<option value=\"{$count}\"";
		if ($sel_line['position'] == $count)
				{
			echo " selected";
				}
			echo ">{$count}</option>";
	 }
	 echo"</select><br/>";*/

	echo"<h4>News Content :</h4>
	<textarea rows='8' cols='50' name='content'>" . mysql_prep($sel_line['content']) . "</textarea></br>
	<input type ='submit' name ='submit' value ='submit' /> &nbsp;&nbsp;&nbsp;
	<a href='../admin/delnews.php?line=" . urlencode($sel_line['position']) . "'onclick=\"return confirm('are you sure?');\"> Delete </a>
	</form>";


 echo "</div>"; ?>


<?php require("../include/footer.php");?>