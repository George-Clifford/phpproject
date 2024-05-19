<?php
session_start();
include 'database-connect.php';

if ($_SESSION['role'] !== 'admin') {
    $isAdmin = false;
} else {
    $isAdmin = true;
}

function getCurrentDateTime() {
    return date("Y-m-d H:i:s");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $isAdmin) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $datetime = getCurrentDateTime();

    $sql = "INSERT INTO posts (title, content, datetime) VALUES ('$title', '$content', '$datetime')";

    if ($db_connect->query($sql) === TRUE) {
        echo "<script>alert('Post added successfully'); window.location.href = 'dashboard.php?id=posts';</script>";
    } else {
        echo "<script>alert('Error adding post'); window.location.href = 'dashboard.php?id=posts';</script>";
    }
}

if (isset($_GET['delete']) && $isAdmin) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM posts WHERE id='$id'";

    if ($db_connect->query($sql) === TRUE) {
        echo "<script>alert('Post deleted successfully'); window.location.href = 'dashboard.php?id=posts';</script>";
    } else {
        echo "<script>alert('Error deleting post'); window.location.href = 'dashboard.php?id=posts';</script>";
    }
}

$sql = "SELECT * FROM posts";
$result = $db_connect->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <style>
        .container {
            width: 80%;
            margin: 0 auto;
            padding-top: 20px;
        }

        .form-container, .posts-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        .form-container input[type="text"],
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            color: white;
            background-color: #007BFF;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 1rem;
        }

        .btn:hover {
            background-color: #0056b3;
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
    </style>
</head>

<body>
    <div class="container">
        <?php if ($isAdmin): ?>
        <div class="form-container">
            <h2>Add Post</h2>
            <form action="posts.php" method="post">
                <label for="title">Title:</label><br>
                <input type="text" id="title" name="title" required><br>
                <label for="content">Content:</label><br>
                <textarea id="content" name="content" rows="10" required></textarea><br><br>
                <input type="submit" class="btn" value="Add Post">
            </form>
        </div>
        <?php endif; ?>

        <div class="posts-container">
            <h2>Posts</h2>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Date and Time</th>
                    <?php if ($isAdmin) echo '<th>Action</th>'; ?>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['title'] . '</td>';
                        echo '<td>' . $row['content'] . '</td>';
                        echo '<td>' . $row['datetime'] . '</td>';
                        if ($isAdmin) {
                            echo '<td><a href="edit_post.php?id=' . $row['id'] . '">Edit</a> | <a href="posts.php?delete=' . $row['id'] . '">Delete</a></td>';
                        }
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4">No posts found.</td></tr>';
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>
