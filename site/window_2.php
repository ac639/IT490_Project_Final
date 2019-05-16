<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
session_start();
$sessionName = $_SESSION['username'];
if (!isset($_SESSION['username'])) {
     //echo "You are not logged in";
} else {
    echo "Welcome, $sessionName";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
</head>
<body>
    <p id="output"></p>
    <script>
        
        if( 'Notification' in window){
            
            if (Notification.permission === 'granted') {
                doNotify();
            }else{
                
                Notification.requestPermission()
                    .then(function(result) {
                        console.log(result);
                        if( Notification.permission == 'granted'){ 
                            doNotify();
                        }
                    })
                
                    .catch( (err) => {
                        console.log(err);
                    });
            }
        
        }

        function doNotify(){
            let title = "NOTIFICATION";
            let t = Date.now() + 120000;
            let options = {
                body: 'Arsenal WON!!',
                data: {prop1:123, prop2:"Steve"},
                timestamp: t,
            }
            let n = new Notification(title, options);
            n.addEventListener('show', function(ev){
                console.log('SHOW', ev.currentTarget.data);
            });
            n.addEventListener('close', function(ev){
               console.log('CLOSE', ev.currentTarget.body); 
            });
            setTimeout( n.close.bind(n), 3000);
        }
        
    </script>
</body>


    <title>My Account Page</title>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
                <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                                
                                <style>
                                    html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
                                    </style>
                                <body class="w3-light-black">
                                    <div class="w3-top">
                                        <nav class="navbar navbar-expand-lg navbar-black bg-light">
                                            <a class="navbar-brand" href="">Teken 4</a>
                                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                                <span class="navbar-toggler-icon"></span>
                                            </button>
                                            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                                <ul class="navbar-nav">
                                                    <li class="nav-item active">
                                                        <a class="nav-link" href="homepage.php">Home <span class="sr-only">(current)</span></a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="window_2.php">My Account</a>
                                                    </li>
						<li class ="nav-item">
						<a class = "nav-link" href = "matches.php">Matches</a>
						</li>
                                                    </li>
                                                    
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="contact2.html">Contact us</a>
                                                    </li>
      						    <li class="nav-item">
        					        <?php
           						if (!isset($_SESSION['username'])) {
              						      // echo "You are not logged in";
           						} else {
					                      echo '<a name="logout" class="nav-link" href="homepage.php?logout=true">Logout</a>';
           						}
           						if (isset($_GET['logout'])) {
              							session_unset();
              							session_destroy();
              							$_SESSION = array();
              							header("location: login.html");
           						}
					                //LOGGING
              					        $logFile = fopen("../490_authsys/login_auth.log", "a") or die();
              					        $txt = "$sessionName has logged out";
             					        fwrite($logFile, "\n". $txt);
              					        fclose($logFile);
        						?>
      						    </li>
                                                </ul>
                                            </div>
                                            
                                        </nav>
                                    </div>
                                    <div class="w3-container w3-pale-red " >
                                    <!-- Page Container -->
                                    <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
                                        <!-- The Grid -->
                                        <div class="w3-row">
                                            <!-- Left Column -->
                                            <div class="w3-col m3">
                                                <div class="w3-card w3-round w3-white">
                                                    <div class="w3-container">
                                                        <h4 class="w3-center">My Profile</h4>
                                                        <p class="w3-center"><img src="profile-pic.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
                                                            <hr>
                                                            <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> 
							         <?php
								     //DISPLAY USERNAME INSIDE BLUE BOX
                                                                     include_once('../490_authsys/testRabbitMQClient2.php');
                                                                     $usrName = $_SESSION['username'];
                                                                     $sqlStatement = "SELECT username FROM login WHERE login.username='$usrName'";    
                                                                     $record = fetchData($usrName, $sqlStatement);
                                                                     foreach($record as $key => $row) {
							                  echo $row;
                                                                     }
             						             //LOGGING
								     $logFile = fopen("../490_authsys/db_access.log", "a") or die();
             							     $txt = "fetchData() accessed, display username for $usrName";
             							     fwrite($logFile, "\n". $txt);
                                                                     fclose($logFile);
                                                                ?>
							    </p>
                                                          <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i>
							        <?php
								    //DISPLAY EMAIL
								    include_once('../490_authsys/testRabbitMQClient2.php');
							            //ini_set('display_errors', 1);
							            //ini_set('display_startup_errors', 1);
								    //error_reporting(E_ALL);
                                                                    $usrName = $_SESSION['username'];
                                                                    $sqlStatement = "SELECT email FROM login WHERE login.username='$usrName'";
                                                                    $record = fetchData($usrName, $sqlStatement);
                                                                    foreach($record as $key => $row) {
                                                                         echo $row;
                                                                    }
							            //LOGGING
								    $logFile = fopen("../490_authsys/db_access.log", "a") or die();
             							    $txt = "fetchData() accessed, display email for $usrName";
             							    fwrite($logFile, "\n". $txt);
                                                                    fclose($logFile);
                                                                ?>
							    </p>
                                                            <p><i class="fa-money fa-fw w3-margin-right w3-large w3-text-teal"></i>
                                                                <?php
								    //DISPLAY BALANCE
                                                                    include_once('../490_authsys/testRabbitMQClient2.php');
                                                                    $usrName = $_SESSION['username'];
                                                                    $sqlStatement = "SELECT wallet.balance FROM wallet LEFT JOIN login ON wallet.id = login.id WHERE login.username='$usrName';";
                                                                    $record = fetchData($usrName, $sqlStatement);
                                                                    foreach($record as $key => $row) {
								         echo $row;
                                                                    }
								    //LOGGING
								    $logFile = fopen("../490_authsys/db_access.log", "a") or die();
             							    $txt = "fetchData() accessed, display balance for $usrName";
             							    fwrite($logFile, "\n". $txt);
                                                                    fclose($logFile);
                                                               ?>
							    </p>
                                                            </div>
                                                </div>
                                                </div>
                                                
                                                <br>
                                                
                                            
                                            <div class="w3-col m7">
                                                        <!-- Accordion -->
                                                         <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
                                                        <div class="w3-card w3-round">
                                                            <div class="w3-white">
                                                                <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align" ><i class="fa fa-circle-o-notch fa-fw w3-margin-center"></i> My Stats</button>
                                                                <div id="Demo1" class="w3-hide w3-container">

                                                               				
								<p>
								<?php
                                                                include_once('../490_authsys/testRabbitMQClient2.php');
			
                                                                $usrName = $_SESSION['username'];
                						//wlratio($usrName);
								$usrID = wlratio($usrName);
								$sqlStatement = "SELECT win, loss, ratio FROM stats WHERE id='$usrID'";
                                                                $record = fetchMatch($usrName, $sqlStatement);
                                                                $html  = "<table class='w3-table-all'>";
                                                                $html .= "<thead>";
                                                                $html .= "<tr class='w3-red'>";
                                                                $html .= "<th>WIN</th>";
                                                                $html .= "<th>LOSS</th>";
                                                                $html .= "<th>RATIO</th>";
                                                                $html .= "</tr>";
                                                                $html .= "</thead>";
                                        			
                                         			foreach ($record as $tmpArray) {
                                              			     $html .= "<tr>";
                                              			     foreach($tmpArray as $key => $row) {
                                                 		          $html .= "<td>";
                                                 			  $html .= "$row";
                                                 			  $html .= "</td>";
                                              			    }
                                              			    $html .= "</tr>"; //END OF ROW
			                                       }
                                         		       $html .= "</table>";   
                                         		       echo $html;


                                              			?>
                                        			</p>



                                                                </div>
								<button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-center"></i> My Activity</button>
                                                                <div id="Demo2" class="w3-hide w3-container">
                                                                 
								<p>
								<?php
                                                                include_once('../490_authsys/testRabbitMQClient2.php');
                                                                $usrName = $_SESSION['username'];
								//wlratio($usrName);
                                                                $usrID = wlratio($usrName);

                						$sqlStatement = "SELECT event_key, event_status, teambeton, amount FROM bethistory WHERE id='$usrID'";
                                                                $record = fetchMatch($usrName, $sqlStatement);
                                                                $html  = "<table class='w3-table-all'>";
                                                                $html .= "<thead>";
                                                                $html .= "<tr class='w3-red'>";
                                                                $html .= "<th>Match ID</th>";
                                                                $html .= "<th>Status</th>";
                                                                $html .= "<th>Betted Team</th>";
                                                                $html .= "<th>Amount</th>";
								//$html .= "<th>WON/LOST</th>";
                                                                $html .= "</tr>";
                                                                $html .= "</thead>";
							
                                     			        foreach ($record as $tmpArray) {
                                                                     $html .= "<tr>";
                                                                     foreach($tmpArray as $key => $row) {
                                                                          $html .= "<td>";
                                                                          $html .= "$row";
                                                                          $html .= "</td>";
                                                                    }
                                                                    $html .= "</tr>"; //END OF ROW
                                                                }
                                                                $html .= "</table>";   
                                                                echo $html;

                                              			?>
                                        			</p>
                                                                </div>
                                                           	</div>
                                                            	</div>
                                                		</div>
	                                                       	</div>
                                            			</div>
                                        			</div>
                                        			</div>
                                    				</div>
                                        <style>
                                        
                                            .footer {
                                                position: fixed;
                                                left: 0;
                                                bottom: 0;
                                                width: 100%;
                                                background-color: red;
                                                color: white;
                                                text-align: center;
                                            }
                                        </style>
                                        <!-- Footer -->
                                        <br>
                                        
                                        <br>
                                        <footer class="w3-center-align w3-black w3-padding-16">
                                            <p>&copy; <a href="" target="_blank" class="w3-hover-text-green">Simranjeet Tuhaid Andre Lionel</a> | New Jersey Institute of Technology</p> </footer>
                                        <!-- End page content -->
                    
                                    
                                    <!--JAVASCRIPT-->
                                    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                                    <script> // Accordion
                                        function myFunction(id) {
                                            var x = document.getElementById(id);
                                            if (x.className.indexOf("w3-show") == -1) {
                                                x.className += " w3-show";
                                                x.previousElementSibling.className += " w3-theme-d1";
                                            } else {
                                                x.className = x.className.replace("w3-show", "");
                                                x.previousElementSibling.className =
                                                x.previousElementSibling.className.replace(" w3-theme-d1", "");
                                            }
                                        }
                                    </script>
                                    
                                </body>
</html>

