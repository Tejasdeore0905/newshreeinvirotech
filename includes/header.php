<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shree Enviro Tech</title>
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
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
            gap: 25px;
            margin: 0;
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
        }
        
        nav ul li a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #333;
            transition: width 0.3s ease;
        }
        
        nav ul li a:hover {
            color: #333;
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
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="<?php echo (strpos($_SERVER['PHP_SELF'], 'services/') !== false) ? '../assets/logo.png' : 'assets/logo.png'; ?>" alt="Shree Enviro Tech Logo">
        </div>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
                <ul class="nav navbar-nav nav-links">
                    <li><a href="<?php echo (strpos($_SERVER['PHP_SELF'], 'services/') !== false) ? '../index.php' : 'index.php'; ?>">Home</a></li>
                    <li><a href="<?php echo (strpos($_SERVER['PHP_SELF'], 'services/') !== false) ? '../about_us.php' : 'about_us.php'; ?>">About us</a></li>
                    <li><a href="<?php echo (strpos($_SERVER['PHP_SELF'], 'services/') !== false) ? '../services.php' : 'services.php'; ?>">Services</a></li>
                    <li><a href="<?php echo (strpos($_SERVER['PHP_SELF'], 'services/') !== false) ? '../Client.php' : 'Client.php'; ?>">Clients</a></li>
                    <li><a href="<?php echo (strpos($_SERVER['PHP_SELF'], 'services/') !== false) ? '../events.php' : 'events.php'; ?>">Events</a></li>
                    <li><a href="<?php echo (strpos($_SERVER['PHP_SELF'], 'services/') !== false) ? '../contact_us.php' : 'contact_us.php'; ?>">Contact</a></li>
                </ul>
            </div>
        </nav>
    </header>

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
    </script>
</body>
</html>