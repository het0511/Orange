<?php
	//authorization access control
	//check whether the user is logged in or not
	if(!isset($_SESSION['user'])) // if user is not set
	{
		//user not logged in
		//redirect to login page
		$_SESSION['no-login-message'] = "Please log in to continue.";
		header('location:'.SITEURL.'login-page.php');	
	}
?>