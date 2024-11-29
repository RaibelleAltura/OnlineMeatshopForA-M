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

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting form data
    $email = $_POST['email'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $contact = $_POST['contact'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    // Hash ng password before storing sa database
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // insert sa staff
    $sql = "INSERT INTO staff (email, firstName, lastName, contact, role, password) 
            VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("ssssss", $email, $firstName, $lastName, $contact, $role, $passwordHash);

    // Execute the statement
    if ($stmt->execute()) {
        echo '<script>alert("Staff Added successfully!"); window.location.href="staffs.php";</script>';
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
