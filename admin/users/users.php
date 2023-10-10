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



function countCSVRows($csvFilePath) {
    if (file_exists($csvFilePath)) {
        $rowCount = 0;
        
        if (($fp = fopen($csvFilePath, "r")) !== false) {
            // Loop through the file and count the rows
            while (($data = fgetcsv($fp)) !== false) {
                $rowCount++;
				
            }
            
            fclose($fp);
        } else {
            // Unable to open the CSV file
            return false;
        }
        
        return $rowCount;
    } else {
        // CSV file does not exist
        return false;
    }
}



function printRow($csvFilePath,$num){
	
	 if (file_exists($csvFilePath)) {
		if (($fp = fopen($csvFilePath, "r")) !== false) {
			 $csvData = array_map('str_getcsv', file($csvFile));
			//dont think this does anything here
			$headers = array_shift($csvData);
			$count=0;
			 foreach ($csvData as $row) {
				 echo $row[$num];
			 }
				
			}else{echo "file not found";
			}
	 }
}
	
	



function deletecsv($path,$num){
	
	$csvData = file($path);
	if ($num >= 0 && $num < count($csvData)) {
	// Remove the specified line
		unset($csvData[$num]);
		file_put_contents($path, implode('', $csvData));
	}
	
	
}
?>