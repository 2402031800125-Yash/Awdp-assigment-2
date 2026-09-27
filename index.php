<?php
session_start();
include 'config.php';

if (isset($_SESSION['admin_logged_in'])) {
    header("Location: dashboard.php");
    exit;
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_name'] = $row['name'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid Email or Password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Login</title>
    <!-- Ensure this matches your file structure -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="login-container">
        <h2 style="text-align: center;">Admin Login</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>Email ID</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn-submit">Login</button>
            <p style="color:red; text-align: center;"><?php echo $error; ?></p>
        </form>
    </div>
</body>

</html>