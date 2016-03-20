<?php

// This page destroys the sessions and sends the user back to the TA main page.

session_start();
session_destroy();

// echo "logged out" ;

header ('Location: main.php');

?>
