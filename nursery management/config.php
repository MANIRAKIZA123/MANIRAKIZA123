<?php
$host = 'localhost';         
$username = 'root';          
$password = '';              
$dbname = 'nurse_management'; 

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    // If connection fails, output an error
    die("Connection failed: " . mysqli_connect_error());
}
?>
