<?php
// Database connection details
$db_host = "localhost";
$db_username = "php";
$db_password = "Voidnull0";
$db_name = "ringDB";

// Set the serial port path and baud rate
//$serial_port = "/dev/ttyAMA10";   // for GPIO pins
$serial_port = "/dev/ttyUSB0";      // for port
$baud_rate = "2400";                //match my ATMEAGA baudrate

// Configure the serial port
exec("stty -F $serial_port $baud_rate cs8 -cstopb -parenb");

// Function to check PIN in the database
function check_pin($pin) {
    global $db_host, $db_username, $db_password, $db_name;

    // Create database connection
    $mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Check connection
    if ($mysqli->connect_error) {
        return false;
    }

    // Prepare and execute SQL query
    $stmt = $mysqli->prepare("SELECT COUNT(*) FROM users WHERE pin = ?");
    $stmt->bind_param("s", $pin);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    $mysqli->close();

    return $count > 0;
}

// Function to check RFID UID in the database
function check_rfid($rfid) {
    global $db_host, $db_username, $db_password, $db_name;

    // Create database connection
    $mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Check connection
    if ($mysqli->connect_error) {
        return false;
    }

    // Prepare and execute SQL query
    $stmt = $mysqli->prepare("SELECT COUNT(*) FROM users WHERE rfid = ?");
    $stmt->bind_param("s", $rfid);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    $mysqli->close();

    return $count > 0;
}

// Open the serial port
$serial = fopen($serial_port, "w+");
if (!$serial) {
    echo json_encode(['status' => 'error', 'message' => 'Unable to open serial port']);
    exit;
}

// Read input command from the serial port
$input_command = fread($serial, 128);  // Adjust the buffer size as needed
$input_command = strtoupper(trim($input_command));

// Parse the input command
$command_type = substr($input_command, 0, 1);  // Extract the command type (P or R)
$identifier = substr($input_command, 1);      // Extract the PIN or UID

$response = "F"; // Default response is "F" for Failed

if ($command_type === "P" && strlen($identifier) === 4) {
    // Check if the PIN exists in the database
    if (check_pin($identifier)) {
        $response = "P"; // Pass
    }
} elseif ($command_type === "R" && strlen($identifier) === 8) {
    // Check if the RFID UID exists in the database
    if (check_rfid($identifier)) {
        $response = "P"; // Pass
    }
}

// Send response back to the serial port
fwrite($serial, $response);
fclose($serial);
?>
