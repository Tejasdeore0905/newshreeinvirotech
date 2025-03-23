<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completed Projects - Shree Enviro Tech</title>
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
        
        @keyframes borderPulse {
            0% { box-shadow: 0 0 0 0 rgba(110, 183, 110, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(110, 183, 110, 0); }
            100% { box-shadow: 0 0 0 0 rgba(110, 183, 110, 0); }
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

        .header {
            text-align: center;
            padding: clamp(60px, 10vw, 120px) 20px;
            background: linear-gradient(rgba(26, 75, 140, 0.9), rgba(44, 62, 80, 0.9)), url('assets/services-bg.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #ffffff;
            position: relative;
            margin-top: clamp(40px, 5vw, 60px);
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(26, 75, 140, 0.9), rgba(44, 62, 80, 0.9));
            z-index: 1;
        }

        .header h1 {
            margin: 0;
            color: #ffffff;
            font-size: clamp(2rem, 5vw, 4rem);
            position: relative;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 700;
            z-index: 2;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            animation: fadeInDown 1s ease;
            font-family: 'Poppins', sans-serif;
        }

        .header h1::after {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: -15px;
            width: clamp(80px, 15vw, 150px);
            height: 4px;
            background: linear-gradient(90deg, #ff6b6b, #ffd93d);
            border-radius: 2px;
            animation: width 1.5s ease-out;
        }

        .header p {
            font-size: clamp(1rem, 2vw, 1.4rem);
            line-height: 1.8;
            color: #ffffff;
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 1s ease;
            font-family: 'Open Sans', sans-serif;
            font-weight: 400;
            letter-spacing: 0.5px;
            padding: 0 15px;
        }

        .projects-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            padding: 10px;
            background: transparent;
        }

        .project-card {
            background: #ffffff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            margin: 0 10px;
            border: 1px solid #e0e6ed;
        }

        .project-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(26, 75, 140, 0.2);
            border-color: rgba(26, 75, 140, 0.3);
        }

        .project-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .project-card:hover img {
            transform: scale(1.1);
        }

        .project-card-content {
            padding: 25px;
            background: #ffffff;
            position: relative;
            z-index: 1;
        }

        .project-card-content h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #1a4b8c;
            margin-bottom: 15px;
            position: relative;
            padding-bottom: 10px;
            letter-spacing: 0.5px;
            line-height: 1.3;
        }

        .project-card-content h3::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, #1a4b8c, #6EB76E);
            transition: width 0.3s ease;
        }

        .project-card:hover .project-card-content h3::after {
            width: 100px;
        }

        .project-card-content p {
            font-family: 'Open Sans', sans-serif;
            font-size: 1.1rem;
            font-weight: 400;
            line-height: 1.8;
            color: #555;
            margin-bottom: 20px;
            position: relative;
            padding-left: 15px;
            border-left: 3px solid #6EB76E;
            transition: all 0.3s ease;
        }

        .project-card:hover .project-card-content p {
            color: #333;
            border-left-color: #1a4b8c;
            transform: translateX(5px);
        }

        @media (max-width: 768px) {
            .projects-container {
                grid-template-columns: 1fr;
                padding: 10px;
            }

            .project-card-content h3 {
                font-size: 1.3rem;
            }
        }

        .clients-section {
            text-align: center;
            padding: clamp(40px, 8vw, 80px) 20px;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        }

        .clients-section h2 {
            font-size: clamp(1.8rem, 4vw, 2.5rem);
            color: #1a4b8c;
            margin-bottom: clamp(20px, 5vw, 40px);
            position: relative;
            display: inline-block;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .clients-section h2::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: clamp(60px, 12vw, 100px);
            height: 4px;
            background: linear-gradient(90deg, #1a4b8c, #6EB76E);
            border-radius: 2px;
            animation: width 1.5s ease-out;
        }

        .clients {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: clamp(15px, 3vw, 30px);
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .clients img {
            width: clamp(80px, 15vw, 120px);
            height: clamp(80px, 15vw, 120px);
            border-radius: 50%;
            border: 2px solid #e0e6ed;
            transition: all 0.3s ease;
            object-fit: cover;
            padding: 5px;
            background: #ffffff;
        }

        .clients img:hover {
            transform: scale(1.1);
            border-color: #1a4b8c;
            box-shadow: 0 8px 25px rgba(26, 75, 140, 0.15);
        }

        @media (max-width: 1024px) {
            .header {
                padding: 80px 20px;
            }

            .clients {
                grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
                gap: 20px;
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 60px 15px;
                margin-top: 40px;
            }

            .header h1::after {
                bottom: -10px;
                height: 3px;
            }

            .clients-section {
                padding: 40px 15px;
            }

            .clients {
                grid-template-columns: repeat(auto-fit, minmax(90px, 1fr));
                gap: 15px;
                padding: 15px;
            }
        }

        @media (max-width: 480px) {
            .header {
                padding: 40px 12px;
                margin-top: 30px;
            }

            .header h1::after {
                bottom: -8px;
                height: 2px;
            }

            .clients-section {
                padding: 30px 10px;
            }

            .clients {
                grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
                gap: 12px;
                padding: 10px;
            }
        }

        @media (max-width: 360px) {
            .header {
                padding: 30px 10px;
                margin-top: 25px;
            }

            .clients-section {
                padding: 25px 8px;
            }

            .clients {
                grid-template-columns: repeat(auto-fit, minmax(70px, 1fr));
                gap: 10px;
                padding: 8px;
            }
        }

        /* Project Highlights Section */
        .half-width-container {
            display: flex;
            align-items: stretch;
            justify-content: center;
            width: 100%;
            min-height: 500px;
            background-color: white;
            flex-wrap: wrap;
            padding: 20px;
            gap: 30px;
        }

        /* Left side - Text */
        .image-text-left {
            flex: 1;
            min-width: 300px;
            padding: clamp(20px, 4vw, 40px);
            text-align: justify;
            background-color: rgba(255, 255, 255, 0.9);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .image-text-left h2 {
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            font-family: 'Poppins', sans-serif;
            color: #1a4b8c;
            margin-bottom: 20px;
        }

        .image-text-left p {
            font-size: clamp(1rem, 1.5vw, 1.2rem);
            line-height: 1.8;
            color: #555;
            text-align: justify;
        }

        /* Right side - Slideshow */
        .slideshow-container {
            flex: 1;
            min-width: 300px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .slide {
            display: none;
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .slide.active {
            display: block;
            opacity: 1;
        }

        /* Navigation buttons */
        .prev, .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: clamp(8px, 2vw, 15px);
            cursor: pointer;
            font-size: clamp(14px, 2vw, 18px);
            border-radius: 50%;
            width: clamp(35px, 5vw, 45px);
            height: clamp(35px, 5vw, 45px);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 2;
        }

        .prev { left: 10px; }
        .next { right: 10px; }

        .prev:hover, .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
            transform: translateY(-50%) scale(1.1);
        }

        @media (max-width: 1024px) {
            .half-width-container {
                padding: 15px;
                gap: 20px;
            }

            .image-text-left, .slideshow-container {
                min-width: 280px;
            }
        }

        @media (max-width: 768px) {
            .half-width-container {
                flex-direction: column;
                min-height: auto;
                padding: 10px;
                gap: 15px;
            }

            .image-text-left {
                width: 100%;
                padding: 20px;
            }

            .slideshow-container {
                width: 100%;
                height: 400px;
            }
        }

        @media (max-width: 480px) {
            .half-width-container {
                padding: 8px;
                gap: 12px;
            }

            .image-text-left {
                padding: 15px;
            }

            .slideshow-container {
                height: 300px;
            }

            .prev, .next {
                padding: 6px;
                width: 30px;
                height: 30px;
            }
        }

        @media (max-width: 360px) {
            .half-width-container {
                padding: 5px;
                gap: 10px;
            }

            .image-text-left {
                padding: 12px;
            }

            .slideshow-container {
                height: 250px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="assets/logo.png" alt="Shree Enviro Tech Logo">
        </div>
        <nav>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="about_us.php">About us</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="Client.php">Clients</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="contact_us.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <div class="main-content">
        <?php include 'flex.php'; ?>

<!-- Completed Projects Section -->
<div class="projects-container">
    <!-- Project 1 -->
    <div class="project-card">
        <img src="assets/CPU.jpg" alt="CPU">
        <div class="project-card-content">
            <h3>CPU COMPLETED PROJECTS</h3>
            <p>1.NSL SUGAR LTD. U-3 Jaimahesh,Pawarwadi,Tal. Majalgaon, Beed.<br>
               2.Shrinath Mhaskoba Sakhar Karkhana.Atpost:Patethan, Tal.: Daund, Dist.: Pune<br>
               3.Shri Sant Tukaram SSK LTD. Atpost: Kasarsaie, Pune.<br>
               4.AJINKYATARA SSK LTD. Distillery CPU,SATARA<br>
               5. Khandoba Prassan Distillery,Satara<br>
               6. Ashti sugars Ltd. Ashti,Tal.: Mohol,Dist.: Solapur.</p>
        </div>
    </div>

    <!-- Project 2 -->
    <div class="project-card">
        <img src="assets/STP.jpg" alt="STP">
        <div class="project-card-content">
            <h3>STP COMPLETED PROJECTS</h3>
            <p>1.Sinhgad Institute of Technology.AtPost: Ambegaon, Tal.: Haveli, Dist.:Pune.<br>
               2.D Y PATIL Collage Akurdi,Pune.<br>
               3.Hotel Lemon Tree Hinjawadi, Pune<br>
               4. Dana India Pvt. Ltd Hinjawadi, Pune<br>
               5.Hotel Sagarplaza Pune-1<br>
               6.Precision Automation & Robotics India Ltd.Dhangarwadi, Shirwal
               7. Autocomp Corporation Mahalunge,Tal.:Khed,Dist.: Pune 
               8.Ashwani Construction Greenvalley Project,Wakad,Pune</p>
        </div>
    </div>
    <div class="project-card">
        <img src="assets/WTP.jpg" alt="WTP">
        <div class="project-card-content">
            <h3>WTP COMPLETED PROJECTS</h3>
            <p>1. SMDM Agro Products Pvt.Ltd.Atpost:Moha,Tal.:Kalamb,Dist.: Dharashiv </p>
        </div>
    </div>

    <!-- Project 3 -->
    <div class="project-card">
        <img src="assets/ETP.png" alt="ETP">
        <div class="project-card-content">
            <h3>ETP COMPLETED PROJECTS</h3>
            <p>1.SP SUGARS PVT. LTD.Atpost: Tadawala,Dharashiv<br>
               2.SMDM Agro Products Pvt. Ltd.Atpost:Moha,Tal.:Kalamb,Dist.:Dharashiv<br>
               3.Blue Sappire Food Processing LTD.Tirthpuri,Tal.:Ghansawangi,Dist.:Jalana.<br>
               4.Shri Basweshwar Sugar Pvt. Ltd,Athani, Karnataka.<br>
               5.Pawar-Lohiya Jaggery Pvt. Ltd.Shirsala,Dist.: Beed.
               6.Baramati Agro Ltd. Unit-II Kannad SSK Ltd. Tal.Kannad,Dist:Aurangabad
               7.Shree Doodhganga SSSK LTD.Tal.: Chikodi,Dist.:Belgavi.Karnataka state.
               8.Vikas SSK Ltd.-Uint-II Atp.:Tondar,Tal.:Udgir,Dist.:Latur. 
              </p>
        </div>
    </div> 
</div>
<div class="half-width-container">
    <!-- Left Side - Text Content -->
    <div class="image-text-left">
        <h2>Project Highlights</h2>
        <p>
        "Every project we undertake tells a story of innovation, dedication, and excellence. 
        Our Success Stories in Pictures showcase the transformative impact of our work—from cutting-edge 
        water treatment plants ensuring clean water access to waste management solutions that promote environmental
         sustainability. These visuals capture the essence of our commitment to quality, efficiency, and eco-friendly
          practices. Each completed project stands as a milestone, reflecting our mission to build a greener, cleaner, 
          and more sustainable future. Explore our journey through these images and witness the difference we create!"
        </p>
    </div>

    <!-- Right Side - Slideshow -->
    <div class="slideshow-container">
        <img src="projects/img1.jpg" class="slide active">
        <img src="projects/img2.jpg" class="slide">
        <img src="projects/img3.jpg" class="slide">
        <img src="projects/img4.jpg" class="slide">
        <img src="projects/img5.jpg" class="slide">
        <img src="projects/img6.jpg" class="slide">
        <img src="projects/img7.jpg" class="slide">
        <img src="projects/img8.jpg" class="slide">
        <img src="projects/img9.jpg" class="slide">
        <img src="projects/img10.jpg" class="slide">
        <img src="projects/img11.jpg" class="slide">
        <img src="projects/img12.jpg" class="slide">
        <img src="projects/img13.jpg" class="slide">
        <img src="projects/img14.jpg" class="slide">
        <img src="projects/img15.jpg" class="slide">
        <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
        <button class="next" onclick="changeSlide(1)">&#10095;</button>
    </div>
</div>

<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll(".slide");

    function changeSlide(direction) {
        slides[currentSlide].classList.remove("active");
        currentSlide = (currentSlide + direction + slides.length) % slides.length;
        slides[currentSlide].classList.add("active");
    }

    // Auto Slide Change
    setInterval(() => changeSlide(1), 3000);
</script>

          

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
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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

