<?php include('partials/menu.php'); ?>
<?php
	$id = $_GET['id'];
	$sql="SELECT * FROM tbl_order WHERE id=$id";
	$res=mysqli_query($conn, $sql);
	if($res==true)
	{
		$count = mysqli_num_rows($res);
		if($count==1)
		{
			$row=mysqli_fetch_assoc($res);
			$status=$row['status'];
			if($status=='Ordered'){
				$sql2 = "UPDATE tbl_order SET status='Delivered' WHERE id='$id'";
			}
			else {
				$sql2 = "UPDATE tbl_order SET status='Ordered' WHERE id='$id'";
			}
			$res2=mysqli_query($conn, $sql2);
			header('location:'.SITEURL.'admin/manage-order.php');
		}
	}
?>
