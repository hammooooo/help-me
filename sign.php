<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db.php';

    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $first_name = $_POST['1st_name'];
    $second_name = $_POST['2nd_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $gender = $_POST['gender'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "Passwords do not match. Please try again.";
        exit();
    }

   
    // Check if user_name already exists
    $check_query = "SELECT * FROM `dentist` WHERE user_name = '$user_name'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "User name already exists. Please choose a different one.";
    } else {
        // Insert new user
        $sql = "INSERT INTO `dentist` (user_name,password, 1st_name, 2nd_name, email, phone_number, gender,confirm_password) 
                VALUES ('$user_name', '$password', '$first_name', '$second_name', '$email', '$phone_number', '$gender','$confirm_password')";
        $result = mysqli_query($con, $sql);

        if ($result) {
            include 'login.php';
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title> Registration </title>
    <link rel="stylesheet" href="css/register.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
  
  
<div class="container">
        <div class="title">Registration</div>
        <div class="content">
            <form method="post" action="sign.php" action="index.html" >
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">First name</span>
                      <input type="text"  placeholder="Enter your name" name='1st_name' required />
                    </div> <div class="input-box">
                    <span class="details">Second name </span>
                    <input type="text" placeholder="Enter your name" name='2nd_name' required />
                </div>
                    <div class="input-box">
                        <span class="details">Username</span>
                        <input type="text" placeholder="Enter your username" name='user_name' required />
                    </div>
                    <div class="input-box">
                        <span class="details">Email</span>
                        <input type="text" placeholder="Enter your email" name='email'required />
                    </div>
                    <div class="input-box">
                        <span class="details">Phone Number</span>
                        <input type="text" placeholder="Enter your number" name='phone number' required />
                    </div>
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="text" placeholder="Enter your password"name='password' required />
                    </div>
                    <div class="input-box">
                        <span class="details">Confirm Password</span>
                        <input type="text" placeholder="Confirm your password"name='confirm password' required />
                    </div>
                </div>
                <div class="gender-details" name="gender">
                    <input type="radio" name="gender" id="dot-1" />
                    <input type="radio" name="gender" id="dot-2" />
                    <input type="radio" name="gender" id="dot-3" />
                    <span class="gender-title">Gender</span>
                    <div class="category">
                        <label for="dot-1">
                            <span class="dot one"></span>
                            <span class="gender">Male</span>
                        </label>
                        <label for="dot-2">
                            <span class="dot two"></span>
                            <span class="gender">Female</span>
                        </label>
                        <label for="dot-3">
                            <span class="dot three"></span>
                            <span class="gender">Prefer not to say</span>
                        </label>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Register" />
                </div>
            </form>
        </div>
    </div>
</body>

<!-- <!doctype html>
<html lang="en" >
  <head> -->
    <!-- Required meta tags -->
    <!-- <meta charset="utf-8"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">

    <title>signup page</title>
  </head>
  <body>
    <h1 class='text-center'>signup page <h1>
    <div class="container-fluid mt-5">
    <form action ='sign.php' method='POST'>
  <div class="form-group">
    <label for="exampleInputEmail1">user_name</label>
    <input type="text" class="form-control"  placeholder="Enter your user name" name='user_name'>
  </div> 
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="text" class="form-control"  placeholder="enter your password"name='password'>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">1st_name</label>
    <input type="text" class="form-control"  placeholder="Enter your 1st name" name='1st_name'>
  </div>  
  <div class="form-group">
    <label for="exampleInputEmail1">2nd_name</label>
    <input type="text" class="form-control"  placeholder="Enter your 2nd name" name='2nd_name'>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">email</label>
    <input type="text" class="form-control"  placeholder="Enter your email" name='email'>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">phone number</label>
    <input type="text" class="form-control"  placeholder="Enter your DOB" name='phone number'>
  </div>
  <div class="form-group">
  <label for="genderSelect">Gender</label>
  <select class="form-control" id="genderSelect" name="gender">
    <option value="male">Male</option>
    <option value="female">Female</option>
  </select>
</div>
  <div class="form-group">
    <label for="exampleInputEmail1">confirm password</label>
    <input type="text" class="form-control"  placeholder="Enter your 2nd name" name='confirm password'>
  </div> 
  
  <button type="submit" class="btn btn-primary w-100">Submit</button>
</form>

    </div>
    
  </body>
</html> -->