<?php

session_start();
if (!isset($_SESSION['email']) || $_SESSION['role']!=1) header("Location: ../../redirect.php");




//prints index information from all users
//index page
function printUsers(){
	try{
		
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
				echo '<a href="detail.php?getid=' . $row['ID'] . '">Detail</a>';

				
				echo '</td>';
				echo '<td>';
				echo $row['email'];
				echo '</td><td>';
				echo $row['firstname'];
				echo '</td><td>';
				echo $row['lastname'];
				echo '</td><td>';
				echo $row['role'];
				echo '</td><td>';
				echo '<a href="edit.php?getid=' . $row['ID'] . '">Edit</a>';
				echo ' | ';
				echo '<a href="delete.php?getid=' . $row['ID'] . '">Delete</a>';
				
			echo '</tr>';
			
			
			
		}
	}catch (PDOException $e) {
    echo "Error: please contact admin and try again later " ;
	}
	
}

//function prints all information on specific user from databse
//detail page
function printAll(){
	try{
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
		$query=$connection->prepare('SELECT * FROM users where ID=?');
		$query->execute([$_GET['getid']]);
		foreach ($query as $item){
			echo '<tr>';
				echo '<td>';
				echo $item['ID'];
				echo'</td><td>';
				echo $item['email'];
				echo '</td><td>';
				
				echo $item['firstname'];
				echo '</td><td>';
				echo $item['lastname'];
				echo '</td><td>';
				echo $item['role'];
				echo '</td><td>';
				echo totalWorkouts($_GET['getid']);
			echo '</tr>';
		}
		
		
	}catch (PDOException $e) {
    echo "Error: please contact admin and try again later " ;
	}
	
	
}

//delete
function deleteUser(){
	try{
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
		$query=$connection->prepare('DELETE FROM users where ID=?');
		$query->execute([$_GET['getid']]);
	}catch (PDOException $e) {
    echo "Error: please contact admin and try again later " ;
	}
	
	
}


function getData($item){
	try{
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
	$query=$connection->prepare('SELECT * FROM users WHERE ID=?');
	$query->execute([$_GET['getid']]);
	$result=$query->fetch();
	echo $result[$item];
	}catch (PDOException $e) {
    echo "Error: please contact admin and try again later " ;
	}


}


function editData($id,$email,$password,$role){
	try{
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
		$query = $connection->prepare("UPDATE users
		SET email = :email,
			password = :password,
			role = :role
		WHERE ID = :id");

		$query->bindParam(':email', $email);
		$query->bindParam(':password', $password);
		$query->bindParam(':role', $role);
		$query->bindParam(':id', $id);

		$query->execute();
	}catch (PDOException $e) {
    echo "Error: please contact admin and try again later " ;
	}

	
	
	
	
	
	
}

function totalWorkouts($userID) {
	try{
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
	$query=$connection->prepare('SELECT * FROM workouts WHERE user_ID=?');
	$query->execute([$userID]);
	$counter=0;
	while($row=$query->fetch()){
	$counter+=1;}
	echo $counter;}catch (PDOException $e) {
    echo "Error: please contact admin and try again later " ;
	}
}





?>