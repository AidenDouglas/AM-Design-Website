<?php
$servername = "localhost"; 
$username = "root";
$password = ""; 
$dbname = "am_design_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the email address from the form
    $email = $_POST["email"];

    // Prepare and execute the SQL query to insert the email into the database
    $stmt = $conn->prepare("INSERT INTO emails (email) VALUES (?)");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        echo "Email saved successfully!";
    } else {
        echo "Error saving email: " . $conn->error;
    }
}