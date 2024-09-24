<?php include('config/constants.php'); ?>
<html>
<head>
<title>Sign-up page</title>
<link rel="stylesheet" href="../css/admin.css">
<style>
.tbl-full {
	width: 100%;
}
table tr th {
	border-bottom: 1px solid black;
	padding: 1%;
	text-align: left;
}
table tr td {
	padding: 1%;
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
.btn-secondary {
	background-color: #90EE90;
	padding: 1%;
	color: white;
	text-decoration: none;
	font-weight: bold;
}
.btn-secondary:hover {
	background-color: green;
}
.btn-danger {
	background-color: #FFCCCB;
	padding: 1%;
	color: white;
	text-decoration: none;
	font-weight: bold;
}
.btn-danger:hover {
	background-color: red;
}
.tbl-30 {
	width: 30%;
	border: 1px solid black;
	margin-top: 30px;
	padding-left: 55px;
	padding-top: 10px;
	padding-bottom: 10px;
}
</style>
</head>
<body>
<div class="main-content">
	<div class="wrapper">
		<center><h1>Add User</h1><br>
		<br>
		<?php
			if(isset($_SESSION['add']))
			{
				echo $_SESSION['add'];
				unset($_SESSION['add']);
			}
			if(isset($_SESSION['user-exists']))
			{
				echo $_SESSION['user-exists'];
				unset($_SESSION['user-exists']);
			}
		?>
		<form action="" method="POST">
		<table class="tbl-30">
		<tr>
		<td>Full Name:</td>
		<td><input type="text" name="name" placeholder="Enter your Name" required></td>
		</tr>
		<tr>
		<td>Username:</td>
		<td><input type="text" name="username" placeholder="Enter your Username" required></td>
		</tr>
		<tr>
		<td>Email:</td>
		<td><input type="text" name="email" placeholder="Enter your Email" required></td>
		</tr>
		<tr>
		<td>Password:</td>
		<td><input type="password" name="password" placeholder="Enter your Password" required></td>
		</tr>
		<tr>
		<td colspan="2">
		<center><input type="submit" name="submit" value="Sign Up" class="btn-secondary" required></center>
		</td>
		</tr>
		</table>
		<p>Already having an account?<a href="login-page.php"> Click here to login.</a></p>
		</form>
		</center>
	</div>
</div>
</body>
</html>

<?php
//Process the Value from form and save it to the database
//check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
	//Button clicked
	
	//getting the data from form
	$name= $_POST['name'];
	$username= $_POST['username'];
	$email= $_POST['email'];
	$password= md5($_POST['password']); //password encryption with md5

	//checking whether the user already exists or not
	$sql2 = "SELECT * FROM tbl_user WHERE username='$username' OR email='$email'";
	$res2 = mysqli_query($conn, $sql2);
	if($res2==true)
	{
		$count2 = mysqli_num_rows($res2);
		if($count2==0)
		{
			//SQl Query to save the data into database
			$sql="INSERT INTO tbl_user SET
				name='$name',
				username='$username',
				email='$email',
				password='$password'
			";
			// executing query and saving data into database
			$res = mysqli_query($conn, $sql) or die(mysqli_error());
			// checking whether the data is inserted or not
			if($res==TRUE)
			{
				//Data inserted
				// creating session variable
				$_SESSION['add'] = "User added successfully";
				//Redirect Page
				header("location:".SITEURL.'login-page.php');
			}
			else {
				//failed to execute
				$_SESSION['add'] = "Failed to add User";
				//Redirect Page
				header("location:".SITEURL.'sign-up.php');
			}
		}
		else {
			$_SESSION['user-exists']="Either this username alreadly exists or an account is already linked with this email";
			header('location:'.SITEURL.'sign-up.php');
		}
	}
	
}
?>