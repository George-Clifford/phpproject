<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
   <?php include  'navbar.php'?>


    <!-- main content -->
         
    
    <div class="container">
        <div class="form-header">
            <h1>Signup</h1>
        </div>
        <form action="process_signup.php" method="post">
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
                <input type="submit" name="signup" value="Signup">
            </div>
        </form>
    </div>


    <!-- footer -->


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

    // Check if the email already exists
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $db_connect->query($sql);

    if ($result->num_rows > 0) {
        // Email already exists
        echo "<script>alert('Email is already registered. Please use a different email.'); window.location.href = 'signup.php';</script>";
        exit;
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Determine the role (default is 'user')
        $role = 'user';

        // Insert the new user into the database
        $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$hashed_password', '$role')";
        if ($db_connect->query($sql) === TRUE) {
            // Successful signup
            $_SESSION['username'] = $username; // Store username in session for future use
            $_SESSION['role'] = $role; // Store role in session for future use
            echo "<script>alert('Signup successful'); window.location.href = 'dashboard.php';</script>";
            exit;
        } else {
            // Signup error
            echo "<script>alert('Signup failed. Please try again.'); window.location.href = 'signup.php';</script>";
        }
    }
}
?>
