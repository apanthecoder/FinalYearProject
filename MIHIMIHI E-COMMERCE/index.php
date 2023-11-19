<?php 
    include 'connection.php';
    session_start();
    $user_id = $_SESSION['user_id'];
    if (!isset($user_id)) {
        header('location:login.php');
    }
    if(isset($_POST['logout'])){
        session_destroy();
        header("location: login.php");
    }
    //adding product in wishlist
    if (isset($_POST['add_to_wishlist'])) {
    	$product_id = $_POST['product_id'];
    	$product_name = $_POST['product_name'];
    	$product_price = $_POST['product_price'];
    	$product_image = $_POST['product_image'];

    	$wishlist_number = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id ='$user_id'") or die('query failed');
    	$cart_num = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id ='$user_id'") or die('query failed');
    	if (mysqli_num_rows($wishlist_number)>0) {
    		$message[]='product already exist in wishlist';
    	}else if (mysqli_num_rows($cart_num)>0) {
    		$message[]='product already exist in cart';
    	}else{
    		mysqli_query($conn, "INSERT INTO `wishlist`(`user_id`,`pid`,`name`,`price`,`image`) VALUES('$user_id','$product_id','$product_name','$product_price','$product_image')");
    		$message[]='product successfuly added in your wishlist';
    	}
    }

     //adding product in cart
    if (isset($_POST['add_to_cart'])) {
    	$product_id = $_POST['product_id'];
    	$product_name = $_POST['product_name'];
    	$product_price = $_POST['product_price'];
    	$product_image = $_POST['product_image'];
    	$product_quantity = $_POST['product_quantity'];

    	$cart_num = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id ='$user_id'") or die('query failed');
    	if (mysqli_num_rows($cart_num)>0) {
    		$message[]='product already exist in cart';
    	}else{
    		mysqli_query($conn, "INSERT INTO `cart`(`user_id`,`pid`,`name`,`price`,`quantity`,`image`) VALUES('$user_id','$product_id','$product_name','$product_price','$product_quantity','$product_image')");
    		$message[]='product successfuly added in your cart';
    	}
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!------------------------bootstrap icon link------------------------------->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!------------------------bootstrap css link------------------------------->
    <!------------------------slick slider link------------------------------->
    <link rel="stylesheet" type="text/css" href="slick.css" />
    <!------------------------default css link------------------------------->
    <link rel="stylesheet" href="main.css">
    <title>mihimihi - home page</title>
</head>

<body>
    <?php include 'header.php'; ?>
    <!------------------------slide------------------------------->

    <div class="container-fluid">
        <div class="hero-slider">
            <div class="slider-item">
                <img src="img/slider.png" alt="...">
                <div class="slider-caption">
                    <span>Taste The Sweetness</span>
                    <h1>Original <br>French Puff</h1>
                    <p>An oblong crispy mascarpone custard puff that is topped with almonds<br>
					 and baked until crispy on the outside and hollow on the inside. </p>
                    <a href="shop.php" class="btn">buy now</a>
                </div>
            </div>
            <div class="slider-item">
                <img src="img/slider2.png" alt="...">
                <div class="slider-caption">
                    <span>Share The Sweetness</span>
                    <h1>Mini <br> French Puff</h1>
                    <p>A mini crispy mascarpone custard puff that is topped with almonds<br>
					 and baked until crispy on the outside and hollow on the inside.</p>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
            </div>
			<div class="slider-item">
                <img src="img/slider3.png" alt="...">
                <div class="slider-caption">
                    <span>Feel The Cream</span>
                    <h1> Cream puff </h1>
                    <p>A profiterole, cream puff, or chou à la crème is a filled French choux<br>
					 pastry ball with a typically sweet and <br>
						moist filling of custard.</p>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
            </div>
        </div>
        <div class="control">
            <i class="bi bi-chevron-left prev"></i>
            <i class="bi bi-chevron-right next"></i>
        </div>
    </div>
    <div class="line"></div>
    <div class="services">
    	<div class="row">
    		<div class="box">
    			<img src="img/0.png">
    			<div>
    				<h1>Taste Guarantee</h1>
    				<p>We will make sure every bites<br> bring happiness.</p>
    			</div>
    		</div>
    		<div class="box">
    			<img src="img/1.png">
    			<div>
    				<h1>Affordable Price</h1>
    				<p>The price is suitable based on<br>the quality and taste.</p>
    			</div>
    		</div>
    		<div class="box">
    			<img src="img/2.png">
    			<div>
    				<h1>100% Original</h1>
    				<p>We use real products and non-artificial custard flavours.</p>
    			</div>
    		</div>
    	</div>
    </div>
    <div class="line2"></div>
    <div class="story">
    	<div class="row">
    		<div class="box">
    			<span>OUR HISTORY</span>
    			<h1>Founded in 2018 by Yumlab sdn bhd</h1>
    			<p> Mihimihi Pastry Shop quickly became a culinary icon in Willowbrook. 
					Combining traditional recipes with a modern twist, Mihimihi offered a delightful array of pastries and confections.
					 In an era of digital commerce, the shop retained its charm as a cozy brick-and-mortar haven.
					  By 2023, it had established itself as a local landmark,
					   fostering a community of pastry aficionados and coffee lovers who gathered
					    to savor exquisite treats and create cherished memories.
						 Founder's commitment to quality and creativity remains at the heart of Mihimihi,
						  making it a beloved institution in Willowbrook's culinary scene.</p>
                <a href="about.php" class="btn"> Learn More</a>
    		</div>
    		<div class="box">
    			<img src="img/8.jpg">
    		</div>
    	</div>
    </div>
    <div class="line3"></div>
    <!-- testimonial -->
    <div class="line4"></div>
    <div class="testimonial-fluid">
    	<h1 class="title">Customer Review</h1>
    	<div class="testimonial-slider">
    		<div class="testimonial-item">
    			<img src="img/3.jpg">
    			<div class="testimonial-caption">
    				<span> Zuhairi</span>
    				<h1>Exquisite Culinary Craftsmanship</h1>
    				<p> Customers frequently extol the exquisite culinary craftsmanship at Mihimihi. <br>
					The pastries, cakes, and confections are often described as miniature works of art that 
					<br>tantalize the taste buds and delight the senses. <br>
					These creations, meticulously crafted with a fusion of traditional recipes and <br>
					innovative twists, stand as a testament to the pastry shop's unwavering commitment to excellence..</p>

    			</div>
    		</div>
    		<div class="testimonial-item">
    			<img src="img/4.jpg">
    			<div class="testimonial-caption">
    				<span> Insyirah</span>
    				<h1>A Charming Oasis of Community</h1>
    				<p>Mihimihi is more than a pastry shop; it's a charming oasis of community.<br>
						 Testimonials often highlight the cozy ambiance of the shop,<br>
						  adorned with vintage pastry-making tools and rustic decor. <br>
						  This welcoming environment encourages patrons to linger, <br>
						  forging connections over cups of rich coffee and sharing delightful conversations.</p>
    			</div>
    		</div>
    		<div class="testimonial-item">
    			<img src="img/profile.jpg">
    			<div class="testimonial-caption">
    				<span>Zharfan</span>
    				<h1>Exceptional Customer Service</h1>
    				<p>Mihimihi is renowned for its exceptional customer service.<br>
						 Visitors often praise the warmth, care, and attentiveness they receive during their visits.<br>
						  The shop's team consistently goes the extra mile to ensure every customer's experience is memorable.<br>
						   This exceptional customer service fosters <br>
						   a sense of belonging and keeps patrons returning for more than just the culinary delights.</p>
    			</div>
    		</div>
    	</div>
    	 <div class="control">
            <i class="bi bi-chevron-left prev1"></i>
            <i class="bi bi-chevron-right next1"></i>
        </div>
    </div>
    <div class="line"></div>
    <!---discover section --->
    <div class="line2"></div>
    <div class="discover">
    	<div class="detail">
    		<h1 class="title">Niko Neko Matcha</h1>
    		<span>Original/Mini French Puff</span>
    		<p>'Niko Neko Matcha' a Unique mixture of<br>
				 pure Japanese roasted Brown Rice powder and Shaded Green Tea powder.</p>
				 <br>
            <a href="shop.php" class="btn">Discover More</a>
    	</div>
    	<div class="img-box">
    		<img src="img/13.png">
    	</div>
    </div>
    <div class="line3"></div>
    <?php include 'homeshop.php'; ?>
    <div class="line2"></div>
    <div class="newslatter">
    	<h1 class="title">Get Notified!</h1>
    	<p>Be the first to know our latest update and incoming promotions.
        </p>
        <input type="text" name="" placeholder="Enter your email">
        <a href="subscription_confirmation.html">
        <button>Subscribe Now</button>
    </a>
    </div>
    <div class="line3"></div>
    <div class="client">
    	<div class="box">
    		<img src="img/client0.png">
    	</div>
    	<div class="box">
    		<img src="img/client1.png">
    	</div>
    	<div class="box">
    		<img src="img/client2.png">
    	</div>
    	<div class="box">
    		<img src="img/client3.png">
    	</div>
    	<div class="box">
    		<img src="img/client.png">
    	</div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="jquary.js"></script>
    <script src="slick.js"></script>

    <script type="text/javascript">
        <?php include 'script2.js' ?>
    </script>
</body>

</html>