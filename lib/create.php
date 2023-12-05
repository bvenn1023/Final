<!-- CREATE.PHP FOR TABLES.PHP -->

<?php

// $userId = $_SESSION['email'];
// $filePath = $userId . '.json';
// Check if the user is logged in
/* if (isset($_SESSION['email'])) {

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
} */
?>

<!-- <!DOCTYPE html>
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

</html> -->
<?php
require_once('db.php');
session_start();

function getUserWorkoutData($userId)
{
    $filePath = $_SESSION['id'] . '.json';

    if (file_exists($filePath)) {
        $jsonData = file_get_contents($filePath);
    } else {
        $jsonData = '[]';
        file_put_contents($filePath, $jsonData);
    }

    $data = json_decode($jsonData, true);

    return $data;
}
$userId = $_SESSION['id'];
$userWorkoutData = getUserWorkoutData($userId);

?>


<!--  function getUserWorkoutData($userId)
{
    $filePath = 'lib/' . $_SESSION['id'] . '.json';

    if (file_exists($filePath)) {
        $jsonData = file_get_contents($filePath);
    } else {
        $jsonData = '[]';
        file_put_contents($filePath, $jsonData);
    }

    $data = json_decode($jsonData, true);

    return $data;
}
$userId = $_SESSION['id'];
$userWorkoutData = getUserWorkoutData($userId);  -->



<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Tables</title>

    <!-- Custom fonts for this template -->
    <link href="../assets/vendors/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../assets/vendors/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Gymify </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="../index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Nav Item - Pages Collapse Menu -->
            <?php //only executes if user is admin, links to admin features

            if ($_SESSION['admin'] == true) { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Pages</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Admin Features:</h6>
                            <a class="collapse-item" href="admin/users/../../../../index.php">Edit Users</a>
                            <a class="collapse-item" href="admin/pages/../../../../index.php">Edit Pages</a>

                        </div>
                    </div>
                </li>
            <?php } ?>


            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Workouts</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <h2>Gymify Fitness Application</h2>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["email"]; ?></span>
                                <form method="POST">
                                    <input type="submit" name="logout" value="logout">
                                </form>
                            </a>


                        </li>



                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Create Workouts</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Workout Name</th>
                                            <th>Exercises</th>
                                            <th>Calorie Burn Goal</th>
                                            <th>Calories Burned</th>
                                            <th>Time Worked Out (Minutes)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <form method="post">
                                                <td><input type="text" name="workoutName" required></td>
                                                <td><input type="text" name="exercises" required></td>
                                                <td><input type="number" name="calorieGoal" required></td>
                                                <td><input type="number" name="caloriesBurned" required></td>
                                                <td><input type="number" name="timeWorkedOut" required></td>
                                                <td><button type="submit">Create</button></td>
                                            </form>
                                        </tr>
                                        <?php


                                        $host = 'localhost';
                                        $name = 'final';
                                        $user = 'root';
                                        $pass = '';

                                        //Specify options
                                        $opt = [
                                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                                            PDO::ATTR_EMULATE_PREPARES => false
                                        ];
                                        $connection = new PDO('mysql:host=' . $host . ';dbname=' . $name . ';charset=utf8mb4', $user, $pass, $opt);

                                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                                                    // Get form data
                                                    $name = $_POST['workoutName'];
                                                    $exercises = $_POST['exercises'];
                                                    $calories = $_POST['caloriesBurned'];
                                                    $time = $_POST['timeWorkedOut'];

                                                    // Insert into database
                                                    $stmt = $connection->prepare("INSERT INTO workouts (name, exercises, cal_burned, time_worked) VALUES (?, ?, ?, ?)");

                                                    $stmt->execute([$name, $exercises, $calories, $time]);
                                                }

                                                // Get workouts for display
                                                $query = $connection->prepare('SELECT * FROM workouts');
                                                $query->execute();
                                        ?>

                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Exercises</th>
                                                    <th>Calories Burned</th>
                                                    <th>Time</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <?php while ($row = $query->fetch()) : ?>
                                                    <tr>
                                                        <td><?php echo $row['name']; ?></td>
                                                        <td><?php echo $row['cal_burned']; ?></td>
                                                        <td><?php echo $row['time_worked']; ?></td>
                                                    </tr>
                                                <?php endwhile; ?>

                                            </tbody>
                                        </table>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2020</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="assets/vendors/jquery/jquery.min.js"></script>
        <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="assets/vendors/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="assets/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="assets/vendors/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/vendors/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="assets/js/demo/datatables-demo.js"></script>

</body>

</html>