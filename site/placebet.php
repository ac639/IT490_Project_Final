<?php

	$matchid = $_POST['param1'];
	$betteam = $_POST['param2'];
	//echo $matchid;
	//echo $betteam;

	include('../490_authsys/testRabbitMQClient2.php');

        session_start();

        $usrName = $_SESSION['username'];

     	if (!isset($_SESSION['username'])) {
             echo "You are not logged in";
     	} else {
	      $response = placeBet($usrName, $matchid, $betteam);
	      if ($response == true) {
	           echo "Bet Placed";
	      } else {
	          echo "Incorrect match ID/Team or bet already placed";
                  //header("refresh:2; url=../matches.php?placebet=error");
	      }
	}

?>
