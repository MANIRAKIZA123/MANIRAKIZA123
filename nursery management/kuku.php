<?php
include('config.php');

if (isset($_POST['submit'])) {
    $stmt = $conn->prepare("INSERT INTO students (name, level, age, gender, parent1, parent2, phone, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $_POST['name'], $_POST['level'], $_POST['age'], $_POST['gender'], $_POST['parent1'], $_POST['parent2'], $_POST['phone'], $_POST['address']);

    if ($stmt->execute()) {
        echo "Data inserted successfully";
    } else {
        echo "Error executing query: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
body {
    font-family: 'Poppins', sans-serif;
    margin: 20px;
    padding: 20px;
    background-color: #eaeaea;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px auto;
    font-size: 16px;
    text-align: left;
    background-color: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.15);
}
th {
    background-color: #343a40;
    color: white;
    padding: 14px;
    border-bottom: 2px solid #ddd;
}
tr {
    transition: 0.3s ease;
}
td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
}
tr:nth-child(even) {
    background-color: #f8f9fa;
}
tr:hover {
    background-color: #dcdcdc;
    transform: scale(1.01);
}
button {
    padding: 8px 14px;
    font-size: 14px;
    cursor: pointer;
    border: none;
    border-radius: 6px;
    transition: 0.3s ease;
}
button[name="edit"] {
    background-color: #007bff;
    color: white;
}

button[name="edit"]:hover {
    background-color: #0056b3;
}
button[name="delete"] {
    background-color: #ff4d4d;
    color: white;
}

button[name="delete"]:hover {
    background-color: #cc0000;
}
@media (max-width: 768px) {
    table {
        font-size: 14px;
    }
    th, td {
        padding: 10px;
    }
    button {
        font-size: 12px;
        padding: 6px 10px;
    }
}
</style>
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
<form action="delete_student.php" method="POST">
<form action="edit_student.php" method="POST">
    <table border="1">
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>LEVEL</th>
            <th>AGE</th>
            <th>GENDER</th>
            <th>PARENT1</th>
            <th>PARENT2</th>
            <th>PHONE</th>
            <th>ADDRESS</th>
            <th>ACTION</th>
                </tr>
         <?php
                include "config.php";
                $sql = "SELECT * FROM students";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                        ?>
            <tr>
                  <td><?=$row['id']; ?></td>
                  <td><?=$row['name']; ?></td>
                   <td><?=$row['level']; ?></td>
                   <td><?=$row['age']; ?></td>
                   <td><?=$row['gender']; ?></td>
                   <td><?=$row['parent1']; ?></td>
                   <td><?=$row['parent2']; ?></td>
                   <td><?=$row['phone']; ?></td>
                   <td><?=$row['address']; ?></td>
                   <td><button type="submit" name="edit" value="<?=$row['id'];?>">Edit</button></td><br>
                   <td><button type="submit" name="delete" value="<?=$row['id'];?>">Delete</button></td><br>
          </tr>
</form>

        <?php
                    }
                ?>
                <a href="student_search.php"></a>
    </table>
</body>
</html>
