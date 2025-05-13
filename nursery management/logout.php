<?php
session_start();
setcookie(session_name(), '', time() - 5000, '/');
session_destroy();
ob_start();
header("Location: login.php");
exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logout Confirmation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="container text-center">
        <div class="card p-4 shadow-lg">
            <h2 class="text-danger">ARE YOU SURE YOU WANT TO LOGOUT?</h2>
            <p class="lead">If you log out, you will need to log in again.</p>
            <div class="mt-4">
                <a href="logout_process.php" class="btn btn-danger">Yes, Logout</a>
                <a href="index.php" class="btn btn-secondary">No, Stay Logged In</a>
            </div>
        </div>
    </div>
</body>
</html>


