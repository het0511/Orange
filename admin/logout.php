<?php
	include('../config/constants.php');
	//deleting the session
	session_destroy(); // also unsets $_SESSION['user']
	//redirect to login page
	header('location:'.SITEURL.'admin/login.php');
?>