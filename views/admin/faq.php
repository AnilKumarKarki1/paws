<?php
include 'config/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: admin/login');
    exit;
}

$query = $pdo->prepare("SELECT * FROM faq");
$query->execute();
$faqs = $query->fetchAll();

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
    <h2 class="mt-5">Frequently Asked Questions</h2>
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createModal">Add New FAQ</button>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Question</th>
                <th>Answer</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($faqs as $faq): ?>
                <tr>
                    <td><?php echo $faq['question']; ?></td>
                    <td><?php echo $faq['answer']; ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" data-id="<?php echo $faq['id']; ?>">Edit</button>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $faq['id']; ?>">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Create FAQ Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Add New FAQ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="../actions/create_faq_action.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="question">Question</label>
                            <input type="text" class="form-control" id="question" name="question" required>
                        </div>
                        <div class="form-group">
                            <label for="answer">Answer</label>
                            <textarea class="form-control" id="answer" name="answer" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit FAQ Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit FAQ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="../actions/update_faq_action.php">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_question">Question</label>
                            <input type="text" class="form-control" id="edit_question" name="question" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_answer">Answer</label>
                            <textarea class="form-control" id="edit_answer" name="answer" required></textarea>
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

    <!-- Delete FAQ Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete FAQ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="../actions/delete_faq_action.php">
                    <input type="hidden" id="delete_id" name="id">
                    <div class="modal-body">
                        <p>Are you sure you want to delete this FAQ?</p>
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
<?php include('views/admin/layout/footer.php') ?>

<script>
    $('#editModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);

        $.ajax({
            url: '../../actions/get_faq_details.php',
            method: 'GET',
            data: { id: id },
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
                    modal.find('#edit_question').val(data.question);
                    modal.find('#edit_answer').val(data.answer);
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
