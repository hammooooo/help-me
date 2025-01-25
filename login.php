<?php
include("db.php");
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<form action="<?php// htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
	<h2>Welcome to HELP ME!</h2>
	username:<br>
	<input type="text" name="user_name"><br>
	password:<br>
	<input type="password" name="password"><br>
	<input type="submit" name="submit" value="register">
    </form>


</body>
</html> -->
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="stylesheet" href="css/sign-in.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <div class="container">
        <div class="title">Sign in</div>
        <div class="content">
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">>
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Username</span>
                        <input type="text" placeholder="Enter your email" name="user_name" required />
                    </div>

                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="text" placeholder="Enter your password"  name="password" required />
                    </div>
                </div>

                <div class="button">
                    <input type="submit" value="login" />
                </div>
            </form>
            <h3>Don't have account?<a href="register.html">create new
                    account</a> </h3>
        </div>
    </div>
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
        header("location: index.html");
        exit;
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