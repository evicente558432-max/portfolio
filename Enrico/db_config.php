<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mini_portfolio";

// Create connection to MySQL server
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$create_db = $conn->query("CREATE DATABASE IF NOT EXISTS mini_portfolio");

if (!$create_db) {
    die("Error creating database: " . $conn->error);
}

// Now select the database
$select_db = $conn->select_db($dbname);

if (!$select_db) {
    die("Error selecting database: " . $conn->error);
}

// Create tables if they don't exist
$create_about = $conn->query("CREATE TABLE IF NOT EXISTS about (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    bio LONGTEXT NOT NULL,
    profile_image VARCHAR(255),
    github_url VARCHAR(255)
)");

$create_skills = $conn->query("CREATE TABLE IF NOT EXISTS skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    skill_name VARCHAR(255) NOT NULL,
    proficiency_level INT NOT NULL,
    category VARCHAR(100) NOT NULL,
    icon VARCHAR(100)
)");

$create_contact = $conn->query("CREATE TABLE IF NOT EXISTS contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message LONGTEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Check if tables were created
if (!$create_about || !$create_skills || !$create_contact) {
    die("Error creating tables: " . $conn->error);
}

// Insert sample data if tables are empty
$check_about = $conn->query("SELECT COUNT(*) as count FROM about");
if ($check_about) {
    $count_result = $check_about->fetch_assoc();
    if ($count_result['count'] == 0) {
        $conn->query("INSERT INTO about (title, bio, profile_image, github_url) VALUES (
            'Enrico - Full Stack Developer',
            'I am a passionate full-stack developer with expertise in building modern web applications. I love solving complex problems and creating beautiful user experiences.',
            'profile.jpg',
            'https://github.com'
        )");
    }
}

// Insert skills sample data
$check_skills = $conn->query("SELECT COUNT(*) as count FROM skills");
if ($check_skills) {
    $count_result = $check_skills->fetch_assoc();
    if ($count_result['count'] == 0) {
        $conn->query("INSERT INTO skills (skill_name, proficiency_level, category, icon) VALUES ('HTML', 95, 'Frontend', '🏗️')");
        $conn->query("INSERT INTO skills (skill_name, proficiency_level, category, icon) VALUES ('CSS', 90, 'Frontend', '🎨')");
        $conn->query("INSERT INTO skills (skill_name, proficiency_level, category, icon) VALUES ('JavaScript', 85, 'Frontend', '⚡')");
        $conn->query("INSERT INTO skills (skill_name, proficiency_level, category, icon) VALUES ('PHP', 80, 'Backend', '🐘')");
        $conn->query("INSERT INTO skills (skill_name, proficiency_level, category, icon) VALUES ('MySQL', 85, 'Database', '🗄️')");
        $conn->query("INSERT INTO skills (skill_name, proficiency_level, category, icon) VALUES ('Git', 87, 'Tools', '🔧')");
    }
}

// Set charset to utf8
$conn->set_charset("utf8");
?>