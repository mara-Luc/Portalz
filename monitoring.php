<?php
session_start(); // Start session to manage user authentication

// Include the database connection file
include 'db_connect.php';

// Check if the user is logged in and has the right role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    echo "Access denied. You must be an Admin to view this page.";
    exit;
}

// Query to retrieve user data
$sql = "SELECT picture, firstname, lastname, department FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Center</title>
    <style>
        /* Basic page styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 20px auto;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .user-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .user-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            width: 200px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        .user-card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .user-card p {
            margin: 5px 0;
            font-size: 16px;
        }
        .user-card .department {
            color: #777;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Monitoring Center</h1>
        <div class="user-grid">
            <?php
            // Display user data in a grid format
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='user-card'>";
                    echo "<img src='data:image/jpeg;base64," . base64_encode($row['picture']) . "' alt='User Picture'>";
                    echo "<p>" . htmlspecialchars($row['firstname']) . " " . htmlspecialchars($row['lastname']) . "</p>";
                    echo "<p class='department'>" . htmlspecialchars($row['department']) . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No users found in the database.</p>";
            }
            // Close the database connection
            $conn->close();
            ?>
        </div>
    </div>
        <!--Java Script to pop up video-->
            <script>
                function checkSecurityAlert() {
                fetch("get_alert.php")
                    .then(response => response.text())
                    .then(data => {
                        if (data) {
                        showPopup(data);
                        }
                            });
                }

            function showPopup(message) {
            let popup = document.createElement("div");
            popup.innerHTML = `<div style='position: fixed; top: 20%; left: 50%; transform: translate(-50%, -50%);
                        background: red; color: white; padding: 20px; border-radius: 10px; font-size: 18px;
                        box-shadow: 0px 0px 10px black; text-align: center;'>
                        <strong>${message}</strong></div>`;

            document.body.appendChild(popup);
            setTimeout(() => { popup.remove(); }, 5000);
            }

                setInterval(checkSecurityAlert, 3000);
            </script>
            <!--end of Java Script-->
</body>
</html>