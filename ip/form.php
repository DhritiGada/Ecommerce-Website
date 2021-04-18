<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="for.css">
  <script src="forms.js">
  </script>
  <!-- <link rel="stylesheet" type="text/css" href="app.css"> -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
<style>
  #navbar {
            background-color: rgb(245, 228, 228);
            display: flex;
            align-items: center;
            position: sticky;
            top: 0px;
            border-radius: 42px;
            margin-bottom: 20px;
        }

        footer{
          position :fixed;
          width:100%;
          top:87%;
        }
        footer a:hover{
text-decoration: none;
}
        
</style>
  </head>
<body style="background-color: #ebebea;">
    <div class="header">
    <nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-dark" >
  <a class="navbar-brand" href="./shoppingCart/index.php">DJ&B Shopping Center</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="./shoppingCart/index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="/shop/about">About Us</a>
      </li> -->
      <li class="nav-item active">
        <a class="nav-link" href="./forms.php">Contact Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./login.php">Logout</a>
      </li>
      
    </ul>
  </div>
</nav>
</div>

<div class="wrapper">
  <h2>Contact us</h2>
  <div id="error_message">
     
  </div>
  <form action="" id="myform" onsubmit = "return validate();" method="POST">
    <div class="input_field">
        <input type="text" placeholder="Name" id="name" name="name">
    </div>
    <div class="input_field">
        <input type="text" placeholder="Subject" id="subject" name="subject">
    </div>
    <div class="input_field">
        <input type="text" placeholder="Phone" id="phone" name="phone">
    </div>
    <div class="input_field">
        <input type="text" placeholder="Email" id="email" name="email">
    </div>
    <div class="input_field">
        <textarea placeholder="Message" id="message" name="message"></textarea>
    </div>
    <div class="btn">
        <input type="submit">
    </div>
  </form>
    <?php

    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "test";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($_POST) {
        echo($_POST['name']);
        $name = $_POST['name'];
        $subject = $_POST['subject'];
        $phone = $_POST['phone'];
         $emailid = $_POST["email"];
        $message = $_POST['message'];
       
        if ($name == "" || $subject == "" || $phone == "" || $emailid == "" || $message == "") {
    ?>
            <script>
                alert("Fill All The Details");
            </script>
    <?php
        } else {
            $sql = "insert into contact (name,subject,phone,emailid,message) values ('" . $name . "','" . $subject . "','" . $phone . "','" . $emailid . "','" . $message . "')";
            $result = $conn->query($sql);
            header("location:./shoppingCart/index.php");
        }
    }
    ?>


</div>

<footer style="background-color:#ffedec; width=100%; padding:23px; ">
<a href="./feed.php" style="color:black; ">Your feedback is IMPORTANT to us!</a><br>
&copy;Copyrights reserved.
</footer>
</body>
</html>