<?php
// Fetch database credentials from environment variables
$servername = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$dbname = getenv('DB_NAME');

// Create connection to MySQL
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create a new database
$createDatabaseQuery = "CREATE DATABASE IF NOT EXISTS `$dbname`";

if (!$conn->query($createDatabaseQuery)) {
    die("Error creating database: " . $conn->error);
}

// Select the newly created or existing database
$conn->select_db($dbname);

// Create a new table in the database if it doesn't already exist
$createTableQuery = "CREATE TABLE IF NOT EXISTS scores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(255) NOT NULL,
    score INT NOT NULL,
    subject VARCHAR(255) NOT NULL
)";

if (!$conn->query($createTableQuery)) {
    die("Error creating table: " . $conn->error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and validate the student name, score, and subject from the form
    $student_name = trim($_POST["student_name"]);
    $score = trim($_POST["score"]);
    $subject = trim($_POST["subject"]);

    if (empty($student_name) || empty($score) || empty($subject)) {
        echo "Please fill in all fields.";
    } else {
        // Prepare and execute an SQL insert statement
        $sql = "INSERT INTO scores (student_name, score, subject) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Error preparing the statement: " . $conn->error);
        }

        $stmt->bind_param("sis", $student_name, $score, $subject);

        if ($stmt->execute()) {
            // Data was inserted successfully, reload the page with a success message
            header("Location: index.php?success=1");
            exit;
        } else {
            // Error occurred during insertion
            echo "Error: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>

