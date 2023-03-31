<?php
	function redirect_to($location = NULL)
    {
    	if ($location != NULL)
    	{
    		header("Location:{$location}");
    		exit;
    	}
    }

    function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed: " . mysql_error());
		}
	}

	function get_line_by_position($line_position) {
		global $connection;
		$query = "SELECT * ";
		$query .= "FROM content ";
		$query .= "WHERE position='" . $line_position ." '";
		$query .= "LIMIT 1";
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
		// REMEMBER:
		// if no rows are returned, fetch_array will return false
		if ($position = mysql_fetch_array($result_set)) {
			return $position;
		} else {
			return NULL;
		}
	}




// Function to be able to insert (') to data base through the form
	function mysql_prep($value)
    {
    	$magic_quotes_active = get_magic_quotes_gpc();
    	$new_enough_php= function_exists("mysql_real_escape_string");


    	if($new_enough_php){//for php 4.3 or higher
    		if($magic_quotes_active){$value=stripslashes($value);}
    		$value= mysql_real_escape_string($value);
    		}
    		else {//for php less than 4.3
    			if(!$magic_quotes_active){$value=addslashes($value);}
    			}
    			return $value;
    }



?>