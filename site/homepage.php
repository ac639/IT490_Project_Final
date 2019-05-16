<?php

session_start();

$sessionName = $_SESSION['username'];

if (!isset($_SESSION['username'])) {
    // echo "You are not logged in";
} else {
    echo "Welcome, $sessionName";
}


?>


<!DOCTYPE html>
<html>
<title>Homepage</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 
<style>
body,h1,h2{font-family: "Raleway", sans-serif}
body, html {height: 100%}
p {line-height: 2}
.bgimg {
min-height: 100%;
background-position: center;
background-size: cover;

}
.bgimg {background-image: url("soccer.jpeg")}

</style>
<body>
<!-- Header / Home-->
<header class="w3-display-container w3-wide bgimg " id="home">
<div class="w3-yellow w3-display-right w3-text-black w3-center" w>
<h1 class="w3-jumbo"><b>Teken 4</b></h1>
</div>
</header>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="">TEKEN 4</a>
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

      <li class="nav-item">
        <a class="nav-link" href="matches.php">Matches</a>
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
	      //LOGGING
              $logFile = fopen("../490_authsys/login_auth.log", "a") or die();
              $txt = "$sessionName has logged out";
              fwrite($logFile, "\n". $txt);
              fclose($logFile);
           }
	?>
      </li>
      <li class="nav-item">
	<form action="searchmatches.php" method="POST">
		<input type="text" name="srch" placeholder="Search for team">
		<button type="submit" name="submit-search">Search</button>	
	</form>
      </li>
    </ul>
  </div>
</nav>
  <!-- About/Navi and Harry -->
<div class="w3-container w3-padding-64 w3-pale-red w3-grayscale-min" id="us">
  <div class="w3-content">
    <h1 class="w3-center w3-text-grey"><b>About Us </b></h1>
    <p><i>lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nis ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed  do eiusmod tempor incididunt ut labore et dolore magna aliqua. ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</i></p><br> 
  </div>
</div>
</div>
<!-- Footer-->
<footer class="w3-center w3-black w3-padding-16">
<p>&copy; <a href="" target="_blank" class="w3-hover-text-green">Simranjeet Kaur Tuhaid Asif Andre Catarino Lionel Aliaj </a> | New Jersey Institute of Technology</p> </footer>
<div class="w3-hide-small" style="margin-bottom:32px"> </div>

<!--JAVASCRIPT-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

</body>
</html>















