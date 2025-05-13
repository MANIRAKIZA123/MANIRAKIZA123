<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['token']) && isset($_GET['new_password'])) {
    $token = $_GET['token'];
    $new_password = $_GET['new_password'];
    $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL WHERE reset_token = ?");
    $stmt->bind_param("ss", $new_password, $token);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success text-center'>Your password has been updated! 
              <a href='login.php'>Login here</a></div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error updating password.</div>";
    }

    $stmt->close();
    $conn->close();
}
?>
