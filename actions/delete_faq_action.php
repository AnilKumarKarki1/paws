<?php
include '../config/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: /admin/login');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    try {
        $query = $pdo->prepare("DELETE FROM faq WHERE id = :id");
        $query->execute(['id' => $id]);
        $_SESSION['success'] = "FAQ deleted successfully!";
    } catch (Exception $e) {
        $_SESSION['errors'] = "Failed to delete FAQ. Error: " . $e->getMessage();
    }

    header('Location: /admin/faq');
    exit;
}
