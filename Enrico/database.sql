-- Create database
CREATE DATABASE IF NOT EXISTS mini_portfolio;
USE mini_portfolio;

-- Create about table
CREATE TABLE IF NOT EXISTS about (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    bio LONGTEXT NOT NULL,
    profile_image VARCHAR(255),
    github_url VARCHAR(255)
);

-- Create skills table
CREATE TABLE IF NOT EXISTS skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    skill_name VARCHAR(255) NOT NULL,
    proficiency_level INT NOT NULL,
    category VARCHAR(100) NOT NULL,
    icon VARCHAR(100)
);

-- Create contact table
CREATE TABLE IF NOT EXISTS contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message LONGTEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample about data with new name
INSERT INTO about VALUES (NULL, 'Enrico - Full Stack Developer', 'I am a passionate full-stack developer with expertise in building modern web applications. I love solving complex problems and creating beautiful user experiences.', 'profile.jpg', 'https://github.com');

-- Insert sample skills data
INSERT INTO skills VALUES (NULL, 'HTML', 95, 'Frontend', '🏗️');
INSERT INTO skills VALUES (NULL, 'CSS', 90, 'Frontend', '🎨');
INSERT INTO skills VALUES (NULL, 'JavaScript', 85, 'Frontend', '⚡');
INSERT INTO skills VALUES (NULL, 'PHP', 80, 'Backend', '🐘');
INSERT INTO skills VALUES (NULL, 'MySQL', 85, 'Database', '🗄️');
INSERT INTO skills VALUES (NULL, 'Git', 87, 'Tools', '🔧');