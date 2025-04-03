<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Hotel Staff</title>
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
        .content-section{
            background-color: #fafafa;
            border: 2px solid #E0E0E0;
        }
        .content-section h2 {
            margin-bottom: 1rem;
            font-size: 2rem;
            font-weight: bold;
        }
        .content-section p, .content-section ul {
            font-size: 1.3rem;
            line-height: 1.8;
        }
        .content-section ul {
            list-style-type: disc;
            margin-left: 2rem;
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
    <div class="container mt-5">
        <div class="content-section p-4 mb-5 rounded shadow">
            <h2 style="color: #334D99;">Our Mission</h2>
            <p>Our mission is to provide exceptional hospitality services that exceed guest expectations, creating memorable experiences through personalized care, innovation, and a commitment to excellence.</p>
        </div>
        <div class="content-section p-4 mb-5 rounded shadow">
            <h2 style="color: #334D99;">Our Vision</h2>
            <p>Our vision is to be the leading hotel in the industry, recognized for our outstanding service, sustainable practices, and dedication to creating a welcoming environment for all our guests.</p>
        </div>
        <div class="content-section p-4 rounded shadow">
            <h2 style="color: #334D99;">Our Objectives</h2>
            <ul>
                <li>To deliver unparalleled guest satisfaction through exceptional service.</li>
                <li>To foster a culture of innovation and continuous improvement.</li>
                <li>To operate sustainably and responsibly, minimizing our environmental impact.</li>
                <li>To create a positive and inclusive workplace for our team members.</li>
                <li>To build lasting relationships with our guests and the community.</li>
            </ul>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
