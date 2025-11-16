<?php
// Include Composer's autoloader to use `phpdotenv`
require_once '/var/www/html/Project/vendor/autoload.php';

// Load the `.env` file
$dotenv = Dotenv\Dotenv::createImmutable('/var/www/html/Project');
$dotenv->load();

// Access environment variables securely
$db_host = $_ENV['DB_HOST'];
$db_username = $_ENV['DB_USERNAME'];
$db_password = $_ENV['DB_PASSWORD'];
$db_name = $_ENV['DB_NAME'];

// Create a database connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
        $picture = addslashes(file_get_contents($_FILES["picture"]["tmp_name"])); // Convert file to binary
    } else {
        $picture = null;
    }

    // Prepare the SQL query
    $sql = "INSERT INTO users (picture, username, password, firstname, lastname, department, pin, RFID_UID, login_time) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $picture, $username, $password, $firstname, $lastname, $department, $pin, $RFID_UID, $login_time);

    // Execute the query
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