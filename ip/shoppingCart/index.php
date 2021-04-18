<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Ecommerce Website</title>
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
</style>
</head>


   <body>
   <div class="header">
	<nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-dark" >
  <a class="navbar-brand" href="./index.php">DJ&B Shopping Center</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="/shop/about">About Us</a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="../form.php">Contact Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../login.php">Logout</a>
      </li>
      
    </ul>
  </div>
</nav>
</div>
</body>
</html>
<?php 

//index.php

$connect = new PDO("mysql:host=localhost:3307;dbname=test", "root", "");

$message = '';

if(isset($_POST["add_to_cart"]))
{
 if(isset($_COOKIE["shopping_cart"]))
 {
  $cookie_data = stripslashes($_COOKIE['shopping_cart']);

  $cart_data = json_decode($cookie_data, true);
 }
 else
 {
  $cart_data = array();
 }

 $item_id_list = array_column($cart_data, 'item_id');

 if(in_array($_POST["hidden_id"], $item_id_list))
 {
  foreach($cart_data as $keys => $values)
  {
   if($cart_data[$keys]["item_id"] == $_POST["hidden_id"])
   {
    $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["quantity"];
   }
  }
 }
 else
 {
  $item_array = array(
   'item_id'   => $_POST["hidden_id"],
   'item_name'   => $_POST["hidden_name"],
   'item_price'  => $_POST["hidden_price"],
   'item_quantity'  => $_POST["quantity"]
  );
  $cart_data[] = $item_array;
 }

 
 $item_data = json_encode($cart_data);
 setcookie('shopping_cart', $item_data, time() + (86400 * 30));
 header("location:index.php?success=1");
}

if(isset($_GET["action"]))
{
 if($_GET["action"] == "delete")
 {
  $cookie_data = stripslashes($_COOKIE['shopping_cart']);
  $cart_data = json_decode($cookie_data, true);
  foreach($cart_data as $keys => $values)
  {
   if($cart_data[$keys]['item_id'] == $_GET["id"])
   {
    unset($cart_data[$keys]);
    $item_data = json_encode($cart_data);
    setcookie("shopping_cart", $item_data, time() + (86400 * 30));
    header("location:index.php?remove=1");
   }
  }
 }
 if($_GET["action"] == "clear")
 {
  setcookie("shopping_cart", "", time() - 3600);
  header("location:index.php?clearall=1");
 }
}

if(isset($_GET["success"]))
{
 $message = '
 <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Item Added into Cart
 </div>
 ';
}

if(isset($_GET["remove"]))
{
 $message = '
 <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Item removed from Cart
 </div>
 ';
}
if(isset($_GET["clearall"]))
{
 $message = '
 <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Your Shopping Cart has been clear...
 </div>
 ';
}


?>
<!DOCTYPE html>
<html>
 <head>
  <title>E-COMMERCE WEBSITE</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<style>
footer a:hover{
text-decoration: none;
}
img{
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;

  }
.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 30%;
  left: 50%;
  width: 100%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.display:hover .img-responsive {
  opacity: 0.3;
}

.display:hover .middle {
  opacity: 0.8;
}

.text {
  background-color: #4CAF50;
  color: white;
  font-size: 16px;
  padding: 16px 32px;
}


