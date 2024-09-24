<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Admin</h1><br>
		<br>
		<?php
			if(isset($_SESSION['add']))
			{
				echo $_SESSION['add'];
				unset($_SESSION['add']);
			}
		?>
		<form action="" method="POST">
		<table class="tbl-30">
		<tr>
		<td>Full Name:</td>
		<td><input type="text" name="full_name" placeholder="Enter your Name"></td>
		</tr>
		<tr>
		<td>Username:</td>
		<td><input type="text" name="username" placeholder="Enter your Username"></td>
		</tr>
		<tr>
		<td>Password:</td>
		<td><input type="password" name="password" placeholder="Enter your Password"></td>
		</tr>
		<tr>
		<td colspan="2">
		<input type="submit" name="submit" value="Add Admin" class="btn-secondary">
		</td>
		</tr>
		</table>
		</form>
	</div>
</div>
<?php include('partials/footer.php'); ?>


<?php
//Process the Value from form and save it to the database
//check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
	//Button clicked
	
	//getting the data from form
	$full_name= $_POST['full_name'];
	$username= $_POST['username'];
	$password= md5($_POST['password']); //password encryption with md5

	//SQl Query to save the data into database
	$sql="INSERT INTO tbl_admin SET
		full_name='$full_name',
		username='$username',
		password='$password'
	";
	// executing query and saving data into database
	$res = mysqli_query($conn, $sql) or die(mysqli_error());
	// checking whether the data is inserted or not
	if($res==TRUE)
	{
		//Data inserted
		// creating session variable
		$_SESSION['add'] = "Admin added successfully";
		//Redirect Page
		header("location:".SITEURL.'admin/manage-admin.php');
	}
	else {
		//failed to execute
		$_SESSION['add'] = "Failed to add Admin";
		//Redirect Page
		header("location:".SITEURL.'admin/add-admin.php');
	}
	
}
?>