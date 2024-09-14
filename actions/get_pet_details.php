<?php
try {
    include '../config/config.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Fetch pet details from the database
        $query = $pdo->prepare("SELECT * FROM pets WHERE id = ?");
        $query->execute([$id]);
        $pet = $query->fetch(PDO::FETCH_ASSOC);
        if ($pet) {
            echo json_encode($pet);
        } else {
            throw new Exception('Pet not found');
        }
    } else {
        throw new Exception('Invalid ID');
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
