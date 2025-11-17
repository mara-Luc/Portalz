<!DOCTYPE html>

<html>

    <head>
    
        <title>Create Account</title>
    
    </head>
    
    <body>
        <h1>Make Account</h1>
    
        <!--Form type 1-->
        <form ><!--action="/action_page.php">-->
            
            <label for="username">Enter Username</label>
            
            <input type="username" id="username" name="username" placeholder="make a username" required>
            <br><br>

            <label for="email">Enter email</label>
        
            <input type="email" id="email" name="email" placeholder="your email">
            <br><br>
                        
            <label for="pwd">Enter Password:</label>
            
            <input type="password" id="pwd" name="pwd" pattern=".{8,}" title="Eight or more characters" placeholder="your password" required>
            <br><br>
        
            <!--Form type 2-->
            <p>Select your Age:</p>
        
            <select id="birthyear" name="birthyear" required>
                
                <option value="1">Under 18</option>
                
                <option value="2">18-25</option>
                
                <option value="3">26-35</option>
                
                <option value="4">36-45</option>
                
                <option value="5">46-55</option>
                
                <option value="6">56 or over</option>
            
            </select>
            <br><br>
            
            <!--Form type 3-->
            <p>Sex:</p>
            
            <input type="checkbox" id="sex1" name="sex1" value="Male">
                
            <label for="sex1"> Male</label><br>
                
            <input type="checkbox" id="sex2" name="sex2" value="Female">
                
            <label for="sex2"> Female</label><br>
                
            <input type="checkbox" id="sex3" name="sex3" value="other">
                
            <label for="sex3"> Other</label>

            <!--Form type 4-->
            <p>What are you?</p>
            
            <input type="radio" name="use" value="hobbyist" id="option-1">
            
            <label for="option-1">Hobbyist</label>
            
            <input type="radio" name="use" value="education" id="option-2">
            
            <label for="option-2">Student</label>
            
            <input type="radio" name="use" value="business" id="option-3">
            
            <label for="option-3">Business</label>
            <br><br>

            <!--same as Form 2-->
            <label for="question">Security question:</label>
            
            <select name="question" id="question">
            
                <option value="q1">What is your favorite color?</option>
            
                <option value="q2">What is your first pets name?</option>
            
                <option value="q3">Where were you born?</option>
        
            </select>
            <br><br>

            <label for="ans">ANS:</label>
            
            <input type="text" id="ans" name="ans">
            <br><br>
            
            <input type="submit" value="Submit"/>
            <br><br>

        </form>

    <!--A way back to main site-->
    <a href="index.php">Back to the landing page</a>

</body>

</html> 