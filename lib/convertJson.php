<?php
session_start(); // Start or resume the session

function getUserWorkoutData($userId) {
    // Define the directory where user files are stored

    // Create a file path for the user's data
    $filePath = $userId . '.json';

    if (file_exists($filePath)) {
        // File exists, so read and return its content
        $jsonData = file_get_contents($filePath);
    } else {
        // File doesn't exist, so create an empty array
        $jsonData = '[]';
        // Create an empty JSON file for the user
        file_put_contents($filePath, $jsonData);
    }

    // Decode JSON data
    $data = json_decode($jsonData, true);

    return $data;
}

