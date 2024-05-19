<?php
session_start();
include 'database-connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding-top: 20px;
            text-align: center; /* Center the container */
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

        .form-container, .users-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            width: 50%; /* Increase form size */
            margin-left: auto; /* Center form container */
            margin-right: auto; /* Center form container */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        if ($_SESSION['role'] === 'admin') {
            echo '<button class="btn" onclick="toggleForm()">Add User</button>';
        }
        ?>
        <button class="btn" onclick="viewUsers()">View Users</button>

        <div id="form-container" class="form-container hidden">
            <form action="add_user.php" method="post">
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required><br>
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required><br>
                <label for="role">Role:</label><br>
                <select id="role" name="role" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select><br><br>
                <input type="submit" class="btn" value="Add User">
            </form>
        </div>

        <div id="users-container" class="users-container hidden">
            <?php
            $username = $_SESSION['username'];
            $role = $_SESSION['role'];

            if ($role === 'admin') {
                $sql = "SELECT * FROM users";
            } else {
                $sql = "SELECT * FROM users WHERE username='$username'";
            }

            $result = $db_connect->query($sql);

            if ($result->num_rows > 0) {
                echo '<table>';
                echo '<tr><th>Username</th><th>Email</th>';
                if ($role === 'admin') {
                    echo '<th>Role</th><th colspan="2">Action</th>';
                } else {
                    echo '<th>Action</th>';
                }
                echo '</tr>';

                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['username'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    if ($role === 'admin') {
                        echo '<td>' . $row['role'] . '</td>';
                        echo '<td><a href="edit_user.php?id=' . $row['id'] . '">Edit</a></td>';
                        echo '<td><a href="delete_user.php?id=' . $row['id'] . '">Delete</a></td>';
                    } else if ($username === $row['username']) {
                        echo '<td><a href="edit_user.php?id=' . $row['id'] . '">Edit</a></td>';
                    }
                    echo '</tr>';
                }

                echo '</table>';
            } else {
                echo '<p>No users found.</p>';
            }
            ?>
        </div>
    </div>

    <script>
        function toggleForm() {
            var formContainer = document.getElementById('form-container');
            formContainer.classList.toggle('hidden');
        }

        function viewUsers() {
            var usersContainer = document.getElementById('users-container');
            usersContainer.classList.toggle('hidden');
        }
    </script>
</body>
</html>
