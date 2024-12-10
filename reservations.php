<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "meatshop";

// Enable error reporting (optional, for debugging)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Establishing connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
date_default_timezone_set('Asia/Colombo');

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $fullName = $firstName . ' ' . $lastName; // Combine first and last name
    $contact = $_POST['contact'];
    $noOfBox = $_POST['noOfBox'];
    $typeOfProduct = $_POST['typeOfProduct'];
    $specificProduct = $_POST['specificProduct'];  // New field for specific product
    $reservedDate = $_POST['reservedDate'];

    // Prepare SQL statement
    $sql = "INSERT INTO reservations (email, name, contact, noOfBox, typeOfProduct, specificProduct, reservedDate) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("sssssss", $email, $fullName, $contact, $noOfBox, $typeOfProduct, $specificProduct, $reservedDate);

    if ($stmt->execute()) {
        echo '<script>alert("Reservation successful!"); window.location.href="index.php";</script>';
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close connection
$conn->close();
?>