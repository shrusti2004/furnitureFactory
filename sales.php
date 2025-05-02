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

// Get max ID for manual numbering
$id_query = "SELECT MAX(id) AS max_id FROM sales";
$id_result = mysqli_query($conn, $id_query);
$row = mysqli_fetch_assoc($id_result);
$next_id = $row['max_id'] ? $row['max_id'] + 1 : 1; // If no records, start from 1

// Check if form is submitted
if (isset($_POST['submit'])) {
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $total_amount = $_POST['total_amount'];

    // Insert data into the database
    $query = "INSERT INTO sales (id, product_name, quantity, price, total_amount) 
              VALUES ('$next_id', '$product_name', '$quantity', '$price' , '$total_amount')";
   
    if (mysqli_query($conn, $query)) {
        $message = "Sales added successfully!";
        $status = "success";
    } else {
        $message = "Error: " . mysqli_error($conn);
        $status = "error";
    }
}

// Fetch all sales records ordered by ID ASC
$sales_query = "SELECT * FROM sales ORDER BY id ASC";
$sales_result = mysqli_query($conn, $sales_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Entry</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 Library -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

                body {
                width: 100%;
                min-height: 100vh; /* Ensure full height */
                background: #f4f7f9;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                overflow: auto; /* Ensure no content is hidden */
            }

        .container {
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 90%;
            max-width: 400px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            min-height: 500px; /* Increase height */
            overflow: visible; /* Prevent content from being cut */
        }


        h1 {
            font-size: 28px;
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 15px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"], 
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            outline: none;
            font-size: 16px;
            background: #ffffff;
            color: #2c3e50;
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
        <h1>Sales Entry</h1>
        <form method="POST" action="">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required oninput="calculateTotal()">

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required oninput="calculateTotal()">

            <label for="total_amount">Total Amount:</label>
            <input type="text" id="total_amount" name="total_amount" readonly>

            <input type="submit" name="submit" value="Add Sale">
        </form>
    </div>

    <!-- Sales Table -->
    <div class="table-container">
        <h1>Sales Records</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($sales_result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['total_amount']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        function calculateTotal() {
            var quantity = document.getElementById('quantity').value;
            var price = document.getElementById('price').value;
            var totalAmount = quantity * price;
            document.getElementById('total_amount').value = totalAmount.toFixed(2);
        }

        var message = "<?php echo $message; ?>";
        var status = "<?php echo $status; ?>";

        if (message.trim() !== "") {
            Swal.fire({
                title: status === "success" ? "Success" : "Error",
                text: message,
                icon: status,
                confirmButtonColor: status === "success" ? "#28a745" : "#dc3545"
            });
        }
    </script>
</body>
</html>
