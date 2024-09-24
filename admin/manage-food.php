<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Manage food</h1>
		<br>
		<?php
			if(isset($_SESSION['add']))
			{
				echo $_SESSION['add'];
				unset($_SESSION['add']);
			}
			if(isset($_SESSION['delete-food']))
			{
				echo $_SESSION['delete-food'];
				unset($_SESSION['delete-food']);
			}
			if(isset($_SESSION['upload']))
			{
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);
			}
			if(isset($_SESSION['update']))
			{
				echo $_SESSION['update'];
				unset($_SESSION['update']);
			}
		?>
		<br>
		<br>
		<!-- Button to Add food-->
		<a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
		<br>
		<br>
		<table class="tbl-full">
			<tr>
				<th>SR.No.</th>
				<th>Title</th>
				<th>Price</th>
				<th>Image</th>
				<th>Featured</th>
				<th>Active</th>
				<th>Actions</th>
			</tr>
			<?php
				//create sql query to get all food
				$sql = "SELECT * FROM tbl_food";
				//execute the query
				$res = mysqli_query($conn, $sql);
				//count the rows to check whether we have foods
				$count = mysqli_num_rows($res);
				$sn=1;
				if($count>0)
				{
					//getting the food from database and display
					while($row=mysqli_fetch_assoc($res))
					{
						$id = $row['id'];
						$title = $row['title'];
						$price = $row['price'];
						$image_name = $row['image_name'];
						$featured = $row['featured'];
						$active = $row['active'];
						?>
						
						<tr>
						<td><?php echo $sn++; ?></td>
						<td><?php echo $title; ?></td>
						<td><?php echo $price; ?></td>
						<td>
						<?php
							if($image_name=="")
							{
								echo "Image not added";
							}
							else
							{
								?>
								<img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
								<?php
							}
						?>
						</td>
						<td><?php echo $featured; ?></td>
						<td><?php echo $active; ?></td>
						<td>
							<a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
							<a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>" class="btn-danger">Delete Food</a>
						</td>
						</tr>	

						<?php
					}
				}
				else
				{
					//food not added in database
					echo "<tr><td colspan='7'>Food not added yet</td></tr>";
				}
			?>
					
		</table>
	</div>
</div>
<?php include('partials/footer.php'); ?>