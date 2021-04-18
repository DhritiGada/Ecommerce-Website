<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@700&family=Bree+Serif&display=swap"
        rel="stylesheet">

<link rel="stylesheet" type="text/css" href="app.css">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

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
      <li class="nav-item">
        <a class="nav-link" href="./form.php">Contact Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./login.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>
    <style>
        .container {
            width: 50%;
            margin: auto;
            border: 1px solid gray;
            padding: 0px 29px;
            border-radius: 37px;
            background-color: rgb(102, 100, 101);
            color: white;
        }

        .container::before {
            content: "";
            background: url('programming.jpeg') no-repeat center center/cover;
            background-attachment: fixed;
            position: fixed;
            top: 0px;
            left: 0px;
            height: 100%;
            width: 100%;
            z-index: -1;
            opacity: 0.64;
        }

        #navbar {
            background-color: rgb(245, 228, 228);
            display: flex;
            align-items: center;
            position: sticky;
            top: 0px;
            border-radius: 42px;
            margin-bottom: 20px;
        }

        h1 {
            text-align: center;
        }

        fieldset {
            display: flex;
            flex-direction: column;
            margin: 19px 0px;
            border: 2px solid rgb(118, 118, 118);
            border-radius: 11px;
        }

        textarea {
            padding: 12px;
            margin: 7px 0px;
            border-radius: 8px;
            resize: vertical;
            outline-style: none;
            margin-bottom: 20px;
        }

        /* .fa-star {
            font-size: 22px;
        } */

        /* .checked {
            color: orange;
        } */

        p {
            margin-top:35px;
            font-size: 19px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        label,
        legend {
            font-size: 17px;
            margin: 7px 0px;
            padding: 6px;
        }

        input {
            font-size: 17px;
            border-radius: 4px;
            padding: 6px;
            margin: 5px 0px;
            border: 1px solid rgb(118, 118, 118);
            outline-style: none;
        }

        .check input[type="checkbox"],
        label {
            margin: 11px 0px;
        }

        .rdb {
            display: inline-block;
        }

        .left {
            margin-left: 26px;
        }

        /* table {
            font-size: 17px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            margin: 29px 0px;
        }

        td {
            padding-right: 16px;
            padding-bottom: 9px;
        }

        td input[type="radio"] {
            -ms-transform: scale(1.3);
            -webkit-transform: scale(1.3);
            transform: scale(1.3);
        } */

        .head {
            text-align: left;
            padding-right: 52px;
            padding-bottom: 9px;
        }
footer a:hover{
text-decoration: none;
}
    </style>
    <script>
        function validate() {
            if (document.myForm.zipcode.value == "" || isNaN(document.myForm.zipcode.value) ||
                document.myForm.zipcode.value.length != 6) {

                alert("Please provide a zipcode in the format ######.");
                document.myForm.zipcode.focus();
                return false;
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <form method="post" action="./shoppingCart/index.php" name="myForm" onsubmit="return(validate());" id="feedback">
            <h1>Feedback Form</h1>
            <p>We would love to hear your thoughts, suggestions, concerns or problems with anything so we can improve
                our
                services!</p>
            <fieldset>
                <legend>Personalia</legend>
                <label for=" fname">First name:</label>
                <input type="text" id="fname" name="fname">
                <label for="lname">Last name:</label>
                <input type="text" id="lname" name="lname">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
                <label for="zipcode">Zip Code:</label>
                <input type="number" id="zipcode" name="zipcode">
            </fieldset>
            <label for="purchase date">Date of Purchase:</label>
            <input type="date" id="purchase" name="purchase">

            <p>How would you describe your experience with our product?</p>
            <input list="experience" name="experience">
            <datalist id="experience">
                <option value="Great">
                <option value="Good">
                <option value="Okay">
                <option value="Poor">
            </datalist>

            <!-- <p>Reliabiity of our services</p>
            <input list="reliability" name="reliability">
            <datalist id="reliability">
                <option value="Very dissatisfied">
                <option value="Not satisfied">
                <option value="Neutral">
                <option value="Satisfied">
                <option value="Very satisfied">
            </datalist> -->
            

            <p>Reliability of our products</p>
            <div class="rdb">
                <input type="radio" id="comments" name="reliability" value="Very dissatisfied">
                <label for="Very dissatisfied">Very dissatisfied</label>
                <input type="radio" id="suggestions" name="reliability" value="Not satisfied" class="left">
                <label for="Not satisfied">Not satisfied</label>
                <input type="radio" id="questions" name="reliability" value="Neutral" class="left">
                <label for="Neutral">Neutral</label>
                <input type="radio" id="questions" name="reliability" value="Satisfied" class="left">
                <label for="Satisfied">Satisfied</label>
                <input type="radio" id="questions" name="reliability" value="Very satisfied" class="left">
                <label for="Very satisfied">Very satisfied</label>
            </div>
            <p>Services offered</p>
            <div class="rdb">
                <input type="radio" id="comments" name="services" value="Very dissatisfied">
                <label for="Very dissatisfied">Very dissatisfied</label>
                <input type="radio" id="suggestions" name="services" value="Not satisfied" class="left">
                <label for="Not satisfied">Not satisfied</label>
                <input type="radio" id="questions" name="services" value="Neutral" class="left">
                <label for="Neutral">Neutral</label>
                <input type="radio" id="questions" name="services" value="Satisfied" class="left">
                <label for="Satisfied">Satisfied</label>
                <input type="radio" id="questions" name="services" value="Very satisfied" class="left">
                <label for="Very satisfied">Very satisfied</label>
            </div>
            <p>Pricing of our products</p>
            <div class="rdb">
                <input type="radio" id="comments" name="pricing" value="Very dissatisfied">
                <label for="Very dissatisfied">Very dissatisfied</label>
                <input type="radio" id="suggestions" name="pricing" value="Not satisfied" class="left">
                <label for="Not satisfied">Not satisfied</label>
                <input type="radio" id="questions" name="pricing" value="Neutral" class="left">
                <label for="Neutral">Neutral</label>
                <input type="radio" id="questions" name="pricing" value="Satisfied" class="left">
                <label for="Satisfied">Satisfied</label>
                <input type="radio" id="questions" name="pricing" value="Very satisfied" class="left">
                <label for="Very satisfied">Very satisfied</label>
            </div>
            <p>After sales support</p>
            <div class="rdb">
                <input type="radio" id="comments" name="support" value="Very dissatisfied">
                <label for="Very dissatisfied">Very dissatisfied</label>
                <input type="radio" id="suggestions" name="support" value="Not satisfied" class="left">
                <label for="Not satisfied">Not satisfied</label>
                <input type="radio" id="questions" name="support" value="Neutral" class="left">
                <label for="Neutral">Neutral</label>
                <input type="radio" id="questions" name="support" value="Satisfied" class="left">
                <label for="Satisfied">Satisfied</label>
                <input type="radio" id="questions" name="support" value="Very satisfied" class="left">
                <label for="Very satisfied">Very satisfied</label>
            </div>
            <p>Design of our products</p>
            <div class="rdb">
                <input type="radio" id="comments" name="design" value="Very dissatisfied">
                <label for="Very dissatisfied">Very dissatisfied</label>
                <input type="radio" id="suggestions" name="design" value="Not satisfied" class="left">
                <label for="Not satisfied">Not satisfied</label>
                <input type="radio" id="questions" name="design" value="Neutral" class="left">
                <label for="Neutral">Neutral</label>
                <input type="radio" id="questions" name="design" value="Satisfied" class="left">
                <label for="Satisfied">Satisfied</label>
                <input type="radio" id="questions" name="design" value="Very satisfied" class="left">
                <label for="Very satisfied">Very satisfied</label>
            </div>
            <p>Quality of our products</p>
            <div class="rdb">
                <input type="radio" id="comments" name="quality" value="Very dissatisfied">
                <label for="Very dissatisfied">Very dissatisfied</label>
                <input type="radio" id="suggestions" name="quality" value="Not satisfied" class="left">
                <label for="Not satisfied">Not satisfied</label>
                <input type="radio" id="questions" name="quality" value="Neutral" class="left">
                <label for="Neutral">Neutral</label>
                <input type="radio" id="questions" name="quality" value="Satisfied" class="left">
                <label for="Satisfied">Satisfied</label>
                <input type="radio" id="questions" name="quality" value="Very satisfied" class="left">
                <label for="Very satisfied">Very satisfied</label>
            </div>
            <p>Feedback Type</p>
            <div class="rdb">
                <input type="radio" id="comments" name="feedback" value="comments">
                <label for="comments">Comments</label>
                <input type="radio" id="suggestions" name="feedback" value="suggestions" class="left">
                <label for="suggestions">Suggestions</label>
                <input type="radio" id="questions" name="feedback" value="Questions" class="left">
                <label for="questions">Questions</label>
            </div>
            <p>Describe your Feedback</p>
            <textarea name="message" rows="15" cols="30"></textarea><br>
            <div style="text-align: center;">
                <input type="submit" value="Submit" >
            </div>
        </form>
    </div>
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
        // echo($_POST['name']);
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST["email"];
        $zipcode = $_POST['zipcode'];
        $purchase = $_POST['purchase'];
        // $checkbx=implode(',',$POST_['checkbx']);
        $experience=$_POST['experience'];
        $reliability = $_POST['reliability'];
        $services = $_POST['services'];
        $pricing = $_POST['pricing'];
        $support = $_POST['support'];
        $design = $_POST['design'];
        $quality = $_POST['quality'];
        $feedback = $_POST['feedback'];
        $message = $_POST['message'];
        if ($fname == "" || $lname=="" || $email == "" || $zipcode=="" || $purchase=="" || $experience=="" || $reliability=="" || $services == "" || $pricing=="" || $support=="" || $design == "" || $quality=="" || $feedback== "" || $message== "") {
    ?>
            <script>
                alert("Fill All The Details");
            </script>
    <?php
        } else {
            $sql = "insert into feed (fname,lname,email,zipcode,purchase,experience,reliability,services,pricing,support,design,quality,feedback,message) values ('" . $fname . "','" . $lname . "','" . $email . "','" . $zipcode . "','" . $purchase . "','" . $experience . "','" . $reliability . "','" . $services . "','" . $pricing . "','" . $support . "','" . $design . "','" . $quality . "','" . $feedback . "','" . $message . "')";
            $result = $conn->query($sql);
        }
    }
    ?>
<footer style="background-color:#ffedec; width=100%; padding:23px; ">
<a href="./feed.php" style="color:black; ">Your feedback is IMPORTANT to us!</a><br>
&copy;Copyrights reserved.
</footer>
</body>

</html>