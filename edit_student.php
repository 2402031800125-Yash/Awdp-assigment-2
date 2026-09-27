<?php
session_start();
include 'config.php';

// Session Tracking Verification
if (!isset($_SESSION['admin_logged_in'])) { 
    header("Location: index.php"); 
    exit; 
}

// Fetch existing student data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM students WHERE id = $id");
    
    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
    } else {
        header("Location: dashboard.php");
        exit;
    }
}

// Handle Update Request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id']; // Hidden field from the form
    $name = $conn->real_escape_string($_POST['full_name']);
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $email = $conn->real_escape_string($_POST['email']);
    $mobile = $conn->real_escape_string($_POST['mobile']);

    $sql = "UPDATE students SET full_name='$name', age='$age', gender='$gender', dob='$dob', email='$email', mobile='$mobile' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Error updating record: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2 style="text-align: center;">Update Student</h2>
        
        <?php if(isset($error)) { echo "<p style='color:red; text-align:center;'>$error</p>"; } ?>
        
        <form method="POST" action="">
            <!-- Hidden ID field required for the update query -->
            <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
            
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" value="<?php echo $student['full_name']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Age</label>
                <input type="number" name="age" value="<?php echo $student['age']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Gender</label>
                <select name="gender" required>
                    <option value="Male" <?php if($student['gender']=='Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if($student['gender']=='Female') echo 'selected'; ?>>Female</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" name="dob" value="<?php echo $student['dob']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Email ID</label>
                <input type="email" name="email" value="<?php echo $student['email']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Mobile Number</label>
                <input type="text" name="mobile" value="<?php echo $student['mobile']; ?>" required>
            </div>
            
            <button type="submit" class="btn-submit">Update Student</button>
            <a href="dashboard.php" class="btn-cancel" style="display:block; text-align:center; padding:10px; background:#ccc; color:#333; text-decoration:none; border-radius:4px; margin-top:10px;">Cancel</a>
        </form>
    </div>
</body>
</html>