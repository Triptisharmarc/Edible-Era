<?php
session_start();

// Function to remove item from cart by product_id
function removeItem($product_id) {
    if(isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}

// Handle removing item from cart
if(isset($_POST['remove_from_cart'])) {
    if(isset($_POST['product_id'])) {
        removeItem($_POST['product_id']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add your custom CSS here -->
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
                        <li><a href="mycategories.html">Products</a></li>
                        <li><a href="cart.php">Cart</a></li>
                        <li><a href="my_products.php">My products</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <h2>My Products</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Expiry Date</th>
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
                        // Check if product_exp is set
                        if(isset($product['product_exp'])) {
                            echo "<td>{$product['product_exp']}</td>";
                        } else {
                            echo "<td>N/A</td>";
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>You don't have any products yet.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
