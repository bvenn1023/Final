<?php

$host = 'localhost';
// database name not table name
$name = 'final';
$user = 'root';
$pass = '';

$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];

$db = new PDO('mysql:host=' . $host . ';dbname=' . $name . ';charset=utf8mb4', $user, $pass, $opt);

?>