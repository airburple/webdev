<?php
$username = $_POST ['username'];
$score = $_POST ['score'];


include("dbconnector.php");
$sql = "INSERT INTO SnakeGame.scores (user_name, score) VALUES ('".$username."','".$score."');";
$stmt = $db->prepare ( $sql );
$stmt->execute ();


?>
