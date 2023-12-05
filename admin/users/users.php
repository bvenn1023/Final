<?php

function printUsers(){
	
	
		$host='localhost';
	$name='final';
	$user='root';
	$pass='';

	//Specify options
	$opt = [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES => false
	];
	$connection=new PDO('mysql:host='.$host.';dbname='.$name.';charset=utf8mb4',$user,$pass,$opt);
	$query=$connection->prepare('SELECT * FROM users ');
	$query->execute();
	while($row=$query->fetch()){
		echo '<tr>';
			echo '<td>';
			echo $row['email'];
			echo '</td><td>';
			echo $row['firstname'];
			echo '</td><td>';
			echo $row['lastname'];
			echo '</td><td>';
			echo $row['role'];
			echo '</td>';
		echo '</tr>';
		
		
	}
	
}



?>