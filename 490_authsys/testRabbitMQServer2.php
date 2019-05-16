#!/usr/bin/php
<?php
//ini_set('log_errors',1);
//ini_set('error_log', dirname(__FILE__) . '/var/www/html/490auth_and_website/490_authsys/490rabbitmq.log');
//error_reporting(E_ALL);

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');


function searchMatch($search, $sqlStatement) {
        $db = mysqli_connect("127.0.0.1", "admin", "password", "490db");
        $runQuery = mysqli_query($db, $sqlStatement);
        $queryResults = mysqli_num_rows($runQuery);
        if (!$db) {
                die("MySQL Connection Failed: " . mysqli_connect_error() );
        } else {
             if ( $queryResults > 0 ) {
                while ($row = mysqli_fetch_assoc($runQuery)) {
                     $tmpArray[] = $row; 
                }
                print_r($tmpArray);
                return $tmpArray;
             }
       }
}

function loginAuth($usrName, $usrPassword) {
	//echo "loginAuth method run";
	$db = mysqli_connect("127.0.0.1", "admin", "password", "490db");

	if  (!$db) {
	     die("MySQL Connection Failed: " . mysqli_connect_error() );
	} else {
	     $authUser = "SELECT * FROM login WHERE username='$usrName' AND password='$usrPassword'";
             $confirmAuth = mysqli_query($db, $authUser);
             if (mysqli_num_rows($confirmAuth) >= 1) {
                 echo "\nusername and password found in table\n";
                 return true;
             } else {
                 echo "\nusername and password NOT found in table\n";
                 return false;
             }
	}
}


function wlratio($usrName) {
	echo "\nwlratio called\n";
	$db = mysqli_connect("127.0.0.1", "admin", "password", "490db");
        if  (!$db) {
             die("MySQL Connection Failed: " . mysqli_connect_error() );
        } else {
	     //Get the user id
             $getUserID = mysqli_query($db, "SELECT id FROM login WHERE username='$usrName'");
             $userID = mysqli_fetch_assoc($getUserID);
             $resultUserID = (int)$userID['id']; //THIS IS THE USER ID TO PUT INTO TABLE/ROW
	     //echo "$resultUserID";
             //END
	     //Get match stats
	     $getMatchStats = mysqli_query($db, "SELECT event_key, event_status, event_final_result, teambeton, homeoraway FROM bethistory WHERE id='$resultUserID'");
 	     $win = 0;
             $loss = 0;
	     //Loop for "Home"
	     while($row = mysqli_fetch_assoc($getMatchStats)) {
		  //echo "first while loop";
	          $event_key = $row['event_key'];
		  $event_status = $row['event_status'];
		  $event_final_result = $row['event_final_result'];
		  $teambeton = $row['teambeton'];
		  $homeoraway = $row['homeoraway'];
		  if ($event_status == "Finished") {
		       if ($homeoraway == "Home") {
		            $homescore = (int)$event_final_result[0];
			    $awayscore = (int)$event_final_result[4];
			    if ($homescore > $awayscore) {
			         $win += 1;
			    } elseif ($homescore < $awayscore) {
			         $loss += 1;
			    } else {
			        $win += 0;
				$loss += 0;
			    }
		       }
		  } else {
		   //Do nothing as match has not finished
		   return $resultUserID;
		  }
	     }
	     //Loop for "Away"
	     $getMatchStats2 = mysqli_query($db, "SELECT event_key, event_status, event_final_result, teambeton, homeoraway FROM bethistory WHERE id='$resultUserID'");
	     while($row = mysqli_fetch_assoc($getMatchStats2)) {
		  //echo "second while loop";
	          $event_key = $row['event_key'];
		  $event_status = $row['event_status'];
		  $event_final_result = $row['event_final_result'];
		  $teambeton = $row['teambeton'];
		  $homeoraway = $row['homeoraway'];
		  if ($event_status == "Finished") {
		       if ($homeoraway == "Away") {
                            $homescore = (int)$event_final_result[0];
                            $awayscore = (int)$event_final_result[4];
			    if ($awayscore > $homescore) {
			         $win += 1;
			    } elseif ($awayscore < $homescore) {
			         $loss += 1;
			    } else {
                                $win += 0;
                                $loss += 0;
                            }
		       }
		  } else {
		   //Do nothing as match has not finished
		    return $resultUserID;
		  }
	     }
	//////After all while loops
	//echo "\nWins: $win\n";
	//echo "\nLoss: $loss\n";
        $winlossratio = (100 * $win) / ($win + $loss);

	//INSERT THE RATIO INTO TABLE
	$checkRow = "SELECT * FROM stats WHERE id='$resultUserID'";
        $checkRowExists = mysqli_query($db, $checkRow);
        if (mysqli_num_rows($checkRowExists) == 0) {
	     mysqli_query($db, "INSERT INTO stats(id, event_key, win, loss, ratio) VALUES('$resultUserID', '$event_key', '$win', '$loss', '$winlossratio')");
	     echo "\nInserted win/loss into stats table for $usrName\n";
	     return $resultUserID;
	} else {
	     mysqli_query($db, "DELETE FROM stats WHERE id='$resultUserID'");
	     echo "\nRow already exists, deleting win/loss row...ready for new row insert\n";	     
	     mysqli_query($db, "INSERT INTO stats(id, event_key, win, loss, ratio) VALUES('$resultUserID', '$event_key', '$win', '$loss', '$winlossratio')");
	     echo "\nInserted win/loss into stats table for $usrName\n";
	     return $resultUserID;
	}

    }

}

