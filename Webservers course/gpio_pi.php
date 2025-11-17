<title>GPIO Example</title>
    <!--code for the LED button-->
    <script>
        function toggleLED() {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "control_led.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = () => {
                if (xhr.status === 200) {
                    document.getElementById("toggleButton").innerText = xhr.responseText;
                }
            };
            xhr.send("toggle=1");
        }

        function getLEDStatus() {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "control_led.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = () => {
                if (xhr.status === 200) {
                    document.getElementById("toggleButton").innerText = xhr.responseText;
                }
            };
            xhr.send("status=1");
        }

        window.onload = getLEDStatus; // Check LED status when the page loads
    </script>
    </head>
<body>
    
    <h1>GPIO Example</h1>
    
    <br><br>
    
    <button id="toggleButton" onclick="toggleLED()">Loading...</button>

    <br><br>
    
    <!--A way back to main site-->
    <a href="index.php">Back to the landing page</a>

</body>
</html>
