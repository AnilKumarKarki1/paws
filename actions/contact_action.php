<?php
include '../config/config.php';  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'] ?? '';  // Optional phone field
    $message = $_POST['message'];

    try {
        if (empty($name) || empty($email) || empty($message)) {
            throw new Exception("Name, Email, and Message are required.");
        }

        $query = $pdo->prepare("INSERT INTO leads (name, email, phone, message) VALUES (?, ?, ?, ?)");
        $query->execute([$name, $email, $phone, $message]);

        echo json_encode(['success' => true, 'message' => 'Thank You For Contacting will get Back to you soom!']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
