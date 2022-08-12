

<?php
//session start
session_start();

//include the functions page
require("functions.php");

//get the required action
$action = filter_input(INPUT_POST, "action");
if($action == null){
	$action = filter_input(INPUT_GET, "action");
	
}

switch($action){
	case "index":
	header("Location: index.php");
	break;
	
	case "admin":
	include("adminLogin.php");
	break;
	
	case "home":
	include("home.php");
	break;
	
	case "student":
	include("login.php");
	break;
	
	case "logout":
	include("view/logout.php");
	break;
	
	 default:
	include("home.php");
}

?>