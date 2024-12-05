<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Scores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f9fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            max-width: 800px;
            width: 100%;
        }
        h1 {
            text-align: center;
            color: #333;
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
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        @media (max-width: 600px) {
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
        <h1>Student Scores</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>Score</th>
                <th>Subject</th>
            </tr>

            <?php
            $conn = new mysqli("mysql", "root", "Linux.adm@1", "new_database");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and execute an SQL query to retrieve student scores
            $sql = "SELECT id, student_name, score, subject FROM scores";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data from each row
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

            // Close the database connection
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
