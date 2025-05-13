<?php
include('config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete_sql = "DELETE FROM students WHERE id='$id'";

    if (mysqli_query($conn, $delete_sql)) {
        header("Location: student_search.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>
<a href="kuku.php"></a>
