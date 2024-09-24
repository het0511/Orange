<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
	<h1>Change Password</h1>
	<br>
	<?php
		if(isset($_GET['id']))
		{
			$id=$_GET['id'];
		}
	?>
	<form action="" method="POST">
	<table class="tbl-30">
	<tr>
	<td>Current Password:</td>
	<td>
	<input type="password" name="current_password" placeholder="Current Password">
	</td>
	</tr>
	<tr>
	<td>New Password:</td>
	<td>
	<input type="password" name="new_password" placeholder="New Password">
	</td>
	</tr>
	<tr>
	<td>Confirm Password:</td>
	<td>
	<input type="password" name="confirm_password" placeholder="Confirm Password">
	</td>
	</tr>
	<tr>
	<td colspan="2">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" name="submit" value="Change Password" class="btn-secondary">
	</td>
	</table>
	</form>
	</div>
</div>

<?php

	//check whether button is clicked or not
	if(isset($_POST['submit']))
	{
		//get the data from form
		$id= $_POST['id'];
		$current_password= md5($_POST['current_password']);
		$new_password = md5($_POST['new_password']);
		$confirm_password= md5($_POST['confirm_password']);

		//check whether the user exists or not
		$sql= "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
		//now executing the query
		$res = mysqli_query($conn, $sql);
		if($res==true)
		{
			//check whether data is available or not
			$count=mysqli_num_rows($res);
			if($count==1)
			{
				//check whether the new password and confirm password matches
				if($new_password==$confirm_password)
				{
					//update the password
					$sql2 = "UPDATE tbl_admin SET
						password='$new_password'
						WHERE id=$id
					";
					//executing query
					$res = mysqli_query($conn, $sql2);
					//checking whether the query is executed or not
					if($res==true)
					{
						$_SESSION['change-pwd'] = "Password changed successfully";
						//redirect to manage admin page
						header('location:'.SITEURL.'admin/manage-admin.php');
					}
					else
					{
						$_SESSION['change-pwd'] = "Password changing unsuccessful";
						//redirect to manage admin page
						header('location:'.SITEURL.'admin/manage-admin.php');
					}
				}
				else
				{
					//redirect to admin page with error message
					$_SESSION['pwd-not-match'] = "Error";
					//redirect to manage admin page
					header('location:'.SITEURL.'admin/manage-admin.php');
				}	
			}
			else
			{
				$_SESSION['user-not-found'] = "User Not Found";
				//redirect to manage admin page
				header('location:'.SITEURL.'admin/manage-admin.php');
			}
		} 
	}


?>

<?php include('partials/footer.php'); ?>