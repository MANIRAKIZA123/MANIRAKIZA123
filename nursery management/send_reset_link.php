<?php
require 'config.php';

$token = isset($_GET['token']) ? $_GET['token'] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    if ($token && $new_password) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE reset_token=? AND reset_expiry > NOW()");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id);
            $stmt->fetch();

            // Update password & remove token
            $stmt = $conn->prepare("UPDATE users SET password=?, reset_token=NULL, reset_expiry=NULL WHERE id=?");
            $stmt->bind_param("si", $new_password, $id);
            $stmt->execute();

            echo "<div class='alert alert-success text-center'>Password successfully reset! <a href='login.php'>Login now</a></div>";
        } else {
            echo "<div class='alert alert-danger text-center'>Invalid or expired token.</div>";
        }
    }
}
?>

<form method="post">
    <input type="password" name="password" required placeholder="Enter new password">
    <button type="submit">Reset Password</button>
</form>
?>
