<?php
session_start();

// Include database connection
include 'database-connect.php';

// Function to sanitize user input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Add New User
if (isset($_POST['add_user'])) {
    $username = sanitize_input($_POST['username']);
    $email = sanitize_input($_POST['email']);
    $role = sanitize_input($_POST['role']);

    // Validation
    if (empty($name) || empty($email) || empty($role)) {
        echo "<script>alert('Please fill in all fields.'); window.location.href = 'dashboard.php';</script>";
        exit;
    }

    // Insert new user into database
    $sql_add_user = "INSERT INTO users (username, email, role) VALUES ('$username', '$email', '$role')";
    if ($db_connect->query($sql_add_user) === TRUE) {
        echo "<script>alert('New user added successfully.'); window.location.href = 'dashboard.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error adding user.'); window.location.href = 'dashboard.php';</script>";
        exit;
    }
}

// Delete User
if (isset($_GET['delete_user'])) {
    $user_id = $_GET['delete_user'];

    // Delete user from database
    $sql_delete_user = "DELETE FROM users WHERE id=$user_id";
    if ($db_connect->query($sql_delete_user) === TRUE) {
        echo "<script>alert('User deleted successfully.'); window.location.href = 'dashboard.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error deleting user.'); window.location.href = 'dashboard.php';</script>";
        exit;
    }
}

// Fetch all users from database
$sql_fetch_users = "SELECT * FROM users";
$result_fetch_users = $db_connect->query($sql_fetch_users);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management Dashboard</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <!-- Include navigation -->

    <!-- Main Content -->
    <div class="container">
        <h1>User Management Dashboard</h1>

        <!-- Add New User Form -->
        <h2>Add New User</h2>
        <form action="dashboard.php" method="post">
            <div class="form-input">
                <input type="text" name="name" placeholder="Enter name">
            </div>
            <div class="form-input">
                <input type="email" name="email" placeholder="Enter email">
            </div>
            <div class="form-input">
                <input type="text" name="role" placeholder="Enter role">
            </div>
            <div class="form-input">
                <input type="submit" name="add_user" value="Add User">
            </div>
        </form>

        <!-- View All Users -->
        <h2>View All Users</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            <?php
            if ($result_fetch_users->num_rows > 0) {
                while ($row = $result_fetch_users->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    //echo "<td>" . $row['role'] . "</td>";
                    echo "<td><a href='edit_user.php?id=" . $row['id'] . "'>Edit</a> | <a href='dashboard.php?delete_user=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No users found</td></tr>";
            }
            ?>
        </table>
    </div>

    <!-- Footer -->
</body>

</html>
