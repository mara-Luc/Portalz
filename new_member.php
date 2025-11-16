<?php
// Include the database connection file
include 'db_connect.php'; // Establishes connection using predefined credentials

// Process form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and validate inputs
    $username = htmlspecialchars($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password for security
    $firstname = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $department = htmlspecialchars($_POST["department"]);
    $pin = htmlspecialchars($_POST["pin"]);
    $RFID_UID = htmlspecialchars($_POST["RFID_UID"]);
    $login_time = htmlspecialchars($_POST["login_time"]);

    // Handle file upload (picture)
    if (isset($_FILES["picture"]) && $_FILES["picture"]["error"] == 0) {
        // Read the image file contents as binary data
        $picture = file_get_contents($_FILES["picture"]["tmp_name"]);
    } else {
        $picture = null;
    }

    // Prepare the SQL query
    $sql = "INSERT INTO users (picture, username, password, firstname, lastname, department, pin, RFID_UID, login_time) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters to prevent SQL injection
    $stmt->bind_param("sssssssss", $picture, $username, $password, $firstname, $lastname, $department, $pin, $RFID_UID, $login_time);

    // Execute the query and check for success
    if ($stmt->execute()) {
        echo "<p>Data successfully inserted!</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    // Close connections
    $stmt->close();
}

// Close database connection
$conn->close();
?>