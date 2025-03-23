<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Shree Enviro Tech</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Import Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap');

        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f0f4f8 0%, #e6eef7 100%);
        }

        .content-section {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .content-section h2 {
            color: #1a4b8c;
            font-family: 'Poppins', sans-serif;
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        .content-section p {
            color: #444;
            line-height: 1.8;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .main-content {
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        /* Animation keyframes */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes lineWidth {
            from { width: 0; }
            to { width: 80px; }
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        /* Header Styles */
        .flex-header {
            text-align: center;
            padding: 40px 0;
            background: linear-gradient(to right, #1a4b8c, #2c3e50);
            color: #ffffff;
            position: relative;
            margin-bottom: 0;
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
            margin-bottom: 10px;
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
            font-size: 1.1rem;
            font-weight: 400;
            font-family: 'Inter', sans-serif;
            max-width: 700px;
            margin: 10px auto 0;
            line-height: 1.6;
            opacity: 0;
            animation: fadeInUp 1s ease-out forwards;
            animation-delay: 0.5s;
            letter-spacing: 0.3px;
        }

        /* About Overview Section */
        .about-overview {
            padding: 40px 0;
            position: relative;
            min-height: 100vh;
            background: linear-gradient(135deg, #f0f4f8 0%, #e6eef7 100%);
        }

        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            gap: 40px;
            align-items: flex-start;
            background: rgba(255, 255, 255, 0.95);
            padding: 60px;
            border-radius: 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .text-content {
            flex: 1;
            padding-right: 30px;
        }

        .about-text {
            margin-bottom: 0;
            background: transparent;
            padding: 0;
            border-radius: 0;
            box-shadow: none;
        }

        .about-text p {
            font-size: 1.1rem;
            line-height: 1.7;
            color: #2c3e50;
            margin-bottom: 30px;
            padding-left: 20px;
            border-left: 4px solid #1a4b8c;
            opacity: 0;
            transform: translateX(-20px);
            animation: fadeInLeft 0.8s ease forwards;
            text-align: justify;
            letter-spacing: 0.3px;
        }

        .about-text ul {
            padding-left: 0;
            margin: 35px 0;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .about-text ul li {
            margin-bottom: 0;
            font-size: 0.95rem;
            padding: 15px;
            background: rgba(248, 249, 250, 0.9);
            border-radius: 8px;
            transition: all 0.3s ease;
            border-left: 3px solid #1a4b8c;
        }

        .about-text ul li:hover {
            transform: translateX(5px);
            background: rgba(26, 75, 140, 0.1);
        }

        .video-container {
            flex: 1;
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(0);
            transition: transform 0.3s ease;
            max-width: 500px;
        }

        .video-container video {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 15px;
            transition: transform 0.3s ease;
        }

        .features-section {
            display: flex;
            justify-content: space-between;
            gap: 30px;
            margin-top: 60px;
            max-width: 1200px;
            margin: 60px auto 0;
            padding: 60px 20px;
            background: #fff;
        }

        .feature-card {
            flex: 1;
            background: transparent;
            padding: 40px;
            border-radius: 0;
            text-align: center;
            box-shadow: none;
            transition: all 0.3s ease;
            border-top: none;
            border-right: 1px solid rgba(0, 0, 0, 0.1);
        }

        .feature-card:last-child {
            border-right: none;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            background: transparent;
        }

        .feature-card i {
            font-size: 2.4rem;
            color: #1a4b8c;
            margin-bottom: 25px;
            transition: all 0.3s ease;
        }

        .feature-card:hover i {
            transform: scale(1.2);
            color: #2c3e50;
        }

        .feature-card h3 {
            font-size: 1.3rem;
            margin-bottom: 20px;
            color: #2c3e50;
            font-weight: 600;
        }

        .feature-card p {
            font-size: 1rem;
            line-height: 1.6;
            color: #555;
        }

        .floating-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            padding: 15px 40px;
            background: linear-gradient(135deg, #1a4b8c, #2c3e50);
            color: #ffffff;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(26, 75, 140, 0.2);
            font-family: 'Poppins', sans-serif;
            letter-spacing: 0.5px;
            z-index: 1000;
            animation: float 3s ease-in-out infinite;
        }

        .floating-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 6px 20px rgba(26, 75, 140, 0.3);
            background: linear-gradient(135deg, #2c3e50, #1a4b8c);
        }

        @media (max-width: 1024px) {
            .content-wrapper {
                padding: 40px;
                gap: 30px;
            }

            .features-section {
                flex-wrap: wrap;
            }

            .feature-card {
                flex: 0 0 calc(50% - 15px);
                border-right: none;
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
                padding: 30px;
            }
        }

        @media (max-width: 768px) {
            .flex-header h1 {
                font-size: 2.2rem;
            }

            .flex-header p {
                font-size: 1rem;
                padding: 0 20px;
            }

            .content-wrapper {
                flex-direction: column;
                padding: 30px 20px;
            }

            .text-content {
                padding-right: 0;
            }

            .about-text p {
                font-size: 1rem;
                padding-left: 15px;
            }

            .about-text ul {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .video-container {
                max-width: 100%;
            }

            .feature-card {
                flex: 0 0 100%;
                padding: 25px;
            }

            .floating-btn {
                padding: 12px 30px;
                font-size: 1rem;
                right: 20px;
                bottom: 20px;
            }
        }

        @media (max-width: 480px) {
            .flex-header {
                padding: 30px 15px;
            }

            .flex-header h1 {
                font-size: 1.8rem;
            }

            .flex-header p {
                font-size: 0.9rem;
            }

            .content-wrapper {
                padding: 20px 15px;
            }

            .about-text p {
                font-size: 0.9rem;
                padding-left: 10px;
                margin-bottom: 20px;
            }

            .feature-card {
                padding: 20px;
            }

            .feature-card i {
                font-size: 2rem;
                margin-bottom: 15px;
            }

            .feature-card h3 {
                font-size: 1.1rem;
                margin-bottom: 15px;
            }

            .feature-card p {
                font-size: 0.9rem;
            }

            .floating-btn {
                padding: 10px 25px;
                font-size: 0.9rem;
                right: 15px;
                bottom: 15px;
            }
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="main-content">
        <div class="flex-header">
            <h1>ABOUT US</h1>
            <p>Leading the way in environmental engineering solutions with innovation and expertise.</p>
        </div>

        <!-- About Us Section -->
        <section class="about-overview">
            <div class="content-wrapper">
                <div class="text-content">
                    <div class="about-text">
                        <p class="fade-in">SHREE ENVIRO TECH is a leading provider of environmental engineering solutions, specializing in water and wastewater treatment systems. With years of expertise, we deliver innovative and sustainable solutions to industries and municipalities across the country.</p>
                        <p class="fade-in">Our comprehensive range of services includes:</p>
                        
                        <p class="fade-in">Our team of highly qualified professionals combines technical expertise with sustainable practices to deliver efficient and environmentally friendly solutions. We pride ourselves on our commitment to innovation and customer satisfaction.</p>
                    </div>
                </div>
                <div class="video-container">
                    <video controls class="fade-in">
                        <source src="assets/video.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            <div class="features-section">
                <div class="feature-card">
                    <i class="fa fa-check-circle"></i>
                    <h3>Expert Team</h3>
                    <p>Our team of experienced professionals ensures the highest quality solutions.</p>
                </div>
                <div class="feature-card">
                    <i class="fa fa-clock-o"></i>
                    <h3>24/7 Support</h3>
                    <p>Round-the-clock technical support for all your environmental needs.</p>
                </div>
                <div class="feature-card">
                    <i class="fa fa-line-chart"></i>
                    <h3>Innovation</h3>
                    <p>Continuous research and development for better solutions.</p>
                </div>
            </div>
            <a href="contact_us.php" class="floating-btn">Enquiry Now</a>
        </section>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>


