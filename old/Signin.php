<!DOCTYPE html>

<html>

    <head>
    
        <title>Sign in</title>
        
    </head>

    <body>
        <h1>Sign in</h1>
        
        <!--using forms to Authenticate user with user name being required and having a placeholder for clairity-->
        <!--modified form to action/method for php "form_response.php"-->
        <form action="php_post_get_example.php" method="POST">
            <!-- Your form inputs here -->
            
            <label for="username">Username</label>
            
            <input type="username" id="username" name="username" placeholder="your username or email" required>
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
            <br>

            <!--using forms to Authenticate user with password that needs to be 8 char using pattern and having a placeholder for clairity-->
            <label for="pwd">Password:</label>
        
            <input type="password" id="pwd" name="pwd" pattern=".{8,}" title="Eight or more characters" placeholder="your password" required>
            <br><br>            
            <input type="submit" value="Submit"/>   
        </form>

        <br><br>

        <!--A way back to main site-->
        <a href="index.php">Back to the landing page</a>
    
    </body>

</html> 