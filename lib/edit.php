<?php
session_start(); 

function getUserWorkoutData($userId)
{
    $filePath = $userId . '.json';

    if (file_exists($filePath)) {
        $jsonData = file_get_contents($filePath);
        if (empty($jsonData)) {
            $jsonData = promptUserForInput();
            file_put_contents($filePath, $jsonData);
        }
    } else {
        $jsonData = promptUserForInput();
        file_put_contents($filePath, $jsonData);
    }

    $data = json_decode($jsonData, true);

    return $data;
}

function promptUserForInput()
{
    $workoutData = [];
    $fields = ['WorkoutName', 'Exercises', 'CalorieBurnGoal', 'CaloriesBurned', 'TimeWorkedOut'];

    foreach ($fields as $field) {
        $workoutData[$field] = readline("Enter $field: ");
    }

    return json_encode([$workoutData]);
}

function saveUserWorkoutData($userId, $data)
{
    $filePath = $userId . '.json';
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($filePath, $jsonData);
}

$userId = $_SESSION['email']; 
$userWorkoutData = getUserWorkoutData($userId);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input data from the form
    $workoutName = $_POST['workoutName'];
    $exercises = $_POST['exercises'];
    $calorieBurnGoal = $_POST['calorieBurnGoal'];
    $caloriesBurned = $_POST['caloriesBurned'];
    $timeWorkedOut = $_POST['timeWorkedOut'];

    $updatedWorkoutData = [
        'WorkoutName' => $workoutName,
        'Exercises' => $exercises,
        'CalorieBurnGoal' => $calorieBurnGoal,
        'CaloriesBurned' => $caloriesBurned,
        'TimeWorkedOut' => $timeWorkedOut,
    ];

    $userWorkoutData[] = $updatedWorkoutData;

    saveUserWorkoutData($userId, $userWorkoutData);

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
    <h2>Welcome, <?php echo $userId; ?>!</h2>
    <h3>Your Workout Data:</h3>
    <ul>
        <?php if (!empty($userWorkoutData)) : ?>
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
        <?php else : ?>
            <li>
                <form method="post">
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

                    <button type="submit">Save</button>
                </form>
            </li>
        <?php endif; ?>
    </ul>
    <a href="../tables.php">Return To Workouts</a>
</body>

</html>