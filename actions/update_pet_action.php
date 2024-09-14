<?php
include '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $breed = isset($_POST['breed']) ? trim($_POST['breed']) : '';
    $age = isset($_POST['age']) ? intval($_POST['age']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';

    try {
        // Validate form fields
        if (empty($name) || empty($breed) || empty($age) || empty($description)) {
            throw new Exception('All fields are required.');
        }

        if (!is_numeric($age) || $age <= 0) {
            throw new Exception('Please enter a valid age.');
        }

        // Allowed image extensions
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        // Begin transaction
        $pdo->beginTransaction();

        // Fetch the current image path
        $query = $pdo->prepare("SELECT image FROM pets WHERE id = ?");
        $query->execute([$id]);
        $pet = $query->fetch();

        $oldImage = $pet['image'];  // Store the old image path

        // Prepare the new image path if a new file is uploaded
        $image = $oldImage; // If no new image is uploaded, retain the old one
        if (!empty($_FILES['image']['name'])) {
            $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

            // Validate image type
            if (!in_array($imageFileType, $allowedExtensions)) {
                throw new Exception('Invalid image type. Only JPG, JPEG, PNG, and GIF files are allowed.');
            }

            // Set the new image path
            $image = 'uploads/' . basename($_FILES['image']['name']);
            
            // Move the uploaded file
            if (!move_uploaded_file($_FILES['image']['tmp_name'], '../public/' . $image)) {
                throw new Exception('Failed to upload the image.');
            }

            // Delete the old image if a new one was uploaded
            if ($oldImage && file_exists('../public/' . $oldImage)) {
                unlink('../public/' . $oldImage);
            }
        }

        // Update the pet record
        $query = $pdo->prepare("UPDATE pets SET name = ?, breed = ?, age = ?, description = ?, image = ? WHERE id = ?");
        $query->execute([$name, $breed, $age, $description, $image, $id]);

        $pdo->commit();

        header('Location: /admin/pet');
        exit;
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['errors'] = $e->getMessage();
        header('Location: /admin/pet');
        exit();
    }
}
?>
