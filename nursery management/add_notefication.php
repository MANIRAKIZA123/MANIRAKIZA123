<?php
require 'config.php';

$user_id = 1; // Change dynamically
$message = "You have a new update in your account!";

$sql = "INSERT INTO notifications (user_id, message, status) VALUES ('$user_id', '$message', 'unread')";
mysqli_query($conn, $sql);

echo "Notification added!";
?>
