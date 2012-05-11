README
=============


  1. INSTALLATION
  ******************************************
  
    Edit the file db_register.php in the includes folder and update the configuration information (with your host name, db username, db password ) 
    
    To create 'Users' Table: Uncomment the below block in the register_table.php file.
    
    To connect with facebook account directly, you need to replace the appId and secret as per your app created in https://www.facebook.com/developers/


-------------------------------------------
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
	echo "Successfully added table! <strong>Now delete this file from your server.</strong>"; */-------------------------------------------


  
  2. ABOUT THIS APPLICATION
  ******************************************
  
      This is a PHP application that allows you to:
      Create User Accounts by filling up the Registration form (with Captcha + JQuery Validations) or directly with Users Facebook Accounts.
      
  
  
  3.REQUIREMENTS
  ******************************************

    You must have PHP 5.0 or greater installed.
    CURL must be enabled.i.e., uncomment extension=php_curl.dll in php.ini file in xamp/php.



  4. WHAT THIS APPLICATION CONTAINS
  ******************************************
  
    Below is a list of files released as part of this build.
    
    index.php - file for registration form(in this registration form we have included all the basic html form elements like textbox , textarea , single combo , multi combo, Radio buttons, check box, file upload with progress bar,capctha) ,provided with respective JQurey validations and fconnect.
    
    register_user.php - In this file, we will insert the registered users into database.
    
    includes/style - this file contains all StyleSheets used to beautify our Application.
    
    includes/images - this file contains all relevant images included in this sample.
    
    includes/js - this file contains all js files that are included in the application.
    
    image_req.php,process.php,rand.php - these files are for captcha.
    
    src,with_js_sdk.php - these files contain the code for fconnect.
    
    font/Anorexia.ttf - font used for captcha.
  


  
  USAGE OF FACEBOOK CONNECT
  ******************************************
  require 'src/facebook.php';
  
  you need to  create your own app name and change the site url , canvas url and secure canvas url to your site url in edit settings in www.facebook.com/developers/.
  
  you need to replace the "appid" and "secret" with your appid and secret at https://www.facebook.com/developers/
   
        $facebook = new Facebook(array(
          'appId'  => 'YOUR_APP_ID',
          'secret' => 'YOUR_APP_SECRET',
        ));
  
     	 // Get User ID
      	$user = $facebook->getUser();
  
  To make [API][API] calls:

    	if ($user) {
         try {
           // Proceed knowing you have a logged in user who's authenticated.
           $user_profile = $facebook->api('/me');
         } catch (FacebookApiException $e) {
           error_log($e);
           $user = null;
          }
      }
  
  Login or logout url will be needed depending on current user state.
  
      	if ($user) {
        	$logoutUrl = $facebook->getLogoutUrl();
     	 } else {
        	$loginUrl = $facebook->getLoginUrl();
     	 }
  
  In order to keep us nimble and allow us to bring you new functionality, without
  	compromising on stability, we have ensured full test coverage of the application.
  	We are including this in the open source repository to assure you of our
  	commitment to quality, but also with the hopes that you will contribute back to
  	help keep it stable. 
  
  



