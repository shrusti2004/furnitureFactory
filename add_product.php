<?php
// Database connection
$servername = "localhost";
$username = "root";      // Database username
$password = "";          // Database password
$dbname = "fms";  // Database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['product_image']) && isset($_POST['product_name']) && isset($_POST['product_price'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $image = $_FILES['product_image'];

    // Upload the image
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image["name"]);
    if (move_uploaded_file($image["tmp_name"], $target_file)) {
        // Insert product into the database
        $sql = "INSERT INTO products (name, price, image_path) VALUES ('$product_name', '$product_price', '$target_file')";
        if ($conn->query($sql) === TRUE) {
            echo "New product added successfully.";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>

<h2>Add New Product</h2>
<form method="POST" enctype="multipart/form-data">
    <label for="product_name">Product Name:</label>
    <input type="text" name="product_name" id="product_name" required><br><br>

    <label for="product_price">Product Price:</label>
    <input type="text" name="product_price" id="product_price" required><br><br>

    <label for="product_image">Product Image:</label>
    <input type="file" name="product_image" id="product_image" required><br><br>

    <input type="submit" value="Add Product">
</form>

</body>
</html>
