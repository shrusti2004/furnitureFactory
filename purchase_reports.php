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

// Fetch records from the purchase table
$query = "SELECT * FROM purchase ORDER BY id ASC";
$result = mysqli_query($conn, $query);

// Calculate total purchase amount
$total_purchase = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $total_purchase += $row['total_amount'];
}

// Reset the result pointer to fetch data again for display
mysqli_data_seek($result, 0); // Rewind the result set
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Report</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            min-height: 500px;
        }

        h1 {
            font-size: 28px;
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 15px;
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

        .total {
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
        }

        .total-amount {
            font-size: 24px;
            color: #2c3e50;
            font-weight: 700;
        }
    </style>
</head>
<body>

<div class="container">
<h1>Purchase Report</h1>
        
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
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
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

    <div class="total">
        <p>Total Purchase Amount:</p>
        <p class="total-amount"><?php echo number_format($total_purchase, 2); ?> </p>
    </div>
</div>

</body>
</html>
