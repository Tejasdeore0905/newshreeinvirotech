<!-- Footer Section -->
<footer class="footer">
    <div class="footer-container">
        <div class="footer-column">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="<?php echo (strpos($_SERVER['PHP_SELF'], 'services/') !== false) ? '../index.php' : 'index.php'; ?>">Home</a></li>
                <li><a href="<?php echo (strpos($_SERVER['PHP_SELF'], 'services/') !== false) ? '../about_us.php' : 'about_us.php'; ?>">About us</a></li>
                <li><a href="<?php echo (strpos($_SERVER['PHP_SELF'], 'services/') !== false) ? '../services.php' : 'services.php'; ?>">Services</a></li>
                <li><a href="<?php echo (strpos($_SERVER['PHP_SELF'], 'services/') !== false) ? '../gallery.php' : 'gallery.php'; ?>">Gallery</a></li>
                <li><a href="<?php echo (strpos($_SERVER['PHP_SELF'], 'services/') !== false) ? '../Client.php' : 'Client.php'; ?>">Clients</a></li>
                <li><a href="<?php echo (strpos($_SERVER['PHP_SELF'], 'services/') !== false) ? '../events.php' : 'events.php'; ?>">Events</a></li>
                <li><a href="<?php echo (strpos($_SERVER['PHP_SELF'], 'services/') !== false) ? '../contact_us.php' : 'contact_us.php'; ?>">Contact</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h3>Our Services</h3>
            <ul>
                <li><a href="<?php echo (strpos($_SERVER['PHP_SELF'], 'services/') !== false) ? 'stp.php' : 'services/stp.php'; ?>">Sewer Treatment Plant</a></li>
                <li><a href="<?php echo (strpos($_SERVER['PHP_SELF'], 'services/') !== false) ? 'etp.php' : 'services/etp.php'; ?>">Effluent Treatment Plant</a></li>
                <li><a href="<?php echo (strpos($_SERVER['PHP_SELF'], 'services/') !== false) ? 'cpu.php' : 'services/cpu.php'; ?>">Condensate Polishing Unit</a></li>
                <li><a href="<?php echo (strpos($_SERVER['PHP_SELF'], 'services/') !== false) ? 'ro.php' : 'services/ro.php'; ?>">Reverse Osmosis Plant</a></li>
                <li><a href="<?php echo (strpos($_SERVER['PHP_SELF'], 'services/') !== false) ? 'dm.php' : 'services/dm.php'; ?>">Demineralization Plant</a></li>
                <li><a href="<?php echo (strpos($_SERVER['PHP_SELF'], 'services/') !== false) ? 'wtp.php' : 'services/wtp.php'; ?>">Water Treatment Plant</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h3>About Us</h3>
            <p>Shree Enviro Tech is a leading provider of environmental engineering solutions. With years of experience, we deliver high-quality water and wastewater treatment systems to industries and municipalities across the country.</p>
            <div class="social-icons">
                <a href="#"><i class="fa fa-globe"></i></a>
                <a href="#"><i class="fa fa-shopping-cart"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
            </div>
        </div>
        <div class="footer-column">
            <h3>Contact Us</h3>
            <p><i class="fa fa-map-marker"></i> 1 Shreyas apt Dangat, SR. No.79/2, Pandurang Industrial Area, Shivane, Pune, Maharashtra 411023</p>
            <p><i class="fa fa-phone"></i> +91 98765 43210</p>
            <p><i class="fa fa-envelope"></i> info@shreeenvirotech.com</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2025 Shree Enviro Tech. All Rights Reserved.</p>
        <div class="footer-bottom-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="#">Sitemap</a>
        </div>
    </div>
</footer>

