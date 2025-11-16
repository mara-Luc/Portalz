<!DOCTYPE html>

<html>

    <head>
    
        <title>Harry Potter Example DataBase</title>
        
        <?php
            $server = "localhost";
            $username = "php";
            $password = "Voidnull0";
            $database = "signinDB";
            $conn = mysqli_connect($server, $username, $password, $database);
            // Check for successful connection
            if (!$conn) {
                die("Connection failed: {mysqli_connect_error()}");
                }
                //write a query for all users
                $sql = "SELECT * FROM users;";
                //make query & get results
                $result = mysqli_query($conn, $sql);
        ?>
        
    </head>

    <body>
        <h1>Harry Potter Example</h1>
        <br><br>
        <h2>Pick a username already in database to find out more about them!</h2>
        <!--based on Teacher example: select from already stored usernames and have returned stats about username creator-->
        <form action="process_form.php" method="get">
            <label for="username">Select a username:</label><br/>
            <select id="username" name="username">
                <?php
                    foreach($result as $row)
                    {
                        echo "<option>{$row['username']}</option>\n";
                    }
                    
                    // Don't forget to close the connection!
                    mysqli_close($conn);
                ?>
            
            </select>

            <br><br> 
        
            <input type="submit" value="submit"/>
        
        </form>

        <br><br>
        <h2>Add a username (and your info) to the database!</h2>
        <!--Input of a new entry into the database-->
        <form action="Data_entry.php" method="POST">
            <!-- Your form inputs here -->
            
            <label for="username">Username</label>
            
            <input type="username" id="username" name="username" placeholder="your username" required>
            <br>
            
            <label for="firstname">First Name</label>
            
            <input type="firstname" id="firstname" name="firstname" placeholder="John" required>
            <br>

            <label for="lastname">Last Name</label>
            
            <input type="lastname" id="lastname" name="lastname" placeholder="Smith" required>
            <br>

            <label for="school">School Attending</label>
            
            <input type="school" id="school" name="school" placeholder="Hogwarts" required>
            <br>

            <label for="spell">What is your favorite Spell?</label>
            
            <input type="spell" id="spell" name="spell" placeholder="Expelliarmus" required>
            
            <br><br>            
            
            <input type="submit" value="Submit"/>   

        </form>

        <br><br>

        <!--A way back to main site-->
        <a href="index.php">Back to the landing page</a>
    
    </body>

</html> 