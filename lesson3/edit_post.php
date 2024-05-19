<?php
session_start();
include 'database-connect.php';

if ($_SESSION['role'] !== 'admin') {
    echo "<script>alert('You do not have permission to edit this post.'); window.location.href = 'dashboard.php?id=posts';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE posts SET title='$title', content='$content' WHERE id='$id'";

    if ($db_connect->query($sql) === TRUE) {
        echo "<script>alert('Post updated successfully'); window.location.href = 'dashboard.php?id=posts';</script>";
    } else {
        echo "<script>alert('Error updating post'); window.location.href = 'dashboard.php?id=posts';</script>";
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM posts WHERE id='$id'";
    $result = $db_connect->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            margin: 0;
        }

        .form-container {
            background-color: white;
            padding: 40px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 50%;
            max-width: 600px;
        }

        .form-container h2 {
            text-align: center;
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

        label, input, textarea {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }

        textarea {
            resize: vertical;
            height: 150px;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Edit Post</h2>
        <form action="edit_post.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo $row['title']; ?>" required>
            <label for="content">Content:</label>
            <textarea id="content" name="content" required><?php echo $row['content']; ?></textarea>
            <input type="submit" class="btn" value="Update Post">
        </form>
    </div>
</body>

</html>
