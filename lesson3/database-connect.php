<?php

// connect to the database 1. mysqli 2. pdo
$db_connect = mysqli_connect("localhost", "root", "", "phpdb");

if($db_connect->connect_error){
    echo $db_connect->connect_error;
}