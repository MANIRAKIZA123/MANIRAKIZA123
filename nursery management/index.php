<?php
session_start();

// Redirect to login if user not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle language selection via GET
if (isset($_GET['lang'])) {
    $_SESSION['language'] = $_GET['lang'];
}

// Default to English if no language selected
$language = $_SESSION['language'] ?? 'en';

// Set username or default
$username = $_SESSION['username'] ?? "Guest";

// Language translations
$translations = [
    'en' => [
        'welcome' => "Welcome",
        'manage_students' => "Manage Students",
        'manage_teachers' => "Manage Teachers",
        'manage_users' => "Manage Users",
        'dashboard_intro' => "Manage nursery students, teachers, and users efficiently.",
        'students' => "Students",
        'teachers' => "Teachers",
        'users' => "Users",
        'logout' => "Logout",
    ],
    'rw' => [
        'welcome' => "Murakaza neza",
        'manage_students' => "Shyiraho Abanyeshuri",
        'manage_teachers' => "Shyiraho Abarimu",
        'manage_users' => "Shyiraho Abakoresha",
        'dashboard_intro' => "Shyira ku murongo abanyeshuri, abarimu n'abakoresha neza.",
        'students' => "Abanyeshuri",
        'teachers' => "Abarimu",
        'users' => "Abakoresha",
        'logout' => "Sohoka",
    ],
    'fr' => [
        'welcome' => "Bienvenue",
        'manage_students' => "Gérer les élèves",
        'manage_teachers' => "Gérer les enseignants",
        'manage_users' => "Gérer les utilisateurs",
        'dashboard_intro' => "Gérez efficacement les élèves, enseignants et utilisateurs.",
        'students' => "Élèves",
        'teachers' => "Enseignants",
        'users' => "Utilisateurs",
        'logout' => "Déconnexion",
    ]
];

$t = $translations[$language];
?>

<!DOCTYPE html>
<html lang="<?php echo $language; ?>">
<head>
    <meta charset="UTF-8">
    <title>Nursery Management Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Nursery Management School</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav me-3">
                <li class="nav-item"><a class="nav-link" href="student_search.php"><?php echo $t['students']; ?></a></li>
                <li class="nav-item"><a class="nav-link" href="teacher_levels.php"><?php echo $t['teachers']; ?></a></li>
                <li class="nav-item"><a class="nav-link" href="register.php"><?php echo $t['users']; ?></a></li>
                <li class="nav-item"><a class="nav-link text-danger fw-bold" href="logout.php"><?php echo $t['logout']; ?></a></li>
            </ul>

            <!-- Language Dropdown -->
            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    🌐 <?php echo strtoupper($language); ?>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="?lang=en">English</a></li>
                    <li><a class="dropdown-item" href="?lang=rw">Kinyarwanda</a></li>
                    <li><a class="dropdown-item" href="?lang=fr">French</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Welcome Section -->
<section class="container my-5">
    <div class="bg-primary text-white text-center py-5 rounded shadow">
        <h1 class="display-4"><?php echo $t['welcome'] . ", " . htmlspecialchars($username) . "!"; ?></h1>
        <p class="lead"><?php echo $t['dashboard_intro']; ?></p>
    </div>
</section>

<!-- Cards -->
<section class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo $t['students']; ?></h5>
                    <p class="card-text"><?php echo $t['manage_students']; ?></p>
                    <a href="student_search.php" class="btn btn-primary w-100"><?php echo $t['manage_students']; ?></a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo $t['teachers']; ?></h5>
                    <p class="card-text"><?php echo $t['manage_teachers']; ?></p>
                    <a href="teacher_levels.php" class="btn btn-primary w-100"><?php echo $t['manage_teachers']; ?></a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo $t['users']; ?></h5>
                    <p class="card-text"><?php echo $t['manage_users']; ?></p>
                    <a href="register.php" class="btn btn-primary w-100"><?php echo $t['manage_users']; ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer bg-dark text-white text-center py-3 mt-5 shadow">
    <p>&copy; Developed by JULDAS & LILIANE. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
