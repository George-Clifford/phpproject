<?php
session_start();
include 'database-connect.php';

if ($_SESSION['role'] !== 'admin') {
    echo "<script>alert('You do not have permission to delete this user.'); window.location.href = 'manage_users.php';</script>";
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id='$id'";

    if ($db_connect->query($sql) === TRUE) {
        echo "<script>alert('User deleted successfully'); window.location.href = 'manage_users.php';</script>";
    } else {
        echo "<script>alert('Error deleting user'); window.location.href = 'manage_users.php';</script>";
    }
}
?>
