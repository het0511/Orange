<?php include('../config/constants.php'); ?>
<html>
<head>
<style>
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
</style>
<title>Login Page</title>
<link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<div class="login">
	<h1 class="text-center">Login</h1><br>
	<?php
		if(isset($_SESSION['login']))
		{
			echo $_SESSION['login'];
			unset($_SESSION['login']);
		}
		if(isset($_SESSION['no-login-message']))
		{
			echo $_SESSION['no-login-message'];
			unset($_SESSION['no-login-message']);
		}
	?>
	<br>
	<!--Login Form starts-->
	<form action="" method="POST" class="text-center">
	Username:<br>
	<input type="text" name="username" placeholder="Enter username"><br><br>
	Password:<br>
	<input type="password" name="password" placeholder="Enter password"><br><br>
	<input type="submit" name="submit" value="Login" class="btn-primary">
	<!--Login Form ends-->
</div>
</body>
</html>

<?php
	//check whether submit button is clicked or not
	if(isset($_POST['submit']))
	{
		//process for login
		//getting the data from login form
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		//sql query whether username and password exists or not
		$sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
		
		//executing the query
		$res = mysqli_query($conn, $sql);

		//count rows to check whether user exists or not
		$count = mysqli_num_rows($res);

		if($count==1)
		{
			//user available
			$_SESSION['login'] = "Login Successful";
			$_SESSION['admin'] = $username; // to check whether user is logged in or not and log out will unset it
			//redirect to index page
			header('location:'.SITEURL.'admin/');
		}
		else
		{
			//user not available
			$_SESSION['login'] = "Login not Successful";
			header('location:'.SITEURL.'admin/login.php');			
		}
		
	}

?>