<?php
session_start();

if (!isset($_POST) || empty($_POST)) {
    header("Location: reservation.php");
    exit();
}

// Database connection
try {
    $pdo = new PDO("mysql:host=localhost;dbname=hotel_reservation", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$submissionTime = filter_input(INPUT_POST, 'submissionTime');
$reservationTime = date('h:i A');

$rates = [
    'Single' => [
        'Regular' => 100,
        'De Luxe' => 300,
        'Suite' => 500,
    ],
    'Double' => [
        'Regular' => 200,
        'De Luxe' => 500,
        'Suite' => 800,
    ],
    'Family' => [
        'Regular' => 500,
        'De Luxe' => 750,
        'Suite' => 1000,
    ],
];

$customerName = filter_input(INPUT_POST, 'customerName');
$contactNumber = filter_input(INPUT_POST, 'contactNumber');
$roomType = filter_input(INPUT_POST, 'roomType');
$roomCapacity = filter_input(INPUT_POST, 'roomCapacity');
$paymentType = filter_input(INPUT_POST, 'paymentType');
$fromDate = filter_input(INPUT_POST, 'fromDate');
$toDate = filter_input(INPUT_POST, 'toDate');

if (!$customerName || !$contactNumber || !$roomType || !$roomCapacity || !$paymentType || !$fromDate || !$toDate) {
    echo "Error: Missing required reservation information.";
    exit();
}

try {
    $checkIn = new DateTime($fromDate);
    $checkOut = new DateTime($toDate);
    $numDays = $checkIn->diff($checkOut)->days;
    if ($numDays <= 0) {
        throw new Exception("Invalid date range.");
    }
    // Format dates for database insertion
    $formattedFromDate = $checkIn->format('Y-m-d');
    $formattedToDate = $checkOut->format('Y-m-d');
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

// Base rate
$dailyRate = $rates[$roomCapacity][$roomType] ?? 0;
$subTotal = $dailyRate * $numDays;

// Discount
$discount = ($numDays >= 6) ? 0.15 : 0.10;
$discountAmount = $subTotal * $discount;

// Additional charges
$additionalCharge = 0;
if ($paymentType === 'Cheque') {
    $additionalCharge = $subTotal * 0.05;
} elseif ($paymentType === 'Credit') {
    $additionalCharge = $subTotal * 0.10;
}

// Total bill
$totalBill = $subTotal + $additionalCharge - $discountAmount;

// Insert reservation into the database
try {
    $stmt = $pdo->prepare("INSERT INTO reservations (customer_name, contact_number, room_type, room_capacity, payment_type, from_date, to_date, num_days, sub_total, additional_charge, discount_amount, total_bill, reservation_time) VALUES (:customerName, :contactNumber, :roomType, :roomCapacity, :paymentType, :fromDate, :toDate, :numDays, :subTotal, :additionalCharge, :discountAmount, :totalBill, :reservationTime)");
    $stmt->execute([
        ':customerName' => $customerName,
        ':contactNumber' => $contactNumber,
        ':roomType' => $roomType,
        ':roomCapacity' => $roomCapacity,
        ':paymentType' => $paymentType,
        ':fromDate' => $formattedFromDate, // Use formatted date
        ':toDate' => $formattedToDate,     // Use formatted date
        ':numDays' => $numDays,
        ':subTotal' => $subTotal,
        ':additionalCharge' => $additionalCharge,
        ':discountAmount' => $discountAmount,
        ':totalBill' => $totalBill,
        ':reservationTime' => $reservationTime,
    ]);
} catch (PDOException $e) {
    echo "Error saving reservation: " . $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      
        .navbar {
            height: 10vh;
            background-color: #0D1426;
        }
        .navbar .nav-link {
            font-size: 1.5rem;
            color: #fafafa;
        }
        .navbar-brand {
            font-size: 2rem;
            font-weight: bolder;
            color: #334D99 !important;
        }
        .discount-banner {
            background-color: #334D99;
            color: #fff;
            text-align: center;
            padding: 0.5rem;
            font-size: 1.1rem;
            font-weight: bold;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .billing-statement {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }
        .billing-statement th, .billing-statement td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .billing-statement th {
            background-color: #f8f9fa;
            text-align: left;
        }
        .total {
            font-weight: bold;
            background-color: #f8f9fa;
        }
        .btn-home {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #1A2D4A;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="home.php">D & A</a>
            <button class="navbar-toggler" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="reservation.php">Reservation</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="discount-banner">
        Enjoy our 10% discount for 3-5 days of reservation or Enjoy our 15% discount for 6 days or above of reservation
    </div>
    <div class="container">
        <h1>Billing Statement</h1>
        <p><strong>Time:</strong> <?= htmlspecialchars($reservationTime) ?></p>
        <table class="billing-statement">
            <tr>
                <th>Customer Name:</th>
                <td><?= htmlspecialchars($customerName) ?></td>
            </tr>
            <tr>
                <th>Contact Number:</th>
                <td><?= htmlspecialchars($contactNumber) ?></td>
            </tr>
            <tr>
                <th>Date of Reservation:</th>
                <td>From: <?= htmlspecialchars($checkIn->format('F d, Y')) ?> To: <?= htmlspecialchars($checkOut->format('F d, Y')) ?></td>
            </tr>
            <tr>
                <th>Room Type:</th>
                <td><?= htmlspecialchars($roomType) ?></td>
            </tr>
            <tr>
                <th>Room Capacity:</th>
                <td><?= htmlspecialchars($roomCapacity) ?></td>
            </tr>
            <tr>
                <th>Payment Type:</th>
                <td><?= htmlspecialchars($paymentType) ?></td>
            </tr>
            <tr>
                <th>No. of Days:</th>
                <td><?= htmlspecialchars($numDays) ?></td>
            </tr>
            <tr>
                <th>Sub-Total:</th>
                <td>₱<?= htmlspecialchars(number_format($subTotal, 2)) ?></td>
            </tr>
            <tr>
                <th>Payment Type Charge:</th>
                <td>₱<?= htmlspecialchars(number_format($additionalCharge, 2)) ?></td>
            </tr>
            <tr>
                <th>Discount:</th>
                <td>-₱<?= htmlspecialchars(number_format($discountAmount, 2)) ?></td>
            </tr>
            <tr class="total">
                <th>Total Bill:</th>
                <td>₱<?= htmlspecialchars(number_format($totalBill, 2)) ?></td>
            </tr>
        </table>
        <a href="home.php" class="btn-home">Home</a>
    </div>
</body>
</html>
