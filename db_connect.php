<?php
// Database connection details (hardcoded)
$db_host = "localhost";
$db_username = "php";
$db_password = "Voidnull0";
$db_name = "ringDB";

// Create a database connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}