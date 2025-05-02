<?php
// Database connection
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "fms";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
$status = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $total_amount = $_POST['total_amount'];

    // Insert data into the database
    $query = "INSERT INTO purchase (product_name, quantity, price, total_amount) VALUES ('$product_name', '$quantity', '$price' , '$total_amount')";

    if (mysqli_query($conn, $query)) {
        $message = "Purchase added successfully!";
        $status = "success";
    } else {
        $message = "Error: " . mysqli_error($conn);
        $status = "error";
    }

    // Redirect to avoid form resubmission issue
    header("Location: purchase.php?message=" . urlencode($message) . "&status=" . urlencode($status));
    exit();
}

// Reset and order IDs correctly
mysqli_query($conn, "SET @num = 0;");
mysqli_query($conn, "UPDATE purchase SET id = @num := @num + 1 ORDER BY id ASC;");
//mysqli_query($conn, "ALTER TABLE purchase AUTO_INCREMENT = (SELECT MAX(id) + 1 FROM purchase);");

// Fetch records from the purchase table
$query = "SELECT * FROM purchase ORDER BY id ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Entry</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
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

        input[type="submit"] {
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
        }

        input[type="submit"]:hover {
            background: linear-gradient(135deg, rgb(35, 83, 116), #1c5980);
        }

        /* Heading */
        h1 {
            font-size: 34px;
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 15px;
            text-align: center;
            }


        .table-container {
            width: 100%;
            max-width: 800px;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
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
    </style>
</head>
<body>

<div class="container">
    <h1>Purchase Entry</h1>
    <form method="POST" action="purchase.php">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required oninput="calculateTotal()">

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required oninput="calculateTotal()">

        <label for="total_amount">Total Amount:</label>
        <input type="text" id="total_amount" name="total_amount" readonly>

        <input type="submit" name="submit" value="Add Purchase">
    </form>
</div>

<div class="table-container">
    <h2>Purchase Records</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total Amount</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['total_amount']; ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

<script>
    function calculateTotal() {
        var quantity = document.getElementById('quantity').value;
        var price = document.getElementById('price').value;
        var totalAmount = quantity * price;
        document.getElementById('total_amount').value = totalAmount.toFixed(2);
    }

    // Display success/error message using SweetAlert2 after form submission
    document.addEventListener("DOMContentLoaded", function () {
        const urlParams = new URLSearchParams(window.location.search);
        const message = urlParams.get("message");
        const status = urlParams.get("status");

        if (message) {
            Swal.fire({
                title: status === "success" ? "Success" : "Error",
                text: message,
                icon: status,
                confirmButtonColor: status === "success" ? "#28a745" : "#dc3545"
            }).then(() => {
                window.location.href = "purchase.php"; // Clear URL parameters after showing alert
            });
        }
    });
</script>

</body>
</html>
