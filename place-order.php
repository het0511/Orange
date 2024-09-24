<?php include('config/constants.php'); ?>
<?php include('login-check1.php'); ?>
<html>
<head>
<title>Place Order</title>
<style>
.tbl-30 {
	width: 30%;
	border: 1px solid black;
	margin-left: 35%;
}
form {
	margin-top: 10%;
}
.btn-primary {
	background-color: #87CEEB;
	padding: 1%;
	color: white;
	text-decoration: none;
	font-weight: bold;
}
.btn-primary:hover {
	background-color: blue;
}
.btn-danger {
	background-color: #FFCCCB;
	border: 2px solid black;
	color: white;
	text-decoration: none;
	font-weight: bold;
}
.btn-danger:hover {
	background-color: red;
}
</style>
</head>
<body>
<center><h1>Welcome <?php echo $_SESSION['user']; ?>, place your order here...</h1></center>
<form action="" method="POST">
<table class="tbl-30">
<tr>
<td>Phone Number:</td>
<td><input type="tel" id="number" name="number" required></td>
</tr>
<tr>
<td>Delivery Address:</td>
<td><input type="text" id="address" name="address" placeholder="Your Address..." required></td>
</tr>
<tr>
<td>
<div class="place-order">
<input type="submit" name="submit" value="Place Order" class="btn-primary">
<a href="cart.php" class="btn-danger">Cancel</a>
</div>
</td>
</tr>
</table>
</form>
</body>
</html>

<?php

	if(isset($_POST['submit'])){
		$number = $_POST['number'];
		$delivery_address = $_POST['address'];
		$username = $_SESSION['user'];
		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d h:i:sa");
		$sql = "SELECT * FROM tbl_user WHERE username='$username'";
		$res = mysqli_query($conn, $sql);
		if($res==true){
			$count=mysqli_num_rows($res);
			if($count==1){
				$row = mysqli_fetch_assoc($res);
				$name = $row['name'];
				$email = $row['email'];
			}
			else{
				header('location:'.SITEURL.'cart.php');
			}
		}
		$sql2 = "SELECT * FROM tbl_cart WHERE username='$username'";
		$res2 = mysqli_query($conn, $sql2);
		if($res2==true){
			$count2=mysqli_num_rows($res2);
			if($count2>0){
				while($rows=mysqli_fetch_assoc($res2)){
					$food=$rows['food'];
					$qty=$rows['quantity'];
					$sql3 = "INSERT INTO tbl_order SET
						food='$food',
						qty='$qty',
						order_date='$date',
						status='Ordered',
						customer_name='$name',
						customer_contact='$number',
						customer_email='$email',
						customer_address='$delivery_address'
					";
					$res3 = mysqli_query($conn, $sql3);
					if($res3==true){
						$sql4 = "DELETE FROM tbl_cart WHERE username='$username'";
						$res4 = mysqli_query($conn, $sql4);
						$_SESSION['order-success']="YOUR ORDER HAS BEEN PLACED SUCCESSFULLY. CHECK YOUR MOBILE PHONE FOR THE BILL AND ORDER STATUS.";
						header('location:'.SITEURL.'cart.php');
					}
					else{
						header('location:'.SITEURL.'cart.php');
					}
				}
			}
		}
	}
?>