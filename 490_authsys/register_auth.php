<?php
        ini_set('log_errors',1);
        ini_set('error_log', dirname(__FILE__) . 'register_auth.log');
        error_reporting(E_ALL);

	//session_start();
	include('testRabbitMQClient2.php');

	$usrName = $_POST['usrName'];
	$usrPassword = $_POST['usrPassword'];
	$usrEmail = $_POST['usrEmail'];

        if ( empty($usrName) || empty($usrPassword) ||  empty($usrEmail) ) {
             echo "One or more fields left empty...Redirecting";
             header("refresh:2; url=../site/login.html?registration=error");
             $logFile = fopen("register_auth.log", "a") or die();
             $txt = "Register Failed: Credentials left empty";
             fwrite($logFile, "\n". $txt);
             fclose($logFile);

        } else {
	     $response = registerAuth($usrName,$usrPassword,$usrEmail);
	     if ($response == true) {
	         // echo "Account created...Redirecting";
	          //header("location: ../login.html");
	          header("refresh:2; url=../site/login.html?registration=success");
                  $logFile = fopen("register_auth.log", "a") or die();
                  $txt = "Registration Successful: $usrName has been registered";
                  fwrite($logFile, "\n". $txt);
                  fclose($logFile);

	     } else {
                  //echo "\nregister_auth.php: ";
	          echo "Account with Username/Email already exists...Redirecting";
	          header("refresh:2; url=../site/login.html?registration=error");
	          $logFile = fopen("register_auth.log", "a") or die();
                  $txt = "Registration Failed: Username/Email already exists";
                  fwrite($logFile, "\n". $txt);
                  fclose($logFile);
	     }
	}

?>
