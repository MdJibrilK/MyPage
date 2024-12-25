<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
// Database credentials
$servername = "localhost";
$username = "root"; // Replace with your DB username
$password = "password"; // Replace with your DB password
$dbname = "if0_37218906_website";
// $servername = "sql210.infinityfree.com";
// $username = "if0_37218906"; // Replace with your DB username
// $password = "Ri0JdwA6clE"; // Replace with your DB password
// $dbname = "if0_37218906_website";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $subject = $_POST['subject'];

    // Validate form data
    if (empty($name) || empty($email) || empty($message) || empty($subject)) {
        die("All fields are required!");
    }

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contacts (name, email,subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    // Execute and check
    if ($stmt->execute()) {
        echo 'OK'; // Success
    } else {
        echo 'Error: ' . $mail->ErrorInfo; // Error message
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>
