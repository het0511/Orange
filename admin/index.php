<?php include('partials/menu.php'); ?>

<!-- Main Content starts -->
<div class="main-content">
	<div class="wrapper">
		<h1>Dashboard</h1><br>
		<?php
			if(isset($_SESSION['login']))
			{
				echo $_SESSION['login'];
				unset($_SESSION['login']);
			}
		?>
		<br>
		<div class="col-4 text-center">
		<?php
			$sql = "SELECT * FROM tbl_admin";
			$res = mysqli_query($conn, $sql);
			$count = mysqli_num_rows($res);
		?>
		<h1><?php echo $count ?></h1>
		<br>
		Admins 
		</div>
		<div class="col-4 text-center">
		<?php
			$sql2 = "SELECT * FROM tbl_user";
			$res2 = mysqli_query($conn, $sql2);
			$count2 = mysqli_num_rows($res2);
		?>
		<h1><?php echo $count2; ?></h1>
		<br>
		Users 
		</div>
		<div class="col-4 text-center">
		<?php
			$sql3 = "SELECT * FROM tbl_food";
			$res3 = mysqli_query($conn, $sql3);
			$count3 = mysqli_num_rows($res3);
		?>
		<h1><?php echo $count3; ?></h1>
		<br>
		Foods 
		</div>
		<div class="col-4 text-center">
		<?php
			$sql4 = "SELECT * FROM tbl_order";
			$res4 = mysqli_query($conn, $sql4);
			$count4 = mysqli_num_rows($res4);
		?>
		<h1><?php echo $count4; ?></h1>
		<br>
		Orders 
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- Main Content ends -->

<?php include('partials/footer.php'); ?>