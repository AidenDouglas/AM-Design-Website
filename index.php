<?php
session_start();

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

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400); // Bad request HTTP status code
        echo json_encode(['message' => 'Invalid email']);
        die();
    }

    // Prepare and execute the SQL query to insert the email into the database
    $stmt = $conn->prepare("INSERT INTO emails (email) VALUES (?)");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Email saved successfully!";
        http_response_code(200); // Success HTTP status code
        echo json_encode(['message' => 'Email saved successfully!']);
    } else {
        $_SESSION['message'] = "Error saving email: " . $conn->error;
        http_response_code(500); // Error HTTP status code
        echo json_encode(['message' => 'Error saving email: ' . $conn->error]);
    }

    // Add this for debugging
    die();
}
?>
