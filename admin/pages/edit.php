
    <form method="POST">


        <label for="newContent">New File Contents:</label><br>
        <textarea id="newContent" name="newContent" value="<?php echo (file_get_contents($_GET["name"]));?>" rows="40" cols="50" required></textarea><br><br>

        <input type="submit" value="Create Item">
    </form>
	
	
<?php
require "pages.php";

echo "<br>";
if (isset($_GET["name"])) {

editText($_GET["name"]);


} else {
    echo '<p>error accessing file</p>';
}

?>
<p><a href="index.php">Back to Item List</a></p>