</style>
 </head>
 <body>
  <br />
  <div class="container">
   <br><br>
   <h4>External Storage Devices</h4>
   <?php
   $query = "SELECT * FROM tbl_product ORDER BY id ASC";
   $statement = $connect->prepare($query);
   $statement->execute();
   $result = $statement->fetchAll();
   foreach($result as $row)
   {
   ?>
   <div class="col-md-3">
    <form method="post">
     <div style="background-color:#ffffff; border-radius:5px; padding:16px;" align="center">
     <div class="display">
      <img style="width:182px;height:196px;" src="images/<?php echo $row["image"]; ?>" class="img-responsive" /><br />
      <div class="middle"><div class="text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Est, et recusandae accusamus laboriosam quibusdam ipsa? Porro, alias odit.</div></div>
     </div>
      <h4 class="text-info"><?php echo $row["name"]; ?></h4>

      <h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>

      <input type="text" name="quantity" value="1" class="form-control" />
      <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
      <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
      <input type="hidden" name="hidden_id" value="<?php echo $row["id"]; ?>" />
      <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
     </div>
    </form>
   </div>
   <?php
   }
   ?>
   <h4>Charging devices</h4>
   <?php
   $query = "SELECT * FROM tbl_product2 ORDER BY id ASC";
   $statement = $connect->prepare($query);
   $statement->execute();
   $result = $statement->fetchAll();
   foreach($result as $row)
   {
   ?>
   <div class="col-md-3">
    <form method="post">
     <div style="background-color:#ffffff; border-radius:5px; padding:16px;" align="center">
     <div class="display">
      <img style="width:182px;height:196px;" src="images/<?php echo $row["image"]; ?>" class="img-responsive" /><br />
      <div class="middle"><div class="text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Est, et recusandae accusamus laboriosam quibusdam ipsa? Porro, alias odit.</div></div>
     </div>
      <h4 class="text-info"><?php echo $row["name"]; ?></h4>

      <h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>

      <input type="text" name="quantity" value="1" class="form-control" />
      <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
      <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
      <input type="hidden" name="hidden_id" value="<?php echo $row["id"]; ?>" />
      <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
     </div>
    </form>
   </div>
   <?php
   }
   ?>

   <h4>Headphones</h4>
   <?php
   $query = "SELECT * FROM tbl_product3 ORDER BY id ASC";
   $statement = $connect->prepare($query);
   $statement->execute();
   $result = $statement->fetchAll();
   foreach($result as $row)
   {
   ?>
   <div class="col-md-3">
    <form method="post">
     <div style="background-color:#ffffff; border-radius:5px; padding:16px;" align="center">
     <div class="display">
      <img style="width:182px;height:196px;" src="images/<?php echo $row["image"]; ?>" class="img-responsive" /><br />
      <div class="middle"><div class="text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Est, et recusandae accusamus laboriosam quibusdam ipsa? Porro, alias odit.</div></div>
     </div>
      <h4 class="text-info"><?php echo $row["name"]; ?></h4>

      <h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>

      <input type="text" name="quantity" value="1" class="form-control" />
      <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
      <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
      <input type="hidden" name="hidden_id" value="<?php echo $row["id"]; ?>" />
      <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
     </div>
    </form>
   </div>
   <?php
   }
   ?>
   
   
   <div style="clear:both"></div>
   <br />
   <h3>Order Details</h3>
   <div class="table-responsive">
   <?php echo $message; ?>
   <div align="right">
    <a href="index.php?action=clear"><b>Clear Cart</b></a>
   </div>
   <table class="table table-bordered">
    <tr>
     <th width="40%">Item Name</th>
     <th width="10%">Quantity</th>
     <th width="20%">Price</th>
     <th width="15%">Total</th>
     <th width="5%">Action</th>
    </tr>
   <?php
   if(isset($_COOKIE["shopping_cart"]))
   {
    $total = 0;
    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);
    foreach($cart_data as $keys => $values)
    {
   ?>
    <tr>
     <td><?php echo $values["item_name"]; ?></td>
     <td><?php echo $values["item_quantity"]; ?></td>
     <td>$ <?php echo $values["item_price"]; ?></td>
     <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
     <td><a href="index.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
    </tr>
   <?php 
     $total = $total + ($values["item_quantity"] * $values["item_price"]);
    }
   ?>
    <tr>
     <td colspan="3" align="right">Total</td>
     <td align="right">Rs <?php echo number_format($total, 2); ?></td>
     <td><form method="POST" action="./payment.php">                            
     <input type="submit" value="Pay <?php echo $total?>" name="total">
                        </form></td>
    </tr>
   <?php
   }
   else
   {
    echo '
    <tr>
     <td colspan="5" align="center">No Item in Cart</td>
    </tr>
    ';
   }
   ?>
   </table>
   </div>
  </div>
  <br />

<footer style="background-color:#ffedec; width=100%; padding:23px; ">
<a href="../feed.php" style="color:black; ">Your feedback is IMPORTANT to us!</a><br>
&copy;Copyrights reserved.
</footer>

 </body>
</html>