<?php
require_once 'config.php';
require_once 'classes/Alumni.php';

$database = new Database();
$db = $database->getConnection();

$alumni = new Alumni($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['apply_job'])) {
    try {
        $alumni->applyJob($_POST['job_id']);
        echo "Application successful!";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Alumni Dashboard</title>
</head>
<body>
    <h1>Alumni Dashboard</h1>
    <h2>Available Jobs</h2>
    <ul>
        <?php
        $jobs = $alumni->viewJobs();
        foreach ($jobs as $job) {
            echo "<li>{$job['title']} - {$job['description']}<form method='post' style='display:inline;'><button type='submit' name='apply_job' value='{$job['id']}'>Apply</button><input type='hidden' name='job_id' value='{$job['id']}'></form></li>";
        }
        ?>
    </ul>
</body>
</html>
