<?php
require "php_serial.class.php";
require "db_connect.php"; // Include your database connection file

$serial = new phpSerial();
$serial->deviceSet("/dev/ttyUSB0"); // Adjust for your serial device
$serial->confBaudRate(2400);
$serial->confParity("none");
$serial->confCharacterLength(8);
$serial->confStopBits(1);
$serial->deviceOpen();

while (true) {
    $input = $serial->readPort();

    if ($input == "V") {
        shell_exec("raspivid -o /var/www/html/live.h264 -t 0 &");

        // Notify web server
        $ch = curl_init("http://10.0.0.184:5555/notify.php");
        //$ch = curl_init("http://10.0.0.184/notify.php"); //IP of server
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "event=recording_started");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
    } elseif ($input == "R") {
        $uid = "";
        for ($i = 0; $i < 8; $i++) {
            $uid .= $serial->readPort();
        }

        // Check UID in database
        $query = $conn->prepare("SELECT pin FROM users WHERE uid = ?");
        $query->bind_param("s", $uid);
        $query->execute();
        $query->store_result();

        if ($query->num_rows > 0) {
            $query->bind_result($pin);
            $query->fetch();
            $serial->sendMessage("P" . $pin);
        } else {
            $serial->sendMessage("X");
        }
        $query->close();
    } elseif ($input == "W") {
        shell_exec("pkill -f raspivid"); // Stop recording
    }

    usleep(500000); // Wait half a second before checking again
}

$serial->deviceClose();
$conn->close(); // Close the database connection
?>