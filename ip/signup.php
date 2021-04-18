<?php

session_start();

$con = mysqli_connect('localhost:3307', 'root', '', 'test');

mysqli_select_db($con, 'register');

$username = $_POST['username']; 
$password = $_POST['pass'];

$s="select * from register where username = '$username'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1){ 
    echo "Username Already Taken";
}else{
    $reg= "INSERT INTO register (username, pass) VALUES ('$username', '$password')";
    // echo $reg;
    mysqli_query($con, $reg);
    echo "Registration Successful";
}
   
?>