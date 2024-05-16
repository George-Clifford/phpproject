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
    <?php include 'navbar.php' ?>

    <!-- Main Content -->

    <div class="container">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <div class="form-input">
                <input type="text" name="username" placeholder="Enter username">
            </div>
            <div class="form-input">
                <input type="email" name="email" placeholder="Enter email">
            </div>
            <div class="form-input">
                <input type="password" name="password" placeholder="Enter password">
            </div>
            <div class="form-input">
                <input type="submit" name="login" value="Login">
            </div>
        </form>
    </div>


    <!-- Footer -->
</body>

</html>


<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Include database connection
    include 'database-connect.php';

    // Query to retrieve hashed password for the provided username and email
    $sql = "SELECT * FROM users WHERE username='$username' AND email='$email'";
    $result = $db_connect->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the row
        $row = $result->fetch_assoc();
        // Verify the provided password with the stored hashed password
        if (password_verify($password, $row['password'])) {
            // Successful login
            $_SESSION['username'] = $username; // Store username in session for future use
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























<!-- I started the session using session_start() to maintain the user's login state.
After receiving POST data, it checks if the provided username, email, and password exist in the database. If found, it sets the username in the session and redirects the user to a dashboard page (dashboard.php). You need to create this page.
If the login fails, it displays an alert informing the user about the failure. -->