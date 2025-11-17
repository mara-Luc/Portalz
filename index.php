<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>Portals | Login</title>
</head>
<body>
    <div class="wrapper">
        <nav class="nav">
            <div class="nav-logo">
                <p>Portals.</p>
            </div>
            <div class="nav-menu" id="navMenu">
                <ul>
                    <!--<li><a href="login.php" class="link active">Login</a></li>-->
                    <!--<li><a href="monitoring.php" class="link">Monitoring Center</a></li>-->
                    <li><a href="new_member.php" class="link">Monitoring Center</a></li>
                    <li><a href="admin_manage.php" class="link">Monitoring Center</a></li>
                    <li><a href="history.php" class="link">History</a></li>
                    <li><a href="logs.php" class="link">Logs</a></li>
                </ul>
            </div>
        </nav>
        <!----------------------------- Form box ----------------------------------->    
        <form action="login.php" method="POST"><!---->
            <div class="form-box">
            <!------------------- login form -------------------------->
            
                <div class="login-container" id="login">
                    <div class="top">
                        <header>Login</header>
                    </div>
                    <div class="input-box">
                        <input type="text" id="username" name="username" class="input-field" placeholder="Username or Email" required>
                        <i class="bx bx-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" id="password" name="password" class="input-field" placeholder="Password" required>
                        <i class="bx bx-lock-alt"></i>
                    </div>
                    <div class="input-box">
                        <input type="submit" class="submit" value="Sign In">
                    </div>
                </div>
            </form>
 
    <script>
       function myMenuFunction() {
           var i = document.getElementById("navMenu");
           if (i.className === "nav-menu") {
               i.className += " responsive";
           } else {
               i.className = "nav-menu";
           }
       }
    </script>
    <script>
        var a = document.getElementById("loginBtn");
        var b = document.getElementById("registerBtn");
        var x = document.getElementById("login");
        var y = document.getElementById("register");
        function login() {
            x.style.left = "4px";
            y.style.right = "-520px";
            a.className += " white-btn";
            b.className = "btn";
            x.style.opacity = 1;
            y.style.opacity = 0;
        }
        function register() {
            x.style.left = "-510px";
            y.style.right = "5px";
            a.className = "btn";
            b.className += " white-btn";
            x.style.opacity = 0;
            y.style.opacity = 1;
        }
    </script>
</body>
</html>