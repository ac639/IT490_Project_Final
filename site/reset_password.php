<?php
	//ini_set('display_errors', 1);
	//ini_set('log_errors',1);
	//ini_set('error_log', dirname(__FILE__) . '../490auth_sys/login_auth.log');
	//error_reporting(E_ALL);

	session_start();
	include_once('../490_authsys/testRabbitMQClient2.php');
	
	$usrPassword = $_POST['usrPassword'];
	//echo "$usrPassword";
	$confirmPassword = $_POST['confirmPassword'];
	//echo "$confirmPassword";
	$usrEmail = $_POST['usrEmail'];
	//echo "$usrEmail";
	$response = passChange($usrPassword,$usrEmail);

	echo "$response";	
	//if ($password === $confirmPassword) {
	     if ($response == true) {
	          //$_SESSION['username'] = $usrName;
	          echo "Password Changed...redirecting to Login";
		  header("location: login.html?login=success");
	     } else {
                  echo "\nCould not update password...redirecting";
                  header("refresh:2; url=resetPassword.php?reset=error");
	     }
	//} else {
        //     echo "\nPasswords do not match...redirecting";
        //     header("refresh:2; url=resetPassword.php?reset=error");
	//}
exit();
?>
 
