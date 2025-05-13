<?php
include 'config.php'; // Include database connection

// Retrieve student ID from query parameter
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT * FROM students WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $student = mysqli_fetch_assoc($result);
        } else {
            $error = "Student not found.";
        }
    } else {
        $error = "Database query failed: " . mysqli_error($conn);
    }
} else {
    $error = "No student ID provided.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
                     <a href="student_search.php">Students</a>
                     <a href="teacher_levels.php">Teachers</a>
                     <a href="register.php">Users</a>
               </header>
               <div class="dropdown ms-3">
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
<h1>Student Details</h1>
<?php if (isset($student)): ?>
    <ul>
        <li><strong>Name:</strong> <?= htmlspecialchars($student['name']) ?></li>
        <li><strong>Level:</strong> <?= htmlspecialchars($student['level']) ?></li>
        <li><strong>Age:</strong> <?= htmlspecialchars($student['age']) ?></li>
        <li><strong>Gender:</strong> <?= htmlspecialchars($student['gender']) ?></li>
        <li><strong>Parent1:</strong> <?= htmlspecialchars($student['parent1']) ?></li>
        <li><strong>Parent2:</strong> <?= htmlspecialchars($student['parent2']) ?></li>
        <li><strong>Phone:</strong> <?= htmlspecialchars($student['phone']) ?></li>
        <li><strong>Address:</strong> <?= htmlspecialchars($student['address']) ?></li>
        <li><strong>Location:</strong> <?= htmlspecialchars($student['location']) ?></li>
    </ul>
<?php else: ?>
    <p><?= isset($error) ? htmlspecialchars($error) : "Student not found." ?></p>
<?php endif; ?>
<p><a href="student_search.php">Back to Student Search</a></p>
</body>
</html>
