
    <form method="POST">


        <label for="newContent">New File Contents:</label><br>
        <textarea id="newContent" name="newContent" rows="4" cols="50" required></textarea><br><br>

        <input type="submit" value="Create Item">
    </form>
	
	
<?php
require "pages.php";
echo "current contents: <br>";
echo file_get_contents($_GET["name"]);
echo "<br>";
if (isset($_GET["name"])) {

editText($_GET["name"]);
echo "<br> updated contents: <br>";
echo file_get_contents($_GET["name"]);
echo "<br>";


} else {
    echo '<p>error accessing file</p>';
}

?>
<p><a href="index.php">Back to Item List</a></p>
