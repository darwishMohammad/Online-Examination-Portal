<?php

$dsn = "mysql:host=localhost;dbname=onlineexamportal";
$username = "root";
$password = "";

try{
	$db = new PDO($dsn, $username, $password);
}catch (PDOException $ex){
	$msg = $ex->getMessage();
	include("error.php");
	exit();
}

?>