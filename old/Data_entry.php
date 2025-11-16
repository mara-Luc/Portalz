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
            $database = "signinDB";
            $conn = mysqli_connect($server, $username, $password, $database);

            // Check for successful connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Retrieve submitted information
            $username = htmlspecialchars($_POST["username"]);
            $firstname = htmlspecialchars($_POST["firstname"]);
            $lastname = htmlspecialchars($_POST["lastname"]);
            $school = htmlspecialchars($_POST["school"]);
            $spell = htmlspecialchars($_POST["spell"]);

            // Insert data into database
    
            $sql = "INSERT INTO users (username, firstname, lastname, school, spell) VALUES ('$username', '$firstname', '$lastname', '$school', '$spell')";
        
            if (mysqli_query($conn, $sql)) 
            {
        
                echo "New record created successfully<br>";
                echo "Username: $username<br>";
                echo "First Name: $firstname<br>";
                echo "Last Name: $lastname<br>";
                echo "School: $school<br>";
                echo "Favorite Spell: $spell<br>";
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
