

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        nav {
            background-color: black;
            color: white;
            text-align: center;
        }

        .top-nav {
            display: flex;
            list-style-type: none;
            padding: 0;
            justify-content: space-between; /* evenly spaced */
        }

        .top-nav li {
            flex-grow: 1; /* occupy full width */
        }

        .top-nav li a {
            display: block;
            padding: 20px;
            color: white;
            text-decoration: none;
        }

        .top-nav li a:hover {
            background-color: #333;
        }

        .container {
            padding-top: 20px;
        }

        .welcome {
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <nav>
        <ul class="top-nav">
            <li><a href="dashboard.php?id=dashboard">Dashboard</a></li>
            <li><a href="dashboard.php?id=profile">Profile</a></li>
            <li><a href="dashboard.php?id=users">Users</a></li>
            <li><a href="dashboard.php?id=posts">Posts</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            switch ($id) {
                case 'dashboard':
                    if (isset($_SESSION['username'])) {
                        echo '<div class="welcome">';
                        echo 'Hello, welcome to the dashboard, ';
                        echo htmlspecialchars($_SESSION['username']); // Assuming username is stored in session
                        echo '</div>';
                    } else {
                        echo "You clicked dashboard";
                    }
                    break;
                case 'profile':
                    echo "You clicked profile";
                    break;
                case 'users':
                    include_once 'manage-users.php';
                    break;
                case 'posts':
                    include_once 'posts.php';
                    break;
                default:
                    echo "Page not found";
                    break;
            }
        }
        ?>
    </div>
</body>
</html>
