<?php include 'php/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/signupstyle.css">
</head>
<body>
    
    <div class="container">
        <form action="php/signup_process.php" method="post">

            <h2>Sign Up</h2>
        
            <input type="text" id="name" name="name" placeholder="Enter your name" required>           
        
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
                   
            <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>   
           
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        
            <select id="role" name="role" required>
                <option value="" disabled selected>Select your role</option>
                <option value="admin">Admin</option>
                <option value="customer">Customer</option>
                <option value="merchant">Merchant</option>
            </select>
            <input type="submit" value="Sign Up">
            <p class="login-link">Have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
    
</body>
</html>
