<?php
session_start(); // Start session to store language preference
include 'config.php'; // Include database connection

// Check if connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle language selection
if (isset($_GET['language'])) {
    $_SESSION['language'] = $_GET['language']; // Store selected language in session
}
$language = $_SESSION['language'] ?? 'en'; // Default to English

// Define translations
$translations = [
    'en' => ['title' => 'Add Teacher', 'name' => 'Name:', 'gender' => 'Gender:', 'subject' => 'Subject:', 'level' => 'Level:', 'submit' => 'Add Teacher', 'cancel' => 'Cancel'],
    'rw' => ['title' => 'Ongeramo Mwarimu', 'name' => 'Izina:', 'gender' => 'Igitsina:', 'subject' => 'Isomo:', 'level' => 'Urwego:', 'submit' => 'Ongeramo Mwarimu', 'cancel' => 'Hagarika'],
    'fr' => ['title' => 'Ajouter un Professeur', 'name' => 'Nom:', 'gender' => 'Genre:', 'subject' => 'Matière:', 'level' => 'Niveau:', 'submit' => 'Ajouter Professeur', 'cancel' => 'Annuler']
];

// If form is submitted, insert new teacher into the database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $subject = $_POST['subject'];
    $level = $_POST['level'];

    // Use prepared statements for security
    $stmt = $conn->prepare("INSERT INTO teachers (name, gender, subject, level) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $gender, $subject, $level);

    // Execute query and handle errors
    if ($stmt->execute()) {
        header('Location: teacher_levels.php'); // Redirect after successful addition
        exit;
    } else {
        echo "<div class='alert alert-danger text-center'>Error adding teacher: " . $conn->error . "</div>";
    }

    $stmt->close(); // Close statement
}
?>

<!DOCTYPE html>
<html lang="<?php echo $language; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $translations[$language]['title']; ?></title>

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

            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown">
                    Select Language
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="?language=en">English</a></li>
                    <li><a class="dropdown-item" href="?language=rw">Kinyarwanda</a></li>
                    <li><a class="dropdown-item" href="?language=fr">French</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center"><?php echo $translations[$language]['title']; ?></h1>

        <div class="card mx-auto shadow-sm p-4" style="max-width: 500px;">
            <form method="POST" action="add_teacher.php">
                <div class="mb-3">
                    <label class="form-label"><?php echo $translations[$language]['name']; ?></label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label"><?php echo $translations[$language]['gender']; ?></label>
                    <select name="gender" class="form-select" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label"><?php echo $translations[$language]['subject']; ?></label>
                    <input type="text" name="subject" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label"><?php echo $translations[$language]['level']; ?></label>
                    <select name="level" class="form-select" required>
                        <option value="Baby">Baby</option>
                        <option value="Middle">Middle</option>
                        <option value="Top">Top</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100"><?php echo $translations[$language]['submit']; ?></button>
            </form>
        </div>

        <p class="text-center mt-3">
            <a href="teacher_levels.php" class="btn btn-outline-secondary"><?php echo $translations[$language]['cancel']; ?></a>
        </p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
