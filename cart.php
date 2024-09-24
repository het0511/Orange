<?php include('config/constants.php'); ?>
<?php include('login-check1.php'); ?>
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Orange Restaurant</title>
  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,700|Raleway:400,700&display=swap"
    rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
<style>
.empty-cart {
	width=50%;
}
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
</style>
</head>

<body class="sub_page">
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="index.php">
            <img src="images/logo.png" alt="" />
            <span>
              Orange
            </span>
          </a>

          <div class="navbar-collapse" id="">
            <div class="custom_menu-btn">
              <button onclick="openNav()">
                <span class="s-1"> </span>
                <span class="s-2"> </span>
                <span class="s-3"> </span>
              </button>
            </div>
            <div id="myNav" class="overlay">
              <div class="overlay-content">
                <a href="index.php">HOME</a>
                <a href="about.php">ABOUT</a>
                <a href="food.php">Food</a>
		<a href="cart.php">Your Cart</a>
                <a href="contact.php">Contact Us</a>
		<a href="logout1.php">Log Out</a>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>
<h1><center>Welcome, <?php echo $_SESSION['user']; ?></center></h1><br><br>
<center>
<?php
			if(isset($_SESSION['delete-item'])){
				echo $_SESSION['delete-item'];
				unset($_SESSION['delete-item']);
			}
			if(isset($_SESSION['order-success'])){
				echo $_SESSION['order-success'];
				unset($_SESSION['order-success']);
			}
?>
</center><br>
<table class="tbl-full">
<tr>
	<th>SR.No.</th>
	<th>Food</th>
	<th>Image</th>
	<th>Price</th>
	<th>Quantity</th>
	<th>Sub Total</th>
	<th>Action</th>
</tr>
			<?php
				$user = $_SESSION['user'];
				$sql = "SELECT * FROM tbl_cart WHERE username='$user'";
				//execute the query
				$res = mysqli_query($conn, $sql);
				//count the rows to check whether we have foods
				$count = mysqli_num_rows($res);
				$sn=1;
				if($count>0)
				{
					//getting the food from database and display
					while($row=mysqli_fetch_assoc($res))
					{
						$id = $row['id'];
						$food = $row['food'];
						$image = $row['image'];
						$price = $row['price'];
						$quantity = $row['quantity'];
						$subtotal = $row['total'];
						?>
						<tr>
						<td><?php echo $sn++; ?></td>
						<td><?php echo $food; ?></td>
						<td>
						<?php
							if($image=="")
							{
								echo "Image not added";
							}
							else
							{
								?>
								<img src="<?php echo SITEURL; ?>images/food/<?php echo $image; ?>" width="100px">
								<?php
							}
						?>
						</td>
						<td><?php echo $price; ?></td>
						<td><?php echo $quantity; ?></td>
						<td><?php echo $subtotal; ?></td>
						<td><a href="<?php echo SITEURL; ?>delete-item.php?id=<?php echo $id; ?>" class="btn-danger">Delete</a></td>
						</tr>	

						<?php
					}
				}
				else
				{
					echo "<center>It Looks Like Your Cart is Empty</center>";
				}
			?>
					
</table><br><br>
<?php
if($count>0){
	?>
	<center><a href="place-order.php" class="btn-primary">Order Now</a></center>
	<?php
}
?>
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>

  <script>
    function openNav() {
      document.getElementById("myNav").classList.toggle("menu_width");
      document
        .querySelector(".custom_menu-btn")
        .classList.toggle("menu_btn-style");
    }
  </script>

  <!-- owl carousel script -->
  <script type="text/javascript">
    $(".owl-carousel").owlCarousel({
      loop: true,
      margin: 35,
      navText: [],
      autoplay: true,
      autoplayHoverPause: true,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 2
        },
        1000: {
          items: 3
        }
      }
    });
  </script>
  <!-- end owl carousel script -->
</body>
</html>