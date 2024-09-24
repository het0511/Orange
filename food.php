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

  <title>Orange</title>
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

  <!-- dish section -->
  <section class="dish_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="dish_container">
            <div class="box">
              <img src="images/1.jpg">
            </div>
	    <div class="box">
              <img src="images/2.jpeg">
            </div>
	    <div class="box">
              <img src="images/3.jpg">
            </div>
	    <div class="box">
              <img src="images/4.jpg">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <hr>
              <h2>
                Our <br>
                Food <br>
                dishs
              </h2>
            </div>
            <p>
              We offer variety of Cuisines according to your taste. 
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end dish section -->

  <!-- hot section -->

  <section class="hot_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          What's Hot
        </h2>
        <hr>
      </div>
      <p>
        Eat-Repeat-Eat-repeat
      </p>
    </div>
    <div class="carousel_container">
      <div class="container">
        <div class="carousel-wrap ">
          <div class="owl-carousel">
	    <?php
		$sql="SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes'";
		$res=mysqli_query($conn, $sql);
		$count=mysqli_num_rows($res);
		if($count>0)
		{
			while($row=mysqli_fetch_assoc($res))
			{
				$id=$row['id'];
				$title=$row['title'];
				$image_name=$row['image_name'];
				$price=$row['price'];
				$description=$row['description'];
				?>
				<div class="item">
              				<div class="box">
                				<div class="img-box">
							<?php
								if($image_name=="")
								{
									echo "Image not available";
								}
								else 
								{
									?>
									<img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>">
									<?php
								} 
							?>
                				</div>
                			<div class="detail-box">
                  			<h4>
                    				<?php echo $price; ?>
                  			</h4>
                  			<p>
                    				<?php echo $description; ?>
                  			</p>
                  			<a href="<?php echo SITEURL; ?>order-form.php?id=<?php echo $id; ?>">
                    				Order Now
                  			</a>
                			</div>
              				</div>
            			</div>
				<?php
			}
		}
		else
		{
			echo "Food not added";
		}
	    ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end hot section -->

  <!-- subscribe section -->

  <section class="subscribe_section">
    <div class="container">
      <form action="">
        <div class="row">
          <div class="col-lg-3 col-md-4">
            <label for="subEmail">
              Our Newsletter
            </label>
          </div>
          <div class="col-lg-9 col-md-8">
            <div class="box">
              <input type="email" placeholder="Enter your email" id="subEmail">
              <button>
                Subscribe
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>

  <!-- end subscribe section -->

  <!-- footer section -->
  <section class="container-fluid footer_section">
    <div class="social_container">
      <h4>
        Follow on
      </h4>
      <div class="social-box">
        <a href="">
          <img src="images/fb.png" alt="">
        </a>
        <a href="">
          <img src="images/twitter.png" alt="">
        </a>
        <a href="">
          <img src="images/linkedin.png" alt="">
        </a>
        <a href="">
          <img src="images/youtube.png" alt="">
        </a>
      </div>
    </div>
    <p>
      &copy; 2019 All Rights Reserved. Design by
      <a href="https://html.design/">Free Html Templates</a>
    </p>
  </section>
  <!-- footer section -->

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