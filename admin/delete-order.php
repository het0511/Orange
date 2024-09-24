<?php
	//including constants.php file here
	include('../config/constants.php');

	//get the id of admin to delete
	$id = $_GET['id'];

	// create sql query to delete admin
	$sql = "DELETE FROM tbl_order WHERE id=$id";
	
	// execute the query
	$res = mysqli_query($conn, $sql);
	
	//check whether the query executed successfully or not
	if($res==TRUE)
	{
		//Query executed successfully
		$_SESSION['delete-order'] = "Order deleted successfully";
		//redirect to manage admin page
		header('location:'.SITEURL.'admin/manage-order.php');
	}
	else {
		//query not executed
		$_SESSION['delete-order'] = "Order to delete admin";
		//redirect to manage admin page
		header('location:'.SITEURL.'admin/manage-order.php');
	}
?>