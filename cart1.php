<?php
session_start();
include ("server/connection.php");
// Function to remove item from cart by product_id
function removeItem($product_id) {
    if(isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}

// Function to calculate total cost of all products in the cart
function calculateTotalCost() {
    $total = 0;
    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach($_SESSION['cart'] as $product) {
            $total += $product['product_price'];
        }
    }
    return $total;
}

// Handle removing item from cart
if(isset($_POST['remove_from_cart'])) {
    if(isset($_POST['product_id'])) {
        removeItem($_POST['product_id']);
    }
}

// Handle adding item to cart
if(isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_image = $_POST['product_image'];
    $product_price = $_POST['product_price'];

    $_SESSION['cart'][$product_id] = array(
        'product_name' => $product_name,
        'product_image' => $product_image,
        'product_price' => $product_price
    );
}

// Handle "Buy now" button
if(isset($_POST['buy_now'])) {
    // Redirect to my_orders page
    header("Location: my_orders.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <!-- <link rel="stylesheet" href="assets/css/styles.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add your custom CSS here -->
   <style>
    /* Body Styles */
body {
    font-family: 'Montserrat', sans-serif;
    background-color: #f8f9f9;
    line-height: 1.6;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.container {
    flex-grow: 1;
}

.header {
    width:160%;
    background-color: #ffc107;
    color: #fff;
    padding: 15px 0;
    margin:20px;
    box-shadow: 0 2px 4px rgba(208, 243, 133, 0.1);
}

.header .container {
    display: flex;
    width:160%;
    justify-content:left;
    align-items:start;
    /* margin: -20px; */
}

.logo h1 {
    color: #fff;
    font-size: 1.8rem;
}

.nav-links {
    list-style: none;
    display: flex;
}

.nav-links li {
    margin: 0 15px;
}

.nav-links a {
    text-decoration: none;
    color: #fff;
    font-weight: bold;
    transition: color 0.3s ease;
}

.nav-links a:hover {
    color: #ffc107;
}

/* Footer Styles */
.footer {
    background-color: #ffc107;
    color: #fff;
    padding: 40px 0;
    margin-top: auto;
    padding-left: -120px;
    width:117%;
}

.footer .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.footer-col-1 h3,
.footer-col-2 p,
.footer-col-3 h3,
.footer-col-4 h3 {
    font-size: 1.2rem;
    margin-bottom: 20px;
}

.footer-col-2 img {
    width: 100px;
    margin-right: 10px;
}

.footer-col-3 ul,
.footer-col-4 ul {
    list-style: none;
}

.footer-col-3 ul li,
.footer-col-4 ul li {
    margin-bottom: 10px;
}

/* Cart Page Styles */
.container {
    text-align: center;
}

.table {
    margin-top: 30px;
}

.table th,
.table td {
    text-align: center;
}

.btn-primary {
    margin-top: 20px;
}

.footer {
    margin-top: 50px;
}

    </style>
</head>

<body>
    <div class="container mt-5">
        <header class="header">
            <div class="container">
                <div class="logo">
                    <h1><b>EDIBLE ERA</b></h1>
                </div>
                <nav>
                    <ul class="nav-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="cart1.php">Cart</a></li>
                        <li><a href="my_orders.php">My products</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <h2>Cart</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
    <?php
    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach($_SESSION['cart'] as $product_id => $product) {
            echo "<tr>";
            echo "<td><img src='{$product['product_image']}' alt='Product Image' style='max-width: 100px;'></td>";
            echo "<td>{$product['product_name']}</td>";
            echo "<td>{$product['product_price']}</td>";
            echo "<td>
                    <form method='post'>
                        <input type='hidden' name='product_id' value='{$product_id}'> <!-- Added hidden input -->
                        <button type='submit' class='btn btn-danger' name='remove_from_cart'>Remove</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Your cart is empty</td></tr>";
    }
    ?>
</tbody>
        </table>
        
        <!-- Display total cost -->
        <p>Total Cost: <?php echo calculateTotalCost(); ?></p>

        <!-- "Buy now" button -->
        <form method="post">
            <button type="submit" class="btn btn-primary" action="my_orders.php"  name="buy_now">Buy now</button>
        </form>
    </div>
</body>
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
</html>