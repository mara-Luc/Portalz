<!DOCTYPE html>
    <html>
    
    <head>
        <title>SQL test</title>
        
        <?php

            // Retrieve submitted information
            $user_info = htmlspecialchars($_GET["username"]);
            $server = "localhost";
            $db_username = "php"; // Changed the variable name to avoid conflict
            $password = "Voidnull0";
            $database = "signinDB";
            $conn = mysqli_connect($server, $db_username, $password, $database);

            // Check for successful connection
            if (!$conn) {
                die("Connection failed: {mysqli_connect_error()}");
            }

            $sql = "SELECT firstname, lastname, school, spell FROM users WHERE username='$user_info'";
            
            $result = mysqli_query($conn, $sql);
        
        ?>
    
    </head>

    <body>

        <?php
            
            //echo selection
            echo "You selected username: " . htmlspecialchars($user_info) . ".<br>";


            foreach($result as $row) // There should only be one row returned!
            {
                echo "<p>Hello, your name is: {$row['firstname']} {$row['lastname']}. Your school is: {$row['school']}. Your favorite spell is: {$row['spell']}.</p>";
            }

            // Don't forget to close the connection!
            mysqli_close($conn);
        ?>

    </body>

</html>