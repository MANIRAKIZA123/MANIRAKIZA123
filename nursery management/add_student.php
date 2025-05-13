<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $formType = $_POST['type'];

    if ($formType == 'student') {
        $name    = mysqli_real_escape_string($conn, $_POST['name']);
        $level   = mysqli_real_escape_string($conn, $_POST['level']);
        $age     = intval($_POST['age']);
        $gender  = mysqli_real_escape_string($conn, $_POST['gender']);
        $parent1 = mysqli_real_escape_string($conn, $_POST['parent1']);
        $parent2 = mysqli_real_escape_string($conn, $_POST['parent2']);
        $phone   = mysqli_real_escape_string($conn, $_POST['phone']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);

        $sql = "INSERT INTO students (name, level, age, gender, parent1, parent2, phone, address)
                VALUES ('$name', '$level', $age, '$gender', '$parent1', '$parent2', '$phone', '$address')";

        if (mysqli_query($conn, $sql)) {
            header("Location: student_search.php");
            exit();
        } else {
            echo "Student Insert Error: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }

        .form-container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        header {
            background-color: #343a40;
            padding: 10px 20px;
        }

        header a {
            color: white;
            font-weight: bold;
            margin-right: 15px;
            text-decoration: none;
        }

        header a:hover {
            color: #ffc107;
        }
    </style>
</head>
<body>

<header class="d-flex justify-content-between align-items-center">
    <div>
        <a href="student_search.php">Students</a>
        <a href="teacher_levels.php">Teachers</a>
        <a href="register.php">Users</a>
    </div>
    <div class="dropdown me-3">
        <button class="btn btn-outline-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
            🌐 Select Language
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#" onclick="changeLanguage('en')">English</a></li>
            <li><a class="dropdown-item" href="#" onclick="changeLanguage('rw')">Kinyarwanda</a></li>
            <li><a class="dropdown-item" href="#" onclick="changeLanguage('fr')">French</a></li>
        </ul>
    </div>
</header>

<div class="form-container">
    <h2 id="formTitle" class="text-center text-primary mb-4">Add Student</h2>

    <form method="POST" action="">
        <input type="hidden" name="type" value="student">

        <div class="mb-3">
            <label class="form-label lang-name">Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label lang-level">Level:</label>
            <select name="level" class="form-select" required>
                <option value="Baby">Baby</option>
                <option value="Middle">Middle</option>
                <option value="Top">Top</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label lang-age">Age:</label>
            <input type="number" name="age" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label lang-gender">Gender:</label>
            <select name="gender" class="form-select" required>
                <option value="">-- Select --</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label lang-parent1">Parent 1:</label>
            <input type="text" name="parent1" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label lang-parent2">Parent 2:</label>
            <input type="text" name="parent2" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label lang-phone">Phone:</label>
            <input type="number" name="phone" class="form-control" required>
        </div>

        <div class="mb-4">
            <label class="form-label lang-address">Address:</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100 lang-submit">Add Student</button>
    </form>

    <div class="text-center mt-3">
        <a href="student_search.php" class="btn btn-outline-secondary btn-sm">View Student Records</a>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
function changeLanguage(lang) {
    const translations = {
        en: {
            title: "Add Student",
            name: "Name:",
            level: "Level:",
            age: "Age:",
            gender: "Gender:",
            parent1: "Parent 1:",
            parent2: "Parent 2:",
            phone: "Phone:",
            address: "Address:",
            submit: "Add Student"
        },
        rw: {
            title: "Ongeramo Umwana",
            name: "Izina:",
            level: "Icyiciro:",
            age: "Imyaka:",
            gender: "Igitsina:",
            parent1: "Umubyeyi wa 1:",
            parent2: "Umubyeyi wa 2:",
            phone: "Telefone:",
            address: "Aderesi:",
            submit: "Ohereza Umwana"
        },
        fr: {
            title: "Ajouter un Élève",
            name: "Nom:",
            level: "Niveau:",
            age: "Âge:",
            gender: "Sexe:",
            parent1: "Parent 1:",
            parent2: "Parent 2:",
            phone: "Téléphone:",
            address: "Adresse:",
            submit: "Ajouter l'Élève"
        }
    };

    const t = translations[lang];
    if (t) {
        document.getElementById("formTitle").innerText = t.title;
        document.querySelector(".lang-name").innerText = t.name;
        document.querySelector(".lang-level").innerText = t.level;
        document.querySelector(".lang-age").innerText = t.age;
        document.querySelector(".lang-gender").innerText = t.gender;
        document.querySelector(".lang-parent1").innerText = t.parent1;
        document.querySelector(".lang-parent2").innerText = t.parent2;
        document.querySelector(".lang-phone").innerText = t.phone;
        document.querySelector(".lang-address").innerText = t.address;
        document.querySelector(".lang-submit").innerText = t.submit;
    }
}
</script>

</body>
</html>
