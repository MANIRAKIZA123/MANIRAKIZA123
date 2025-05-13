<?php
include('config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM students WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $student = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $level = $_POST['level'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $parent1 = $_POST['parent1'];
    $parent2 = $_POST['parent2'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "UPDATE students SET name='$name', level='$level', age='$age', gender='$gender',
            parent1='$parent1', parent2='$parent2', phone='$phone', address='$address'
            WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: student_search.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<form action="edit_student.php" method="POST">
    <input type="hidden" name="id" value="<?= $student['id']; ?>">
    Name: <input type="text" name="name" value="<?= $student['name']; ?>" required><br>
    Level: <input type="text" name="level" value="<?= $student['level']; ?>" required><br>
    Age: <input type="number" name="age" value="<?= $student['age']; ?>" required><br>
    Gender: <input type="text" name="gender" value="<?= $student['gender']; ?>" required><br>
    Parent 1: <input type="text" name="parent1" value="<?= $student['parent1']; ?>" required><br>
    Parent 2: <input type="text" name="parent2" value="<?= $student['parent2']; ?>"><br>
    Phone: <input type="text" name="phone" value="<?= $student['phone']; ?>" required><br>
    Address: <input type="text" name="address" value="<?= $student['address']; ?>" required><br>
    <button type="submit" name="update">Update</button>
</form>
