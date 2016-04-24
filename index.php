<?php
    // Create connection
    $conn = new mysqli('127.0.0.1', 'root', 'toor', 'childdaycare');
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM childdaycare";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"]. "<br>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
?>