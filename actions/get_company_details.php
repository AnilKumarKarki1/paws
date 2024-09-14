<?php

include '../config/config.php';

if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'No company ID provided.']);
    exit;
}

$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

if (!$id) {
    echo json_encode(['error' => 'Invalid company ID.']);
    exit;
}

// Fetch company details from the database
try {
    $query = $pdo->prepare("SELECT * FROM company WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $company = $query->fetch(PDO::FETCH_ASSOC);

    if ($company) {
        echo json_encode($company);
    } else {
        echo json_encode(['error' => 'Company not found.']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
