<?php
	//ini_set('display_errors', 1);
	ini_set('log_errors',1);
	ini_set('error_log', dirname(__FILE__) . '/login_auth.log');
	error_reporting(E_ALL);

	session_start();
	include('testRabbitMQClient2.php');

	$usrName = $_POST['usrName'];
	$usrPassword = $_POST['usrPassword'];
	$response = loginAuth($usrName, $usrPassword);
	
	if (empty($usrName || empty($usrPassword) )) {
	     echo "Username/Password field empty...redirecting";
             header("refresh:2; url=../login.html?login=error");
             $logFile = fopen("login_auth.log", "a") or die();
             $txt = "Login Failed: Credentials left empty";
             fwrite($logFile, "\n". $txt);
             fclose($logFile);

	} else {
             if ($response == true) {
	          $_SESSION['username'] = $usrName;
	          header("location: ../site/homepage.php?login=success");
		  $logFile = fopen("login_auth.log", "a") or die();
		  $txt = "Login Successful: $usrName has logged in";
		  fwrite($logFile, "\n". $txt);
                  fclose($logFile);
	     } else {
                  echo "\nIncorrect Username/Password...redirecting";
                  header("refresh:2; url=../site/login.html?login=error");
		  $logFile = fopen("login_auth.log", "a") or die();
                  $txt = "Login Failed: Username/Password Incorrect";
                  fwrite($logFile, "\n". $txt);
                  fclose($logFile);


	     }
	}


exit();
?>
