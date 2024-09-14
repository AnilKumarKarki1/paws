<?php
include '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $petId = $_POST['id'];

        try {
            // Start a transaction to ensure both image deletion and record deletion happen together
            $pdo->beginTransaction();

            // Get the image path from the database
            $query = $pdo->prepare("SELECT image FROM pets WHERE id = ?");
            $query->execute([$petId]);
            $pet = $query->fetch(PDO::FETCH_ASSOC);

            if ($pet && !empty($pet['image'])) {
                // Define the full path to the image file
                $imagePath = '../public/' . $pet['image'];

                // Check if the image file exists and delete it
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Now delete the pet record from the database
            $deleteQuery = $pdo->prepare("DELETE FROM pets WHERE id = ?");
            $deleteQuery->execute([$petId]);

            // Commit the transaction
            $pdo->commit();

            header('Location: /admin/pet');
            exit();
        } catch (PDOException $e) {
            // Rollback the transaction if any error occurs
            $pdo->rollBack();
            error_log('Database Error: ' . $e->getMessage());
            $_SESSION['errors'] = ['An error occurred while deleting the pet. Please try again.'];
            header('Location: /admin/pet');
            exit();
        } catch (Exception $e) {
            // Rollback the transaction for general errors
            $pdo->rollBack();
            error_log('General Error: ' . $e->getMessage());
            $_SESSION['errors'] = ['An unexpected error occurred. Please try again later.'];
            header('Location: /admin/pet');
            exit();
        }
    }
}
