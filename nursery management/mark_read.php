<?php
require 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "UPDATE notifications SET status = 'read' WHERE id = '$id'";
    mysqli_query($conn, $sql);
    header("Location: notifications.php");
    exit;
}
?>
