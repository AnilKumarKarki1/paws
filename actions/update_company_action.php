<?php
// update_company_action.php

include '../config/config.php';
session_start();

if (!isset($_POST['id']) || !isset($_POST['name']) || !isset($_POST['address']) || !isset($_POST['email']) || !isset($_POST['phone'])) {
    $_SESSION['errors'] = 'All fields are required.';
    header('Location: /admin/company');
    exit;
}

// Sanitize and validate input data
$id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
$name = filter_var($_POST['name']);
$address = filter_var($_POST['address']);
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$phone = filter_var($_POST['phone']);

if (!$id || !$name || !$address || !$email || !$phone) {
    $_SESSION['errors'] = 'Invalid input. Please ensure all fields are properly filled out.';
    header('Location: /admin/company');
    exit;
}

// Update company information in the database
try {
    $query = $pdo->prepare("UPDATE company SET name = :name, address = :address, email = :email, phone = :phone WHERE id = :id");
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':address', $address, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':phone', $phone, PDO::PARAM_STR);
    $query->bindParam(':id', $id, PDO::PARAM_INT);

    $query->execute();
    
    $_SESSION['success'] = 'Company updated successfully.';
} catch (PDOException $e) {
    $_SESSION['errors'] = 'Failed to update company: ' . $e->getMessage();
}

header('Location: /admin/company');
exit;
