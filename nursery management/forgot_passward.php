<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;

    if ($email) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Generate a unique token
            $token = bin2hex(random_bytes(32));
            $expires_at = date("Y-m-d H:i:s", strtotime("+1 hour"));

            // Store token in the database
            $stmt = $conn->prepare("UPDATE users SET reset_token=?, reset_expiry=? WHERE email=?");
            $stmt->bind_param("sss", $token, $expires_at, $email);
            $stmt->execute();

            // Send an email (using `send_email.php`)
            require_once 'send_email.php';
            sendResetEmail($email, $token);

            echo "<div class='alert alert-success text-center'>A password reset link has been sent to your email.</div>";
        } else {
            echo "<div class='alert alert-danger text-center'>Email not found!</div>";
        }
    }
}
?>
<form method="post">
    <input type="email" name="email" required placeholder="Enter your email">
    <button type="submit">Send Reset Link</button>
</form>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Nursery Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="container">
        <div class="card p-4 shadow-lg">
            <h2 class="text-center mb-4">Reset Your Password</h2>
            <form method="post" action="send_reset_link.php">
                <div class="mb-3">
                    <label class="form-label">Enter Your Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
            </form>
        </div>
    </div>
</body>
</html>
