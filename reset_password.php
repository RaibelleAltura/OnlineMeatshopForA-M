<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    include 'db_connection.php';

    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        if ($new_password === $confirm_password) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
            $update_stmt->bind_param("ss", $hashed_password, $email);
            $update_stmt->execute();

            $reset_success = true; // Flag to trigger the modal popup
        } else {
            $error_message = "Passwords do not match. Please try again.";
        }
    } else {
        $error_message = "Email not found in our records.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        /* General Page Styling */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f5f5f5;
}

/* Form Container */
form {
    background-color: #fff;
    padding: 20px 30px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
}

form label {
    display: block;
    font-size: 14px;
    color: #333;
    margin-bottom: 8px;
}

form input {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
}

form button {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color: #0056b3;
}

/* Error Message */
p {
    font-size: 14px;
    color: red;
    text-align: center;
    margin-top: 10px;
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.modal-content {
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    width: 90%;
    max-width: 400px;
    animation: fadeIn 0.3s ease;
}

.modal-content h2 {
    font-size: 20px;
    margin-bottom: 15px;
    color: #28a745;
}

.modal-content p {
    font-size: 14px;
    margin-bottom: 20px;
    color: #555;
}

.close-btn {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.close-btn:hover {
    background-color: #218838;
}

/* Modal Fade-In Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

    </style>
</head>
<body>
    <form action="reset_password.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <button type="submit">Reset Password</button>
    </form>

    <!-- Success Modal -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <h2>Password Reset Successful</h2>
            <p>Your password has been updated. You can now log in with your new password.</p>
            <button class="close-btn" onclick="redirectToLogin()">OK</button>
        </div>
    </div>

    <!-- Error Message -->
    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?= htmlspecialchars($error_message) ?></p>
    <?php endif; ?>

    <script>
        // Trigger the success modal if password reset is successful
        <?php if (isset($reset_success) && $reset_success): ?>
            document.getElementById('successModal').style.display = 'flex';
        <?php endif; ?>

        // Redirect to the login page after closing the modal
        function redirectToLogin() {
            window.location.href = 'login.php';
        }
    </script>
</body>
</html>
