<?php
include '../config/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: /admin/login');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $query = $pdo->prepare("SELECT * FROM faq WHERE id = :id");
        $query->execute(['id' => $id]);
        $faq = $query->fetch(PDO::FETCH_ASSOC);

        if ($faq) {
            echo json_encode($faq);
        } else {
            echo json_encode(['error' => 'FAQ not found']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => 'Error retrieving FAQ: ' . $e->getMessage()]);
    }
}
