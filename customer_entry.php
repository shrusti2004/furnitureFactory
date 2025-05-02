<?php
// Database connection
$servername = "localhost:3307";
$username = "root";  // Default username for XAMPP
$password = "";      // Default password for XAMPP
$dbname = "fms";     // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data into the database if form is submitted
if (isset($_POST['submit'])) {
    // Get form data
    $customer_name = $conn->real_escape_string($_POST['customer_name']);
    $product_name = $conn->real_escape_string($_POST['product_name']);
    $total_amount = $conn->real_escape_string($_POST['total_amount']);
    $contact_number = $conn->real_escape_string($_POST['contact_number']);
    $address = $conn->real_escape_string($_POST['address']);

    // Insert query
    $sql = "INSERT INTO customer_entry (customer_name, product_name, total_amount, contact_number, address)
            VALUES ('$customer_name', '$product_name', '$total_amount', '$contact_number', '$address')";

        if ($conn->query($sql) === TRUE) {
            $success = true;
        } else {
            $success = false;
            $errorMessage = $conn->error;
        }
        }

// Fetch all customer details
$sql = "SELECT * FROM customer_entry";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Entry</title>
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
        font-weight: 800;
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

    <h1>Customer Entry</h1>
    <form action="customer_entry.php" method="POST">
        <label for="customer_name">Customer Name:</label>
        <input type="text" name="customer_name" id="customer_name" required><br><br>

        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" id="product_name" required><br><br>

        <label for="total_amount">Total Amount:</label>
        <input type="text" name="total_amount" id="total_amount" required><br><br>

        <label for="contact_number">Contact Number:</label>
        <input type="text" name="contact_number" id="contact_number"><br><br>

        <label for="address">Address:</label>
        <textarea name="address" id="address" rows="4" cols="50"></textarea><br><br>

        <button type="submit" name="submit">Add Customer</button>

        <script>
        <?php if (isset($success) && $success === true) { ?>
            Swal.fire({
                title: "Success!",
                text: "Customer added successfully!",
                icon: "success",
                confirmButtonText: "OK"
            }).then(() => {
                window.location.href = "customer_entry.php";
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

    <h2>Customer List</h2>

    <?php if ($result && $result->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Product Name</th>
                <th>Total Amount</th>
                <th>Contact Number</th>
                <th>Address</th>
                <th>Created At</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['customer_name']; ?></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php echo $row['total_amount']; ?></td>
                    <td><?php echo $row['contact_number']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No customer details found.</p>
    <?php endif; ?>

    <?php $conn->close(); ?>

</body>
</html>
