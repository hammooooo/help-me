<?php
// Assuming the database connection is already established
$host = 'localhost';
$db = 'help_me';
$user = 'root';
$pass = '';

// Function to add a new post
function addPost($author, $title, $content) {
    global $host, $db, $user, $pass;

    // Establish MySQLi connection
    $con = mysqli_connect($host, $user, $pass, $db);
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Escape variables for security
    $author = mysqli_real_escape_string($con, $author);
    $title = mysqli_real_escape_string($con, $title);
    $content = mysqli_real_escape_string($con, $content);

    // Insert the new post into the database
    $sql = "INSERT INTO posts (author, title, content) VALUES ('$author', '$title', '$content')";
    if (mysqli_query($con, $sql)) {
        echo "New post added successfully";
        echo '<br>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // Close MySQLi connection
    mysqli_close($con);
}