<?php
session_start();
//include("server/connection.php");
$conn = mysqli_connect("localhost","root","","php_project");
if(!$conn){
 die("Couldn't connect to database");

}

?>




<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edible Era | Explore the Flavourful Journey</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .product-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .product-container {
            width: 48%;
            margin-bottom: 20px;
        }

        @media (max-width: 767.98px) {
            /* Styles for mobile devices */
            .product-container {
                width: 100%;
            }
        }
        </style>
</head>

<body>

    <header class="header">
        <div class="container">
            <div class="logo">
                <h1><b>EDIBLE ERA</b></h1>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="cart1.php">Cart</a></li>
                    <li><a href="my.html">My products</a></li>
                </ul>
            </nav>
            
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Discover Exquisite Flavours</h1>
                <p>Explore a world of culinary delights at Edible Era. Unleash the taste that takes you on a flavourful journey.</p>
            </div>
            <div class="hero-image">
                <img src="assets\iiiii\banner4.jpg" alt="Flavourful Journey">
            </div>
        </div>
    </section>

    <div class="small-container mt-5">
        <h2 class="title">Products</h2>
        <div class="products">
            <?php include('server/get_featured_products.php'); ?>
            <div class="product-section" id="chocos-products">
                <?php while ($row = $featured_products->fetch_assoc()) { ?>
                    <div class="product-container">
                    <div class="product">
    <img src="<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">
    <p><?php echo $row['product_name']; ?></p>
    <h5 class="p-price">Rs. <?php echo $row['product_price']; ?></h5>
    <form method="POST" action="cart1.php">
        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>" />
        <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>" />
        <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>" />
        <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>" />
        <button class="buy-now-button" type="submit" name="add_to_cart">Add to cart</button>
    </form>
</div>

                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="banner-container">
            <img src="assets/iiiii/banner1.webp" alt="Business People Shaking Hands" style="width: 80%; height: 400px; display: block; margin: 0 auto;" />
        </div>
    </div>

    <div class="small-container mt-5">
        <h2 class="title">Latest Products</h2>
        <div class="hero-image">
            <img src="assets/iiiii/banner.jpg" alt="Flavorful Journey">
        </div>
    </div>

 
        

           

<!-- -------footer------ -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="footer-col-1">
                <h3>Download our app</h3>
                <p>Top G5  Enabled Prodcuts with good support</p>
                <div class="app-logo">
                   
                </div>
            </div>
            <div class="footer-col-2">
                <img src="images" alt="">
                <p>Best technology enabled product?</p>
            </div>
            <div class="footer-col-3">
                <h3>Useful Links</h3>
                <ul>
                    <li>Coupons</li>
                    <li>Blog Post</li>
                    <li>Return Policy</li>
                    <li>Join Affiliate</li>
                </ul>
            </div>
            <div class="footer-col-4">
                <h3>Follow Us</h3>
                <ul>
                    <li>Facebook</li>
                    <li>Twitter</li>
                    <li>Instagram</li>
                    <li>YouTube</li>
                </ul>
            </div>
        </div>
        <hr>
        <p class="copyright">Copyright 2021 Sarthak</p>
    </div>
</div>
</body>

</html>