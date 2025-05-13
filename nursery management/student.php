<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
h1 {
    text-align: center;
    font-size: 24px;
    color: #007bff;
    margin-bottom: 20px;
}

form {
    width: 50%;
    margin: 0 auto;
    background: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Style form labels */
label {
    font-size: 16px;
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

/* Style input fields and select dropdowns */
input[type="text"], input[type="number"], select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    margin-bottom: 15px;
    box-sizing: border-box;
}

/* Style the submit button */
button {
    width: 100%;
    padding: 12px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #0056b3;
}

/* Responsive design */
@media (max-width: 768px) {
    form {
        width: 90%;
    }
}


header a {
    color: white;
    font-weight: bold;
    text-decoration: none;
    padding: 10px 15px;
    margin: 0 10px;
    display: inline-block;
    transition: color 0.3s ease-in-out, transform 0.2s ease-in-out;
}

/* Hover Effect for Links */
header a:hover {
    color: #ffca28;
    transform: scale(1.1);
}
</style>
<body>
                   <header>
                     <a href="student_search.php">Students</a>
                     <a href="teacher_levels.php">Teachers</a>
                     <a href="register.php">Users</a>
               </header>
    <h1>Add Student</h1>
    <form method="POST" action="kuku.php">
        <input type="hidden" name="type" value="student">
        <div>
            <label>Name:</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label>Level:</label>
            <select name="level" required>
                <option value="Baby">Baby</option>
                <option value="Middle">Middle</option>
                <option value="Top">Top</option>
            </select>
        </div>
        <div>
            <label>Age:</label>
            <input type="number" name="age" required>
        </div>
        <div>
            <label>Gender:</label>
            <select name="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <div>
            <label>Parent 1:</label>
            <input type="text" name="parent1" required>
        </div>
        <div>
            <label>Parent 2:</label>
            <input type="text" name="parent2" required>
        </div>
        <div>
            <label>Phone:</label>
            <input type="number" name="phone" required>
        </div>
        <div>
            <label>Address:</label>
            <input type="text" name="address" required>
        </div>
        <button type="submit">Add Student</button>
    </form>
    <a href="student_search.php">View Student Records</a>

</body>
</html>
