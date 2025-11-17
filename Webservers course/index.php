<!DOCTYPE html>

<html>

    <head>
        
        <title>Index</title>

        <!--Link to the Aesthetic CCS file for simplicity in future-->
        <link rel="stylesheet" href="styles.css">

    </head>

    <body>

        <!-- div used to signify that this area will be effected by CCS -->
        <div class="myDiv">
            <h1>Welcome to My Website</h1>
            <h2>Where I will be developing my skills and demoing them here!</h2>
        </div>
        
        <!--Images with div to center them-->
        <div class="center">
            <!--image id to Modify images later-->
            <img id="myImg1" src="picks/pexels-pixabay-163073.jpg" width="384" height="255">
            <img id="myImg2" src="picks/pexels-pixabay-163100.jpg" width="384" height="255">
            <img id="myImg3" src="picks/glasses-8779028_960_720.jpg" width="384" height="255">
            
        </div>
        
        <!--Header change-->
        <h3>What to expect and where this is going:</h3>
    
        <!--Paragraph with java id for modification-->
        <p id="myParagraph">This site is a submission for a class that I am taking at Dawson college where I am learning the fundamentals of creating Web servers. 
        The goal is to eventually create a site that will be used in conjunction with a project that I will build. 
        I am not sure yet what I will build for my project yet but as things developed so will this site.</p>
    
        <!-- PHP commands Portion-->
        <!-- Var dump test-->
        <h3>Server Info Var dump test</h3>
        <p><?php #var_dump($_SERVER); ?></p>
        
        <!-- make a commad do this https://www.whatismybrowser.com/detect/what-is-my-user-agent-->
        <h3>Server Info what-is-my-user-agent</h3>
        <?php                    
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            echo "<p>Your User Agent is: $userAgent</p>";
        ?>

        <h3>Navagation</h3>
    
        <!--Connecting it to other pages on the same tab-->
        <a href="createaccount.php">Create an Account?</a>
        <br><br>
    
        <a href="Signin.php">Sign in?</a>
        <br><br>
    
        <a href="about.php">About Me</a>
        <br><br>

        <a href="hp_example.php">DataBase example</a>
        <br><br>

        <a href="gpio_pi.php">Controlling an LED with GPIO and a button</a>
        <br><br>

        <a href="gpio_pi_bme280.php">Reading a GPIO values from the BME280</a>
        <br><br>
    
        <h3>References</h3>
        <!--Connecting it to other pages on a different tab as well as shown in an unordered list-->
        <ul>
            <li><a href="https://www.w3schools.com" target="_blank">W3 Schools</a></li>
            
            <li><a href="https://pixabay.com" target="_blank">Images taken from Pixabay</a></li>
            
            <li><a href="https://www.pexels.com/search/electronics/" target="_blank">Images taken from Pexels</a></li>
        
        </ul>

        <!--modified form to action/method for php "form_response.php"-->
        <form><!--<form action="welcome.php" method="GET">-->
            <!-- Your form inputs here -->
            <label for="requiredField">Required Field:</label>
            <input type="text" id="requiredField" onblur="validateField()">
            <span id="errorMessage" class="error">This field is required</span>
        </form>

        <!-- Java Portion-->
        <h3>Try out my Java Script Buttons!</h3>
        
        <!--Marker for hiding my buttons-->
        <div id="myDIV">
        
            <!--Link to my Java Script file with functions-->
            <script src="Sandbox.js"></script>

            <div class="center">
        
                <!-- inline JavaScript example of an alert button --> 
                <button type="button" onclick="alert('Welcome to the Digital... World')">Show Alert</button>
            
                <br><br>

                <!-- click and paragraph change using a function and interal java inside <script></script> -->
                <button onclick="changeText()">Click me to change text</button>
            
                <br><br>

                <!--Hide button function-->
                <meta name="viewport" content="width=device-width, initial-scale=1">
            
                <!--Button to hide content-->
                <button onclick="hidebtn()">Don't Touch Me!</button>

                <br><br>

                <!--Button to change/modify images-->
                <button onclick="imagemod()">New scenery?</button>

                <br><br>

                <!--Button to change/modify button text-->
                <button onclick="changebtn(this)">Are you new here?</button>

                <br><br>

                <!--API simple fetch text-->
                <p id="demo">Fetch a file to change this text.</p>
                
                <button onclick="fetchText()">Fetch Text</button>

                <br><br>

                </div>
                
            </div>

    </body>

</html> 