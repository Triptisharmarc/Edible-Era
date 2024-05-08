<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        /* CSS from register page */
        body {
            background-color: #ffc107;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            padding-top: 20px;
        }

        .container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
    color: #000; /* Set label text color to black */
}

input[type="text"],
input[type="number"],
textarea,
input[type="date"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #000; /* Set input border color to black */
    border-radius: 5px;
}

button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .nav-links {
            list-style: none;
            display: flex;
        }

        .nav-links li {
            margin-left: 20px;
        }

        .nav-links a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: #fcd357;
        }

        /* CSS for add_product page */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<header class="header">
    <div class="container">
        <div class="logo">
            <h1><b>Welcome to Edible Era</b></h1>
        </div>
        <nav>
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="container">
    <h2>Add Product</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>
        </div>
        <div class="form-group">
            <label for="product_description">Product Description:</label>
            <textarea id="product_description" name="product_description" required></textarea>
        </div>
        <div class="form-group">
            <label for="product_category">Product Category:</label>
            <input type="text" id="product_category" name="product_category" required>
        </div>
        <div class="form-group">
            <label for="product_price">Product Price:</label>
            <input type="number" id="product_price" name="product_price" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="product_image">Product Image:</label>
            <input type="file" id="product_image" name="product_image" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="product_mfg">Manufacturing Date:</label>
            <input type="date" id="product_mfg" name="product_mfg" required>
        </div>
        <div class="form-group">
            <label for="product_exp">Expiry Date:</label>
            <input type="date" id="product_exp" name="product_exp" required>
        </div>
        <button type="submit">Add Product</button>
    </form>
</div>

<?php
// Connect to database (replace dbname, username, password, and host as necessary)
try {
    $pdo = new PDO('mysql:host=localhost;dbname=php_project', 'root', '');

    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle database connection error
    echo "Error connecting to database: " . $e->getMessage();
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_category = $_POST['product_category'];
    $product_price = $_POST['product_price'];
    $product_image = $_FILES['product_image']['name'];
    $product_mfg = $_POST['product_mfg'];
    $product_exp = $_POST['product_exp'];

    // Upload image
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);

    try {
        // Insert into database
        $stmt = $pdo->prepare("INSERT INTO products (product_name, product_description, product_category, product_price, product_image, product_mfg, product_exp) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$product_name, $product_description, $product_category, $product_price, $target_file, $product_mfg, $product_exp]);

        // Display success message
        echo "<script>alert('Product added successfully!');</script>";
    } catch (PDOException $e) {
        // Handle database insertion error
        echo "Error inserting data into database: " . $e->getMessage();
        exit();
    }
}
?>
</body>
</html>
