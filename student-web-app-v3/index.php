<?php
// Fetch database credentials from environment variables
$servername = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$dbname = getenv('DB_NAME');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute an SQL query to retrieve student scores
$sql = "SELECT id, student_name, score, subject FROM scores";
$result = $conn->query($sql);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Score Entry</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url('https://t4.ftcdn.net/jpg/10/79/06/55/360_F_1079065590_grhvLuMwt9Luioy7efeT3SqWXaCgiSvZ.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            color: #fff;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
        }
        .container, .scores-container {
            background: rgba(0, 0, 0, 0.8);
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            width: 90%;
            max-width: 800px;
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #ffeb3b;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            color: #ddd;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: none;
            border-radius: 5px;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.8);
            color: #333;
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #ffeb3b;
            border: none;
            color: #333;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #ffc107;
            transform: translateY(-2px);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #3f51b5;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.1);
        }
        tr:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
            h1 {
                font-size: 24px;
            }
            th, td {
                display: block;
                width: 100%;
                box-sizing: border-box;
            }
            th, td {
                border: none;
                border-bottom: 1px solid #ddd;
            }
            th {
                background-color: #f7f7f7;
                padding-top: 10px;
                padding-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Teacher Score Entry</h1>
        <form action="process.php" method="post">
            <label for="student_name">Student Name:</label>
            <input type="text" name="student_name" required>

            <label for="score">Score:</label>
            <input type="number" name="score" required>

            <label for="subject">Subject:</label>
            <input type="text" name="subject" required>

            <input type="submit" value="Submit">
        </form>
    </div>
    <div class="scores-container">
        <h1>Student Scores</h1>
        <table id="scoreTable">
            <tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>Score</th>
                <th>Subject</th>
            </tr>
            <?php if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["student_name"] . "</td>";
                    echo "<td>" . $row["score"] . "</td>";
                    echo "<td>" . $row["subject"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No records found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>

