<?php 
require "users.php";

if (isset($_GET["getid"])){
	
	
	
	deleteUser();
	header("Location: index.php");
	exit;
}

?>