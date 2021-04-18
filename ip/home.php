<?php

session_start();
if(!isset($_SESSION['username'])){
    header('location:signin.php');
}

?>

<html>
<head>
<title> Home Page </title>

</head>

<body>

    <a href="logout.php"> LOGOUT</a>

    <h1> Welcome <?php echo $_SESSION['username']; ?> </h1>

</body>

</htmL>