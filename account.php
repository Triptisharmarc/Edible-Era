<?php 

session_start();

include('server/connection.php');

if(isset($_SESSION['logged_in'])){
}
    if (isset($_POST['change_password'])){
  }
   
  if(isset($_SESSION['logged_in'])){
            $user_id=$_SESSION['user_id'];
             $stmt = $conn->prepare("SELECT * FROM orders where user_id=?");
             $stmt->bind_param('i',$user_id);
            $stmt->execute();
            $orders = $stmt->get_result();
}


?>





<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Home</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap @ 5.1.1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
<div class="container">
<img class="logo" src="assets/imgs/logo.jpeg" /> 
<h2 class="brand">Orange</h2> 
<button class="navbar-toggler" type="button" data-bs-toggle="collapse"  data-bs-target="#navbarSupportedContent"></button><span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse nav-buttons" id="navbarSupported Conter">
<ul class="navbar-nav me-auto mb-2 mb-lg-0">
<li class="nav-item">
<a class="nav-link" href="index.html">Home</a>
</li>
<li class="nav-item">
<a class="nav-link" href="shop.html">Shop</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#">Blog</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#">Contact Us</a>
</li>
<li class="nav-item">
    <i class="fas fa-shopping-bag"></i>
    <i class="fas fa-user"></i>
</li>
</ul>
</div>
</div>
</nav>

<!--Account-->
        <section class="my-5 py-5">
        <div class="row container mx-auto">
        <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
        |<h3 class="font-weight-bold">Account info</h3>
        <hr class="mx-auto">
        <div class="account-info">
        <p>Name<span><?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];}?></span></p>
        <p>Email<span><?php if(isset($_SESSION['user_mail'])){echo $_SESSION['user_mail'];}?></span></p>
        <p><a href="#orders" id="orders-btn">Your orders</a></p>
        <p><a href="" id="logout-btn">Logout</a></p>
        </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 ">
        <form id="account-form">
        <h3>Change Password</h3>
        <hr class="mx-auto">
        <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" id="account-password">
        </div> 
        <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" class="form-control" id="account-password-confirm" name="confirm-password">
        </div>
        <div class="form-group">
            <input type="submit" value="Change Password" class="btn" id="change-pass-btn">
        </div>
        </form>
        </div>
        </div>
        </section>


<section id="orders" class="orders container my-5 py-3">
<div class="container mt-2">
<h2 class="font-weight-bold text-center">Your Orders</h2>
<hr class="mx-auto">
</div>
<table class="mt-5 pt-5">
    <tr>
    <th>order id</th>
    <th>order cost</th>
    <th>order status</th>
    <th>order Date</th>
    <th>order details</th>
    </tr>

<?php while($row = $order->fetch_assoc()){?>
        <tr>
        <td>
        <!-- <div class="product-info">
        <img src="assets/imgs/butter0.jpeg"/>
        <div>
        <p class="mt-3">White Shoes</p>
        </div>
        </div> -->
        <?php echo $row['order_id'];?>
        <span><?php echo $row['order_id'];?></span>
        </td>
        <td> 
        <span><?php echo $row['order_cost'];?></span>
        </td> 
        <td> 
        <span><?php echo $row['order_status'];?></span>
        </td> 
        <td> 
        <span><?php echo $row['order_date'];?></span>
        </td> 
        <td> 
            <form>
                <input class="btn" type="submit" value="details"/>
            </form>
        </td> 

        </tr>
        <?php } ?>
</table>
</section>
