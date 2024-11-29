<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant";

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
    // Collecting form data
    $email = $_POST['email'];
    $name = $_POST['firstName'];  // Make sure the form input name matches
    $contact = $_POST['contact'];
    $noOfBox = $_POST['noOfBox'];
    $typeOfProduct = $_POST['typeOfProduct']; // Replacing reservedTime
    $reservedDate = $_POST['reservedDate']; // Input format is 'YYYY-MM-DD'

    // Prepare SQL statement to insert data into reservations table
    $sql = "INSERT INTO reservations (email, name, contact, noOfBox, typeOfProduct, reservedDate) 
            VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    // Correct bind_param types:
    // "sssis" - First 4 variables are strings, $noOfBox is an integer, and $reservedDate is a string
    $stmt->bind_param("ssssss", $email, $name, $contact, $noOfBox, $typeOfProduct, $reservedDate);


    // Execute the statement
    if ($stmt->execute()) {
        echo '<script>alert("Reservation successful!"); window.location.href="index.php";</script>';
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
