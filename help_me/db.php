<?php
$hostname='localhost';
$user_name='root';
$password='';
$database='help_me';
$con=mysqli_connect($hostname,$user_name,$password,$database);
if($con){
    echo "connection successful" ;
    echo '<br>';
}else{
    die(mysqli_error($con));
}


?>
