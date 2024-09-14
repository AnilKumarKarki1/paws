<?php
include 'config/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: admin/login');
    exit;
}

$query = $pdo->prepare("SELECT * FROM company");
$query->execute();
$companies = $query->fetchAll();

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
    <h2 class="mt-5">Companies</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($companies as $company): ?>
                <tr>
                    <td><?php echo $company['name']; ?></td>
                    <td><?php echo $company['address']; ?></td>
                    <td><?php echo $company['email']; ?></td>
                    <td><?php echo $company['phone']; ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" data-id="<?php echo $company['id']; ?>">Edit</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="../actions/update_company_action.php">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_name">Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_address">Address</label>
                            <input type="text" class="form-control" id="edit_address" name="address">
                        </div>
                        <div class="form-group">
                            <label for="edit_email">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="edit_phone">Phone Number</label>
                            <input type="text" class="form-control" id="edit_phone" name="phone">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>

<?php include('views/admin/layout/footer.php') ?>

<script>
    $('#editModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);

        $.ajax({
            url: '../../actions/get_company_details.php',
            method: 'GET',
            data: {
                id: id
            },
            dataType: 'json',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(data) {
                if (data.error) {
                    alert('Error: ' + data.error);
                } else {
                    modal.find('#edit_id').val(data.id);
                    modal.find('#edit_name').val(data.name);
                    modal.find('#edit_address').val(data.address);
                    modal.find('#edit_email').val(data.email);
                    modal.find('#edit_phone').val(data.phone);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Failed to fetch data. Please check your connection.");
            }
        });
    });
</script>
</body>

</html>
