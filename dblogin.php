<?php
session_start();

// Retrieve the email and password from the form
$email = $_POST['email'];
$password = $_POST['password'];

// Database connection
$servername = "localhost";
$username = "root";
$passwordDB = "";  // Database password (empty if no password)
$dbname = "restaurant";

$conn = new mysqli($servername, $username, $passwordDB, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check for user login (customers)
$sql_users = "SELECT * FROM users WHERE email = ?";
$stmt_users = $conn->prepare($sql_users);
$stmt_users->bind_param("s", $email);
$stmt_users->execute();
$result_users = $stmt_users->get_result();

// Check for staff login (admins)
$sql_staff = "SELECT * FROM staff WHERE email = ?";
$stmt_staff = $conn->prepare($sql_staff);
$stmt_staff->bind_param("s", $email);
$stmt_staff->execute();
$result_staff = $stmt_staff->get_result();

if ($result_users->num_rows > 0) {
    // Customer found
    $user = $result_users->fetch_assoc();
    // Check if password is hashed or plain text
    if (password_verify($password, $user['password']) || $password == $user['password']) {
        // User login successful
        $_SESSION['email'] = $email;
        $_SESSION['userloggedin'] = true;
        echo '<script>alert("User is logged in!"); window.location.href="menu.php";</script>';
        exit();
    } else {
        // Invalid password for user
        echo '<script>alert("Invalid password!"); window.location.href="login.php";</script>';
        exit();
    }
} else if ($result_staff->num_rows > 0) {
    // Staff (Admin) found
    $staff = $result_staff->fetch_assoc();
    // Check if password is hashed or plain text
    if (password_verify($password, $staff['password']) || $password == $staff['password']) {
        // Admin login successful
        $_SESSION['email'] = $email;
        $_SESSION['adminloggedin'] = true;
        echo '<script>alert("Admin is logged in!"); window.location.href="Admin/index.php";</script>';
        exit();
    } else {
        // Invalid password for admin
        echo '<script>alert("Invalid password for admin!"); window.location.href="login.php";</script>';
        exit();
    }
} else {
    // Email not found
    echo '<script>alert("Email not found!"); window.location.href="login.php";</script>';
    exit();
}

// Close connections
$stmt_users->close();
$stmt_staff->close();
$conn->close();
?>
