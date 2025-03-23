<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shree Enviro Tech - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        /* Added animation keyframes */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        @keyframes borderPulse {
            0% { box-shadow: 0 0 0 0 rgba(110, 183, 110, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(110, 183, 110, 0); }
            100% { box-shadow: 0 0 0 0 rgba(110, 183, 110, 0); }
        }
        
        @keyframes slideInRight {
            from { transform: translateX(100px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes slideInLeft {
            from { transform: translateX(-100px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes buttonPulse {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(255, 152, 0, 0.7); }
            70% { transform: scale(1.05); box-shadow: 0 0 0 15px rgba(255, 152, 0, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(255, 152, 0, 0); }
        }
        
        @keyframes textGlow {
            0% { text-shadow: 0 0 10px rgba(255, 255, 255, 0.5); }
            50% { text-shadow: 0 0 20px rgba(255, 255, 255, 0.8); }
            100% { text-shadow: 0 0 10px rgba(255, 255, 255, 0.5); }
        }
        
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background-color: #ffffff; /* White background */
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
            width: 120px; /* Adjust logo size */
            animation: float 4s ease-in-out infinite;
        }

        nav ul {
            list-style: none;
            display: flex;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: #333;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            position: relative;
            padding-bottom: 5px;
            transition: color 0.3s ease;
        }
        
        /* Animated underline for nav links */
        nav ul li a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #6EB76E;
            transition: width 0.3s ease;
        }
        
        nav ul li a:hover {
            color: #6EB76E;
        }
        
        nav ul li a:hover::after {
            width: 100%;
        }
        .hero {
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.5)), url('assets/tinu.jpg') no-repeat center center/cover;
            height: 900px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #fff;
            padding: 50px 20px;
            position: relative;
            overflow: hidden;
            background-attachment: fixed;
            z-index: 1;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, transparent 20%, rgba(0, 0, 0, 0.4) 100%);
            z-index: 1;
        }

        .hero-content {
            max-width: 800px;
            z-index: 2;
            animation: fadeIn 1s ease-out;
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 48px;
            margin-bottom: 20px;
            font-weight: bold;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            animation: slideInLeft 1s ease-out;
        }

        .hero-subtitle {
            font-size: 28px;
            margin-bottom: 20px;
            color: #6EB76E;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
            animation: slideInRight 1s ease-out 0.3s both;
        }

        .hero-description {
            font-size: 18px;
            margin-bottom: 30px;
            color: #fff;
            line-height: 1.6;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
            animation: fadeIn 1s ease-out 0.6s both;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-bottom: 40px;
            animation: fadeIn 1s ease-out 0.9s both;
        }

        .primary-btn {
            background-color: #6EB76E;
            color: #fff;
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .secondary-btn {
            background-color: transparent;
            color: #fff;
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .primary-btn:hover {
            background-color: #5a965a;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(110, 183, 110, 0.3);
        }

        .secondary-btn:hover {
            background-color: #fff;
            color: #333;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.2);
        }

        .hero-features {
            display: flex;
            gap: 40px;
            margin-top: 40px;
            animation: fadeIn 1s ease-out 1.2s both;
        }

        .feature-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .feature-item i {
            font-size: 32px;
            color: #6EB76E;
            margin-bottom: 10px;
        }

        .feature-item span {
            font-size: 16px;
            color: #fff;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        @media (max-width: 768px) {
            .hero {
                height: 700px;
                background-attachment: scroll;
            }

            .hero-title {
                font-size: 36px;
            }

            .hero-subtitle {
                font-size: 24px;
            }

            .hero-description {
                font-size: 16px;
            }

            .hero-buttons {
                flex-direction: column;
                gap: 15px;
            }

            .hero-features {
                flex-direction: column;
                gap: 20px;
            }
        }

        .about-overview {
            padding: 40px;
            background-color: white;
            margin: 20px auto;
            width: 80%;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .about-overview h1 {
            color: #0b5fc0;
            font-size: 40px;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }

        .content-wrapper {
            display: flex;
            gap: 40px;
            align-items: flex-start;
        }

        .text-content {
            flex: 1;
        }

        .text-content p {
            font-size: 22px;
            color: #444;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .video-container {
            flex: 1;
            min-width: 45%;
        }

        .video-container video {
            width: 100%;
            border-radius: 10px;
            height: auto;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .about-overview {
                width: 90%;
                padding: 20px;
            }

            .content-wrapper {
                flex-direction: column;
            }
            
            .video-container {
                width: 100%;
                margin-top: 20px;
            }

            .about-overview h1 {
                font-size: 58px;
            }

            .text-content p {
                font-size: 16px;
            }
        }

        .btn {
            background-color: #ff9800;
            color: rgb(0, 0, 0);
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .btn:hover {
            background-color: #e68900;
        }

        /* About Us & Services Sections */
        .about-overview, .services-overview {
            padding: 40px;
            background-color: white;
            margin: 20px auto;
            width: 80%;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .about-overview h2, .services-overview h2 {
            color: #59d1bd;
            margin-bottom: 15px;
            color: #59d1bd;
            margin-bottom: 25px;
            font-size: 32px;
            text-align: center;
        }

        .services-overview ul {
            list-style: none;
            text-align: center;
            display: inline-block;
            margin: 0 auto;
            padding: 0;
        }

        .services-overview ul li {
            font-size: 18px;
            margin-bottom: 8px;
        }

        /* Chatbot Section */
        .chatbot {
            background-color: #fff;
            padding: 30px;
            width: 60%;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .chatbot h3 {
            color: #004d40;
            margin-bottom: 10px;
        }
        /* Floating Button */
        #enquiry-btn {
            position: fixed;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            background: #0056b3;
            color: white;
            padding: 15px;
            border: none;
            font-weight: bold;
            writing-mode: vertical-rl;
            text-align: center;
            border-radius: 5px 0 0 5px;
            text-decoration: none;
            transition: all 0.3s ease;
            z-index: 1001;
        }

        #enquiry-btn:hover {
            background: #004494;
            transform: translateY(-50%) translateX(-5px);
            box-shadow: 0 5px 15px rgba(0, 86, 179, 0.3);
        }

        /* Hide popup by default */
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 9999; /* Increased z-index to appear above all elements */
        }

        /* Show popup when targeted */
        .popup:target {
            display: flex;
        }

        /* Popup content */
        .popup-content {
            background: #5a4374;
            color: white;
            padding: 20px;
            width: 40%;
            border-radius: 10px;
            position: relative;
            z-index: 10000; /* Higher z-index than the popup overlay */
        }

        .popup-content h2 {
            text-align: center;
        }

        .popup-content input,
        .popup-content textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: none;
            border-radius: 5px;
        }

        .popup-content button {
            background: #4caf50;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .popup-content button:hover {
            background: #45a049;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        }

        /* Close Button */
        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            text-decoration: none;
            color: white;
        }

        /* Client Section Styles */
        .clients-section {
            text-align: center;
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .clients-section h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 30px;
            position: relative;
            display: inline-block;
        }

        .clients-section h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background-color: #6EB76E;
        }

        .clients {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin-top: 40px;
        }

        .clients img {
            width: 120px;
            height: 120px;
            margin: 10px;
            border-radius: 50%;
            border: 2px solid #ddd;
            transition: all 0.3s ease;
            object-fit: cover;
        }

        .clients img:hover {
            transform: scale(1.1);
            border-color: #6EB76E;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .clients img {
                width: 80px;
                height: 80px;
            }
        }

        .services-overview .btn {
            background-color: #6EB76E;
            color: #fff;
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .services-overview .btn:hover {
            background-color: #5a965a;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(110, 183, 110, 0.3);
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
            from {
                width: 0;
            }
            to {
                width: 80px;
            }
        }

        .flex-header {
            text-align: center;
            padding: 60px 0;
            background: linear-gradient(to right, #1a4b8c, #2c3e50);
            color: #ffffff;
            position: relative;
        }

        .flex-header h1 {
            margin: 0;
            font-size: 3.2rem;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            text-transform: uppercase;
            letter-spacing: 3px;
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
            margin-bottom: 15px;
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
            margin: 0;
            font-size: 1.1rem;
            font-weight: 400;
            font-family: 'Inter', sans-serif;
            max-width: 700px;
            margin: 15px auto 0;
            line-height: 1.6;
            opacity: 0;
            animation: fadeInUp 1s ease-out forwards;
            animation-delay: 0.5s;
            letter-spacing: 0.3px;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Welcome to Shree Enviro Tech</h1>
            <h2 class="hero-subtitle">Your Trusted Partner in Environmental Engineering</h2>
            <p class="hero-description">Leading the way in sustainable water treatment solutions and biomass power plants</p>
            <div class="hero-buttons">
                <a href="contact_us.php" class="btn primary-btn">Get in Touch</a>
                <a href="services.php" class="btn secondary-btn">Explore Services</a>
            </div>
        </div>
        <div class="hero-features">
            <div class="feature-item">
                <i class="fa fa-leaf"></i>
                <span>Eco-Friendly Solutions</span>
            </div>
            <div class="feature-item">
                <i class="fa fa-cogs"></i>
                <span>Advanced Technology</span>
            </div>
            <div class="feature-item">
                <i class="fa fa-handshake-o"></i>
                <span>Expert Support</span>
            </div>
        </div>
    </section>

    <section class="about-overview">
        <h1>What We Do?</h1>
        <div class="content-wrapper">
            <div class="text-content">
                <p>We at SHREE ENVIRO TECH are pleased to introduce our range of products & 
                services in the field of Environment Engineering & Bio-mass Power plant in Co-operative & 
                private sugar, pharmaceutical, Agro based Industries, Dairy, food processing Industries, 
                Distilleries, Industrial and domestic sewage treatment plants. 
                </p>
                <p>
                SHREE ENVIRO TECH is a company having highly qualified and experienced 
                environment engineers and technocrats in the field of environmental, rendering valuable 
                Services and offering specially designed products and turn-key solution for the company 
                environmental needs. 
                </p>
            </div>
            <div class="video-container">
                <video controls>
                    <source src="assets/video.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </section>

    <a href="contact_us.php" id="enquiry-btn">ENQUIRY NOW</a>


    <!-- Services Overview -->
    <section class="services-overview">
        <h2>Our Services</h2>
        <ul>
            <li>✅ Sewage Treatment Plants (STP)</li>
            <li>✅ Effluent Treatment Plants (ETP)</li>
            <li>✅ Reverse Osmosis (RO) Systems</li>
            <li>✅ Demineralization (DM) Plants</li>
            <li>✅ Oil Skimmers & Bio-Culture Solutions</li>
        </ul>
        <div style="text-align: center; margin-top: 20px;">
            <a href="services.php" class="btn">View All Services</a>
        </div>
    </section>

    <!-- Our Valuable Clients Section -->
    <section class="clients-section">
        <h2>Our Valuable Clients</h2>
        <div class="clients">
            <img src="assets/lemon_tree.png" alt="lemon_tree">
            <img src="assets/NSLSugars.jpg" alt="NSLSugars">
            <img src="assets/shreenath.png" alt="shreenath">
            <img src="assets/Nirabhima.jpg" alt="Nirabhima">
            <img src="assets/Ajinkyatara.jpg" alt="Ajinkyatara">
            <img src="assets/Vikasshakti.jpg" alt="Vikasshakti">
            <img src="assets/Precision.jpg" alt="Precision">
            <img src="assets/RenaSugar.jpg" alt="RenaSugar">
            <img src="assets/Autocomp.png" alt="Autocomp">
            <img src="assets/DYP.png" alt="DYP">
            <img src="assets/Dana.jpg" alt="Dana">
            <img src="assets/Sagar.png" alt="Sagar">
            <img src="assets/Dharashiv.jpg" alt="Dharashiv">
            <img src="assets/Sinhgad.jpg" alt="Singgad">
            <img src="assets/Jagruti.jpg" alt="Jagruti">
            <img src="assets/Shivshakti.jpg" alt="Shivshakti">
            <img src="assets/Soubhagya.jpg" alt="Soubhagya">
            <img src="assets/Matoshri.jpg" alt="Matoshri">
            <img src="assets/Baramatiagro.png" alt="Baramatiagro">
            <img src="assets/Jaihind.png" alt="Jaihind">
            <img src="assets/Bhimashankar.jpg" alt="Bhimashankar">
            <img src="assets/Shreedatta.png" alt="Shreedatta">
            <img src="assets/EID.png" alt="EID">
            <img src="assets/Venkateshkrupa.jpg" alt="Venkateshkrupa">
            <img src="assets/Karmayogi.jpg" alt="Karmayogi">
            <img src="assets/Sopanrao.jpg" alt="Sopanrao">
            <img src="assets/Khandoba.png" alt="Khandoba">
            <img src="assets/SantTukaram.png" alt="SantTukaram">
            <img src="assets/21.png" alt="21">
            <img src="assets/SP.jpg" alt="SP">
            <img src="assets/SMDM.jpg" alt="SMDM">
            <img src="assets/Blue.png" alt="Blue">
            <img src="assets/ShreeBasaveshwar.jpg" alt="ShreeBasaveshwar">
            <img src="assets/Ashwini.png" alt="Ashwini">
        </div>
    </section>

    <!-- Chatbot Section -->
    <section class="chatbot">
        <h3>Need Help? Chat with Us!</h3>
        <p>[Chatbot Integration Coming Soon]</p>
    </section>

    <!-- Footer Section -->
    <?php include 'includes/footer.php'; ?>

    <script>
        const hamburger = document.querySelector(".hamburger");
        const navLinks = document.querySelector(".nav-links");

        hamburger.addEventListener("click", () => {
            hamburger.classList.toggle("active");
            navLinks.classList.toggle("active");
        });

        document.querySelectorAll(".nav-links li a").forEach(link => {
            link.addEventListener("click", () => {
                hamburger.classList.remove("active");
                navLinks.classList.remove("active");
            });
        });

        // Add animation class when elements come into view
        document.addEventListener('DOMContentLoaded', function() {
            // Optional: Add intersection observer for scroll animations
            const observerOptions = {
                threshold: 0.1
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);
            
            // Observe footer columns
            document.querySelectorAll('.footer-column').forEach(column => {
                observer.observe(column);
            });
        });
    </script>
</body>
</html>