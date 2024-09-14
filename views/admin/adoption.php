<?php

include 'config/config.php';

// Query to fetch all adoption requests along with the pet name
try {
    $query_str = "
        SELECT adoptions.*, pets.name AS pet_name
        FROM adoption_requests AS adoptions
        JOIN pets ON adoptions.pet_id = pets.id";
    
    $query = $pdo->prepare($query_str);
    $query->execute();
    $adoption_requests = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
$error_message = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
unset($_SESSION['errors']); // Clear the error message after displaying
?>

<?php include('views/admin/layout/header.php') ?>
<div class="container">
    <?php if ($error_message): ?>
        <div class="alert alert-danger mt-3" role="alert">
            <?php echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>
    <h2 class="mt-5">Adoption Request</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pet Name</th>
                <th>Client Name</th>
                <th>Client Email</th>
                <th>Client Phone</th>
                <th>Status</th>
                <th>Requested At</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($adoption_requests) > 0): ?>
                <?php foreach ($adoption_requests as $request): ?>
                    <tr>
                        <td><?= htmlspecialchars($request['id']) ?></td>
                        <td><?= htmlspecialchars($request['pet_name']) ?></td>
                        <td><?= htmlspecialchars($request['client_name']) ?></td>
                        <td><?= htmlspecialchars($request['client_email']) ?></td>
                        <td><?= htmlspecialchars($request['client_phone']) ?></td>
                        <td><?= htmlspecialchars($request['status']) ?></td>
                        <td><?= htmlspecialchars($request['requested_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">No adoption requests found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php include('views/admin/layout/footer.php') ?>

</div>
</body>
</html>
