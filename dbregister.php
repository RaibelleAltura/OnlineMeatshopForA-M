<?php
// Database connection
$servername = "localhost";
$username = "root";
$passwordDB = "";
$dbname = "restaurant";

$conn = new mysqli($servername, $username, $passwordDB, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user data from the form
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$password = $_POST['password'];

// Hash the password
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Check if email already exists
$sql_check = "SELECT * FROM users WHERE email = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $email);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    header('Location: login.php?error=email_exists');
    exit();
} else {
    // Insert user into the database
    $sql_insert = "INSERT INTO users (firstName, lastName, email, contact, password) VALUES (?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("sssss", $firstName, $lastName, $email, $contact, $passwordHash);
    
    if ($stmt_insert->execute()) {
        header('Location: login.php?success=registered');
    } else {
        header('Location: login.php?error=registration_failed');
    }
}

$conn->close();
?>
