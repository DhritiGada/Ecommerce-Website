<!-- <!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="pay.css">
<script src="pays.js">
	</script>
</head>
<div class="wrapper">
  <div class="payment">
    <div class="payment-logo">
      <p></p>
    </div>
    
    <h2>Payment Gateway</h2>
    
    
    <div id="error_message">
     
  </div>
    
  
    <div class="form">

    	<form method="POST" action="./payment.php" id="myform" onsubmit = "return validate(); ">
    		<fieldset style="border:none;">
    			<legend>Payment:</legend>
          <label for="onl">TOTAL:</label>
          
      		
         
    			<div class="card space ">
    			<label for="mode" class="label">Choose your payment mode</label>
    			<input list="modes" name="mode" id="mode" class="input">
    			<datalist id="modes" >
    				<option value="Credit Card">
    			    <option value="Debit Card">
    				<option value="BHIM UPI Card">
    			</datalist>
    		    </div>
      <div class="card space ">
        <label class="label">Card holder:</label>
        <input type="text" class="input" placeholder="Account Holder Name" id="hol" name="name">
        
      </div>
      <div class="card space ">
        <label class="label">Card number:</label>
        <input type="text" class="input" data-mask="0000 0000 0000 0000" placeholder="Card Number" id="cardno">
       
      </div>
      <div class="card-grp space">
        <div class="card-item " style="width:100%;">
          <label class="label">Expiry date:</label>
          <input type="text" name="expiry-data" class="input"  placeholder="00 / 00">
          
        </div>
        <div class="card-item " style="width:100%; position:relative; left:20%;">
          <label class="label">CVV:</label>
          <input type="text" class="input" data-mask="000" placeholder="000">
          
        </div>
      

        <center><input type="submit" class="btn"  style="position: relative; top:60%; right:140%;"></center>
      </div> 
      
  </fieldset>
      </form>
  
    </div>
  </div>
</div>
</html>


 -->






<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="pay.css">
<script src="pays.js">
	</script>
</head>
<div class="wrapper">
  <div class="payment">
    <div class="payment-logo">
      <p></p>
    </div>
    
    <h2>Payment Gateway</h2>
    
    
    <div id="error_message">
     
  </div>
    
  
    <div class="form">

    	<form method="POST" action="./index.php" id="myform" onsubmit = "return validate(); ">
    		<fieldset style="border:none;">
    			<legend>Payment:</legend>
          <label for="onl">TOTAL:</label>
          
          <?php 

          echo ($_POST['total']);
          $total = 1000;
          $total =  $_POST['total'];
          // session_destroy();
          ?>
					
          <?php 

          // session_start();
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
            // $fname = $_POST['name'];
                  $tot = $total;
                  $sql = "insert into payment (total) values ('" . $tot . "')";
                  $result = $conn->query($sql);
                //   header("location:./shoppingCart/index.php");
              }
          ?>

    			<div class="card space ">
    			<label for="mode" class="label">Choose your payment mode</label>
    			<input list="modes" name="mode" id="mode" class="input">
    			<datalist id="modes" >
    				<option value="Credit Card">
    			    <option value="Debit Card">
    				<option value="BHIM UPI Card">
    			</datalist>
    		    </div>
      <div class="card space ">
        <label class="label">Card holder:</label>
        <input type="text" class="input" placeholder="Account Holder Name" id="hol" name="name">
        
      </div>
      <div class="card space ">
        <label class="label">Card number:</label>
        <input type="text" class="input" data-mask="0000 0000 0000 0000" placeholder="Card Number" id="cardno">
       
      </div>
      <div class="card-grp space">
        <div class="card-item " style="width:100%;">
          <label class="label">Expiry date:</label>
          <input type="text" name="expiry-data" class="input"  placeholder="00 / 00">
          
        </div>
        <div class="card-item " style="width:100%; position:relative; left:20%;">
          <label class="label">CVV:</label>
          <input type="text" class="input" data-mask="000" placeholder="000">
          
        </div>
      

        <center><input type="submit" class="btn"  style="position: relative; top:60%; right:140%;"></center>
<?php
        
?>
      </div> 
      
  </fieldset>
      </form>
  
    </div>
  </div>
</div>
</html>