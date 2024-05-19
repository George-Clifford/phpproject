<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <!-- Include navigation -->
    <?php include 'navbar.php'; ?>

    <!-- Main Content -->
    <div class="container">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <div class="form-input">
                <input type="email" name="email" placeholder="Enter email" required>
            </div>
            <div class="form-input">
                <input type="password" name="password" placeholder="Enter password" required>
            </div>
            <div class="form-input">
                <input type="submit" name="login" value="Login">
            </div>
        </form>
    </div>
</body>

</html>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Include database connection
    include 'database-connect.php';

    // Query to retrieve hashed password and role for the provided email
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $db_connect->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the row
        $row = $result->fetch_assoc();
        // Verify the provided password with the stored hashed password
        if (password_verify($password, $row['password'])) {
            // Successful login
            $_SESSION['username'] = $row['username']; // Store username in session for future use
            $_SESSION['role'] = $row['role']; // Store role in session for future use
            echo "<script>alert('Login successful'); window.location.href = 'dashboard.php';</script>";
            exit;
        } else {
            // Login error
            echo "<script>alert('Login failed. Please check your credentials.');</script>";
        }
    } else {
        // Login error
        echo "<script>alert('Login failed. Please check your credentials.');</script>";
    }
}
?>
