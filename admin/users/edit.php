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

//deletecsv("../../data/info.csv",$name);
//createcsv();
//print_r($_GET["name"]);
printrow("../../data.users.csv",$_GET["name"]);
} else {
    echo '<p>Item not found.</p>';
}

?>

    <form method="POST">
        <label for="year">User Name:</label>
        <input type="text" id="year" name="year" value="<?phpreadcsv($_GET["name"]["username"])?>"  required><br><br>

        <label for="description">Password:</label><br>
        <input type="Password" id="password" name="password"  required><br><br>

        <input type="submit" value="Edit User">
    </form>










    <p><a href="index.php">Back to Item List</a></p>
</body>
</html>
