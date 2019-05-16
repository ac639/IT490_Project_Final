<?php

session_start();

$sessionName = $_SESSION['username'];

if (!isset($_SESSION['username'])) {
     echo "You are not logged in";
} else {
     echo "You are logged in as $sessionName";
}

exit();

?>

