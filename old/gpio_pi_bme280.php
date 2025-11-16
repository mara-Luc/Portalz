<!DOCTYPE html>
<html>
<head>
    <title>BME280 Sensor Readings</title>
    <script>
        function updateReadings() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "get_readings.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var data = JSON.parse(xhr.responseText);
                    if (data.error) {
                        alert('Error: ' + data.error);
                        return;
                    }
                    document.getElementById("temperature").innerText = data.temperature + "°C";
                    document.getElementById("pressure").innerText = data.pressure + " hPa";
                    document.getElementById("humidity").innerText = data.humidity + "%";
                    document.getElementById("altitude").innerText = data.altitude + " meters";
                }
            };
            xhr.send();
        }
    </script>
</head>
<body>
    <h1>BME280 Sensor Readings</h1>
    <button onclick="updateReadings()">Update Readings</button>
    <br><br>
    <p>Temperature: <span id="temperature">N/A</span></p>
    <p>Pressure: <span id="pressure">N/A</span></p>
    <p>Humidity: <span id="humidity">N/A</span></p>
    <p>Altitude: <span id="altitude">N/A</span></p>
    <br><br>
    <a href="index.php">Back to the landing page</a>
</body>
</html>
