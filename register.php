<!DOCTYPE html>
<?php

function createUser(){

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["email"];
        $password = $_POST["password"];
		
        if (empty($name) || empty($password)) {
            echo '<p>Please fill in all fields.</p>';
        } else {
			try{
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
				$query=$connection->prepare("INSERT INTO users (email, password, firstname, lastname, height,weight,age, role) VALUES (?, ?, ?, ?, ?,?,?,?)");
				$hashedpass=password_hash($_POST["password"],PASSWORD_DEFAULT);
				$query->execute([$_POST["email"], $hashedpass, $_POST["firstname"], $_POST["lastname"],$_POST["height"],$_POST["weight"],$_POST["age"], 0]);
				
	  
				header("Location: login.php");
				exit;
			}catch (PDOException $e) {
			echo "Error: please contact admin and try again later " ;
			}
        }
    }
}
//checks if email has already been used
function checkStatus($email){
	try{
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
			$query=$connection->prepare("SELECT * FROM users WHERE email=?") ;
			$query->execute([$email]);
			if($query->rowCount()>0){
				return true;
				
			}
	}catch (PDOException $e) {
    echo "Error: please contact admin and try again later " ;
	}
	
	
}
$currentYear = date("Y");

//input validation
if (
    isset($_POST["firstname"]) &&
    isset($_POST["lastname"]) &&
    isset($_POST["email"]) &&
    isset($_POST["password"]) &&
    isset($_POST["height"]) &&
    isset($_POST["weight"]) &&
    isset($_POST["birthdate"]) &&
    isset($_POST["password2"])
) {
		if (checkStatus($_POST["email"])==false){
			if (!is_string($_POST["firstname"]) || !is_string($_POST["lastname"])) {
				echo ("Please enter your name");
			} elseif (!is_int((int)$_POST["height"]) || !is_int((int)$_POST["weight"])) {
				echo ("Please enter height and weight as whole numbers");
			} 
			 elseif ($_POST["password"] != $_POST["password2"]) {
				echo("Passwords don't match");
			} else {
				$_POST["age"] = $_POST["birthdate"] ;
				
				createUser();
			}
	} else{echo("You already have an account! please login below");}
}





?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

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

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="POST" action="register.php">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName" name="firstname" maxlength="20"
                                            pattern="[A-Za-z]{1,20}" placeholder="First Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName" name="lastname" maxlength="20"
											pattern="[A-Za-z]{1,20}"
                                            placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email" maxlength="48"
                                        placeholder="Email Address">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" name="password"
                                            id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" name="password2"
                                            id="exampleRepeatPassword" placeholder="Repeat Password">
                                    </div>
                                </div>
								 <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="number" class="form-control form-control-user" name="height" max="96"
                                            id="exampleInputPassword" placeholder="height (inches)">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control form-control-user" name="weight" max="999"
                                            id="exampleRepeatPassword" placeholder="weight (lbs)">
                                    </div>
                                </div>
								 <div class="form-group row">
                                    
									<div class="col-sm-6 mb-3 mb-sm-0">
									    <input type="date" class="form-control form-control-user" name="birthdate"
                                            id="exampleRepeatPassword" placeholder="birthdate MM-DD-YYYY" >
                                        
                                          
                                    </div>
                                   
                                    
                                </div>
                               <button type="submit" >Create Account</button>
                 
                                
                                
                            </form>
                            <hr>
                         
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>