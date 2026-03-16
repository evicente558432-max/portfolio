<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "mini_portfolio"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch skills data
$sql = "SELECT * FROM skills";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skills - My Portfolio</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">My Portfolio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link active" href="skills.php">Skills</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="skills" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">My Skills</h2>
            <div class="row">
                <?php
                if ($result && $result->num_rows > 0) {
                    $count = 0;
                    while ($row = $result->fetch_assoc()) {
                        if ($count > 0 && $count % 3 == 0) echo '</div><div class="row mt-4">';
                        $count++;
                        ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow text-center">
                                <div class="card-body">
                                    <h3><?php echo htmlspecialchars($row['icon']); ?></h3>
                                    <h5 class="card-title"><?php echo htmlspecialchars($row['skill_name']); ?></h5>
                                    <p class="card-text"><small class="text-muted"><?php echo htmlspecialchars($row['category']); ?></small></p>
                                    <div class="progress" style="height: 25px;">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: <?php echo (int)$row['proficiency_level']; ?>%"
                                            aria-valuenow="<?php echo (int)$row['proficiency_level']; ?>" aria-valuemin="0"
                                            aria-valuemax="100"><?php echo (int)$row['proficiency_level']; ?>%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<p class="text-center">No skills found.</p>';
                }
                ?>
            </div>
        </div>
    </section>

    <footer class="text-center py-3 bg-primary text-white">
        <p>&copy; 2026 My Portfolio. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close connection
$conn->close();
?>