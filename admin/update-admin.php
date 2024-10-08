<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Update Admin</h1>
		<br>
		<?php
			//get the id to update
			$id=$_GET['id'];

			//create sql query to update
			$sql="SELECT * FROM tbl_admin WHERE id=$id";

			//execute the query
			$res=mysqli_query($conn, $sql);
			
			//checking whether the query is executed or not
			if($res==true)
			{
				$count = mysqli_num_rows($res);
				// checking whether the data is available or not
				if($count==1)
				{
					//get details
					$row=mysqli_fetch_assoc($res);

					$full_name = $row['full_name'];
					$username = $row['username'];
				}
				else
				{
					//redirect to manage admin page
					header('location:'.SITEURL.'admin/manage-admin.php');
				}
			}
		?>
		<form action="" method="POST">
		<table class="tbl-30">
		<tr>
		<td>Full Name:</td>
		<td>
			<input type="text" name="full_name" value="<?php echo $full_name; ?>">
		</td>
		</tr>
		<tr>
		<td>Username:</td>
		<td>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</td>
		</tr>
		<tr>
		<td colspan=2>
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="submit" name="submit" value="Update Admin" class="btn-secondary">
		</td>
		</tr>
		</table>
		</form>
	</div>
</div>

<?php
	//check whether button is clicked or not
	if(isset($_POST['submit']))
	{
		//getting data from form to update
		$id = $_POST['id'];
		$full_name = $_POST['full_name'];
		$username = $_POST['username'];	
		
		// updating the value by sql query
		$sql = "UPDATE tbl_admin SET
		full_name = '$full_name',
		username = '$username'
		WHERE id='$id'
		";
		
		//executing the query
		$res = mysqli_query($conn, $sql);
		
		//check whether the query is executed
		if($res==true)
		{
			$_SESSION['update'] = "Admin updated successfully";
			//redirect to manage-admin page
			header('location:'.SITEURL.'admin/manage-admin.php');
		}
		else {
			$_SESSION['update'] = "Admin not updated";
			//redirect to manage-admin page
			header('location:'.SITEURL.'admin/manage-admin.php');
		}
	}
?>

<?php include('partials/footer.php'); ?>