<?php
function printcsv()
{
    // Specify the absolute path to the CSV file
    $csvFile = '../../data/users.csv';

    // Check if the CSV file exists
    if (file_exists($csvFile)) {
        
        $csvData = array_map('str_getcsv', file($csvFile));
		//dont think this does anything here
        $headers = array_shift($csvData);
		$count=0;
        foreach ($csvData as $row) {
        //print_r($row);
		$count+=1;
		
		echo "<tr>";
		echo '<td><a href="detail.php?name=' . urlencode($count) . '">' . $count . '</a></td>';
		echo "<td>".$row[0]."</td>";
		echo '<td><a href="edit.php?name=' . urlencode($count) . '">Edit</a> | <a href="delete.php?name=' . urlencode($count) . '">Delete</a></td>';
		echo "</tr>";
		
		
        }
		
       
    } else {
        echo "CSV file not found.";
    }
}







function getCSVRow($csvFilePath, $lineNumber) {
    if (($handle = fopen($csvFilePath, "r")) !== FALSE) {
        $rowNumber = 0;
        
        while (($data = fgetcsv($handle, 0, ',')) !== FALSE) {
            $rowNumber++;
            
            if ($rowNumber == $lineNumber) {
                fclose($handle);
                return $data; // Return the row as an array
            }
        }
        
        fclose($handle);
    }

    return null; // Row not found or file couldn't be opened
}

	
	



function deletecsv($path,$num){
	
	$csvData = file($path);
	if ($num >= 0 && $num < count($csvData)) {
	// Remove the specified line
		unset($csvData[$num]);
		file_put_contents($path, implode('', $csvData));
	}
	
	
}

function editCSVRow($csvFilePath, $lineNumber, $postData) {
    // Read the entire CSV file into an array
    $rows = array_map('str_getcsv', file($csvFilePath));

    // Ensure the line number is valid
    if ($lineNumber >= 1 && $lineNumber <= count($rows)) {
        // Modify the specific row based on POST input
        $rows[$lineNumber - 1] = $postData;

        // Reopen the CSV file for writing
        $file = fopen($csvFilePath, 'w');

        // Write the updated data back to the CSV file
        foreach ($rows as $row) {
            fputcsv($file, $row);
        }

        fclose($file);

        return true; // Edit successful
    } else {
        return false; // Invalid line number
    }
}
?>