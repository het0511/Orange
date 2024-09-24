<?php include('config/constants.php'); ?>
<?php include('login-check1.php'); ?>
<html>
<head>
<title>Order page</title>
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
	border: 1px solid black;
}
</style>
</head>
<body>
<div class="main-content">
	<div class="wrapper">
		<center><h1>Add to your cart</h1><br>
		<br>
		<?php
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$sql = "SELECT * FROM tbl_food WHERE id=$id";
			$res = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($res);
			$title = $row['title'];
			$image = $row['image_name'];
			$price = $row['price'];
		}
		?>
		<form action="" method="POST">
		<table class="tbl-30">
		<tr>
		<td>Food Name:</td>
		<td><?php echo $title; ?></td>
		</tr>
		<tr>
		<td>Food:</td>
		<td>
		<?php
			if($image=="")
			{
				echo "Image not available";
			} 
			else
			{
				?>
				<img src="<?php echo SITEURL; ?>images/food/<?php echo $image; ?>" width="150px">
				<?php
			}
		?>
		</td>
		</tr>
		<tr>
		<td>Price:</td>
		<td><span id="price"><?php echo $price; ?></span></td>
		</tr>
		<tr>
		<td>Quantity:</td>
		<td><input type="number" id="quantity" name="quantity" oninput="calc()" value="1" min="1"></td>
		</tr>
		<tr>
		<td>Total:</td>
		<td><span id="total"><?php echo $price; ?></span></td>
		</tr>
		<tr>
		<td colspan="2">
		<center><input type="submit" name="submit" value="Add to Cart" class="btn-secondary"></center>
		</td>
		</tr>
		</table>
		</form>
		</center>
	</div>
</div>
<script>
function calc() 
{
  var price = document.getElementById("price").innerHTML;
  var quantity = document.getElementById("quantity").value;
  var total = parseFloat(price) * quantity;
  if (!isNaN(total))
    document.getElementById("total").innerHTML = total
}
</script>
</body>
</html>

<?php
	if(isset($_POST['submit'])){
		$quantity = $_POST['quantity'];
		$username = $_SESSION['user'];
		$total = $quantity*$price;
		$sql2 = "INSERT INTO tbl_cart SET
			username='$username',
			food='$title',
			image='$image',
			price='$price',
			quantity='$quantity',
			total='$total'
		";
		$res2 = mysqli_query($conn, $sql2);
		if($res2==true){
			header('location:'.SITEURL.'cart.php');
		}
		else{
			header('location:'.SITEURL.'food.php');
		}
	}
?>