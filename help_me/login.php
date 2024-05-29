<?php
include("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
	<h2>Welcome to HELP ME!</h2>
	username:<br>
	<input type="text" name="user_name"><br>
	password:<br>
	<input type="password" name="password"><br>
	<input type="submit" name="submit" value="register">
    </form>


</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["user_name"];
    $password = $_POST["password"];

    // Validate user credentials
    $sql = "SELECT * FROM dentist WHERE user_name = '$username' AND password = '$password'";
    $result = $con->query($sql);

    if ($result->num_rows == 1) {
        // User credentials are valid, proceed with login
        // Perform any additional actions or redirect to a new page
        echo'your data is right';
    } else {
        echo'you are not registered';
        // User credentials are invalid
        // Display an error message or redirect to an error page
    }
}

?>