<style>
    /* Footer Styles */
    .footer {
        background: linear-gradient(135deg, #1a4b8c 0%, #2c3e50 100%);
        color: #fff;
        padding: 40px 0 0 0;
        margin-top: 40px;
    }
    
    .footer-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .footer-column {
        flex: 1;
        min-width: 250px;
        margin-bottom: 30px;
        padding: 0 15px;
        opacity: 0;
        animation: fadeIn 0.5s ease-out forwards;
        text-align: left;
    }
    
    /* Stagger the animation for each footer column */
    .footer-column:nth-child(1) { animation-delay: 0.1s; }
    .footer-column:nth-child(2) { animation-delay: 0.3s; }
    .footer-column:nth-child(3) { animation-delay: 0.5s; }
    .footer-column:nth-child(4) { animation-delay: 0.7s; }
    
    .footer-column h3 {
        margin-bottom: 20px;
        font-size: 18px;
        position: relative;
        padding-bottom: 10px;
        text-align: left;
    }
    
    .footer-column h3:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 2px;
        background-color: #6EB76E;
        transition: width 0.3s ease;
    }
    
    .footer-column:hover h3:after {
        width: 100%;
    }
    
    .footer-column ul {
        list-style: none;
        padding: 0;
        text-align: left;
    }
    
    .footer-column ul li {
        margin-bottom: 10px;
        transform: translateX(-10px);
        opacity: 0;
        animation: fadeIn 0.5s ease-out forwards;
        animation-delay: calc(0.1s * var(--item-index, 0));
    }
    
    .footer-column ul li:nth-child(1) { --item-index: 1; }
    .footer-column ul li:nth-child(2) { --item-index: 2; }
    .footer-column ul li:nth-child(3) { --item-index: 3; }
    .footer-column ul li:nth-child(4) { --item-index: 4; }
    .footer-column ul li:nth-child(5) { --item-index: 5; }
    .footer-column ul li:nth-child(6) { --item-index: 6; }
    .footer-column ul li:nth-child(7) { --item-index: 7; }
    
    .footer-column ul li a {
        color: #ccc;
        text-decoration: none;
        transition: color 0.3s ease;
        display: block;
        text-align: left;
    }
    
    .footer-column ul li a:hover {
        color: #6EB76E;
    }
    
    .footer-column p {
        color: #ccc;
        line-height: 1.6;
        margin-bottom: 15px;
        text-align: left;
    }
    
    .social-icons {
        margin-top: 20px;
        text-align: left;
    }
    
    .social-icons a {
        display: inline-block;
        width: 36px;
        height: 36px;
        background-color: #444;
        color: #fff;
        border-radius: 50%;
        text-align: center;
        line-height: 36px;
        margin-right: 10px;
        transition: background-color 0.3s ease;
        animation: pulse 2s infinite;
    }
    
    .social-icons a:hover {
        background-color: #ff0000;
        transform: translateY(-3px);
    }
    
    .footer-form {
        display: flex;
        margin-top: 20px;
        text-align: left;
    }
    
    .footer-form input {
        flex: 1;
        padding: 10px;
        border: none;
        border-radius: 4px 0 0 4px;
    }
    
    .footer-form button {
        padding: 10px 15px;
        background-color: #ff0000;
        color: #fff;
        border: none;
        border-radius: 0 4px 4px 0;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    
    .footer-form button:hover {
        background-color: #6EB76E;
    }
    
    .footer-bottom {
        background: linear-gradient(135deg, #162c5c 0%, #1a1a1a 100%);
        padding: 20px;
        text-align: center;
        margin-top: 20px;
        animation: fadeIn 1s ease-out;
    }
    
    .footer-bottom p {
        margin: 0;
        color: #ccc;
    }
    
    .footer-bottom-links {
        margin-top: 10px;
    }
    
    .footer-bottom-links a {
        color: #ccc;
        margin: 0 10px;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .footer-bottom-links a:hover {
        color: #6EB76E;
    }
    
    @media (max-width: 768px) {
        .footer-column {
            flex: 100%;
        }
        
        .footer-form {
            flex-direction: column;
        }
        
        .footer-form input, .footer-form button {
            width: 100%;
            border-radius: 4px;
            margin-bottom: 10px;
        }
    }
</style> 