<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['profile_picture'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is an actual image
    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check === false) {
        echo "<div class='alert alert-danger text-center'>File is not an image.</div>";
        exit();
    }

    // Allow only certain file types
    $allowed_types = ["jpg", "png", "jpeg", "gif"];
    if (!in_array($imageFileType, $allowed_types)) {
        echo "<div class='alert alert-danger text-center'>Only JPG, JPEG, PNG & GIF files are allowed.</div>";
        exit();
    }

    // Move uploaded file to the server folder
    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
        $stmt = $conn->prepare("UPDATE users SET profile_picture = ? WHERE id = ?");
        $stmt->bind_param("si", $target_file, $_SESSION['user_id']);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success text-center'>Profile picture updated successfully!</div>";
        } else {
            echo "<div class='alert alert-danger text-center'>Error updating profile picture.</div>";
        }

        $stmt->close();
    } else {
        echo "<div class='alert alert-danger text-center'>Error uploading file.</div>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Profile Picture</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="container">
        <div class="card p-4 shadow-lg text-center">
            <h2>Upload Profile Picture</h2>
            <form method="post" action="upload_profile.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="file" name="profile_picture" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Upload Picture</button>
            </form>
            <a href="profile.php" class="btn btn-secondary mt-3">Back to Profile</a>
        </div>
    </div>
</body>
</html>