function placeBet($usrName, $matchid, $betteam) {
        //echo "placeBet running";
	$db = mysqli_connect("127.0.0.1", "admin", "password", "490db");
	if  (!$db) {
             die("MySQL Connection Failed: " . mysqli_connect_error() );
        }  else {
	     //echo "else running";
	     $checkMatch = "SELECT event_key FROM api WHERE event_key='$matchid'";
	     $runQuery = mysqli_query($db, $checkMatch);
	     if (mysqli_num_rows($runQuery) >= 1) {
	        //print_r($runQuery);
		echo "$matchid found in api table";
		//Get user id
		$getUserID = mysqli_query($db, "SELECT id FROM login WHERE username='$usrName'");
		$userID = mysqli_fetch_assoc($getUserID);
                $resultUserID = (int)$userID['id']; //THIS IS THE USER ID TO PUT INTO TABLE/ROW
		//END
		//Get match status
		$getMatchStatus = mysqli_query($db, "SELECT event_status FROM api WHERE event_key='$matchid'");
		$matchStatus = mysqli_fetch_assoc($getMatchStatus);
		$resultMatchStatus = $matchStatus['event_status']; //THIS IS THE EVENT STATUS TO PUT INTO TABLE/ROW
		//END
		//Get match sore
		$getMatchScore = mysqli_query($db, "SELECT event_final_result FROM api WHERE event_key='$matchid'");
	        $matchScore = mysqli_fetch_assoc($getMatchScore);
 		$resultMatchScore = $matchScore['event_final_result'];
		//echo "$resultMatchScore";
		//END
		//Get team
		if ($betteam == "Home") { //BET FOR HOME TEAM
		     $getHomeTeam = mysqli_query($db, "SELECT event_home_team FROM api WHERE event_key='$matchid'");
		     $homeTeam = mysqli_fetch_assoc($getHomeTeam);
		     $resultHomeTeam = $homeTeam['event_home_team']; //THIS IS THE HOME TEAM TO PUT INTO TABLE/ROW
		     //echo "$resultHomeTeam";
		     //Check if bet exists on matchid, if not then place the bet
		     $checkBet = "SELECT event_key FROM bethistory WHERE id='$resultUserID' AND event_key='$matchid'";
                     $runCheckBet = mysqli_query($db, $checkBet);
		     if (mysqli_num_rows($runCheckBet) >= 1) {
                          echo "\nBet on $matchid already exists for $usrName, can't place bet\n";
                          return false;
                     } else {
			  //PLACE BET SECTION
			  $betAmount = 5; //dollars
			  $getBalance = mysqli_query($db, "SELECT balance FROM wallet WHERE id='$resultUserID'");
			  $balance2 = mysqli_fetch_assoc($getBalance);
			  $resultBalance = $balance2['balance'];
			  //Check if user has enough funds
			  if ($resultBalance >= $betAmount) {
 			       //echo "\n$resultBalance";
		               $newBalance = $resultBalance - $betAmount;
			       mysqli_query($db, "INSERT INTO bethistory(id, event_key, event_status, event_final_result, teambeton, amount, homeoraway) VALUES('$resultUserID', '$matchid', '$resultMatchStatus','$resultMatchScore', '$resultHomeTeam', '$betAmount','$betteam')");
                               mysqli_query($db, "UPDATE wallet SET balance='$newBalance' WHERE id='$resultUserID' ");
			       echo "\n Subtracted $betAmount from $usrName account balance";
			       echo "\n Placed bet: $resultHomeTeam with $matchid for $usrName with amount $betAmount\n";
			       return true;
			  } else {
			       echo "Place bet failed, $usrName does not have enough funds";
		          }
		    }
		} elseif ($betteam == "Away") { //BET FOR AWAY TEAM
		     $getAwayTeam = mysqli_query($db, "SELECT event_away_team FROM api WHERE event_key='$matchid'");
                     $awayTeam = mysqli_fetch_assoc($getAwayTeam);
                     $resultAwayTeam = $awayTeam['event_away_team']; //THIS IS THE HOME TEAM TO PUT INTO TABLE/ROW
	  	     //echo "$resultAwayTeam";
              	     //Check if bet exists on matchid, if not then place the bet
		     $checkBet = "SELECT event_key FROM bethistory WHERE id='$resultUserID' AND event_key='$matchid'";
                     $runCheckBet = mysqli_query($db, $checkBet);
		     if (mysqli_num_rows($runCheckBet) >= 1) {
                          echo "\nBet on $matchid already exists for $usrName, can't place bet\n";
                          return false;
                     } else {
		          //PLACE BET SECTION
			  $betAmount = 5; //dollars
                          $getBalance = mysqli_query($db, "SELECT balance FROM wallet WHERE id='$resultUserID'");
                          $balance2 = mysqli_fetch_assoc($getBalance);
                          $resultBalance = $balance2['balance'];
                          //Check if user has enough funds
			  if ($resultBalance >= $betAmount) {
			       $newBalance = $resultBalance - $betAmount;
		               mysqli_query($db, "INSERT INTO bethistory(id, event_key, event_status, event_final_result, teambeton, amount, homeoraway) VALUES('$resultUserID', '$matchid', '$resultMatchStatus','$resultMatchScore', '$resultAwayTeam', '$betAmount','$betteam')");
			       mysqli_query($db, "UPDATE wallet SET balance='$newBalance' WHERE id='$resultUserID'");
			       echo "\n Subtracted $betAmount from $usrName account balance";
                               echo "\n Placed bet: $resultAwayTeam with $matchid for $usrName with amount $betAmount\n";
                               return true;
			  } else {
			       echo "Place bet failed, $usrName does not have enough funds";
			  }
		     }
	        }
		//END
		
	     } else {
	          echo "$matchid not found in api table";
		  return false;
             }
	}

}

