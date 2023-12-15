<?php
session_start();

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
		echo $counter;
	}catch (PDOException $e) {
    echo "Error: please contact admin and try again later " ;
	}
}
function workoutsToday($userID) {
	try{
		$date=date("Y-m-d");
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
		$query=$connection->prepare('SELECT * FROM workouts WHERE user_ID=? AND date=?');
		$query->execute([$userID,$date]);
		$counter=0;
		while($row=$query->fetch()){
		$counter+=1;}
		echo $counter;
	}catch (PDOException $e) {
    echo "Error: please contact admin and try again later " ;
	}
}


function totalTimeSpent($userID){
	try{
		$date=date("Y-m-d");
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
		$query=$connection->prepare('SELECT time_worked FROM workouts WHERE user_ID=? AND date=?');
		$query->execute([$userID,$date]);
		$minutes=0;
		while($row=$query->fetch()){
		$minutes+=$row["time_worked"];}
		echo $minutes;
	}catch (PDOException $e) {
    echo "Error: please contact admin and try again later " ;
	}
}

function caloriesToday($userID){
	try{
		$date=date("Y-m-d");
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
		$query=$connection->prepare('SELECT cal_burned FROM workouts WHERE user_ID=? AND date=?');
		$query->execute([$userID,$date]);
		$calories=0;
		while($row=$query->fetch()){
		$calories+=$row["cal_burned"];}
		echo $calories;
	}catch (PDOException $e) {
    echo "Error: please contact admin and try again later " ;
	}
	
}