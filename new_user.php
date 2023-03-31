<?php
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

            // if no errors and code data is valid do the code below
			if (empty($errors))
			{

           		  	$username=trim(mysql_prep($_POST['username']));
					$password=trim(mysql_prep($_POST['password']));
					$hashed_password=sha1($password);


                    $query = "INSERT INTO users ( username, hashed_password ) VALUES ( '{$username}', '{$hashed_password}')";
                    $result = mysql_query($query, $connection);

	                if(mysql_affected_rows()==1)
                    {
                    	$message= "User Created Successfuly";
                    }else{
                    	$message= "New User Creation Faild";
                    	}

			}else{$message = "Check The Empty Fields"; }
		}

include("include/header.php");
?>
<?php
echo "<div id='wb_Text2' style='position:absolute;left:267px;top:102px;width:448px;height:623px;z-index:6' align='left'>";
echo $message;
echo "<form method ='POST' action ='../test/new_user.php'>
<h2>Add New User</h2>
<b>User Name :</b> <input type ='text' name='username' maxlength='30' value='" . htmlentities($username) ."'/></br>
&nbsp;&nbsp;&nbsp;<b>Password :</b> <input type ='password' name='password' maxlength='30' value='" . htmlentities($password) ."'/></br></br>
<input type ='submit' name ='submit' value ='Creat User' />&nbsp;&nbsp;&nbsp;<a href='../test/index.php'>Cancel</a>
</form>

</div>";


?>

<?php require("include/footer.php");?>