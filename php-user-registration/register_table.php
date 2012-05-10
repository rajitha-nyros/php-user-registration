<?php
	include("includes/db_register.php");

	 $reg_db = mysql_select_db($database);
	 /*
$user_register= "CREATE TABLE `register_users` (
					`user_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`user_name` VARCHAR( 30 ) NOT NULL,
					`user_email` VARCHAR( 30 ) NOT NULL,
					`user_password` VARCHAR( 30 ) NOT NULL,
					`user_age` INT( 11 ) NOT NULL ,
					`user_gender` VARCHAR( 30 ) NOT NULL,
					`user_address` VARCHAR( 30 ) NOT NULL,
					`user_city` VARCHAR( 30 ) NOT NULL,
					`user_country` VARCHAR( 30 ) NOT NULL,
					`user_language` VARCHAR( 30 ) NOT NULL,
					`user_image` VARCHAR( 30 ) NOT NULL
					)";
 
	$reg= mysql_query($user_register) or die(mysql_error());
	echo "Successfully added table! <strong>Now delete this file from your server.</strong>"; */
?>


