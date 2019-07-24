<?php 


$host = "localhost";
$user = "root";
$pass = "";
$db = "experiment_db";

$mysqli = new mysqli($host, $user, $pass, $db);
if (!$mysqli) {
	$mysqli->error();
}





 ?>