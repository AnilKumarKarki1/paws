<?php
include 'config/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: admin/login');
    exit;
}

$query = $pdo->prepare("SELECT * FROM pets");
$query->execute();
$pets = $query->fetchAll();


$error_message = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
unset($_SESSION['errors']); // Clear the error message after displaying
?>
<?php include('includes/header.php') ?>
<div class="container">
    <?php if ($error_message): ?>
        <div class="alert alert-danger mt-3" role="alert">
            <?php echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>
    <h2 class="mt-5">Pets</h2>
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createModal">Add New Pet</button>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Breed</th>
                <th>Age</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pets as $pet): ?>
                <tr>
                    <td><?php echo $pet['name']; ?></td>
                    <td><?php echo $pet['breed']; ?></td>
                    <td><?php echo $pet['age']; ?></td>
                    <td><?php echo $pet['description']; ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" data-id="<?php echo $pet['id']; ?>">Edit</button>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $pet['id']; ?>">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Add New Pet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="../actions/create_pet_action.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="breed">Breed</label>
                            <input type="text" class="form-control" id="breed" name="breed">
                        </div>
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="number" class="form-control" id="age" name="age">
                        </div>

                        <div class="form-group"> <label for="description">Description</label> <textarea class="form-control" id="description" name="description"></textarea> </div>
                        <div class="form-group"> <label for="image">Image</label> <input type="file" class="form-control-file" id="image" name="image"> </div>
                    </div>
                    <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> <button type="submit" class="btn btn-primary">Save</button> </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Pet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="../actions/update_pet_action.php" enctype="multipart/form-data">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_name">Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_breed">Breed</label>
                            <input type="text" class="form-control" id="edit_breed" name="breed">
                        </div>
                        <div class="form-group">
                            <label for="edit_age">Age</label>
                            <input type="number" class="form-control" id="edit_age" name="age">
                        </div>
                        <div class="form-group">
                            <label for="edit_description">Description</label>
                            <textarea class="form-control" id="edit_description" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_image">Image</label>
                            <input type="file" class="form-control-file" id="edit_image" name="image" accept="image/png, image/jpeg, image/png, image/gif">
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

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Pet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="../actions/delete_pet_action.php">
                    <input type="hidden" id="delete_id" name="id">
                    <div class="modal-body">
                        <p>Are you sure you want to delete this pet?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<?php include('includes/footer.php') ?>

<script>
    $('#editModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);

        $.ajax({
            url: '../../actions/get_pet_details.php',
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
                console.log(data);
                if (data.error) {
                    alert('Error: ' + data.error);
                } else {
                    modal.find('#edit_id').val(data.id);
                    modal.find('#edit_name').val(data.name);
                    modal.find('#edit_breed').val(data.breed);
                    modal.find('#edit_age').val(data.age);
                    modal.find('#edit_description').val(data.description);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Failed to fetch data. Please check your connection.");
            }
        });
    });


    $('#deleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        modal.find('#delete_id').val(id);
    });
</script>
</body>

</html>