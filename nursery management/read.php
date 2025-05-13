<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 18px;
    text-align: left;
}

th, td {
    padding: 12px;
    border: 1px solid #ddd;
}

th {
    background-color: #007bff;
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #ddd;
}
@media (max-width: 768px) {
    table {
        font-size: 14px;
    }
    th, td {
        padding: 8px;
    }
}

    </style>
</head>
<body>
     <ul>
        <li><a class="a" href="student_search.php">Students</a></li>
        <li><a class="a" href="teaarcher_level.php">Tearchers</a></li>
        <li><a class="a" href="read.php">Users</a></li>
      
    </ul>
 
 <?php
include('config.php');

$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Level</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Parent 1</th>
                <th>Parent 2</th>
                <th>Phone</th>
                <th>Address</th>
            </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['level']}</td>
                <td>{$row['age']}</td>
                <td>{$row['gender']}</td>
                <td>{$row['parent1']}</td>
                <td>{$row['parent2']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['address']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p>No records found.</p>";
}
?>
<script>
function printPage() {
    window.print();
}
</script>

<?php
$conn->close();
?>
<button onclick="printPage()" class="bit">Print</button>
</body>
</html>