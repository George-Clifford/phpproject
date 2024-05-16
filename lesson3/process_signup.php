<?php
echo "Processing signup";

echo "<br>";

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Include database connection
include 'database-connect.php';

$sql = "INSERT INTO users(username, email, password) VALUES('$username', '$email', '$hashed_password')";

$result = $db_connect->query($sql);

var_dump($result);

if($result){
    header('Location: login.php');
}else{
    echo "Signup failed";
}
// var_dump($db_connect);
