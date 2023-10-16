<!DOCTYPE html>
<html>
<head>
	<title>index</title>
</head>
<body>

<table border="1">
<?php require "pages.php";
	
    if (!is_dir("../..")) {
        echo "Folder not found";
        return;
    }

    // Get all files in the folder with .txt extension
    $txtFiles = glob("../..". '/*.*');

    // Check if there are any .txt files
    if (empty($txtFiles)) {
        echo "No .txt files found in the folder";
        return;
    }else{
		
		
		for($i=0;$i<count($txtFiles);$i++){
			echo "<tr>";
			
			echo '<td><a href="detail.php?name=' . urlencode($txtFiles[$i]) . '">' . "view" . '</a></td>';
			echo "<td>".$txtFiles[$i]."</td>";
			echo '<td><a href="edit.php?name=' . urlencode($txtFiles[$i]) . '">Edit</a> | <a href="delete.php?name=' . urlencode($txtFiles[$i]) . '">Delete</a></td>';
			echo "</tr>";
		}
		
	}
?>	
</table>
<p><a href="create.php?row=<?php echo $rowcount; ?>">New Item</a></p>
<hr>
<a href="../../index.php">back to user view</a>
</body>
</html>