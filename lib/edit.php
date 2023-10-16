<?php
session_start();

$userId = $_SESSION['id'];

function getUserWorkoutData($userId)
{
    $filePath = $userId . '.json';

    if (file_exists($filePath)) {
        $jsonData = file_get_contents($filePath);
        if (empty($jsonData)) {
            $jsonData = "[]";
            file_put_contents($filePath, $jsonData);
        }
    } else {
        $jsonData = "[]";
        file_put_contents($filePath, $jsonData);
    }

    $data = json_decode($jsonData, true);

    return $data;
}

function saveUserWorkoutData($userId, $data)
{
    $filePath = $userId . '.json';
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($filePath, $jsonData);
}

function deleteUserWorkoutData($userId, $index)
{
    $filePath = $userId . '.json';
    $jsonData = file_get_contents($filePath);
    $data = json_decode($jsonData, true);

    if (isset($data[$index])) {
        array_splice($data, $index, 1);
        saveUserWorkoutData($userId, $data);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['save_index'])) {
        // Handle save operation
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

        $userWorkoutData = getUserWorkoutData($userId);
        $userWorkoutData[] = $updatedWorkoutData;
        saveUserWorkoutData($userId, $userWorkoutData);
    }

    if (isset($_POST['delete_index'])) {
        // Handle delete operation
        $deleteIndex = $_POST['delete_index'];
        deleteUserWorkoutData($userId, $deleteIndex);
    }
}

$userWorkoutData = getUserWorkoutData($userId);
?>



<!DOCTYPE html>
<html>

<head>
    <title>Workout Tracker</title>
</head>

<body>
    <h1>Workout Tracker</h1>
    <h2>Welcome, <?php echo $_SESSION['email']; ?>!</h2>
    <h3>Your Workout Data:</h3>
    <ul>
        <?php if (!empty($userWorkoutData)) : ?>
            <?php foreach ($userWorkoutData as $index => $workout) : ?>
                <li>
                    <form method="post">
                        <label for="workoutName">Workout Name:</label>
                        <input type="text" name="workoutName" value="<?php echo isset($workout['WorkoutName']) ? $workout['WorkoutName'] : ''; ?>" required><br>

                        <label for="exercises">Exercises:</label>
                        <input type="text" name="exercises" value="<?php echo isset($workout['Exercises']) ? $workout['Exercises'] : ''; ?>" required><br>

                        <label for="calorieBurnGoal">Calorie Burn Goal:</label>
                        <input type="number" name="calorieBurnGoal" value="<?php echo isset($workout['CalorieBurnGoal']) ? $workout['CalorieBurnGoal'] : ''; ?>" required><br>

                        <label for="caloriesBurned">Calories Burned:</label>
                        <input type="number" name="caloriesBurned" value="<?php echo isset($workout['CaloriesBurned']) ? $workout['CaloriesBurned'] : ''; ?>" required><br>

                        <label for="timeWorkedOut">Time Worked Out (minutes):</label>
                        <input type="number" name="timeWorkedOut" value="<?php echo isset($workout['TimeWorkedOut']) ? $workout['TimeWorkedOut'] : ''; ?>" required><br>

                        <button type="submit" name="save_index" value="<?php echo $index; ?>">Save</button>
                    </form>

                    <form method="post">
                        <input type="hidden" name="delete_index" value="<?php echo $index; ?>">
                        <button type="submit" name="delete">Delete</button>
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

                    <button type="submit" name="save_index" value="new">Save</button>
                </form>
            </li>
        <?php endif; ?>




    </ul>
    <a href="../tables.php">Return To Workouts</a>
</body>

</html>