<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $user_id = $_SESSION['user_id'];
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Update the user's profile
    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $username, $email, $user_id);
    
    if ($stmt->execute()) {
        // Log the profile update
        $log_stmt = $conn->prepare("INSERT INTO activity_log (user_id, action, ip_address) VALUES (?, ?, ?)");
        $log_stmt->bind_param("iss", $user_id, $action = "Profile Updated", $ip_address);
        $log_stmt->execute();
        $log_stmt->close();

        echo "<div class='alert alert-success text-center'>Profile updated successfully!</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error updating profile.</div>";
    }

    $stmt->close();
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="container">
        <div class="card p-4 shadow-lg">
            <h2>Edit Your Profile</h2>
            <form method="post" action="edit_profile.php">
                <div class="mb-3">
                    <label class="form-label">Username:</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">New Password (Leave Blank to Keep Existing):</label>
                    <input type="password" name="password" id="password" class="form-control" onkeyup="validatePassword()">
                    <small id="passwordError" class="text-danger"></small>

                </div>
                <button type="submit" class="btn btn-success w-100">Save Changes</button>
            </form>
            <a href="profile.php" class="btn btn-secondary mt-3">Back to Profile</a>
        </div>
    </div>
    <script>
function validatePassword() {
    let password = document.getElementById("password").value;
    let errorBox = document.getElementById("passwordError");

    let regex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@#$%^&!])[A-Za-z\d@#$%^&!]{8,}$/;
    
    if (!regex.test(password)) {
        errorBox.innerHTML = "Password must be at least 8 characters long, include a number and a special character.";
        return false;
    } else {
        errorBox.innerHTML = "";
        return true;
    }
}
</script>

</body>
</html>
