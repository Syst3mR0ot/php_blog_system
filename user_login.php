<?php
require_once("include/session.php");
require_once("include/functions.php");
require_once("include/connection.php");

	if (isset($_POST['submit'])) {
				$errors = array();
            // values validation code
			$required_fields = array('username', 'password');
			foreach($required_fields as $fieldname) {
				if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
					$errors[] = $fieldname;
				}
			}
			$fields_with_lengths = array('username' => 30, 'password'=> 30);
			foreach($fields_with_lengths as $fieldname => $maxlength ) {
				if (strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength) { $errors[] = $fieldname; }
			}
			// end of validation code
   			$username=trim(mysql_prep($_POST['username']));
			$password=trim(mysql_prep($_POST['password']));
			$hashed_password=sha1($password);
            // if no errors and code data is valid do the code below
			if (empty($errors))
			{

                    $query = "SELECT id, username From users
                    WHERE username ='{$username}'
                    AND hashed_password = '{$hashed_password}' LIMIT 1";
                    $result_set = mysql_query($query, $connection);
                    confirm_query($result_set);
                    if(mysql_num_rows($result_set)==1)
                    {   						$found_user=mysql_fetch_array($result_set);
   						$_SESSION['user_id']=$found_user['id'];
   						$_SESSION['username']=$found_user['username'];

   						redirect_to("../test/admin/control.php");                    }else{                    	$message ="Username Or Password is not correct";
                    	 }



			}elseif(count($errors)==1){$message = "Check The Empty Fields"; }
	}else{		if(isset($_GET['logout']) &&  $_GET['logout']==1)
			{				$message="You are now logout";			}	}

include("include/header.php");
?>
<?php
echo "<div id='wb_Text2' style='position:absolute;left:267px;top:102px;width:448px;height:623px;z-index:6' align='left'>";
echo $message;
echo "<form method ='POST' action ='../test/user_login.php'>
<h2>User Login</h2>
<b>User Name :</b> <input type ='text' name='username' maxlength='30' value='" . htmlentities($username) ."'/></br>
&nbsp;&nbsp;&nbsp;<b>Password :</b> <input type ='password' name='password' maxlength='30' value='" . htmlentities($password) ."'/></br></br>
<input type ='submit' name ='submit' value ='Login' />&nbsp;&nbsp;&nbsp;<a href='../test/index.php'>Cancel</a>
</form>

</div>";


?>

<?php require("include/footer.php");?>