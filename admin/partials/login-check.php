<?php
	//authorization access control
	//check whether the user is logged in or not
	if(!isset($_SESSION['admin'])) // if user is not set
	{
		//user not logged in
		//redirect to login page
		$_SESSION['no-login-message'] = "Please log in to access admin panel";
		header('location:'.SITEURL.'admin/login.php');	
	}
?>