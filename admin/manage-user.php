<?php include('partials/menu.php'); ?>

<!-- Main Content starts -->
<div class="main-content">
	<div class="wrapper">
		<h1>Manage User</h1>
		<br>
		<?php
			if(isset($_SESSION['delete'])){
				echo $_SESSION['delete'];
				unset($_SESSION['delete']);
			}
			if(isset($_SESSION['user-not-found'])){
				echo $_SESSION['user-not-found'];
				unset($_SESSION['user-not-found']);
			}
		?>
		<br>
		<br>
		<table class="tbl-full">
			<tr>
				<th>SR.No.</th>
				<th>Full Name</th>
				<th>Username</th>
				<th>E-mail</th>
				<th>Actions</th>
			</tr>
			
			<?php
				//query to get all admin
				$sql = "SELECT * FROM tbl_user";
				//execute the query
				$res = mysqli_query($conn, $sql);
				
				//check whether the query is executed or not
				if($res==TRUE)
				{
					//count no. of rows in database
					$count = mysqli_num_rows($res);
					$sn=1; //creating a variable for id
					if($count>0)
					{
						while($rows=mysqli_fetch_assoc($res))
						{
							$id=$rows['id'];
							$name=$rows['name'];
							$username=$rows['username'];
							$email=$rows['email'];
							
							//display the values in our table
							?>
							<tr>
							<td><?php echo $sn++; ?></td>
							<td><?php echo $name; ?></td>
							<td><?php echo $username; ?></td>
							<td><?php echo $email; ?></td>
							<td>
							<a href="<?php echo SITEURL; ?>admin/delete-user.php?id=<?php echo $id; ?>" class="btn-danger">Delete User</a>
							</td>
							</tr>
							<?php
						}
					}
				}
			?>
		</table>
	</div>
</div>
<!-- Main Content ends -->

<?php include('partials/footer.php'); ?>