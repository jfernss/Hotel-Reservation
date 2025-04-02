<?php

try {
    $conn = new PDO("mysql:host=localhost;dbname=hotel_reservation", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Delete reservation
if (isset($_POST['delete'])) {
    $id = $_POST['reservation_id'];
    $deleteQuery = "DELETE FROM reservations WHERE id = :id";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

// Fetch reservations
$query = "SELECT * FROM reservations";
$stmt = $conn->query($query);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Reservations</title>
    <link rel="icon" type="image/jpg" href="2.jpg">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #1e396b;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table, th, td {
            border: 1px solid #dcdcdc;
        }
        th {
            background-color: #4c8bc2;
            color: #ffffff;
            text-align: left;
            padding: 10px;
        }
        td {
            padding: 10px;
            color: #333333;
        }
        tr:nth-child(even) {
            background-color: #eaf4fc;
        }
        tr:hover {
            background-color: #cce7f6;
        }
        button {
            background-color: #6cb2e4;
            color: #ffffff;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #4c8bc2;
        }
    </style>
</head>
<body>
    <h1>Reservation Details</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Contact Number</th>
                <th>Room Type</th>
                <th>Room Capacity</th>
                <th>Payment Type</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Num Days</th>
                <th>Sub Total</th>
                <th>Additional Charge</th>
                <th>Discount Amount</th>
                <th>Total Bill</th>
                <th>Reservation Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['contact_number']); ?></td>
                    <td><?php echo htmlspecialchars($row['room_type']); ?></td>
                    <td><?php echo htmlspecialchars($row['room_capacity']); ?></td>
                    <td><?php echo htmlspecialchars($row['payment_type']); ?></td>
                    <td><?php echo htmlspecialchars($row['from_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['to_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['num_days']); ?></td>
                    <td><?php echo htmlspecialchars($row['sub_total']); ?></td>
                    <td><?php echo htmlspecialchars($row['additional_charge']); ?></td>
                    <td><?php echo htmlspecialchars($row['discount_amount']); ?></td>
                    <td><?php echo htmlspecialchars($row['total_bill']); ?></td>
                    <td><?php echo htmlspecialchars($row['reservation_time']); ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="reservation_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                            <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this reservation?');">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn = null;
?>
