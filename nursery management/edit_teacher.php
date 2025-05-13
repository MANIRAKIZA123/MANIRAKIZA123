<?php
include 'config.php';

// Retrieve teacher ID from query or form
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} elseif (isset($_POST['id'])) {
    $id = intval($_POST['id']);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($id)) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $level = mysqli_real_escape_string($conn, $_POST['level']);

    $sql = "UPDATE teachers SET name='$name', subject='$subject', level='$level' WHERE id = $id";
    mysqli_query($conn, $sql);

    header('Location: teacher_detail.php?id=' . $id);
    exit;
}

// Fetch teacher info for pre-filling
if (isset($id)) {
    $res = mysqli_query($conn, "SELECT * FROM teachers WHERE id = $id");
    $teacher = mysqli_fetch_assoc($res);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Teacher</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Edit Teacher</h3>
        </div>
        <div class="card-body">
            <?php if (isset($teacher)): ?>
                <form method="POST" action="edit_teacher.php">
                    <input type="hidden" name="id" value="<?php echo $teacher['id']; ?>">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($teacher['name']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject:</label>
                        <input type="text" id="subject" name="subject" class="form-control" value="<?php echo htmlspecialchars($teacher['subject']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="level" class="form-label">Level:</label>
                        <select name="level" id="level" class="form-select" required>
                            <option value="Baby" <?php if ($teacher['level'] == 'Baby') echo 'selected'; ?>>Baby</option>
                            <option value="Middle" <?php if ($teacher['level'] == 'Middle') echo 'selected'; ?>>Middle</option>
                            <option value="Top" <?php if ($teacher['level'] == 'Top') echo 'selected'; ?>>Top</option>
                        </select>
                    </div>

                          <div class="d-flex justify-content-between">
                          <button type="submit" class="btn btn-success">Save Changes</button>
                          <a href="teacher_levels.php" class="btn btn-secondary">Cancel</a>
                      </div>

                </form>
            <?php else: ?>
                <div class="alert alert-danger text-center">Teacher not found.</div>
                <div class="text-center">
                    <a href="teacher_levels.php" class="btn btn-secondary">Back to List</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Bootstrap JS (optional for dropdowns, modals, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
