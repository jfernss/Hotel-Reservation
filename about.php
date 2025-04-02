<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Hotel Staff</title>
    <link rel="icon" type="image/jpg" href="2.jpg">

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
        .team-member {
            margin-bottom: 2rem;
            display: flex;
            align-items: start;
            gap: 2rem;
        }
        .team-member img {
            width: 350px;
            height: 350px;
            object-fit: cover;
            border-radius: 4px;
        }
        .team-member-info h2 {
            margin-bottom: 0.5rem;
            font-size: 2rem;
        }
        .team-member-info span {
            color: #666;
            font-size: 1.5rem;
        }
        .team-member-info p {
            margin-top: 1rem;
            font-size: 1.3rem;
            line-height: 1.8;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <link rel="icon" type="image/jpg" href="2.jpg">
            <a class="navbar-brand" href="home.php">HERON'S HAVEN</a>
            
            <button class="navbar-toggler" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="reservation.php">Reservation</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="admin.php">Profile</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="team-member">
            <img src="josh.jpg" alt="Joshua">
            <div class="team-member-info">
                <h2>Joshua Fernandez <span>- General Manager</span></h2>
                <p>Joshua Fernandez is the General Manager at our hotel, overseeing daily operations with a focus on providing excellent guest experiences. With over 10 years in the hospitality industry, Joshua is dedicated to creating a warm and welcoming environment for every guest. His leadership style emphasizes teamwork, efficiency, and a personalized touch to make each stay memorable. He ensures that every aspect of our hotel meets the highest standards of quality and service.</p>
            </div>
        </div>
        <div class="team-member">
            <img src="rod.jpg" alt="Rod">
            <div class="team-member-info">
                <h2>Rod Anthony Baloro <span>- Front Office Manager</span></h2>
                <p>Rod Anthony Baloro is the Front Office Manager, ensuring that guests receive a seamless and welcoming experience from check-in to check-out. With a strong background in customer service and hotel operations, Rod leads the front desk team with professionalism and efficiency. He prioritizes guest satisfaction, oversees reservations, and manages smooth coordination between departments to enhance the overall stay of every visitor.</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
