<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        .top-nav {
            background-color: black;
            padding: 14px 28px;
        }

        .top-nav li {
            display: inline;
        }

        .top-nav li a {
            color: white;
            text-decoration: none;
            padding: 0 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Navigation -->
        <nav>
            <div class="top-nav">
                <ul>
                    <li><a href="dashboard.php?id=dashboard">Dashboard</a></li>
                    <li><a href="dashboard.php?id=profile">Profile</a></li>
                    <li><a href="dashboard.php?id=users">Manage Users</a></li>
                    <li><a href="dashboard.php?id=reports">Reports</a></li>
                    <li><a href="dashboard.php?id=settings">Settings</a></li>
                    <li><a href="dashboard.php?id=logout">Logout</a></li>
                </ul>
            </div>
        </nav>

        <!-- Main content -->
        <main>
            <div class="main-content">
                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    switch ($id) {
                        case 'dashboard':
                            echo "You clicked dashboard";
                            break;
                        case 'profile':
                            echo "You clicked prifile";
                            break;
                        case 'users':
                            include_once 'manage-users.php';
                            break;
                        default:
                            # code..
                            echo "Page not found";
                            break;
                    }
                }
                ?>
            </div>
        </main>
    </div>
</body>

</html>