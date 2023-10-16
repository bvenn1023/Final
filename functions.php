<?php
session_start();

function countArraysInJsonFile($jsonFilePath) {
    // Read the JSON file into a string
	if (file_exists($jsonFilePath)){
		$jsonString = file_get_contents($jsonFilePath);
		
		// Parse the JSON data
		$jsonData = json_decode($jsonString, true); 

		if ($jsonData === null) {
			// JSON parsing failed
			throw new Exception("Failed to parse JSON data.");
		}
		$arrayCount=0;
		foreach($jsonData as $value){
			$arrayCount+=1;
			
		}

		echo $arrayCount;
	}else{
		echo "0";
	}
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