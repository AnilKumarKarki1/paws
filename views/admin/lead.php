<?php

include 'config/config.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: admin/login');
    exit;
}

$query = $pdo->prepare("SELECT * FROM leads");
$query->execute();
$leads = $query->fetchAll();
?>

<?php include('views/admin/layout/header.php') ?>
<div class="container">
    <h2 class="mt-5">Leads</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($leads) > 0): ?>
                <?php foreach ($leads as $lead): ?>
                    <tr>
                        <td><?= htmlspecialchars($lead['id']) ?></td>
                        <td><?= htmlspecialchars($lead['name']) ?></td>
                        <td><?= htmlspecialchars($lead['email']) ?></td>
                        <td><?= htmlspecialchars($lead['phone']) ?></td>
                        <td><?= htmlspecialchars($lead['message']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">No Lead found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php include('views/admin/layout/footer.php') ?>

</div>
</body>
</html>
