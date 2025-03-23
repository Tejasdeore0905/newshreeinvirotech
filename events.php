<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events - Shree Enviro Tech</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Add Swiper's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        /* Header Styles */
        .header {
            text-align: center;
            padding: 80px 0 60px;
            background: #f8f9fa;
            position: relative;
        }

        .header h1 {
            color: #1e88e5;
            font-size: 36px;
            font-weight: 600;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }

        .header h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: #1e88e5;
        }

        .header h2 {
            color: #757575;
            font-size: 18px;
            font-weight: 400;
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.6;
            padding: 0 20px;
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

        @media (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
            }

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
                top: 100px;
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

        @media (max-width: 1024px) {
            .events-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }

            .upcoming-events-list {
                grid-template-columns: repeat(2, 1fr);
            }

            .event-card {
                margin: 10px;
            }
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2.2rem;
            }

            .header h2 {
                font-size: 1.1rem;
                padding: 0 20px;
            }

            .recent-event-container {
                padding: 30px 20px;
            }

            .events-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .upcoming-events-list {
                grid-template-columns: 1fr;
            }

            .upcoming-event-item {
                flex-direction: column;
                text-align: center;
                padding: 20px;
            }

            .event-date-badge {
                margin: 0 auto 15px;
            }

            .event-info h3 {
                font-size: 1.3rem;
            }
        }

        @media (max-width: 480px) {
            .header {
                padding: 30px 15px;
            }

            .header h1 {
                font-size: 1.8rem;
            }

            .header h2 {
                font-size: 1rem;
            }

            .recent-event-container {
                padding: 20px 15px;
            }

            .section-title {
                font-size: 1.5rem;
                margin-bottom: 20px;
            }

            .event-card {
                margin: 5px;
            }

            .event-info h3 {
                font-size: 1.2rem;
            }

            .event-info p {
                font-size: 0.9rem;
            }

            .event-location {
                font-size: 0.85rem;
            }

            .event-date-badge {
                width: 80px;
                height: 80px;
                font-size: 0.9rem;
            }
        }

        .events-section {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .event-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .event-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 40px;
            overflow: hidden;
        }

        .event-header {
            background: #1e88e5;
            color: white;
            padding: 25px;
        }

        .event-title {
            font-size: 2rem;
            margin: 0;
            font-weight: 600;
        }

        .event-date {
            font-size: 1.1rem;
            margin-top: 10px;
            opacity: 0.9;
        }

        .event-content {
            padding: 30px;
        }

        .event-description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #444;
            margin-bottom: 30px;
        }

        .event-images {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .event-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .event-image:hover {
            transform: scale(1.05);
        }

        /* Slideshow Styles */
        .swiper-container {
            width: 100%;
            height: 500px;
            margin: 30px 0;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        .swiper-slide {
            width: 100%;
            height: 100%;
        }

        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #1e88e5;
            background: #ffffff;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            z-index: 999;
            opacity: 1;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 20px;
            font-weight: bold;
            color: #1e88e5;
        }

        .swiper-button-next {
            right: 20px;
        }

        .swiper-button-prev {
            left: 20px;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: #ffffff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }

        .swiper-pagination {
            position: absolute;
            bottom: 20px;
            z-index: 999;
        }

        .swiper-pagination-bullet {
            width: 12px;
            height: 12px;
            background: #ffffff;
            opacity: 0.7;
        }

        .swiper-pagination-bullet-active {
            background: #1e88e5;
            opacity: 1;
        }

        /* Responsive Styles */
        @media (max-width: 1200px) {
            .event-container {
                padding: 0 15px;
            }
        }

        @media (max-width: 992px) {
            .event-title {
                font-size: 1.8rem;
            }
            
            .event-description {
                font-size: 1rem;
            }
            
            .swiper-container {
                height: 400px;
            }
        }

        @media (max-width: 768px) {
            .events-section {
                padding: 60px 0;
            }

            .event-card {
                margin-bottom: 30px;
            }

            .event-header {
                padding: 20px;
            }

            .event-title {
                font-size: 1.5rem;
            }

            .event-date {
                font-size: 1rem;
            }

            .event-content {
                padding: 20px;
            }

            .event-description {
                font-size: 0.95rem;
                line-height: 1.6;
            }

            .event-images {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 15px;
            }

            .event-image {
                height: 200px;
            }

            .swiper-container {
                height: 300px;
                margin: 20px 0;
            }

            .swiper-button-next,
            .swiper-button-prev {
                width: 40px;
                height: 40px;
            }

            .swiper-button-next:after,
            .swiper-button-prev:after {
                font-size: 16px;
            }

            .swiper-button-next {
                right: 10px;
            }

            .swiper-button-prev {
                left: 10px;
            }
        }

        @media (max-width: 576px) {
            .events-section {
                padding: 40px 0;
            }

            .event-container {
                padding: 0 10px;
            }

            .event-card {
                margin-bottom: 20px;
            }

            .event-header {
                padding: 15px;
            }

            .event-title {
                font-size: 1.3rem;
            }

            .event-date {
                font-size: 0.9rem;
            }

            .event-content {
                padding: 15px;
            }

            .event-description {
                font-size: 0.9rem;
                line-height: 1.5;
            }

            .event-images {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .event-image {
                height: 180px;
            }

            .swiper-container {
                height: 250px;
                margin: 15px 0;
            }

            .swiper-button-next,
            .swiper-button-prev {
                width: 35px;
                height: 35px;
            }

            .swiper-button-next:after,
            .swiper-button-prev:after {
                font-size: 14px;
            }

            .swiper-pagination-bullet {
                width: 8px;
                height: 8px;
            }
        }

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

        @media (max-width: 768px) {
            .flex-header {
                padding: 40px 20px;
            }

            .flex-header h1 {
                font-size: 2.2rem;
                letter-spacing: 2px;
            }

            .flex-header p {
                font-size: 1rem;
                padding: 0 20px;
                line-height: 1.5;
            }
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <!-- Header Section -->
    <div class="flex-header">
        <h1>EVENTS & ACHIEVEMENTS</h1>
        <p>Explore our journey of excellence through conferences, awards, and industry recognition in environmental engineering.</p>
    </div>

    <!-- Recent Event Section -->

    <!-- Events Section -->
    <div class="events-section">
        <div class="event-container">
            <!-- Industrial Expo 2020 -->
            <div class="event-card">
                <div class="event-header">
                    <h2 class="event-title">Industrial Expo 2020</h2>
                    <div class="event-date">
                        <i class="fas fa-calendar-alt"></i> 2020
                    </div>
                </div>
                <div class="event-content">
                    <div class="event-description">
                        <p>Industrial Expo 2020 showcased the latest innovations and technologies in the environmental sector.</p>
                    </div>
                    <div class="event-images">
                        <img src="assets/event1.jpg" alt="Industrial Expo Image 1" class="event-image">
                        <img src="assets/event2.jpg" alt="Industrial Expo Image 2" class="event-image">
                        <img src="assets/event3.jpg" alt="Industrial Expo Image 3" class="event-image">
                    </div>
                </div>
            </div>

            <!-- VSI Conference 2024 -->
            <div class="event-card">
                <div class="event-header">
                    <h2 class="event-title">3rd International Conference - Vasantdada Sugar Institute, Pune</h2>
                    <div class="event-date">
                        <i class="fas fa-calendar-alt"></i> 12 JAN 2024 to 14 JAN 2024
                    </div>
                </div>
                <div class="event-content">
                    <div class="event-description">
                        <p>Shree Nitin Gadkari, Hon. Ministor for Road Transport & Highways of India and Shree Sharad Pawar, President Vasantdada Sugar Institute is waving at the inauguration of 3rd International Conference and Exhibition on Sustainability:Challenges & Opportunities in Global Sugar Industry at Vasantdada Sugar Institute (VSI) at Manjari in Pune, Maharashtra on January 12th-14th, 2024.</p>
                    </div>
                    <!-- Slideshow Container -->
                    <div class="swiper-container vsi-slider">
                        <div class="swiper-wrapper">
                            <!-- Add your VSI conference images here -->
                            <div class="swiper-slide">
                                <img src="assets/vsi_conference1.jpg" alt="VSI Conference Image 1">
                            </div>
                            <div class="swiper-slide">
                                <img src="assets/vsi_conference2.jpg" alt="VSI Conference Image 2">
                            </div>
                            <div class="swiper-slide">
                                <img src="assets/vsi_conference3.jpg" alt="VSI Conference Image 3">
                            </div>
                            <div class="swiper-slide">
                                <img src="assets/vsi_conference4.jpg" alt="VSI Conference Image 4">
                            </div>
                            <div class="swiper-slide">
                                <img src="assets/vsi_conference5.jpg" alt="VSI Conference Image 5">
                            </div>
                            <div class="swiper-slide">
                                <img src="assets/vsi_conference6.jpg" alt="VSI Conference Image 6">
                            </div>
                            <div class="swiper-slide">
                                <img src="assets/vsi_conference7.jpg" alt="VSI Conference Image 7">
                            </div>
                            <div class="swiper-slide">
                                <img src="assets/vsi_conference8.jpg" alt="VSI Conference Image 8">
                            </div>
                            <div class="swiper-slide">
                                <img src="assets/vsi_conference9.jpg" alt="VSI Conference Image 9">
                            </div>
                            <div class="swiper-slide">
                                <img src="assets/vsi_conference10.jpg" alt="VSI Conference Image 10">
                            </div>
                            <div class="swiper-slide">
                                <img src="assets/vsi_conference11.jpg" alt="VSI Conference Image 11">
                            </div>
                            <div class="swiper-slide">
                                <img src="assets/vsi_conference12.jpg" alt="VSI Conference Image 12">
                            </div>
                        </div>
                        <!-- Add Navigation -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <?php include 'includes/footer.php'; ?>

    <!-- Add Swiper JS -->
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Swiper
            var swiper = new Swiper('.vsi-slider', {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                speed: 800,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                // Add observer to update swiper when DOM changes
                observer: true,
                observeParents: true,
                // Add keyboard control
                keyboard: {
                    enabled: true,
                },
                // Add mousewheel control
                mousewheel: {
                    enabled: true,
                },
                // Add breakpoints for responsive design
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 1,
                    },
                    1024: {
                        slidesPerView: 1,
                    },
                },
                // Add onInit callback to check if swiper is initialized
                on: {
                    init: function () {
                        console.log('Swiper initialized');
                    }
                }
            });
        });
    </script>
</body>
</html> 