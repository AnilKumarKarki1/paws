<?php
include '../config/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: /admin/login');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $question = trim($_POST['question']);
    $answer = trim($_POST['answer']);

    if (empty($question) || empty($answer)) {
        $_SESSION['errors'] = "Both question and answer are required.";
        header('Location: /admin/faq');
        exit;
    }

    try {
        $query = $pdo->prepare("UPDATE faq SET question = :question, answer = :answer WHERE id = :id");
        $query->execute([
            'id' => $id,
            'question' => $question,
            'answer' => $answer
        ]);
        $_SESSION['success'] = "FAQ updated successfully!";
    } catch (Exception $e) {
        $_SESSION['errors'] = "Failed to update FAQ. Error: " . $e->getMessage();
    }

    header('Location: /admin/faq');
    exit;
}
