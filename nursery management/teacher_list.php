<?php
require_once 'config.php'; // Ensure database connection is included

// Check if level is set in the GET request
if (isset($_GET['level'])) {
    $level = mysqli_real_escape_string($conn, $_GET['level']);
    echo "<h1 class='text-center text-primary mt-4'>Teachers in Level: " . htmlspecialchars($level) . "</h1>";
    
    // SQL query to fetch teachers based on the selected level
    $sql = "SELECT id, name, subject FROM teachers WHERE level = '$level'";
    $result = mysqli_query($conn, $sql);

    // Error handling if the query fails
    if (!$result) {
        echo "<div class='alert alert-danger text-center'>Error fetching teachers: " . htmlspecialchars(mysqli_error($conn)) . "</div>";
    }
} else {
    echo "<div class='alert alert-warning text-center'>No level selected</div>";
}
?>

<!-- Container for the table and teacher list -->
<div class="container mt-4">
    <!-- Bootstrap Card for Teacher List -->
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white">
            <h3 class="text-center">Teacher List</h3>
        </div>
        <div class="card-body">
            <!-- Check if there are teachers to display -->
            <?php if (isset($result) && $result) {
                if (mysqli_num_rows($result) > 0) { ?>
                    <!-- Table for displaying teachers -->
                    <table class="table table-bordered table-striped table-responsive">
                        <thead class="bg-primary text-white">
                            <style>
                                /* Table Header Style */
th {
    background-color: #007bff; /* Bootstrap Primary Blue */
    color: white; /* White text */
    text-align: center; /* Center align text */
    padding: 12px; /* Padding around text for better spacing */
    font-weight: bold; /* Make header text bold */
    border: 1px solid #dee2e6; /* Light border */
}


tr:hover {
    background-color: #f8f9fa;
}


table {
    width: 100%; 
    border-collapse: collapse; 
}


td, th {
    padding: 12px; 
    text-align: center; /
    border: 1px solid #dee2e6; 
}


td a {
    margin: 0 5px; 
    font-size: 14px;
}

td a.btn {
    padding: 5px 10px;
    border-radius: 4px; 
}


td a.btn-info {
    background-color: #17a2b8;
    color: white;
}

td a.btn-warning {
    background-color: #ffc107;
    color: black;
}

td a.btn-danger {
    background-color: #dc3545; 
    color: white;
}


td a.btn:hover {
    opacity: 0.8; 
}
.table-responsive {
    overflow-x: auto;
}

                            </style>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id'];
                                $name = htmlspecialchars($row['name']);
                                $subject = htmlspecialchars($row['subject']);
                            ?>
                                <tr>
                                    <td><?= $id ?></td>
                                    <td><?= $name ?></td>
                                    <td><?= $subject ?></td>
                                    <td>
                                        <a href="teacher_detail.php?id=<?= $id ?>" class="btn btn-info btn-sm">View</a>
                                        <a href="edit_teacher.php?id=<?= $id ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="delete_teacher.php?id=<?= $id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this teacher?')">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else {
                    echo "<div class='alert alert-warning text-center'>No teachers found in this level.</div>";
                }
            } ?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
