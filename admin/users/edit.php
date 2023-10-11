<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
</head>
<body>
    <h1>Edit Item</h1>

<?php
require "users.php";

if (isset($_GET["name"])) {
$name = $_GET["name"];
$data=GetCSVRow("../../data/users.csv",$_GET["name"]+1);

	if(isset($_POST["email"])&&isset($_POST["password"])&&isset($_POST["admin"])){
		editCSVRow("../../data/users.csv",$_GET["name"]+1,$_POST);
	}
} else {
    echo '<p>Item not found.</p>';
}

?>

    <form method="POST">
        <label for="email">User Name:</label>
        <input type="text" id="email" name="email" value="<?php echo $data[0];?>"  required><br><br>

        <label for="description">Password:</label><br>
        <input type="Password" id="password" name="password" value="<?php echo $data[1];?>"  required><br><br>
		
		<label for="admin">Admin status: </label>
		value of 1 means admin, 0 means user
		<input type="text" id="admin" name="admin" value="<?php echo $data[2];?>"  required><br><br>
        <input type="submit" value="Edit User">
    </form>










    <p><a href="index.php">Back to Item List</a></p>
</body>
</html>
