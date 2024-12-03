<?php

session_start();

// Check if user is already logged in (using session)
if (isset($_SESSION['fullname'])) {
    header('location: welcome.php');
}

// Check if user is already logged in (using cookies)
if (isset($_COOKIE['fullname'])) {
    header('location: welcome.php');
}

// Connect to the database
$connection = mysqli_connect('localhost', 'root', '', 'project');

// Check the connection
if (!$connection) {
    die('Database connection error!');
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $fetchSql = "SELECT * FROM students where username='$username' AND password='$password'";
    $fetchResult = mysqli_query($connection, $fetchSql);

    if (mysqli_num_rows($fetchResult) == 1) {
        $student = mysqli_fetch_assoc($fetchResult);

        // Store user data in session variables
        $_SESSION['fullname'] = $student['fullname'];

        // Set user data in cookie
        $expiry = time() + (86400 * 30); // Cookie expires in 30 days
        setcookie('fullname', $student['fullname'], $expiry);

        header('location: welcome.php');
    } else {
        echo "Login is failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title> Login Form</title>
    <style>
        
        </style>
</head>

<body>
    <form action="" method="POST">
        <fieldset>
            <legend>Login</legend>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            <br> <br>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <br> <br>

            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember me</label>

            <button type="submit">Login</button>
            <br> <br>
            
            <a href="registration2.php">Forgot Password?</a>  
            <a href="registration2.php">Not Registered Yet?</a>
            
           
        </fieldset>
    </form>
</body>
</html>