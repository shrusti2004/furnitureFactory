<?php
// Database connection
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "fms";  // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert Data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = $conn->real_escape_string($_POST['customer_category']);
    $product_name = $conn->real_escape_string($_POST['product_name']);

    $sql = "INSERT INTO customer_categories(customer_category, product_name) VALUES ('$category_name', '$product_name')";

    
    if ($conn->query($sql) === TRUE) {
        $success = true;
    } else {
        $success = false;
        $errorMessage = $conn->error;
    }
  
}

// Fetch Categories
$result = $conn->query("SELECT * FROM customer_categories ORDER BY category_id ASC");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Category Master</title>
      <!-- SweetAlert2 CDN -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    
          /* General Styles */
          body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
            min-height: 100vh;
            overflow-y: auto;
        }

        /* Center Form */
        form {
            text-align: center;
            background: rgba(255, 255, 255, 0.21);
            backdrop-filter: blur(15px);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        /* Form Inputs */
input, textarea {
    width: 100%; /* Full width within the form */
    padding: 12px;
    margin: 8px 0;
    border-radius: 8px;
    border: 1px solid rgba(0, 0, 0, 0.2);
    outline: none;
    font-size: 16px;
    background: #ffffff;
    color: #2c3e50;
    transition: 0.3s ease-in-out;
    box-sizing: border-box; /* Prevents overflow */
}

input:focus, textarea:focus {
    border: 2px solid rgb(18, 56, 82);
    background: rgba(255, 255, 255, 0.95);
    box-shadow: 0px 4px 10px rgba(41, 128, 185, 0.2);
}

        /* Submit Button */
        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            background: linear-gradient(135deg, rgb(28, 58, 78), #1c5980);
            color: white;
            box-shadow: 0px 4px 10px rgba(41, 128, 185, 0.3);
        }

        button:hover {
            background: linear-gradient(135deg, rgb(35, 83, 116), #1c5980);
            box-shadow: 0px 6px 15px rgba(41, 128, 185, 0.4);
        }

        /* Heading */
        h1 {
        font-size: 34px;
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 15px;
    }

        /* Table Styling */
        .table-container {
            max-width: 900px;
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: rgb(39, 75, 114);
            color: white;
        }

        /* Responsive */
        @media (max-width: 600px) {
            form {
                width: 90%;
            }
        }

    </style>
</head>
<body>

    <form action="" method="POST">
        <h2>Customer Category Master</h2>
        
        <label for="customer_category">Customer Category:</label>
        <select id="customer_category" name="customer_category" required>
            <option value="">Select Category</option>
            <option value="Retail Customer">Retail Customer</option>
            <option value="Wholesale Customer">Wholesale Customer</option>
            <option value="Regular Customer">Regular Customer</option>
            <option value="Premium Customer">Premium Customer</option>
            <option value="VIP Customer">VIP Customer</option>
        </select>
        <BR></BR>

        <label for="product_name">Product Name:</label>
        <textarea id="product_name" name="product_name" rows="4"></textarea>
        
        <button type="submit">Save Category</button>



        <script>
        <?php if (isset($success) && $success === true) { ?>
            Swal.fire({
                title: "Success!",
                text: "New category added successfully!",
                icon: "success",
                confirmButtonText: "OK"
            }).then(() => {
                window.location.href = "customer_categories.php";
            });
        <?php } elseif (isset($success) && !$success) { ?>
            Swal.fire({
                title: "Error!",
                text: "<?php echo addslashes($errorMessage); ?>",
                icon: "error",
                confirmButtonText: "OK"
            });

        <?php } ?>
        
    </script>
    </form>

    <?php if ($result && $result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Category</th>
                    <th>Product Name</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['category_id']; ?></td>
                        <td><?php echo $row['customer_category']; ?></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No categories found.</p>
    <?php endif; ?>

</body>
</html>

<?php $conn->close(); ?>