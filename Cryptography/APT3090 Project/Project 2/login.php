<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/signupstyle.css">
</head>
<body>
    
    <div class="container">
        <form action="php/login.php" method="post">
            <h2>Login</h2>
        
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <input type="submit" value="Login">

            <p class="signup-link">Don't have an account? <a href="signup.php">Sign Up</a></p>
        </form>
    </div>
    
</body>
</html>
