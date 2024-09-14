<?php
include '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Use a secure hashing method in production

    $query = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $query->execute([$name, $email, $password]);

    header('Location: /admin/login');
}
?>
