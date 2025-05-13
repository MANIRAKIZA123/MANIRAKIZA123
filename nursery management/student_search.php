<?php
require 'config.php';

$student = null;
$searchTerm = $_GET['search'] ?? null;

if ($searchTerm) {
    // Search by name instead of student_id (adjust as needed)
    $stmt = $conn->prepare("SELECT * FROM students WHERE name LIKE ?");
    $likeSearch = '%' . $searchTerm . '%';
    $stmt->bind_param("s", $likeSearch);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $student = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $student = false;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Search - Multi-Language</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Nursery Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="student_search.php">Students</a></li>
                    <li class="nav-item"><a class="nav-link" href="teacher_levels.php">Teachers</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php">Users</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Search Section -->
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3>Search Students</h3>
            </div>
            <div class="card-body">
                <form method="GET" action="student_search.php">
                    <div class="mb-3">
                        <label class="form-label">Search Name:</label>
                        <input type="text" name="search" class="form-control" placeholder="Enter student name" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-50">
                            <i class="bi bi-search"></i> Search
                        </button>
                        <a href="add_student.php" class="btn btn-success w-50">
                            <i class="bi bi-plus-circle"></i> Add Student
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Results Section -->
        <?php if ($student === false): ?>
            <div class="alert alert-danger mt-4 text-center">❌ No student found.</div>
        <?php elseif (is_array($student)): ?>
            <div class="alert alert-success mt-4 text-center">✅ Student(s) found:</div>
            <table class="table table-hover table-bordered mt-3">
                <thead class="bg-primary text-white text-center">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Age</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($student as $s): ?>
                        <tr class="text-center">
                            <td><?= isset($s['student_id']) ? htmlspecialchars($s['student_id']) : 'N/A' ?></td>
                            <td><?= htmlspecialchars($s['name']) ?></td>
                            <td><?= htmlspecialchars($s['age']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
