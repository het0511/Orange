<?php include('../config/constants.php'); ?>
<?php include('login-check.php'); ?>
<html>
<head>
<title>Home page</title>
<link rel="stylesheet" href="../css/admin.css">
<style>
.tbl-full {
	width: 100%;
}
table tr th {
	border-bottom: 1px solid black;
	padding: 1%;
	text-align: left;
}
table tr td {
	padding: 1%;
}
.btn-primary {
	background-color: #87CEEB;
	padding: 1%;
	color: white;
	text-decoration: none;
	font-weight: bold;
}
.btn-primary:hover {
	background-color: blue;
}
.btn-secondary {
	background-color: #90EE90;
	padding: 1%;
	color: white;
	text-decoration: none;
	font-weight: bold;
}
.btn-secondary:hover {
	background-color: green;
}
.btn-danger {
	background-color: #FFCCCB;
	padding: 1%;
	color: white;
	text-decoration: none;
	font-weight: bold;
}
.btn-danger:hover {
	background-color: red;
}
.tbl-30 {
	width: 30%;
}
</style>
</head>
<body>
<!-- Menu Section starts -->
<div class="menu text-center">
	<div class="wrapper">
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="manage-admin.php">Admin</a></li>
		<li><a href="manage-food.php">Food</a></li>
		<li><a href="manage-order.php">Order</a></li>
		<li><a href="manage-user.php">User</a></li>
		<li><a href="logout.php">Log out</a></li>
	</ul>
	</div>
</div>
<!-- Menu Section ends -->