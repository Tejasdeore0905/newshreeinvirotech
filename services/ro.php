<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reverse Osmosis Plant - Shree Enviro Tech</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        /* Import Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        /* Animation keyframes */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        /* Navbar Styles */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background-color: #ffffff;
            color: #333;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        nav {
            background-color: #ffffff !important;
        }

        .logo img {
            width: 120px;
        }

        nav ul {
            list-style: none;
            display: flex;
            margin: 0;
            gap: 25px;
            padding: 0;
        }

        nav ul li {
            position: relative;
            margin: 0 12.5px;
        }

        nav ul li a {
            color: #333;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            position: relative;
            padding-bottom: 5px;
            transition: color 0.3s ease;
            border-bottom: none;
        }
        
        nav ul li a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: #333;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        nav ul li a:hover {
            color: #333;
            text-decoration: none;
        }
        
        nav ul li a:hover::after {
            width: 100%;
        }

        /* Hamburger Menu Styles */
        .hamburger {
            display: none;
            cursor: pointer;
        }

        .bar {
            display: block;
            width: 25px;
            height: 3px;
            margin: 5px auto;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
            background-color: #333;
        }

        @media (max-width: 768px) {
            .hamburger {
                display: block;
            }

            .hamburger.active .bar:nth-child(2) {
                opacity: 0;
            }

            .hamburger.active .bar:nth-child(1) {
                transform: translateY(8px) rotate(45deg);
            }

            .hamburger.active .bar:nth-child(3) {
                transform: translateY(-8px) rotate(-45deg);
            }


            .nav-links {
                position: fixed;
                left: -100%;
                top: 70px;
                gap: 0;
                flex-direction: column;
                background-color: #ffffff;
                width: 100%;
                text-align: center;
                transition: 0.3s;
                box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
                z-index: 999;
            }

            .nav-links li {
                margin: 16px 0;
            }

            .nav-links.active {
                left: 0;
            }
        }

        /* Header Styles */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes lineWidth {
            from { width: 0; }
            to { width: 80px; }
        }

        .flex-header {
            text-align: center;
            padding: 60px 20px;
            background: linear-gradient(to right, #1a4b8c, #2c3e50);
            color: #ffffff;
            position: relative;
            margin-top: -20px;
        }

        .flex-header h1 {   
            margin: 0 0 15px;
            font-size: clamp(2rem, 5vw, 3.2rem);
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            text-transform: uppercase;
            letter-spacing: 3px;
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
            animation: fadeInDown 1s ease-out;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .flex-header h1::after {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: -5px;
            width: 80px;
            height: 3px;
            background: linear-gradient(to right, #FFD700, #FFA500);
            animation: lineWidth 1.5s ease-out;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .flex-header p {
            font-size: clamp(0.9rem, 2vw, 1.1rem);
            font-weight: 400;
            font-family: 'Inter', sans-serif;
            max-width: 700px;
            margin: 15px auto 0;
            line-height: 1.6;
            opacity: 0;
            animation: fadeInUp 1s ease-out forwards;
            animation-delay: 0.5s;
            letter-spacing: 0.3px;
            padding: 0 15px;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f0f4f8 0%, #e6eef7 100%);
        }
        .service-content {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .service-content img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .service-content h2 {
            color: #1a4b8c;
            font-family: 'Poppins', sans-serif;
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        .service-content p {
            color: #444;
            line-height: 1.8;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }

        .feature-item {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #1a4b8c;
        }

        .feature-item h3 {
            color: #1a4b8c;
            margin-bottom: 10px;
        }

        .feature-item p {
            margin: 0;
            color: #666;
        }

        @media (max-width: 768px) {
            .service-content {
                margin: 20px;
            }
        }
    </style>
</head>
<body>
<header>
        <div class="logo">
            <img src="../assets/logo.png" alt="Shree Enviro Tech Logo">
        </div>
        <nav>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <ul class="nav-links">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../about_us.php">About us</a></li>
                <li><a href="../services.php">Services</a></li>
                <li><a href="../Client.php">Clients</a></li>
                <li><a href="../events.php">Events</a></li>
                <li><a href="../contact_us.php">Contact</a></li>
            </ul>
        </nav>
    </header>
    <div class="flex-header">
        <h1>REVERSE OSMOSIS PLANT UNIT</h1>
        <p>State-of-the-art RO systems for pure water production.</p>
    </div>

    <div class="service-content">
        <img src="../assets/ro.jpg" alt="Reverse Osmosis Plant">
        
        <h2>Overview</h2>
        <p>Reverse Osmosis (RO) is one of the most advanced and efficient water purification technologies available today. Our RO plants are designed to remove dissolved solids, impurities, and contaminants from water, making it suitable for various industrial and commercial applications.</p>
        
        <p>We provide complete turnkey solutions for RO plants, including design, installation, commissioning, and maintenance services. Our systems are customized to meet specific water quality requirements and operational needs.</p>

        <h2>Our Expertise</h2>
        <div class="features">
            <div class="feature-item">
                <h3>Custom Design</h3>
                <p>Tailored solutions based on water quality and capacity requirements.</p>
            </div>
            <div class="feature-item">
                <h3>Advanced Membranes</h3>
                <p>High-quality RO membranes for optimal filtration efficiency.</p>
            </div>
            <div class="feature-item">
                <h3>Automation</h3>
                <p>Smart control systems for automated operation and monitoring.</p>
            </div>
            <div class="feature-item">
                <h3>Energy Efficiency</h3>
                <p>Energy-efficient designs to minimize operational costs.</p>
            </div>
        </div>

        <h2>Benefits</h2>
        <ul>
            <li>High-quality purified water</li>
            <li>Removal of up to 99% of dissolved solids</li>
            <li>Low maintenance requirements</li>
            <li>Automated operation</li>
            <li>Cost-effective solution</li>
            <li>Compact design</li>
        </ul>
    </div>

    <?php include '../includes/footer.php'; ?>

    <!-- Add Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html> 