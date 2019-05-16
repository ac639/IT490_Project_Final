<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Page</title>
    </head>
    <body>
    <div id = "div1"
<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

     include_once('testRabbitMQClient2.php');

     session_start();

     $usrName = $_SESSION['username'];

     if (!isset($_SESSION['username'])) {
          echo "You are not logged in";
     } else {
          //$sqlStatement = "SELECT * FROM login LEFT JOIN wallet ON login.id = wallet.id WHERE login.username='$usrName'";          
          $sqlStatement = "SELECT * FROM login";          
	  $record = fetchData($usrName, $sqlStatement);

	  //Display as HTML TABLE
            //$html = "<table>";
            //foreach($record as $key => $row) {
                 //$html .= "<tr>";
                 //$html .= "<td>" . $key . ': ' . $row . "</td>";
	         //$html .= "<td>". $row . "</td>";
                 //$html .= "</tr>";
            //}
            //$html .= "</table>";
            //echo $html;
          /////END OF DISPLAY AS HTML

	  //DISPLAY AS DIVS
	    $html = "<div>";
 	    foreach($record as $key => $row) {
	       $html .= "<div>". $row . "</div>";
	    }
	    $html .= "</table>";
            echo $html;
          //END OF DISPLAY AS DIVS

	  //DISPLAY IN AN ALREADY EXISTING HTML DIV
            //foreach($record as $key => $row) {
               //$html .= "<div>". $row . "</div>";
               //$html .= $row;
              // echo $row;
            //}
	  //END OF DISPLAY



     } //else statement

exit();
?>
</div>
</body>

</html>



