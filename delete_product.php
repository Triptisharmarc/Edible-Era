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
    // Retrieve product name to delete
    $product_name = $_POST['product_name'];

    try {
        // Delete product from database
        $stmt = $pdo->prepare("DELETE FROM products WHERE product_name = ?");
        $stmt->execute([$product_name]);

        // Check if any row affected
        $rowCount = $stmt->rowCount();
        if ($rowCount > 0) {
            // Product deleted successfully
            echo "<script>alert('Product deleted successfully!');</script>";
        } else {
            // Product not found
            echo "<script>alert('Product not found!');</script>";
        }
    } catch (PDOException $e) {
        // Handle database deletion error
        echo "Error deleting product from database: " . $e->getMessage();
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #ffc107;
        }

        .container {
            width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 70px;
            color: white;
            margin-bottom: 20px;
            
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
            color: #666;
        }

        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="ccontainer">
<h1> Edible Era</h1>
<div class="container">
    
    <h2>Delete Product</h2>
    <form action="" method="post">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required>
        <button type="submit">Delete Product</button>
    </form>
</div>
    </div>
    
</body>
</html>