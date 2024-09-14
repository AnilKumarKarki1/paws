<?php
$host = 'localhost';    
$db = 'website'; 
$user = 'root';
$pass = 'root';

try {
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo 'Connected successfully';
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
