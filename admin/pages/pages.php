<?php

function readText($path,$lineNumber)
{
	$content = file_get_contents($path);
	
	if ($content !== false) {
		$lines = explode("\n", $content);
		$lineCount = count($lines);
		
		
		
		if ($lineNumber >= 1 && $lineNumber <= $lineCount) {
			$lineContent = $lines[$lineNumber-1];
			//need a for loop that echos below table as well as content based on line number
			
			echo $lineContent;
            
            
		} 
			else {
				return "Line number out of range";
			}
	} 
		else {
			return "File not found or unable to read.";
		}
}

function deleteText($path){
	
	unlink($path);
}


function editText($path){
	if (isset($_POST['newContent'])) {
   
    $newContent = $_POST['newContent'];

    // Check if the file exists
    if (file_exists($path)) {
        
        $file = fopen($path, 'w');
        
        // Write the new content to the file
        if ($file) {
            fwrite($file, $newContent);
            fclose($file);
            echo "File '$path' has been successfully updated.";
        } else {
            echo "Unable to open the file for writing.";
        }
    } else {
        echo "File '$filename' does not exist.";
    }//else randomly executes sometimes?
} else {
    echo "Please provide both a filename and new content.";
}
	
	
}
function createFile($fileName, $text){
	$file=fopen($fileName,"w");
	fwrite($file,$text);
	fclose($file);
	header("Location: index.php");
}
	
	
?>
