<?php
// Define the path to the bme280 command
$command = 'sudo /home/MaraLu/raspberry-pi-bme280/bme280';

// Execute the command and capture the output
$raw = shell_exec($command);

// Check if the command execution was successful
if ($raw === null) {
    echo json_encode(['error' => 'Unable to execute command.']);
    exit;
}

// Decode the JSON output
$deserialized = json_decode($raw, true);

// Check if the JSON decoding was successful
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['error' => 'Invalid JSON data.']);
    exit;
}

// Return the sensor readings as a JSON response
echo json_encode([
    'temperature' => $deserialized['temperature'],
    'pressure' => $deserialized['pressure'],
    'humidity' => $deserialized['humidity'],
    'altitude' => $deserialized['altitude']
]);
?>

