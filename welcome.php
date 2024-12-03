<?php

session_start();

if(!isset($_SESSION['fullname'])) {
    header('location: student-login.php');
    exit;
}

if(!isset($_COOKIE['fullname'])) {
    header('location: login.php');
    exit;
}
?>
<h1>Hi, <?php echo $_SESSION['fullname']; ?> !!</h1>