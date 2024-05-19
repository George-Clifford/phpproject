<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('bout.jpg'); /* Path to your background image */
            background-size: cover;
            background-position: center;
            height: 100vh; /* Ensure the background covers the entire viewport height */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .content {
            text-align: center; /* Center the content horizontally */
            color: white; /* Text color on top of the background image */
            margin: auto; /* Center the content vertically */
        }

        h1 {
            font-size: 3em;
        }
    </style>
</head>

<body>
    <!-- Include navigation -->
    <?php include 'navbar.php' ?>

    <!-- Main Content -->
    <div class="content">
        <h1>About Us</h1>
    </div>

    <!-- Footer -->
</body>

</html>
