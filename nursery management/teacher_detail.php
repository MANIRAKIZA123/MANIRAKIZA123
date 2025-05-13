<?php
include 'config.php'; // Include database connection

// Check if teacher ID is set in the query
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Escape the ID to prevent SQL injection (optional if using intval, but good practice)
    $sql = "SELECT * FROM teachers WHERE id = $id";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Database query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) == 1) {
        $teacher = mysqli_fetch_assoc($result);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Details</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- External CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">

    <!-- Navigation Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Nursery Management School</a>
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

            <!-- Language Dropdown -->
            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown">
                    Select Language
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="changeLanguage('en')">English</a></li>
                    <li><a class="dropdown-item" href="#" onclick="changeLanguage('rw')">Kinyarwanda</a></li>
                    <li><a class="dropdown-item" href="#" onclick="changeLanguage('fr')">French</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <h1 class="text-center">Teacher Details</h1>

        <?php if (isset($teacher)): ?>
            <div class="card shadow-sm mx-auto" style="max-width: 500px;">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Name:</strong> <?php echo htmlspecialchars($teacher['name']); ?></li>
                        <li class="list-group-item"><strong>Subject:</strong> <?php echo htmlspecialchars($teacher['subject']); ?></li>
                        <li class="list-group-item"><strong>Level:</strong> <?php echo htmlspecialchars($teacher['level']); ?></li>
                    </ul>
                </div>
            </div>
        <?php else: ?>
            <p class="alert alert-warning text-center">Teacher not found.</p>
        <?php endif; ?>

        <div class="text-center mt-3">
            <?php if (isset($teacher)): ?>
                <a href="teacher_list.php?level=<?php echo urlencode($teacher['level']); ?>" class="btn btn-primary">Back to List</a>
            <?php else: ?>
                <a href="teacher_levels.php" class="btn btn-outline-secondary">Back to Levels</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- JavaScript for Language Switching -->
    <script>
    function changeLanguage(lang) {
        if (lang === 'en') {
            document.getElementById("pageTitle").innerText = "Search Students";
        } else if (lang === 'rw') {
            document.getElementById("pageTitle").innerText = "Shakisha Abanyeshuri";
        } else if (lang === 'fr') {
            document.getElementById("pageTitle").innerText = "Rechercher des Étudiants";
        }
    }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
