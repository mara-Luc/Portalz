<?php
session_start();
include 'db_connect.php'; // A file for database connection logic

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database for user details
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role']; // Ensure this column exists in the database

            // Redirect Admin to monitoring page
            if ($user['role'] === 'Admin') {
                header("Location: admin_manage.php"); //where to go after you log in
                exit;
            } else {
                echo "<div style='color: red;'>Access denied. Only Admins can access this page.</div>";
            }
        } else {
            echo "<div style='color: red;'>Invalid password.</div>";
        }
    } else {
        echo "<div style='color: red;'>User not found.</div>";
    }
}
?>