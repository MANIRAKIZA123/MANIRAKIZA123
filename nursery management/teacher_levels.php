<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Teacher Level</title>

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
    <div class="container mt-5">
        <h1 class="text-center">Select Teacher Level</h1>

        <form action="teacher_list.php" method="get" class="bg-white p-4 rounded shadow-sm mx-auto" style="max-width: 400px;">
            <div class="mb-3 form-check">
                <input type="radio" class="form-check-input" name="level" value="Baby" id="babyLevel">
                <label class="form-check-label" for="babyLevel">Baby</label>
            </div>
            <div class="mb-3 form-check">
                <input type="radio" class="form-check-input" name="level" value="Middle" id="middleLevel">
                <label class="form-check-label" for="middleLevel">Middle</label>
            </div>
            <div class="mb-3 form-check">
                <input type="radio" class="form-check-input" name="level" value="Top" id="topLevel">
                <label class="form-check-label" for="topLevel">Top</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>

        <p class="text-center mt-3">
            <a href="add_teacher.php" class="btn btn-success">Add Teacher</a>
        </p>
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
