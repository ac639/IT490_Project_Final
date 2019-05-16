
<!DOCTYPE html>
<html lang="en">
    <title>Matches Page</title>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                   <!-- CSS FILE FOR MATCHES TABLE -->
		   <link rel="stylesheet" type="text/css" href="tablecss.css"/>
 
                    
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
                                            <a class="nav-link" href="window_2.html">My Account</a>
                                        </li>
                                        
                                        <li class="nav-item">
                                            <a class="nav-link" href="contact2.html">Contact us</a>
                                        </li>
                                    </ul>
                                </div>
                                
                            </nav>
                            
                            <!-- Table -->
                            <div class="w3-container">
                                <h2>Available Soccer Matches</h2>
                                <p>How to use: Enter a match id and team you want to bet on, then press "Place Bet"</p>
                                
                              <!--  <table class="w3-table-all">
                                    <thead>
                                        <tr class="w3-red">
					    <th>Match ID</th>
                                            <th>Home Team</th>
                                            <th>Away Team</th>
                                            <th>Score</th>
                                            //<th>Bet</th>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <td>Jill</td>
                                        <td>Smith</td>
                                        <td>50</td>
                                        <td>lol</td>
                                    </tr>
                                    <tr>
                                        <td>Eve</td>
                                        <td>Jackson</td>
                                        <td>94</td>
                                        <td>lol</td>
                                    </tr>
                                    <tr>
                                        <td>Adam</td>
                                        <td>Johnson</td>
                                        <td>67</td>
                                        <td>lol</td>
                                    </tr>
                                </table> --> 
				<div id="table-wrapper">
  				    <div id="table-scroll">
 					 <?php
                                                                    
				         //DISPLAY MATCHES
                                         include_once('../490_authsys/testRabbitMQClient2.php');
                                         //ini_set('display_errors', 1);
                                         //ini_set('display_startup_errors', 1);
                                         //error_reporting(E_ALL);

                                         $usrName = $_SESSION['username'];
				         $srch = $_POST['srch'];
					 //echo "$srch";

                                         $sqlStatement = "SELECT event_key, event_home_team, event_away_team, event_final_result FROM api WHERE event_home_team='$srch' OR event_away_team='$srch'";
					 $record = searchMatch($srch, $sqlStatement);
					 
				
            				 $html  = "<table class='w3-table-all'>";
					 $html .= "<thead>";
					 $html .= "<tr class='w3-red'>";
				         $html .= "<th>Match ID</th>";
					 $html .= "<th>Home Team</th>";
					 $html .= "<th>Away Team</th>";
					 $html .= "<th>Score</th>";
					 //$html .= "<th>Bet</th>";
					 $html .= "</tr>";
					 $html .= "</thead>";
            				 
					 $count = 0;
					 foreach ($record as $tmpArray) {
					      $html .= "<tr>";
					      foreach($tmpArray as $key => $row) {
						 $html .= "<td>";
					         $html .= "<form action=''>";
					         //$html .= "<input onclick='myFunc(this.id)' type='button' id='$team' value='$row'>";
					         $html .= "$row";
						 $html .= "</form>";
					         $html .= "</td>";
						 ////$html .= "<td id='$count'";
						 ////$html .= "<a href='' onclick='myFunc()'>$row</a>";						 
					         ////$html .= "</td>";
					      }
				              $html .= "</tr>"; //END OF ROW
					      $count += 1;
					 }
            			 	 $html .= "</table>";	
            				 echo $html;
					?>
				  </div>
				</div> 

<br>


			<!--	 <form action=''>  -->
				    <input class="w3-input w3-border" type="text" placeholder="Enter Home or Away" name="betteam" id="betteam">
				    <input class="w3-input w3-border" type="text" placeholder="Enter Match ID" name="matchid" id="matchid">
				    <input type="submit" onclick='myFunc()' name="betButton" value="Place Bet">
			<!--	</form> -->
			    </div>
 <!--Footer-->
			<footer class="w3-center w3-black w3-padding-16">
                            <p>&copy;
                            <a href="" target="_blank" class="w3-hover-text-green">Simranjeet Kaur Tuhaid Andre Lionel</a> | New Jersey Institute of Technology</p>
			</footer>
                       
                            <!-- Endpage content -->
                        </div>

                        
                        <!--JAVASCRIPT-->
                        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
			<script src="jquery.js"></script>
			<script src="placebet.js"></script>
			<script>
		            //function myFunc(x) {
 		              //alert(x);
		              //$.ajax({
               	 		//url: "findmatchid.php", //url for php function
                		//type: "POST",
                		//data: "matchid=x", // data to sent
                		//dataType: 'text',
                		//success: function (data)
                		//{

                		//}
            		     //});
			    //}

			</script>

                        
                    </body>
</html>




