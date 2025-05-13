<?php 
include 'config.php';  // Include database connection

$error = '';
$success = '';
$teacher = null;

// Retrieve teacher ID from query or form
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} elseif (isset($_POST['id'])) {
    $id = intval($_POST['id']);
}

// If form submitted, update teacher
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($id)) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $level = mysqli_real_escape_string($conn, $_POST['level']);

    $sql = "UPDATE teachers SET name='$name', subject='$subject', level='$level' WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        // Redirect to detail page
        header('Location: teacher_detail.php?id=' . $id);
        exit;
    } else {
        $error = "Error updating record: " . mysqli_error($conn);
    }
}

// Fetch teacher info for pre-filling
if (isset($id)) {
    $res = mysqli_query($conn, "SELECT * FROM teachers WHERE id = $id");
    if ($res) {
        $teacher = mysqli_fetch_assoc($res);
        if (!$teacher) {
            $error = "Teacher with ID $id not found.";
        }
    } else {
        $error = "Error fetching teacher: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Teacher</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Teacher</h1>

    <?php if ($error): ?>
        <div style="color: red;"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <?php if ($teacher): ?>
    <form method="POST" action="edit_teacher.php">
        <input type="hidden" name="id" value="<?php echo $teacher['id']; ?>">
        <div>
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($teacher['name']); ?>" required>
        </div>
        <div>
            <label>Subject:</label>
            <input type="text" name="subject" value="<?php echo htmlspecialchars($teacher['subject']); ?>" required>
        </div>
        <div>
            <label>Level:</label>
            <select name="level">
                <option value="Baby" <?php if ($teacher['level'] == 'Baby') echo 'selected'; ?>>Baby</option>
                <option value="Middle" <?php if ($teacher['level'] == 'Middle') echo 'selected'; ?>>Middle</option>
                <option value="Top" <?php if ($teacher['level'] == 'Top') echo 'selected'; ?>>Top</option>
            </select>
        </div>
        <button type="submit">Save Changes</button>
    </form>
    <?php elseif (!$error): ?>
        <p>Teacher not found.</p>
    <?php endif; ?>

    <p><a href="teacher_levels.php">Cancel</a></p>
</body>
</html>
