<?php 
session_start();
if(isset($_POST['place_order'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $order_cost = $_SESSION['total'];
    $order_status = "on_hold";
    $user_id = $_SESSION['user_id'];
    $order_date = date('Y-m-d H:i:s'); // Fixed the format

    $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_address, order_date)
    VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->bind_param('dsisss', $order_cost, $order_status, $user_id, $phone, $address, $order_date); // Corrected data types

    $stmt->execute();
    $order_id = $stmt->insert_id;
    
    foreach($_SESSION['cart'] as $key => $product) {
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_image = $product['product_image'];
        $product_price = $product['product_price'];
        $product_quantity = $product['product_quantity'];

        $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image, product_price, quant, user_id, order_date)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt1->bind_param('iissiiis', $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);
        $stmt1->execute();
    }
}
?>
