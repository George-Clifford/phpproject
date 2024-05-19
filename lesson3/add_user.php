<?php
session_start();
include 'database-connect.php';

function addUser($username, $email, $role) {
    global $db_connect;

    // Sanitize inputs to prevent SQL injection
    $username = $db_connect->real_escape_string($username);
    $email = $db_connect->real_escape_string($email);
    $role = $db_connect->real_escape_string($role);

    $sql = "INSERT INTO users (username, email, role) VALUES ('$username', '$email', '$role')";

    if ($db_connect->query($sql) === TRUE) {
        echo "<script>alert('User added successfully'); window.location.href = 'manage_users.php';</script>";
    } else {
        echo "<script>alert('Error adding user: " . $db_connect->error . "'); window.location.href = 'manage_users.php';</script>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Call the addUser function
    addUser($username, $email, $role);
}
?>
