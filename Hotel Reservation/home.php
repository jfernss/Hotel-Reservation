<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Five Star Hotel</title>
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

        .hero-section::before {
            content: "";
            position: absolute;
            top: 10;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-section {
            background: url('hero-section.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }

        .highlight {
            font-weight: bold;
            color: white;
        }

        .btn-reserve:hover {
            background-color: #345B98 !important;
            color: #fafafa;
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
    <header class="hero-section">
        <div class="container text-center hero-content d-column">
            <h1>WELCOME TO DARREL & AYIEN'S <span class="highlight">FIVE STAR HOTEL</span></h1>
            <p>Where luxury meets tranquility. Your private paradise with stunning pool views and tropical gardens awaits.</p>
            <a href="reservation.php" class="btn btn-reserve btn-lg px-5 py-3 fs-5 fw-semibold text-white" style="background-color: #1A2D4A;">Reserve Now</a>
        </div>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>