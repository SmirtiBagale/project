
<?php

// Connect to the database
$connection = mysqli_connect('localhost', 'root', '', 'project');

// Check the connection
if (!$connection) {
    die('Database connection error!');
}
