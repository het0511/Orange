<?php include('partials/menu.php'); ?>
<div class="main-content">
	<div class="wrapper">
	<h1>Update Food</h1>
	<br>
	<?php
	if(isset($_GET['id']))
	{
		//get all the details
		$id = $_GET['id'];
		//create sql query to get selected food
		$sql = "SELECT * FROM tbl_food WHERE id=$id";
		//now executing the query
		$res = mysqli_query($conn, $sql);
		//get the value
		$row = mysqli_fetch_assoc($res);
		//get the individual value of selected food
		$title = $row['title'];
		$description = $row['description'];
		$price = $row['price'];
		$current_image = $row['image_name'];
		$featured = $row['featured'];
		$active = $row['active'];
	}
	else
	{
		//redirect to manage-food page
		header('location:'.SITEURL.'admin/manage-food.php');
	}
	?>
	<form action="" method="POST" enctype="multipart/form-data">
	<table class="tbl-30">
	<tr>
	<td>Title:</td>
	<td>
	<input type="text" name="title" value="<?php echo $title; ?>">
	</td>
	</tr>
	<tr>
	<td>Description:</td>
	<td>
	<textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
	</td>
	</tr>
	<tr>
	<td>Price:</td>
	<td>
	<input type="number" name="price" value="<?php echo $price; ?>">
	</td>
	</tr>
	<tr>
	<td>Current Image</td>
	<td>
	<?php
		if($current_image=="")
		{
			echo "Image not available";
		} 
		else
		{
			?>
			<img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
			<?php
		}
	?>
	</td>
	</tr>
	<tr>
	<td>Select new image:</td>
	<td>
	<input type="file" name="image">
	</td>
	</tr>
	<tr>
	<td>Featured:</td>
	<td>
	<input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
	<input <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No">No
	</td>
	</tr>
	<tr>
	<td>Active:</td>
	<td>
	<input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes">Yes
	<input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No">No
	</td>
	</tr>
	<tr>
	<td>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
	<input type="submit" name="submit" value="Update Food" class="btn-secondary">
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
		//getting data from form
		$id = $_POST['id'];
		$title = $_POST['title'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$current_image = $_POST['current_image'];
		$featured = $_POST['featured'];
		$active = $_POST['active'];
		//then upload image if selected
		//check whether upload image button is clicked or not
		if(isset($_FILES['image']['name']))
		{
			$image_name = $_FILES['image']['name'];
			//check whether file is available or not
			if($image_name!="")
			{
				$ext = end(explode('.',$image_name));
				$image_name = "Food-Name-".rand(0000,9999).'.'.$ext;
				//get source and destination path
				$src_path = $_FILES['image']['tmp_name'];
				$dest_path = "../images/food/".$image_name;
				$upload = move_uploaded_file($src_path, $dest_path);
				//check whether image is uploaded or not
				if($upload==false)
				{
					$_SESSION['upload'] = "Image not uploaded";
					header('location:'.SITEURL.'admin/manage-food.php');
					//stopping the form process
					die();
				} 
				//remove old image if new image is uploaded
				if($current_image!="")
				{
					$remove_path = "../images/food/".$current_image;
					$remove = unlink($remove_path);
					if($remove==false)
					{
						$_SESSION['remove-failed']="Old image failed to remove";
						header('location:'.SITEURL.'admin/manage-food.php');
						die();
					}
				}
			}
			else
			{
				$image_name=$current_image;
			}
		}
		else
		{
			$image_name = $current_image;
		}
		
		
		//update the food in database
		$sql2 = "UPDATE tbl_food SET
			title = '$title',
			description = '$description',
			price = $price,
			image_name = '$image_name',
			featured = '$featured', 
			active = '$active'
			WHERE id =$id
			";
		//executing the query

		$res2 = mysqli_query($conn, $sql2);

		//check if query is executed or not
		if($res2==true)
		{
			$_SESSION['update']="Food updated successfully";
			header('location:'.SITEURL.'admin/manage-food.php');
		}
		else
		{
			$_SESSION['update']="Food not updated";
			header('location:'.SITEURL.'admin/manage-food.php');
		}
		//redirect to manage-food with session message
	}
?>
<?php include('partials/footer.php'); ?>