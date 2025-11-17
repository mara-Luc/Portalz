<!DOCTYPE html>
<head>
    <title>Data Submission</title>
</head>

<body>
    <!-- Original dump of GET and POST
    <p>GET: <?= var_dump($_GET) ?></p>
    <p>POST: <?= var_dump($_POST) ?></p>-->

    <!--Refined use of the form action/method-->
    <?php
        // Sanitize inputs
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $school = htmlspecialchars($_POST['school']);
        $spell = htmlspecialchars($_POST['spell']);

        // Display the friendly message
        echo "<p>Hello, your name is: $firstname $lastname. Your school is: $school. Your favorite spell is: $spell.</p>";
    ?>

</body>
</html>

