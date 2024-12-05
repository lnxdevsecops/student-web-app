<?php
// Database connection settings
$db_host = 'mysql';
$db_user = 'root';
$db_pass = 'Linux.adm@1';

// Create a connection to MySQL
$conn = new mysqli($db_host, $db_user, $db_pass);

// Check for a successful connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create a new database
$databaseName = 'new_database';
$createDatabaseQuery = "CREATE DATABASE IF NOT EXISTS $databaseName";

if ($conn->query($createDatabaseQuery) === TRUE) {
    echo "Database created successfully.<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select the newly created or existing database
$conn->select_db($databaseName);

// Create a new table in the database if it doesn't already exist
$createTableQuery = "CREATE TABLE IF NOT EXISTS scores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(255) NOT NULL,
    score INT NOT NULL,
    subject VARCHAR(255) NOT NULL
)";

if ($conn->query($createTableQuery) === TRUE) {
    echo "Table created successfully.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and validate the student name, score, and subject from the form
    $student_name = $_POST["student_name"];
    $score = $_POST["score"];
    $subject = $_POST["subject"];

    if (empty($student_name) || empty($score) || empty($subject)) {
        echo "Please fill in all fields.";
    } else {
        // Prepare and execute an SQL insert statement
        $sql = "INSERT INTO scores (student_name, score, subject) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            echo "Error preparing the statement: " . $conn->error;
        } else {
            $stmt->bind_param("sis", $student_name, $score, $subject);

            if ($stmt->execute()) {
                // Data was inserted successfully
                header("Location: index.html?success=1");
                exit;
            } else {
                // Error occurred during insertion
                echo "Error: " . $conn->error;
            }

            // Close the prepared statement
            $stmt->close();
        }
    }
}

// Close the initial database connection
$conn->close();
?>

