<?php
session_start();
$userId = $_SESSION['email'];
$filePath = $userId . '.json';
// Check if the user is logged in
if (isset($_SESSION['email'])) {

    // If the "Save Workout" button is clicked
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
        // Get input data from the form
        $workoutName = $_POST['workoutName'];
        $exercises = $_POST['exercises'];
        $calorieBurnGoal = $_POST['calorieBurnGoal'];
        $caloriesBurned = $_POST['caloriesBurned'];
        $timeWorkedOut = $_POST['timeWorkedOut'];

        // Create an associative array for the workout data
        $workoutData = [
            'WorkoutName' => $workoutName,
            'Exercises' => $exercises,
            'CalorieBurnGoal' => $calorieBurnGoal,
            'CaloriesBurned' => $caloriesBurned,
            'TimeWorkedOut' => $timeWorkedOut,
        ];

        // Get the current user's JSON file path


        // Read existing data if the JSON file exists
        $data = [];
        if (file_exists($filePath)) {
            $jsonData = file_get_contents($filePath);
            $data = json_decode($jsonData, true);
        }

        // Append the new workout data
        $data[] = $workoutData;

        // Save the updated data to the JSON file
        file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT));

        $message = "Workout data saved successfully.";
    }
} else {
    $message = "User not logged in.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Workout Tracker</title>
</head>

<body>
    <h1>Workout Tracker</h1>

    <?php if (isset($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="post" action="create.php">
        <label for="workoutName">Workout Name:</label>
        <input type="text" name="workoutName" required><br>

        <label for="exercises">Exercises:</label>
        <input type="text" name="exercises" required><br>

        <label for="calorieBurnGoal">Calorie Burn Goal:</label>
        <input type="number" name="calorieBurnGoal" required><br>

        <label for="caloriesBurned">Calories Burned:</label>
        <input type="number" name="caloriesBurned" required><br>

        <label for="timeWorkedOut">Time Worked Out (minutes):</label>
        <input type="number" name="timeWorkedOut" required><br>

        <button type="submit" name="save">Save Workout</button>
    </form>
    <a href="edit.php">Edit Wokouts</a><br>
    <a href="../tables.php">Return To Workouts</a>

</body>

</html>