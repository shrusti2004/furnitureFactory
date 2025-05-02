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
    $supplier_name = $_POST['supplier_name'];
    $product_name = $_POST['product_name'];
    $total_amount = $_POST['total_amount'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];

    // Insert query
    $sql = "INSERT INTO supplier_details (supplier_name, product_name, total_amount, contact_number, address)
            VALUES ('$supplier_name', '$product_name', '$total_amount', '$contact_number', '$address')";


     if ($conn->query($sql) === TRUE) {
        $success = true;
    } else {
        $success = false;
        $errorMessage = $conn->error;
    }
    
}

// Fetch all supplier details
$sql = "SELECT * FROM supplier_details ORDER BY id ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Entry</title>
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

    <h1>Supplier Entry</h1>
    <form action="supplier_entry.php" method="POST">
        <label for="supplier_name">Supplier Name:</label>
        <input type="text" name="supplier_name" id="supplier_name" required><br><br>

        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" id="product_name" required><br><br>

        <label for="total_amount">Total Amount:</label>
        <input type="text" name="total_amount" id="total_amount" required><br><br>

        <label for="contact_number">Contact Number:</label>
        <input type="text" name="contact_number" id="contact_number"><br><br>

        <label for="address">Address:</label>
        <textarea name="address" id="address" rows="4" cols="50"></textarea><br><br>

        <button type="submit" name="submit">Add Supplier</button>

        

        <script>
        <?php if (isset($success) && $success === true) { ?>
            Swal.fire({
                title: "Success!",
                text: "Supplier added successfully!",
                icon: "success",
                confirmButtonText: "OK"
            }).then(() => {
                window.location.href = "supplier_entry.php";
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

    <h2>Supplier Entry</h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Supplier Name</th>
                    <th>Product Name</th>
                    <th>Total Amount</th>
                    <th>Contact Number</th>
                    <th>Address</th>
                    <th>Created At</th>
                </tr>";

        // Output data for each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['supplier_name'] . "</td>
                    <td>" . $row['product_name'] . "</td>
                    <td>" . $row['total_amount'] . "</td>
                    <td>" . $row['contact_number'] . "</td>
                    <td>" . $row['address'] . "</td>
                    <td>" . $row['created_at'] . "</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No supplier details found.</p>";
    }

    // Close the connection
    $conn->close();
    ?>

</body>
</html>
