<?php
// db_config.php content: database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mini_portfolio";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Determine current page for navbar active link
$current_page = basename($_SERVER['PHP_SELF'], '.php');

// Fetch about data (assumes there is at least one record)
$result = $conn->query("SELECT * FROM about LIMIT 1");
$about = $result ? $result->fetch_assoc() : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>About - My Portfolio</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Bootstrap CSS (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">My Portfolio</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'index') ? 'active' : ''; ?>" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'about') ? 'active' : ''; ?>" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'skills') ? 'active' : ''; ?>" href="skills.php">Skills</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'contact') ? 'active' : ''; ?>" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">About Me</h2>
                 <img src="Enrico.jpg" alt="Profile" >
                <div class="col-md-8">
                    <p><?php echo $about ? nl2br(htmlspecialchars($about['bio'])) : 'I am a passionate full-stack developer with expertise in building modern web applications. I love solving complex problems and creating beautiful user experiences.'; ?></p>
                    <p>I specialize in creating responsive, user-friendly websites and applications. With a strong foundation in modern web technologies, I deliver solutions that exceed expectations.</p>
                    <?php if ($about && $about['github_url']): ?>
                        <a href="<?php echo htmlspecialchars($about['github_url']); ?>" class="btn btn-primary" target="_blank" rel="noopener noreferrer">Visit GitHub</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-3 bg-primary text-white">
        <p>&copy; 2026 My Portfolio. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>