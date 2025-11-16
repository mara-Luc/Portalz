<!DOCTYPE html>
    <html>
    
    <head>

        <title>SQL Into DB</title>

    </head>

    <body>

        <?php
            $server = "localhost";
            $username = "php";
            $password = "Voidnull0";
            $database = "ringDB";
            $conn = mysqli_connect($server, $username, $password, $database);

            // Check for successful connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Retrieve submitted information
            $username = htmlspecialchars($_POST["username"]);
            $firstname = htmlspecialchars($_POST["firstname"]);
            $lastname = htmlspecialchars($_POST["lastname"]);
            $department = htmlspecialchars($_POST["department"]);
            $pins = htmlspecialchars($_POST["pins"]);
            $rfid = htmlspecialchars($_POST["rfid"]);
            $last_log = htmlspecialchars($_POST["last_log"]);

            // Insert data into database
    
            $sql = "INSERT INTO users (username, firstname, lastname, department, pins, rfid, last_log) VALUES ('$username', '$firstname', '$lastname', '$department', '$pins', '$rfid', '$last_log' )";
        
            if (mysqli_query($conn, $sql)) 
            {
        
                echo "New record created successfully<br>";
                echo "Username: $username<br>";
                echo "First Name: $firstname<br>";
                echo "Last Name: $lastname<br>";
                echo "Department: $department<br>";
                echo "PIN: $pins<br>";
                echo "RFID UID: $rfid<br>";
                echo "Last Login date: $last_log<br>";
            }
        
            else 
            {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            // Close the connection
            mysqli_close($conn);
        ?>
    
        <br><br>
    
        <!--A way back to main site-->
    
        <a href="index.php">Back to the form</a>

    </body>

</html>
