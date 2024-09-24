<?php include('partials/menu.php'); ?>
<div class="main-content">
	<div class="wrapper">
		<h1>Add Food</h1>
		<br>
		<?php
			if(isset($_SESSION['upload']))
			{
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);
			}
		?>
		<form action="" method="POST" enctype="multipart/form-data">
		<table class="tbl-30">
		<tr>
		<td>Title:</td>
		<td>
			<input type="text" name="title" placeholder="Title of the Food">
		</td>
		</tr>
		<tr>
		<td>Description:</td>
		<td>
			<textarea name="description" cols="30" rows="5" placeholder="Description of the Food"></textarea>
		</td>
		</tr>
		<tr>
		<td>Price:</td>
		<td>
			<input type="number" name="price">
		</td>
		</tr>
		<tr>
		<td>Select Image:</td>
		<td>
		<input type="file" name="image">
		</td>
		</tr>
		<tr>
		<td>Featured:</td>
		<td>
			<input type="radio" name="featured" value="Yes">Yes
			<input type="radio" name="featured" value="No">No
		</td>
		</tr>
		<tr>
		<td>Active:</td>
		<td>
			<input type="radio" name="active" value="Yes">Yes
			<input type="radio" name="active" value="No">No
		</td>
		</tr>
		<tr>
		<td colspan="2">
		<input type="submit" name="submit" value="Add Food" class="btn-secondary">
		</td>
		</tr>
		</table>
		</form>
		<?php
			//checking whether button is clicked or not
			if(isset($_POST['submit']))
			{
				//get the data from form
				$title = $_POST['title'];
				$description = $_POST['description'];
				$price = $_POST['price'];
				//check whether radio button for featured and active is checked or not
				if(isset($_POST['featured']))
				{
					$featured = $_POST['featured'];
				}
				else
				{
					$featured = "No";
				}
				if(isset($_POST['active']))
				{
					$active = $_POST['active'];
				}
				else
				{
					$active = "No";
				}
				//need to upload image if selected
				//checking whether image is uploaded or not
				if(isset($_FILES['image']['name'])) //it will only check if button is clicked not whether image is uploaded
				{
					//get the image selected
					$image_name= $_FILES['image']['name'];
					//whether image is selected or not
					if($image_name!="")
					{
						//image is selected
						//rename image
						//get the extension of selected image like .jpg, .png, .jpeg
						$ext = end(explode('.', $image_name));
						//create new name for image
						$image_name = "food-name-".rand(0000,9999).".".$ext;
						//upload image
						//need to get source and destination path
						//source path is the current location of image
						$src = $_FILES['image']['tmp_name'];
						//creating destination path for the image to be uploaded
						$dst = "../images/food/".$image_name;
						//upload image
						$upload = move_uploaded_file($src, $dst);
						//check whether image uploaded or not
						if($upload==false)
						{
							//failed to upload
							//stop the process to stop saving the other data
							$_SESSION['upload'] = "Failed to upload image";
							header('location:'.SITEURL.'admin/add-food.php');
							die();
						}
					}
				}
				else
				{
					//default image
					$image_name = ""; //no image
				}	
				//insert into database
				//creating a sql query
				$sql1 = "INSERT INTO tbl_food SET
					title = '$title',
					description = '$description',
					price = $price,
					image_name = '$image_name',
					featured = '$featured',
					active = '$active'
				";
				//executing query
				$res1 = mysqli_query($conn, $sql1);
				//checking whether query is executed or not
				if($res1==true)
				{
					$_SESSION['add']="Food added successfully";
					header('location:'.SITEURL.'admin/manage-food.php');
				}
				else
				{
					$_SESSION['add']="Food was not added";
					header('location:'.SITEURL.'admin/manage-food.php');
				}
			}
		?>
	</div>
</div>
<?php include('partials/footer.php'); ?>