function fetchData($usrName, $sqlStatement) {
        $db = mysqli_connect("127.0.0.1", "admin", "password", "490db");
        $runQuery = mysqli_query($db, $sqlStatement);

        if  (!$db) {
             die("MySQL Connection Failed: " . mysqli_connect_error() );
        } else {
             $row = mysqli_fetch_assoc($runQuery);
             print_r($row);
             return $row;
             //print_r($new_array);
             //print_r($arrayToString);
             //$secondArray = $new_array['0'];
             //print_r($secondArray);        
             //$arrayToString = implode(',',$new_array);
             //print_r($arrayToString);
             //return $arrayToString;
             //return $secondArray;
             mysqli_close();
        }
}



function fetchMatch($usrName, $sqlStatement) {
        $db = mysqli_connect("127.0.0.1", "admin", "password", "490db");
        $runQuery = mysqli_query($db, $sqlStatement);
	$queryResults = mysqli_num_rows($runQuery);
	
	if (!$db) {
		die("MySQL Connection Failed: " . mysqli_connect_error() );
	} else {
             if ( $queryResults > 0 ) {
		while ($row = mysqli_fetch_assoc($runQuery)) {
		     $tmpArray[] = $row; 
		}
		print_r($tmpArray);
		return $tmpArray;
	     }
       }
}



