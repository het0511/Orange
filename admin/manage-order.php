<?php include('partials/menu.php'); ?>
<div class="main-content">
	<div class="wrapper">
		<h1>Manage order</h1>
		<br>
		<?php
			if(isset($_SESSION['delete-order'])){
				echo $_SESSION['delete-order'];
				unset($_SESSION['delete-order']);
			}
		?><br><br>
		<table class="tbl-full">
			<tr>
				<th>SR.No.</th>
				<th>Full Name</th>
				<th>Food</th>
				<th>Quantity</th>
				<th>Date</th>
				<th>Contact</th>
				<th>E-mail</th>
				<th>Address</th>
				<th>Status</th>
				<th>Actions</th>
			</tr>
	
			<?php
				$sql = "SELECT * FROM tbl_order";
				$res = mysqli_query($conn, $sql);
				$count = mysqli_num_rows($res);
				$sn=1;
				if($count>0)
				{
					while($row=mysqli_fetch_assoc($res)){
						$id = $row['id'];
						$food = $row['food'];
						$qty = $row['qty'];
						$date = $row['order_date'];
						$status = $row['status'];
						$name = $row['customer_name'];
						$number = $row['customer_contact'];
						$email = $row['customer_email'];
						$address = $row['customer_address'];
						?>
						<tr>
						<td><?php echo $sn++; ?></td>
						<td><?php echo $name; ?></td>
						<td><?php echo $food; ?></td>
						<td><?php echo $qty; ?></td>
						<td><?php echo $date; ?></td>
						<td><?php echo $number; ?></td>
						<td><?php echo $email; ?></td>
						<td><?php echo $address; ?></td>
						<td><?php echo $status; ?></td>
						<td>
						<a href="<?php echo SITEURL; ?>admin/change-status.php?id=<?php echo $id; ?>" class="btn-secondary">Status</a><br>
						<a href="<?php echo SITEURL; ?>admin/delete-order.php?id=<?php echo $id; ?>" class="btn-danger">Delete</a>
						</td>
						</tr>
						<?php
					}
				}
				else {
					echo "No Orders Yet";
				}
			?>
		</table>
	</div>
</div>

<?php include('partials/footer.php'); ?>