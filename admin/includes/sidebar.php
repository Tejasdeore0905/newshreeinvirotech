<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<div class="sidebar">
    <div class="sidebar-header">
        <img src="../assets/logo.png" alt="Shree Enviro Tech Logo" class="admin-logo">
        <h3>Admin Panel</h3>
    </div>
    
    <nav class="sidebar-nav">
        <ul>
            <li class="<?php echo $current_page == 'dashboard.php' ? 'active' : ''; ?>">
                <a href="dashboard.php">
                    <i class="fas fa-home"></i>
                    Dashboard
                </a>
            </li>
            <li class="<?php echo $current_page == 'manage_home.php' ? 'active' : ''; ?>">
                <a href="manage_home.php">
                    <i class="fas fa-house-user"></i>
                    Manage Home
                </a>
            </li>
            <li class="<?php echo $current_page == 'manage_about.php' ? 'active' : ''; ?>">
                <a href="manage_about.php">
                    <i class="fas fa-info-circle"></i>
                    About Us
                </a>
            </li>
            <li class="<?php echo $current_page == 'manage_services.php' ? 'active' : ''; ?>">
                <a href="manage_services.php">
                    <i class="fas fa-cogs"></i>
                    Services
                </a>
            </li>
            <li class="<?php echo $current_page == 'manage_projects.php' ? 'active' : ''; ?>">
                <a href="manage_projects.php">
                    <i class="fas fa-project-diagram"></i>
                    Projects
                </a>
            </li>
            <li class="<?php echo $current_page == 'manage_clients.php' ? 'active' : ''; ?>">
                <a href="manage_clients.php">
                    <i class="fas fa-users"></i>
                    Clients
                </a>
            </li>
            <li class="<?php echo $current_page == 'manage_events.php' ? 'active' : ''; ?>">
                <a href="manage_events.php">
                    <i class="fas fa-calendar"></i>
                    Events
                </a>
            </li>
            <li class="<?php echo $current_page == 'manage_gallery.php' ? 'active' : ''; ?>">
                <a href="manage_gallery.php">
                    <i class="fas fa-images"></i>
                    Gallery
                </a>
            </li>
            <li class="<?php echo $current_page == 'manage_settings.php' ? 'active' : ''; ?>">
                <a href="manage_settings.php">
                    <i class="fas fa-cog"></i>
                    Settings
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </li>
        </ul>
    </nav>
</div>
