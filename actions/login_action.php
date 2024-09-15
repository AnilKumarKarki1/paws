<?php
include('../config/config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = $pdo->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $query->execute([$email, md5($password)]); 
    $user = $query->fetch();

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: /admin/pet');
    } else {
        header('Location: /admin/login');
    }
}
?>
