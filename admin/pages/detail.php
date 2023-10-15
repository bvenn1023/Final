<!DOCTYPE html>
<html>
<head>
	<title>index</title>
</head>
<body>


<?php require "pages.php";
	
	$lines=file($_GET["name"]);
	for($i=0;$i<count($lines);$i++){
		
	
		
		readText($_GET["name"],$i+1); 
		echo"<br>";
	
	
	}
?>
<p><a href="index.php">Back to Item List</a></p>
</body>
</html>
