<?php
require_once 'db_config.php';
$current_page = basename($_SERVER['PHP_SELF'], '.php');

// Fetch about data
$result = $conn->query("SELECT * FROM about LIMIT 1");
$about = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - My Portfolio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">My Portfolio</a>
            <ul class="nav-menu">
                <li><a href="index.php" class="nav-link <?php echo ($current_page == 'index') ? 'active' : ''; ?>">Home</a></li>
                <li><a href="about.php" class="nav-link <?php echo ($current_page == 'about') ? 'active' : ''; ?>">About</a></li>
                <li><a href="skills.php" class="nav-link <?php echo ($current_page == 'skills') ? 'active' : ''; ?>">Skills</a></li>
                <li><a href="contact.php" class="nav-link <?php echo ($current_page == 'contact') ? 'active' : ''; ?>">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Home Section -->
    <section id="home">
        <div class="container">
            <div class="home-content">
                  <img src="Enrico.jpg" alt="Profile" >
                <div class="hero-text">
                    <h1>Hi, I'm Enrico</h1>
                    <p class="lead">Full Stack Developer & Web Designer</p>
                    <p class="description">Building beautiful and functional web applications</p>
                    <div class="home-buttons">
                        <a href="about.php" class="btn btn-primary">Learn More</a>
                        <a href="contact.php" class="btn btn-secondary">Get In Touch</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 My Portfolio. All rights reserved.</p>
    </footer>
</body>
</html>