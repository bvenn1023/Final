<!DOCTYPE html>
<html lang="en">

<?php

session_start();
?>


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

            if ($_SESSION['role'] == 1) { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Pages</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Admin Features:</h6>
                            <a class="collapse-item" href="admin/users/../index.php">Edit Users</a>
                            <a class="collapse-item" href="admin/pages/../index.php">Edit Pages</a>

                        </div>
                    </div>
                </li>
            <?php } ?>


            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="../tables.php">
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

                <?php
                // Database connection
                $host = 'localhost';
                $name = 'final';
                $user = 'root';
                $pass = '';
                $connection = new PDO("mysql:dbname=$name;host=$host", $user, $pass);

                $user_id = $_SESSION['ID'];
                $query = $connection->prepare('SELECT * FROM workouts WHERE user_id = ?');
                $query->execute([$user_id]);
                ?>

                <!-- Begin Page Content -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                <form method="post" action="createWorkoutData.php" id="workoutForm">
                    <div id="errorMessages" style="color: red;"></div>
                    <table>
                        <thead>
                            <tr>
                                <th>Workout Name</th>
                                <th>Calories Burned</th>
                                <th>Calorie Burn Goal</th>
                                <th>Time Worked Out (Minutes)</th>
                                <th>Type</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$types=array('Cardiovascular','Strength Training','Flexibility Training','Balance and Stability','Bodyweight Exercises','Custom/Other');
                            $row = $query->fetch(PDO::FETCH_ASSOC);
                            if ($row) {
                                echo '<tr>';
                                echo '<td><input type="text" name="name[]" maxlength="20"></td>';
                                echo '<td><input type="text" name="cal_burned[]" pattern="\d{1,4}" title="Enter up to 4 numbers"></td>';
                                echo '<td><input type="text" name="cal_goal[]" pattern="\d{1,4}" title="Enter up to 4 numbers"></td>';
                                echo '<td><input type="text" name="time_worked[]" pattern="\d{1,3}" title="Enter up to 3 numbers"></td>';
                                echo '<td><select name="type[]">';
								foreach ($types as $type) {
									echo '<option value="' . htmlspecialchars($type) . '">' . htmlspecialchars($type) . '</option>';
								}
                                 echo '<td><input type="text" name="workout_date[]" value="' . date('Y-m-d') . '" pattern="\d{4}[-/](0[1-9]|1[0-2])[-/](0[1-9]|[12][0-9]|3[01])" title="Enter a date (yyyy-mm-dd or yyyy/mm/dd)" maxlength="10"></td>';
                                echo '<input type="hidden" name="ID[]" value="' . $_SESSION['ID'] . '">';
                                echo '</tr>';
                            } else {
                                echo 'No workouts found';
                            }
                            ?>
                        </tbody>
                    </table>
                    <input type="submit" value="Save" onclick="return validateForm();">
                </form>

                <script>
                    function validateForm() {
                        $('#errorMessages').html('');
                        $('input').removeClass('invalid');

                        var isValid = true;

                        $('input[name^="cal_burned"], input[name^="cal_goal"], input[name^="time_worked"], input[name^="type"], input[name^="workout_date"]').each(function() {
                            if (!this.checkValidity()) {
                                isValid = false;
                                $('#errorMessages').append('<p>' + $(this).attr('title') + '</p>');
                                $(this).addClass('invalid');
                            }
                        });

                        return isValid;
                    }

                    $(document).ready(function() {
                        $('#workoutForm').submit(function(event) {
                            if (!validateForm()) {
                                event.preventDefault(); 
                            }
                        });
                    });
                </script>


                <style>
                    .invalid {
                        border: 2px solid red;
                    }
                </style>


</html>

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
                <a class="btn btn-primary" href="../login.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../assets/vendors/jquery/jquery.min.js"></script>
<script src="../assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../assets/vendors/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../assets/vendors/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/vendors/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="../assets/js/demo/datatables-demo.js"></script>

</body>

</html>