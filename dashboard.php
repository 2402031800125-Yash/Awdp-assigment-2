<?php
session_start();
include 'config.php';

// Session Tracking Verification
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit;
}

$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student Records</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="header">
        <div class="welcome-text">Welcome, <?php echo $_SESSION['admin_name']; ?></div>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>

    <div class="container">
        <h2>Student Records</h2>
        <div class="controls">
            <a href="add_student.php" class="btn-insert">Insert New Student</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['full_name']; ?></td>
                        <td><?php echo $row['age']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['dob']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['mobile']; ?></td>
                        <td>
                            <a href="edit_student.php?id=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                            <a href="delete_student.php?id=<?php echo $row['id']; ?>" class="btn-delete"
                                onclick="return confirm('Are you sure?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>