<?php
session_start(); // Start or resume the session

// Function to get user-specific workout data
function getUserWorkoutData($userId)
{
    // Define the directory where user files are stored
    $userWorkoutDirectory = 'lib';

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

// Function to save user-specific workout data
function saveUserWorkoutData($userId, $data)
{
    $userWorkoutDirectory = 'data/';
    $filePath = $userId . '.json';

    // Encode the data to JSON
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);

    // Save the updated data to the JSON file
    file_put_contents($filePath, $jsonData);
}

// Example of how to use the function to get user-specific workout data
$loggedInUserId = $_SESSION['email']; // Replace with your session variable
$userWorkoutData = getUserWorkoutData($loggedInUserId);

// Check if the form is submitted for editing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input data from the form
    $workoutName = $_POST['workoutName'];
    $exercises = $_POST['exercises'];
    $calorieBurnGoal = $_POST['calorieBurnGoal'];
    $caloriesBurned = $_POST['caloriesBurned'];
    $timeWorkedOut = $_POST['timeWorkedOut'];

    // Create an associative array for the updated workout data
    $updatedWorkoutData = [
        'WorkoutName' => $workoutName,
        'Exercises' => $exercises,
        'CalorieBurnGoal' => $calorieBurnGoal,
        'CaloriesBurned' => $caloriesBurned,
        'TimeWorkedOut' => $timeWorkedOut,
    ];

    // Append the updated workout data
    $userWorkoutData[] = $updatedWorkoutData;

    // Save the workout data to the user's JSON file
    saveUserWorkoutData($loggedInUserId, $userWorkoutData);

    $message = "Workout data saved successfully.";
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Workout Tracker</title>
</head>

<body>
    <h1>Workout Tracker</h1>
    <h2>Welcome, <?php echo $loggedInUserId; ?>!</h2>
    <h3>Your Workout Data:</h3>
    <ul>
        <?php foreach ($userWorkoutData as $index => $workout) : ?>
            <li>
                <form method="post">
                    <label for="workoutName">Workout Name:</label>
                    <input type="text" name="workoutName" value="<?php echo $workout['WorkoutName']; ?>" required><br>

                    <label for="exercises">Exercises:</label>
                    <input type="text" name="exercises" value="<?php echo $workout['Exercises']; ?>" required><br>

                    <label for="calorieBurnGoal">Calorie Burn Goal:</label>
                    <input type="number" name="calorieBurnGoal" value="<?php echo $workout['CalorieBurnGoal']; ?>" required><br>

                    <label for="caloriesBurned">Calories Burned:</label>
                    <input type="number" name="caloriesBurned" value="<?php echo $workout['CaloriesBurned']; ?>" required><br>

                    <label for="timeWorkedOut">Time Worked Out (minutes):</label>
                    <input type="number" name="timeWorkedOut" value="<?php echo $workout['TimeWorkedOut']; ?>" required><br>

                    <button type="submit">Save</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="../tables.php">Return To Workouts</a>
</body>

</html>