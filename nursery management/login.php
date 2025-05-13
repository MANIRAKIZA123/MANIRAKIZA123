<?php
session_start();
require_once 'config.php';

if (!$conn) {
    die("<div class='alert alert-danger text-center'>Database connection failed</div>");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null; 
    $ip_address = $_SERVER['REMOTE_ADDR'];

    if ($password === null) {
        echo "<div class='alert alert-danger text-center'>Please enter your password.</div>";
        exit();
    } 

    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $hashed_password, $role);
        $stmt->fetch();

        if (isset($hashed_password) && password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['user_role'] = $role;

            $log_stmt = $conn->prepare("INSERT INTO activity_log (user_id, action, ip_address) VALUES (?, ?, ?)");
            $action = "User Logged In"; 
            $log_stmt->bind_param("iss", $id, $action, $ip_address);
            $log_stmt->execute();
            $log_stmt->close();

            header("Location: index.php");
            exit();
        } else {
            echo "<div class='alert alert-danger text-center'>Incorrect Password.</div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center'>No account found with that email.</div>";
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Nursery Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card p-4 shadow-lg">
            <h1><u>USER'S LOGIN</u></h1><br><br>
                <h2 class="text-center mb-4 text-primary">Login</h2>
                <form method="post" action="login.php">
                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password:</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>

                </form>

                <p class="text-center mt-3">Don't have an account? 
                    <a href="register.php" class="text-primary">Sign up here</a>
                </p>
                <p class="text-center mt-3">
                    Forgot your password? <a href="forgot_password.php" class="text-primary">Reset it here</a>
                </p>
            </div>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
