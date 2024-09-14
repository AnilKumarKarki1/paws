<?php
include '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pet_id = $_POST['pet_id'];
    $client_name = $_POST['client_name'];
    $client_email = $_POST['client_email'];
    $client_phone = $_POST['client_phone'] ?? '';

    try {
        // Validate the form inputs
        if (empty($client_name) || empty($client_email) || empty($pet_id)) {
            throw new Exception("All required fields must be filled out.");
        }

        // Prepare and execute the insertion query
        $query = $pdo->prepare("INSERT INTO adoption_requests (pet_id, client_name, client_email, client_phone) VALUES (?, ?, ?, ?)");
        $query->execute([$pet_id, $client_name, $client_email, $client_phone]);

        // Return success message
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
