<?php
// db_connection.php

$servername = "localhost";
$username = "admin";
$password = "admin";
$database = "dummy_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
