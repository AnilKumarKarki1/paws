<?php
include '../config/config.php';

header('Content-Type: application/json');

$response = array('success' => false);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            try {
                $query = $pdo->prepare("INSERT INTO subscription (email, subscribed_at) VALUES (?, NOW())");
                $query->execute([$email]);
                
                $response['success'] = true;
                $response['message'] = 'Subscription successful.';
            } catch (Exception $e) {
                $response['message'] = 'Database error: ' . $e->getMessage();
            }
        } else {
            $response['message'] = 'Invalid email address.';
        }
    } else {
        $response['message'] = 'No email provided.';
    }
}

echo json_encode($response);
?>
