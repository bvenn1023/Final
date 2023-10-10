<?php
function printWorkoutData($jsonFilePath)
{
    // Read JSON data from the file
    $jsonData = file_get_contents($jsonFilePath);

    // Decode JSON data
    $data = json_decode($jsonData, true);

    // Check if data is an array
    if (is_array($data)) {
        foreach ($data as $workout) {
            echo '<tr>';
            echo '<td>' . $workout['WorkoutName'] . '</td>';
            echo '<td>' . $workout['Exercises'] . '</td>';
            echo '<td>' . $workout['CalorieBurnGoal'] . '</td>';
            echo '<td>' . $workout['CaloriesBurned'] . '</td>';
            echo '<td>' . $workout['TimeWorkedOut'] . '</td>';
            echo '</tr>';
        }
    }
}

