<?php
// Make the page validate
ini_set('session.use_trans_sid', '0');

// Include the random string file
require 'rand.php';

// Begin the session
session_start();

// Set the session contents
$_SESSION['captcha_id'] = $str;

require 'src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  	'appId' => '**************',
    'secret' => '*************',
));

// Get User ID
$user = $facebook->getUser();

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me') ;
		
		 $birthday = $user_profile['birthday'];
		  
			//calculate years of age (input string:DD-MM- YYYY)
	function birthday($birthday){
	
			list($month,$day,$year) = explode("/",$birthday);
			$month_diff = date("m") - $month;
			$day_diff = date("d") - $day;
			$year_diff = date("Y") - $year;
			// If the birthday has not occured this year
			if ($day_diff < 0 || $month_diff < 0)
			  $year_diff--;
			return $year_diff;
			}
			
		$birth = birthday($birthday);
		//echo $birth;
		
		include('includes/db_register.php');

			$select =	mysql_select_db($database) or die(mysql_error());	
		
			$res = mysql_query("SELECT user_email FROM register_users WHERE user_email='$user_profile[email]'");
				
			$row= mysql_num_rows($res);
			
			if($row>0)
				{		
					 $quey = 	"UPDATE 
										register_users
									SET
										
										user_name = '" .$firstname. "',
										user_email ='" .$email. "',
										user_age ='" .$age. "',
										user_gender ='" .$sex. "',
										
									WHERE user_id = ".$user_id; 
										
					mysql_query($quey);
				}
			else{
				$query = "INSERT INTO register_users (user_name,user_age,user_gender, user_email) 
				VALUES ('$user_profile[first_name]','$birth','$user_profile[gender]','$user_profile[email]')";
				 mysql_query($query) or die(mysql_error());
				}			
 	} catch (FacebookApiException $e) {
				error_log($e);
				$user = null;
			  }  }
			   // print_r ($user_profile); 
				
	// Login or logout url will be needed depending on current user state.
	if ($user) {
	  $logoutUrl = $facebook->getLogoutUrl();
	} else {
		  	$loginUrl = $facebook->getLoginUrl(array(
			'scope' => 'email,user_birthday' //for getting permission to access email
	  	));
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration Form</title>

		<!--=======================css files=====================-->

<link href="includes/style/registration.css" rel="stylesheet" type="text/css" />

		<!--=======================script files=====================-->

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="includes/js/jquery.validate.js"></script>
</head>

    <body>
                                    <!--main start-->
        <div id="main">
                         <div class="col">
                         
              <div id="icon">
     			
                <?php if(!$user): ?>
                
                	 
                        <div id="header">
     						 
                             	<h1>Sign Up to Our Service</h1>
                                
							<?php 
                                    if($_GET['action'] == "success")
                            { ?>
                                     <h4 style="color:white;margin-top:10px;float:left;margin-left:100px;background-color:#4BC457; padding:10px;">You have registered successfully</h4>
                            <?php } ?>
                            
                             <?php 
                                    if($_GET['action'] == "failure")
                            { ?>
                                     <h4 style="color:#B94A48;margin-top:10px;float:left;margin-left:100px;background-color:#F2DEDE;padding:10px;">Email id already exists</h4>
                            <?php } ?>
                            
                            </div>
                       
       				 </div>
                           
                           </div>             
    		<div class="span9">
            
        						<!--registration from start-->
        
      		<form class="well form-inline" name="form" method="post"  action="register_user.php" enctype="multipart/form-data" >
           
                 	<label><h3>Create your Personal Account</h3></label><br />
                    
                    <hr />
                    
                                 <input type='hidden' name='submitted' id='submitted' value='1'/>
                                
                            	<!--textbox for firstname with validation-->
                       
                        <p class="field">
                            
                                <label  for="firstname">Firstname</label><label class="mandat"> *</label>:<br />
                                <input type="text" id="firstname" placeholder="firstname" maxlenght="50" name="firstname"/>
                                
                        	
                        </p>
                        
                        		<!--textbox for middle name no validation applied-->
   
                        <p class="field middle">
                        
                                <label  for="middlename">Middlename</label>:<br />
                                <input type="text" id="middlename" placeholder="middlename" maxlenght="50" name="middlename"/>
                            
                        </p>
                        
                        		<!--textbox for lastname  no validation applied-->
                        
                        <P class="field">
                        
                                <label  for="lastname">Lastname</label><label class="mandat"> *</label>:<br />
                                <input type="text" name="lastname" id="lastname" placeholder="lastname" size="15" maxlength="20"/>
                          
                        </P>
                        
                        		<!--textbox for email validation applies-->
                        
                        <P class="field email" >
                        
                                <label  for="email">Email</label><label class="mandat"> *</label>:<br />
                                <input  type="text" name="email" id="email" placeholder="email" size="15" />
                          
                        </P>
                        
                        		<!--textbox for password validation applies-->
                        
                        <P class="field password">
                        
                                <label id="lpassword" for="password">Password</label><label class="mandat"> *</label>:<br />
                                <input type="password" name="password" id="password" placeholder="password" maxlength="50" value="" />
                                
                           				 <!--password meter-->
                            
                               <div class="password-meter">
                                        <div class="password-meter-message">&nbsp;</div> 
                                            <div class="password-meter-bg">
                                              	<div class="password-meter-bar"></div>
                                            </div>
                               </div>
                                        
                        </P>
                        
                        			<!--textbox for confirming password validation applies-->
                     
                        <P class="field confirm">
                        
                                <label  for="confirm_password">Confirm Password</label><label class="mandat"> *</label> :<br />
                                <input id="confirm_password" name="confirm_password" placeholder="confirm password" type="password" maxlength="50" value="" />
                                
                        </P>
                        
                        			<!--textbox for age validation applies-->
                        
                        <P class="field" >
                            
                                <label for="age" class="age1">Age</label>:<br /> 
                                <input type="text" name="age" id="age" placeholder="enter age" /><br />
                               
                        </P>
                        
                        			<!--textbox for radio buttons-->
                       
                        <P class="field sex">
                        
                                <label id="sex" for="sex">Gender</label> :<br /> 
                                <input type="radio" name="sex" id="male" value="Male" /> male
                                <input type ="radio" name="sex" id="Female" value="Female" checked/> female
                                
                       </P>
                       
                       				<!--textarea for address no validation applies-->
                
                       <P class="field area">
                        
                                <label id="area" for="area">Address</label>:<br />
                                <textarea  name="area" id="area" placeholder="enter address" ></textarea>

                       </P>
                       
                       				<!--single combo for city no validation applies -->
    
                       <P class="field city" >
                        
                        	<label for="city" id="city">City</label>:<br />
                                <select name="city" value="">
                                	   <option value="-select-one-" selected="selected">-select-one-</option>
                                      <option value="Vishkapatnam">Vishkapatnam</option>
                                      <option value="Hyderabad">Hyderabad</option>
                                      <option value="Guntur">Guntur</option>
                                      <option value="Vijayawada">Vijayawada</option>
                                      <option value="Nalgonda">Nalgonda</option>
                                      <option value="Warangal">Warangal</option>
                                      <option value="Nizamabad">Nizamabad</option>
                                      <option value="kurnool">kurnool</option>
                                      <option value="Medak">Medak</option>
                                      <option value="Nellor">Nellor</option>
                                      <option value="Kakinada">Kakinada</option>
                                </select>
                    			
                        </P>
                        
                        		<!--single combo for country no validation applies-->
             
                        <P class="field place" >
                        
                        	<label id="country" for="country">Country</label>:<br />
								<select name="country">
                                      <option value="-select-one-" selected="selected">-select-one-</option>
                                      <option value="India">India</option>
                                      <option value="Africa">Africa</option>
                                      <option value="Japan">Japan</option>
                                      <option value="Australia">Australia</option>
                                      <option value="America">America</option>
                                      <option value="Russia">Russia</option>
                                      <option value="Germany">Germany</option>
                                      <option value="Nepal">Nepal</option>
                                      <option value="China">China</option>
                                      <option value="Malasiya">Malasiya</option>
                                      <option value="Indonesia">Indonesia	</option>
                                </select>
                    			
                        </P>
                        
                        		<!--textbox for phone entry vadation applies-->
  
                      <P class="field phone1">
                        
                            <label  for="phone">Phone</label><label class="mandat"> *</label> :<br /> 
                            <input id="phone" maxlength="14" name="phone" placeholder="mobile number" type="text" class="required phone" tabindex="10" value=
                            "" />
                            
 					  </P>
                      
                      		<!--multi combo for language no validation applies-->
      
                      <P class="field Language" >
                        
                        	<label id="Language" for="Language">Language Know</label> :<br /> 
                                <select  multiple="multiple" name="language[]">
                                  <option value="-Select-one-">-Select-one-</option>
                                  <option value="British English">British English</option>
                                  <option value="Telugu">Telugu</option>
                                  <option value="Hindi">Hindi</option>
                                  <option value="Urdu">Urdu</option>
                                  <option value="Tamil">Tamil</option>
                                  <option value="Malayalam">Malayalam</option>
                                  <option value="Marati">Marati</option>
                                  <option value="Odiya">Odiya</option>
                                  <option value="Latin English">Latin English</option>
                                  <option value="French">French</option>
                                  <option value="Thulu">Thulu</option>
                                </select>
                     
                     </P>
                     
                     			<!--image upload -->
                 
                     <P class="field upload">
                     		
                        	<label for="file">Image Upload </label> :<br />
                            <input type="file" name="file" id="file" />
                            <div id="progressbar-container" style="display:none;">  
                                <div id="progressbar">  
                                    <div id="progressbar-fill"></div>  
                                </div>  
                            </div> 
                           		
                     </P>
                     
                     <br />
                     
                      <p>
                    
                            <label for="newsletter" class="news">I'd like to receive the newsletter</label>
                            <input type="checkbox" class="checkbox" id="newsletter" name="newsletter" />
                       
					</p>
                    
        				<fieldset id="newsletter_topics" ><br />
                    
           			
           					 <span class="multi">Please select atleast one </span><br /><br />
                         
                            <label for="topic_marketflash" style="padding-bottom:40px;" class="news">
                            <input type="checkbox" id="topic_marketflash" value="marketflash" name="topic" />
                                Marketflash
                            </label><br />
                            
                            <label for="topic_fuzz" style="padding-bottom:40px;" class="news">
                            <input type="checkbox" id="topic_fuzz" value="fuzz" name="topic" />
                                Latest fuzz
                            </label><br />
                            
                            <label for="topic_digester" style="padding-bottom:40px;" class="news">
                            <input type="checkbox" id="topic_digester" value="digester" name="topic" />
                                Mailing list digester
                            </label>
                            
					</fieldset>
	
    								<!--multi select checkbox end-->
                                    
                     
                     		<!--captcha verification -->
              
                	 <p>
                     		<label for="captcha" class="cap">Enter the characters as in the image below(case insensitive):<br /></
                            label>
                     		<div id="captchaimage"> <input type="text" maxlength="6" name="captcha" id="captcha" style="width:50px;height:30px; margin-left:20px;"/><a href="" id="refreshimg" title="Click to refresh image"><img src="includes/images/image.php"?<?php echo time(); ?> alt="Captcha image" style="width:110px; height:46px; margin-left:10px;" /></a></div>
                       
               		 </p>
                     
                 			
                            <!--checkbox for agree terms validation applies-->
              	
                    <p>
                    
                            <label for="agree" class="agree1" >Please agree to our policy</label>
                            <input type="checkbox" class="checkbox" id="agree" name="agree" />
                        
                    </p>
                           	 
                           	<!--single select checkbox activates multiple checkbox validation applies-->
                        
                   
                                    <!--textbox for submit-->
    							
                    <p class="field">
                        
                           <input type="submit" class="btn createaccount submit" name="submit"  value="Create Account" >
                            
                    </p>
              
      		</form>
            		
                    				<!--registration form end-->
          	 </div>
             
             			<!--facebook user profile-->
             
       <?php endif ?>   
       
          	  <?php if ($user): ?>
              	<a href="<?php echo $logoutUrl; ?>" style="margin-right:900px; margin-top:20px;"><b>LOG OUT</b></a>
              	<h3 style="margin-left:30px; margin-top:20px;">We Welcome You</h3>
              	<img src="https://graph.facebook.com/<?php echo $user; ?>/picture" style="margin-left:30px; margin-bottom:30px;">
             <?php echo('<fb:login-button perms="email,user_birthday,publish_stream,user_status"></fb:login-button>');
     	?>
					
                    			<!--logout for facebook login user-->
                        
            	<?php	session_destroy(); 
            
            else: ?>
            
            		
            				<!-- or login with facebook -->
          
          	<div id="right_panel" >
            
            	<a href="<?php echo $loginUrl; ?>"><img src="includes/images/facebook-connect.png" width="300px" alt=""/></a>
       				
                    		<div id="or" >
                            
                    ________________________________<strong><i>Or</i></strong>________________________________________________
                            </div>
            
           </div>		
          
            <?php endif ?>
            <div class="col" style="border-top:2px solid #ccc;">
            
            </div>
           
    </div> 
   									<!--main ends-->
  </body>
    
</html>
