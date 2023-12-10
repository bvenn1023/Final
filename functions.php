<?php
session_start();

function totalWorkouts($userID) {
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
}
function totalCalories($jsonFilePath){
	if (file_exists($jsonFilePath)){
		$jsonString=file_get_contents($jsonFilePath);
		$jsonData=json_decode($jsonString, true);
		//print_r($jsonData);
		$total=0;
		foreach ($jsonData as $value){
			//print_r($value);
			
			$total=$total+intval($value["CaloriesBurned"]);
			
		
		}
		echo $total;
		}else{
		echo "0";
		}			
}

function totalTimeSpent($jsonFilePath){
	if (file_exists($jsonFilePath)){
		$jsonString=file_get_contents($jsonFilePath);
		$jsonData=json_decode($jsonString, true);
		//print_r($jsonData);
		$total=0;
		foreach ($jsonData as $value){
			//print_r($value);
			
			$total=$total+intval($value["TimeWorkedOut"]);
			
		
		}
		echo $total;
	}else{
		echo "0";
	}
}

function totalCaloriesGoal($jsonFilePath){
	if (file_exists($jsonFilePath)){
		$jsonString=file_get_contents($jsonFilePath);
		$jsonData=json_decode($jsonString, true);
		//print_r($jsonData);
		$total=0;
		foreach ($jsonData as $value){
			//print_r($value);
			
			$total=$total+intval($value["CalorieBurnGoal"]);
			
		
		}
		echo $total;
	}else{
		echo "0";
	}		
}