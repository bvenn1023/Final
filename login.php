<!DOCTYPE html>
<html lang="en">
<?php


//Configure credentials
session_start();

//Establish a connection to the db

function signin($email,$password){
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
	$query=$connection->prepare('SELECT * FROM users WHERE email=?');
	$query->execute([$email]);
	if($query->rowCount()==0) return false;
	$result=$query->fetch();
	if($result['password']!=$password) return false;
	$_SESSION['ID']=$result['ID'];
	$_SESSION['role']=$result['role'];
	$_SESSION['firstname']=$result['firstname'];
	$_SESSION['lastname']=$result['lastname'];
	return true;
}







if(isset($_SESSION['email'])) header("Location: index.php");
$showForm=true;
if(count($_POST)>0){
	if(isset($_POST['email'][0]) && isset($_POST['password'][0])){
		// process information
		
			
		//change age to DOB
		//change workouts
			
			if(signin($_POST['email'],$_POST['password'])==true){
				// Sign the user in
				//1. Save the user's data into the session
				$_SESSION['email']=$_POST['email'];
				$_SESSION['password']=$_POST['password'];

				
				

				//2. Show a welcome message
				echo 'Welcome to our website';$showForm=false;
				if($_SESSION['role']==1){
					print_r($_SESSION['role']);
					header("Location: admin/index.php");
					
				}else{
					header("Location: index.php");
			}
		 }
		}
		
		// The credentials are wrong
		if($showForm) {echo 'Your credentials are wrong';}
					//print_r($line);
					//echo $_POST['email'];
					//echo $_POST['password'];
		}else echo 'Email and password are missing';

//if user isAdmin() header admin folder
if($showForm){
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
   <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
   <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">


    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="POST" action="login.php">
										<div class="form-group">
											<input type="email" class="form-control form-control-user" name="email"
												id="exampleInputEmail" aria-describedby="emailHelp"
												placeholder="Enter Email Address...">
										</div>
										<div class="form-group">
											<input type="password" class="form-control form-control-user" name="password"
												id="exampleInputPassword" placeholder="Password">
										</div>
									  
										<button type="submit">Log in</button>
									</form>

                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
<?php }?>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>
