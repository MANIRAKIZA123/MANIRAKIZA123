<?php
require 'config.php';

$search = $_GET['search'] ?? ''; 

$stmt = $conn->prepare("SELECT * FROM users WHERE username LIKE ? OR email LIKE ?");
$searchParam = "%$search%"; 
$stmt->bind_param("ss", $searchParam, $searchParam);
$stmt->execute();
$result = $stmt->get_result();

echo "<table class='table table-bordered'>";
echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['username']}</td>
            <td>{$row['email']}</td>
            <td>{$row['role']}</td>
          </tr>";
}

$stmt->close();
$conn->close();
echo "</table>";
$role = $_GET['role'] ?? '';

$query = "SELECT * FROM users WHERE (username LIKE ? OR email LIKE ?)"; 

if (!empty($role)) {
    $query .= " AND role = ?";
}

$stmt = $conn->prepare($query);

if (!empty($role)) {
    $stmt->bind_param("sss", $searchParam, $searchParam, $role);
} else {
    $stmt->bind_param("ss", $searchParam, $searchParam);
}

$stmt->execute();
$result = $stmt->get_result();

?>
<?php
session_start();
setcookie("visited", "true", time() + 3600, "/");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome</title>
</head>
<body>
    <p>Cookie has been set.</p>
</body>
</html>

<form method="GET" class="mb-4">
    <input type="text" name="search" class="form-control" placeholder="Search by name or email">
    <button type="submit" class="btn btn-primary mt-2">Search</button>
    <form method="GET" class="mb-4">
    <select name="role" class="form-select">
        <option value="">All Roles</option>
        <option value="admin">Admin</option>
        <option value="user">User</option>
    </select>
    <button type="submit" class="btn btn-secondary mt-2">Filter</button>
</form>
