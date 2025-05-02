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

// Fetch all sales records ordered by ID ASC
$sales_query = "SELECT * FROM sales ORDER BY id ASC";
$sales_result = mysqli_query($conn, $sales_query);

// Fetch total sales amount
$total_sales_query = "SELECT SUM(total_amount) AS total_sales FROM sales";
$total_sales_result = mysqli_query($conn, $total_sales_query);
$total_sales_row = mysqli_fetch_assoc($total_sales_result);
$total_sales = $total_sales_row['total_sales'] ? $total_sales_row['total_sales'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            width: 100%;
            min-height: 100vh;
            background: #f4f7f9;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: auto;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 90%;
            max-width: 800px;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 28px;
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .table-container {
            width: 100%;
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

        .total-sales {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            background: #e3f2fd;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sales Report</h1>
        
        <div class="table-container">

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

        <p class="total-sales">Total Sales: ₹<?php echo number_format($total_sales, 2); ?></p>
    </div>

    <script>
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
