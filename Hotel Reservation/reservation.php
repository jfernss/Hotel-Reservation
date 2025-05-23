<?php
session_start();

// Database connection
try {
    $pdo = new PDO("mysql:host=localhost;dbname=hotel_reservation", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Variables
$roomType = $roomCapacity = $paymentType = $selectedDates = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <style>
        .navbar {
            height: 10vh;
            background-color: #001624;
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

        .reservation-form {
            max-width: 100% !important;
            margin: 2rem 2rem !important;
            padding: 2rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            position: relative;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .radio-group {
            display: flex;
            gap: 2rem;
            margin: 1rem 0;
        }

        .btn-submit {
            font-size: 1.3rem;
            background-color: #1A2D4A !important;
            color: #fafafa !important;
            padding: 0.75rem 2rem;
        }

        .btn-clear {
            font-size: 1.3rem;
            padding: 0.75rem 2rem;
        }

        .current-time-display {
            background-color: #f8f9fa;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            border-left: 4px solid #334D99;
            position: absolute;
            top: 0;
            right: 2rem;
            margin-top: 1rem;
            white-space: nowrap;
        }

        .error {
            color: red;
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
                    <li class="nav-item"><a class="nav-link" href="admin_login.php">Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <form class="reservation-form" action="reserve_info.php" method="POST" id="reservationForm">
            <div class="current-time-display">
                <span class="fw-bold">Current Date & Time:</span>
                <span id="currentDateTime" class="fw-bold"></span>
                <input type="hidden" name="submissionTime" id="submissionTime">
            </div>
            <h1 class="mb-4">Make a Reservation</h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="customerName">Customer Name:</label>
                        <input type="text" class="form-control" id="customerName" name="customerName" required>
                    </div>
                    <div class="form-group">
                        <label for="contactNumber">Contact Number:</label>
                        <input type="text" class="form-control" id="contactNumber" name="contactNumber" required>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Room Type:</label>
                        <div class="radio-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="roomType" id="suite" value="Suite">
                                <label class="form-check-label" for="suite">Suite</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="roomType" id="deluxe" value="Deluxe">
                                <label class="form-check-label" for="deluxe">Deluxe</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="roomType" id="regular" value="Regular">
                                <label class="form-check-label" for="regular">Regular</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Room Capacity:</label>
                        <div class="radio-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="roomCapacity" id="family" value="Family">
                                <label class="form-check-label" for="family">Family</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="roomCapacity" id="double" value="Double">
                                <label class="form-check-label" for="double">Double</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="roomCapacity" id="single" value="Single">
                                <label class="form-check-label" for="single">Single</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Payment Type:</label>
                        <div class="radio-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentType" id="cash" value="Cash" <?php echo ($paymentType == 'Cash') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="cash">Cash</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentType" id="cheque" value="Cheque" <?php echo ($paymentType == 'Cheque') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="cheque">Cheque</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentType" id="credit" value="Credit" <?php echo ($paymentType == 'Credit') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="credit">Credit</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fw-bold">From Date:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="fromDate" name="fromDate" placeholder="Select check-in date" required readonly>
                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">To Date:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="toDate" name="toDate" placeholder="Select check-out date" required readonly>
                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group text-center mt-3">
                <button type="submit" class="btn btn-submit mt-4">Submit Reservation</button>
                <button type="button" class="btn btn-secondary btn-clear mt-4" id="clearForm">Clear Entry</button>
            </div>
        </form>
    </div>
    <!-- Add jQuery before Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons for the calendar icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const currentDateTime = new Date().toLocaleString();
            document.getElementById("currentDateTime").textContent = currentDateTime;
            document.getElementById("submissionTime").value = currentDateTime;
        });

        $(document).ready(function() {
            $('#fromDate').datepicker({
                format: "mm/dd/yyyy",
                todayHighlight: true,
                autoclose: true,
                startDate: new Date(),
                orientation: "bottom auto"
            }).on('changeDate', function(e) {
                const minDate = new Date($('#fromDate').val());
                $('#toDate').datepicker('setStartDate', minDate);

                // Clear To Date if it is before From Date
                const toDate = new Date($('#toDate').val());
                if (toDate <= minDate) {
                    $('#toDate').val('');
                }
            });

            $('#toDate').datepicker({
                format: "mm/dd/yyyy",
                todayHighlight: true,
                autoclose: true,
                startDate: new Date(),
                orientation: "bottom auto"
            });

            $('#clearForm').click(function() {
                $('#reservationForm')[0].reset();
                $('#fromDate').datepicker('clearDates');
                $('#toDate').datepicker('clearDates');
                $('#toDate').datepicker('setStartDate', new Date());
            });

            $('#reservationForm').on('submit', function(e) {
                const fromDate = $('#fromDate').val();
                const toDate = $('#toDate').val();
                const roomType = $('input[name="roomType"]:checked').val();
                const roomCapacity = $('input[name="roomCapacity"]:checked').val();
                const paymentType = $('input[name="paymentType"]:checked').val();

                let errorMessage = "";

                if (!roomType) {
                    errorMessage += "Please select a Room Type.\n";
                }

                if (!roomCapacity) {
                    errorMessage += "Please select a Room Capacity.\n";
                }

                if (!paymentType) {
                    errorMessage += "Please select a Payment Type.\n";
                }

                if (!fromDate) {
                    errorMessage += "Please select a From Date.\n";
                }

                if (!toDate) {
                    errorMessage += "Please select a To Date.\n";
                }

                if (fromDate && toDate && new Date(fromDate) >= new Date(toDate)) {
                    errorMessage += "To Date must be after From Date.\n";
                }

                if (errorMessage) {
                    alert(errorMessage);
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>