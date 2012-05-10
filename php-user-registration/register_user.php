<?php
	/*session_start();
	
	if(!isset($_SESSION['userid']))
	{
		@header('Location:index.php');
	}*/
	
				include("includes/db_register.php"); // database connection
				
					//database selection
				
				$select = mysql_select_db($database) or die(mysql_error());	
				
				if(isset($_POST['update']) && ($_POST['update'])== "update")
				{
				
						//update query to change already entered values
					extract($_POST);
					
					 $quey = 	"UPDATE 
										register_users
									SET
										
										user_name = '" .$firstname. "',
										user_email ='" .$email. "',
										user_age ='" .$age. "',
										user_gender ='" .$sex. "',
										user_address ='" .$area. "',
										user_city ='" .$city. "',
										user_country ='" .$country. "',
										user_image ='" .$file. "'
									WHERE user_id = ".$user_id; 
										
					mysql_query($quey);
					
					@header('Location:register_user.php');	
				}
	if(isset($_POST['submit']) &&( $_POST['submit'])=="Create Account") {
	 
				$user_name=$_POST['firstname'];
				$user_email=$_POST['email'];
				$user_password=$_POST['password'];
				$user_age=$_POST['age'];
				$user_gender=$_POST['sex'];
				$user_address=$_POST['area'];
				$user_city=$_POST['city'];
				$user_country=$_POST['country'];
				$user_language=$_POST['language'];
				$image= $_FILES['file']['name'];
				
				$comma_separated=$_POST['language'];
				$user_language = implode(",", $user_language);
				
					$dbunames = mysql_query("SELECT * FROM register_users WHERE user_email='".$user_email."'");
				    if(mysql_num_rows($dbunames) > 0 ) { //check if there is already an entry for that username
					@header('location:index.php?action=failure');
					} 
					else{						//insert query that we enter from form
			  $adduser = "INSERT INTO register_users (user_name, user_email, user_password,user_age,user_gender,user_address,user_city,user_country,user_language,user_image) 
				VALUES ('$user_name', '$user_email', '$user_password','$user_age','$user_gender','$user_address','$user_city','$user_country','$user_language','$image')"; 
				
				$ins_res = mysql_query($adduser) or die(mysql_error()); 
				}	
				if($ins_res)
				{
							
							@header('location:index.php?action=success');	
				//echo "<a href='register_user.php'>Back to main page</a>";
				
				}
				else{
							echo "ERROR";
				}
				
	}
				
	?>
      
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Users List</title>
</head>
<body>
                 
        								<!-- Footer ends -->
                                                   
</body>
</html>



