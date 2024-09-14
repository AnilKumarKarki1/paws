<?php
include '../config/config.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Validate form inputs
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $breed = isset($_POST['breed']) ? $_POST['breed'] : '';
        $age = isset($_POST['age']) ? $_POST['age'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        if (empty($name) || empty($breed) || empty($age) || empty($description)) {
            throw new Exception('All fields are required.');
        }

        // Handle image upload
        $image = '';
        if (!empty($_FILES['image']['name'])) {
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

            if (!in_array($imageFileType, $allowedExtensions)) {
                throw new Exception('Only JPG, JPEG, PNG & GIF files are allowed.');
            }

            $image = 'uploads/' . basename($_FILES['image']['name']);
            if (!move_uploaded_file($_FILES['image']['tmp_name'], '../public/' . $image)) {
                throw new Exception('Failed to upload the image.');
            }
        }

        // Insert pet data into the database
        $query = $pdo->prepare("INSERT INTO pets (name, breed, age, description, image) VALUES (?, ?, ?, ?, ?)");
        $query->execute([$name, $breed, $age, $description, $image]);

        header('Location: /admin/pet');
        exit();

    } catch (Exception $e) {
        // Store error message in the session and redirect back to the form
        $_SESSION['errors'] = $e->getMessage();
        header('Location: /admin/pet');
        exit();
    }
}
