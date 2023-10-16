<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_index'])) {
        $deleteIndex = $_POST['delete_index'];
        $userId = $_SESSION['email'];
        $filePath = "lib/{$userId}.json";

        if (file_exists($filePath)) {
            $jsonData = file_get_contents($filePath);
            $data = json_decode($jsonData, true);

            if (array_key_exists($deleteIndex, $data)) {
                unset($data[$deleteIndex]);
                $updatedData = array_values($data);
                $updatedJsonData = json_encode($updatedData, JSON_PRETTY_PRINT);
                file_put_contents($filePath, $updatedJsonData);
            }
        }
    }
}

header("Location: edit.php");
exit();
