<!DOCTYPE html>
<html>
<head>
    <title>Student Scores</title>
</head>
<body>
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
            echo "<tr><td colspan='3'>No records found</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </table>
</body>
</html>
