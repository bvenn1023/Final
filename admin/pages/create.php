    <form method="POST">
		 <label for="fileName">New File Name(including file extention) : </label>
        <input type="text" id="fileName" name="fileName" required><br><br>

        <label for="newContent">New File Contents:</label><br>
        <textarea id="newContent" name="newContent" rows="4" cols="50" required></textarea><br><br>

        <input type="submit" value="Create Item">
    </form>
	
<?php require "pages.php";

if (isset($_POST["fileName"])&&isset($_POST["newContent"])){
	$filePath="../../ ".$_POST["fileName"];
	$text=$_POST["newContent"];

	createFile($filePath,$text);
}
?>