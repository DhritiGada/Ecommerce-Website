<?php
	$host='localhost:3307';
    $user='root';
    $password='';
    $database='test';
    $conn = new mysqli($host,$user,$password,$database);
    if(mysqli_connect_errno()) {
        echo 'FAIL'.mysqli_connect_errno();
    }

		$error;
		$success;
		$username=$_POST['username'];
		$pass=$_POST['pass'];
		$query = "SELECT * FROM register WHERE username='{$username}' AND pass='{$pass}'";
		$result =mysqli_query($conn,$query);
		$posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
		$username;


		if($result){
			// echo print_r($posts);
			$success=TRUE;
			if(count($posts)>0) {$username=$posts[0]['username']; 
			session_start();
			$_SESSION['username']=$username;
			header('Location: ./shoppingCart/index.php');}

			else{
				echo '<script>alert("Incorrect Username or Password. Please try again.")</script>'; 
				flush();
				?>

				<script>window.location.href = "./login.php";</script>
				<?php				
			}
		}
   
	
?>