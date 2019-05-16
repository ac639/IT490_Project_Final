<?php

	$matchid = $_POST['param1'];
	echo $matchid;
	//echo $matchid;
	//$intmatchid = (int)$matchid;
	//$intmatchidminusone = $intmatchid - 1;

	include('../490_authsys/testRabbitMQClient2.php');

        session_start();

        $usrName = $_SESSION['username'];

     	if (!isset($_SESSION['username'])) {
             //echo "You are not logged in";
     	} else {
	     //$start = $matchid;
	     //$count = $matchid;
             //$sqlStatement = "SELECT event_key FROM api LIMIT $matchid, 1";
            
	     $record = fetchData($usrName, $sqlStatement);

	}

?>