function passChange($usrPassword, $usrEmail) {
        echo "running";
        $db = mysqli_connect("127.0.0.1", "admin", "password", "490db");

        if  (!$db) {
             die("MySQL Connection Failed: " . mysqli_connect_error() );
        } else {
             $authUser = "SELECT email FROM login WHERE email='$usrEmail'";
             $confirmAuth = mysqli_query($db, $authUser);
             if (mysqli_num_rows($confirmAuth) >= 1) {
                 //echo "\nusername and password found in table\n";
		 echo "$usrPassword";
		 $changePass = "UPDATE login SET password='$usrPassword' WHERE email='$usrEmail'";                 
                 mysqli_query($db, $changePass);
                 echo "\nPassword changed";
                 return true;
             } else {
                 echo "\nemail NOT found in table\n";
                 return false;
             }
        }

}



function registerAuth($usrName,$usrPassword,$usrEmail) {
	$db = mysqli_connect("127.0.0.1", "admin", "password", "490db");
        if  (!$db) {
             die("MySQL Connection Failed: " . mysqli_connect_error() );
        } else {
             $searchUser = "SELECT * FROM login WHERE username='$usrName'";
	     $searchEmail = "SELECT * FROM login WHERE email='$usrEmail'";
             $checkUserExist = mysqli_query($db, $searchUser);
             $checkEmailExist = mysqli_query($db, $searchEmail);
	     if (mysqli_num_rows($checkUserExist) >= 1) {
	          echo "\nusername already exists\n";
                  return false;
             } elseif (mysqli_num_rows($checkEmailExist) >= 1 ) {
                  echo "\nemail already exists\n";
		  return false;
             } else {
                mysqli_query($db, "INSERT INTO login(username, password, email) VALUES('$usrName', '$usrPassword', '$usrEmail')");
		$getUserID = mysqli_query($db, "SELECT id FROM login WHERE username='$usrName'");
		//print_r($getUserID);
		$userID = mysqli_fetch_assoc($getUserID);
		//print_r($userID);
		$resultUserID = (int)$userID['id'];
		//print_r(gettype($resultUserID));
		mysqli_query($db, "INSERT INTO wallet(id, balance) VALUES('$resultUserID', 100)");
		echo "\naccount created\n";
                return true;
	     }
       }
}


function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "login":
      //return doLogin($request['username'],$request['password']);
      return loginAuth($request['usrName'],$request['usrPassword']);
    case "register":
      return registerAuth($request['usrName'],$request['usrPassword'],$request['usrEmail']);
    case "fetchData":
      return fetchData($request['usrName'], $request['sqlStatement']);
    case "fetchMatch":
      return fetchMatch($request['usrName'], $request['sqlStatement']);
    case "passChange":
      return passChange($request['usrPassword'],$request['usrEmail']);
    case "betting":
      return placeBet($request['usrName'],$request['matchid'],$request['betteam']);
    case "winlossratio":
      return wlratio($request['usrName']);
    case "searchmatch":
      return searchMatch($request['search'],$request['sqlStatement']);
    //case "validate_session":
      //return doValidate($request['sessionId']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>




