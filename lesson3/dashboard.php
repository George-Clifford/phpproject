<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .welcome {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .username {
            color: #007bff;
            font-weight: bold;
        }

        .content {
            text-align: center;
        }

        .logout-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to the Dashboard</h1>
        </div>
        <div class="content">
            <p class="welcome">Hello, <span class="username"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; ?></span>!</p>
            <p>Welcome to the dashboard.</p>
        </div>
    </div>
</body>

</html>
