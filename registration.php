<?php

include 'connection.php';

$isValid = true;
$errors = array();

if (isset($_POST["submit"])) {
    if (isset($_POST["fullname"]) && !empty($_POST["fullname"]) && trim($_POST["fullname"]) != "") {
        $fullname = $_POST["fullname"];
    } else {
        $errors['fullname'] = "FullName is not valid <br>";
        $isValid = false;
    }

    if (isset($_POST["phone"]) && !empty($_POST["phone"]) && trim($_POST["phone"]) != "") {
            $phone = $_POST["phone"];
        }
    } else {
        $errors['phone'] = "Phone is not valid <br>";
        $isValid = false;
    }

    if (isset($_POST["email"]) && !empty($_POST["email"]) && trim($_POST["email"]) != "") {

        // Email validation using regex
        $pattern = '/^[a-zA-z0-9._%+]+@[a-zA-Z0-9.-]+\.[a-zA-z]{2,}$/';

        if (preg_match($pattern, $_POST["email"])) {
            $email = $_POST["email"];
        }
    } else {
        $errors['email'] = "Email is not valid <br>";
        $isValid = false;
    }

    if (isset($_POST["username"]) && !empty($_POST["username"]) && trim($_POST["username"]) != "") {
        $username = $_POST["username"];
    } else {
        $errors['username'] = "UserName is not valid <br>";
        $isValid = false;
    }


    if (isset($_POST["password"]) && !empty($_POST["password"]) && trim($_POST["password"]) != "") {
        $password = $_POST["password"];
    } else {
        $errors['passowrd'] = "Password is not valid <br>";
        $isValid = false;
    }

    if (isset($_POST["confirmpassword"]) && !empty($_POST["confirmpassword"]) && trim($_POST["confirmpassword"]) != "") {
        $confirmpassword = $_POST["confirm"];
    } else {
        $errors['confirmpassowrd'] = "ConfirmPassword is not valid <br>";
        $isValid = false;
    }


    
    echo "<pre>";
    print_r($errors);

    if ($isValid) {
        // Encrypt password before storing to the database
        $password = md5($password);

        //SQL query to insert data into the database
        $insertSql = "INSERT INTO students(fullname, phone, email, username, password, confirmpassword)
                    VALUES ('$fullname', '$phone', '$email', '$username', '$password', '$confirmpassword')";

        // Execute query
        $insertResult = mysqli_query($connection, $insertSql);

        // Show success/fail message
        if ($insertResult) {
            header('location:login.php');
        } else {
            echo "Sorry, users can not be registered.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
</head>

<body>
    <form method="POST">
        <fieldset>
            <legend>Register</legend>
            <label for="fullname">Full Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" />
            <br><br>

            <label for="phone">Phone</label>
            <input type="number" id="phone" name="phone" placeholder="Enter your number" />
            <br><br>

            <label for="email">Email</label>
            <input type="text" id="email" name="email" placeholder="Enter your email" />
            <br><br>

            <label for="username">Username</label>
            <input type="text" id="username" name="name" placeholder="Enter your username" />
            <br><br>


            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" />
            <br><br>

            
            <label for="confirmpassword">Confirm Password</label>
            <input type="password" id="password" name="password" placeholder="Confirm your password" />
            <br><br>
        

            <a href="student-login.php">Already Registered?</a>

            <input type="submit" name="submit" value="Register" />
            <br><br>
        </fieldset>
    </form>
</body>
</html>