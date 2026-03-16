<?php
require_once 'db_config.php';
$current_page = basename($_SERVER['PHP_SELF'], '.php');

$success_message = '';
$error_message = '';
$messages = array();

// Handle form submission
if(isset($_POST['send'])){
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);
    
    if($conn->query("INSERT INTO contact (name, email, message) VALUES ('$name', '$email', '$message')")){
        $success_message = "✓ Thanks $name! Your message has been sent successfully.";
    } else {
        $error_message = "✗ Error sending message. Please try again.";
    }
}

// Fetch messages
$result = $conn->query("SELECT * FROM contact ORDER BY created_at DESC");
if($result) {
    while($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - My Portfolio</title>
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

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <h2>Get In Touch</h2>
            
            <div class="contact-wrapper">
                <div class="contact-form">
                    <?php if(!empty($success_message)): ?>
                        <div class="alert alert-success">
                            <?php echo $success_message; ?>
                            <button class="alert-close" onclick="this.parentElement.style.display='none';">×</button>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($error_message)): ?>
                        <div class="alert alert-danger">
                            <?php echo $error_message; ?>
                            <button class="alert-close" onclick="this.parentElement.style.display='none';">×</button>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="5" required></textarea>
                        </div>

                        <button type="submit" name="send" class="btn btn-primary">Send Message</button>
                    </form>
                </div>

                <div class="messages-list">
                    <h3>Recent Messages</h3>
                    <?php if(count($messages) > 0): ?>
                        <?php foreach($messages as $msg): ?>
                            <div class="message-box">
                                <p class="msg-from"><strong><?php echo htmlspecialchars($msg['name']); ?></strong></p>
                                <p class="msg-email"><?php echo htmlspecialchars($msg['email']); ?></p>
                                <p class="msg-date"><?php echo date('M d, Y - H:i', strtotime($msg['created_at'])); ?></p>
                                <p class="msg-text"><?php echo htmlspecialchars($msg['message']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="no-messages">No messages yet.</p>
                    <?php endif; ?>
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