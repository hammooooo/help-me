<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include 'db.php';
  $user_name = $_POST['user_name'];
  $password = $_POST['password'];
  $first_name = $_POST['1st_name'];
  $second_name = $_POST['2nd_name'];
  $email=$_POST['email'];
  $DOP=$_POST['DOB'];
  $gender =$_POST['gender'];
  $card_id=$_POST['card_id'];
 

  // Check if user_name already exists/  
  /*$check_query = "SELECT * FROM `dentist` WHERE username = '$user_name'";
  $check_result = mysqli_query($con, $check_query);
  if (mysqli_num_rows($check_result)> 0) {
      echo "User name already exists. Please choose a different one.";
  } else {*/

      // Insert new user
      $sql = "insert into `dentist` (user_name, password , 1st_name , 2nd_name ,email ,DOB ,gender ,card_id ) 
              VALUES ('$user_name', '$password', '$first_name', '$second_name', '$email', '$DOP', '$gender', '$card_id')";
      $result = mysqli_query($con, $sql);
      if ($result) {
          echo "Data inserted successfully";
      } else {
        echo "Error: " . mysqli_error($con);
      }
  }


?>




<!doctype html>
<html lang="en" >
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">

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
    <label for="exampleInputEmail1">DOB</label>
    <input type="text" class="form-control"  placeholder="Enter your DOB" name='DOB'>
  </div>
  <div class="form-group">
  <label for="genderSelect">Gender</label>
  <select class="form-control" id="genderSelect" name="gender">
    <option value="male">Male</option>
    <option value="female">Female</option>
  </select>
</div>
  <div class="form-group">
    <label for="exampleInputEmail1">card_id</label>
    <input type="text" class="form-control"  placeholder="Enter your 2nd name" name='card_id'>
  </div> 
  
  <button type="submit" class="btn btn-primary w-100">Submit</button>
</form>

    </div>
    
  </body>
</html>