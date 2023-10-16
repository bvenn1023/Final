<?php require 'pages.php';


if (isset($_GET["name"])){
	deleteText($_GET["name"]);
	print_r($_GET["name"]);
	header("Location: index.php");
	exit;
}
?>
