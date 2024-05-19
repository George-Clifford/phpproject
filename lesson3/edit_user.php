<?php
session_start();
include 'database-connect.php';

if ($_SESSION['role'] !== 'admin' && $_SESSION['username'] !== $_GET['username']) {
    echo "<script>alert('You do not have permission to edit this user.'); window.location.href = 'manage_users.php';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET username='$username', email='$email', role='$role' WHERE id='$id'";

    if ($db_connect->query($sql) === TRUE) {
        echo "<script>alert('User updated successfully'); window.location.href = 'manage_users.php';</script>";
    } else {
        echo "<script>alert('Error updating user'); window.location.href = 'manage_users.php';</script>";
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = $db_connect->query($sql);
    $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-input {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="email"], select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            color: white;
            background-color: #007BFF;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit User</h2>
    <form action="edit_user.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <div class="form-input">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>" required>
        </div>
        <div class="form-input">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
        </div>
        <?php if ($_SESSION['role'] == 'admin') { ?>
        <div class="form-input">
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="user" <?php echo $row['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                <option value="admin" <?php echo $row['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
            </select>
        </div>
        <?php } ?>
        <input type="submit" class="btn" value="Update User">
    </form>
</div>
</body>
</html>
<?php
}
?>
