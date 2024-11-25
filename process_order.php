<?php
session_start();
require 'db_connection.php';

// Check if user is logged in
if (!isset($_SESSION['userloggedin']) || $_SESSION['userloggedin'] !== true) {
    header('Location: login.php');
    exit;
}

$allowed_provinces = ['Cavite', 'Laguna', 'Rizal', 'Batangas', 'Quezon'];
$province = $_POST['province'] ?? '';

if (!in_array($province, $allowed_provinces)) {
    die('Invalid province selected. Please choose a valid province from Region 4A.');
}

// Retrieve form data
$firstName = $_POST['firstName'] ?? '';
$lastName = $_POST['lastName'] ?? '';
$email = $_POST['email'] ?? '';
$address = $_POST['address'] ?? '';
$contact = $_POST['contact'] ?? '';
$orderNote = $_POST['order_note'] ?? '';
$paymentMode = $_POST['payment_mode'] ?? '';
$total = $_POST['total'] ?? 0;
$subtotal = $_POST['subtotal'] ?? 0;
$selectedItems = json_decode($_POST['selected_items'], true) ?? [];

// Handle bank transfer proof upload for 'Card' payment mode
// YUNG DIRECTORY NYA IS SA UPLOADS KO NALANG NILAGAY YUNG PROOF OF PAYMENT
// YUNG DIRECTORY NYA IS SA UPLOADS KO NALANG NILAGAY YUNG PROOF OF PAYMENT
// YUNG DIRECTORY NYA IS SA UPLOADS KO NALANG NILAGAY YUNG PROOF OF PAYMENT


$proofOfPayment = null;
if ($paymentMode === 'Card' && isset($_FILES['proof_of_payment']) && $_FILES['proof_of_payment']['error'] === 0) {
    // Directory for storing proof of payment
    $proofDirectory = 'uploads/';
    if (!file_exists($proofDirectory)) {
        mkdir($proofDirectory, 0777, true); // Ensure directory exists
    }

    // Get the file name and ensure it has a valid extension
    $fileName = basename($_FILES['proof_of_payment']['name']);
    $filePath = $proofDirectory . $fileName;

    // Check file extension (for image types)
    $validExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    
    if (in_array($fileExtension, $validExtensions)) {
        // Move the file to the uploads folder
        if (move_uploaded_file($_FILES['proof_of_payment']['tmp_name'], $filePath)) {
            $proofOfPayment = $fileName; // Store the file name in the database
        } else {
            echo 'Error uploading the file.';
            exit;
        }
    } else {
        echo 'Invalid file type. Please upload an image file.';
        exit;
    }
}

// Begin transaction
$conn->begin_transaction();

try {
    // Insert order details

    // DITO YUNG PROOF OF PAYMENT INSERTION
    // DITO YUNG PROOF OF PAYMENT INSERTION
    // DITO YUNG PROOF OF PAYMENT INSERTION

    
    $stmt = $conn->prepare('INSERT INTO orders (firstName, lastName, email, phone, address, sub_total, grand_total, pmode, note, proof_of_payment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    if ($stmt === false) {
        throw new Exception('Failed to prepare order insertion statement: ' . $conn->error);
    }
    $stmt->bind_param('sssssddsss', $firstName, $lastName, $email, $contact, $address, $subtotal, $total, $paymentMode, $orderNote, $proofOfPayment);
    $stmt->execute();
    $orderId = $stmt->insert_id;

    // Prepare statement for inserting order items
    $stmt = $conn->prepare('INSERT INTO order_items (order_id, itemName, quantity, price, total_price, image) VALUES (?, ?, ?, ?, ?, ?)');
    if ($stmt === false) {
        throw new Exception('Failed to prepare order items insertion statement: ' . $conn->error);
    }

    foreach ($selectedItems as $item) {
        $itemId = $item['id'] ?? 0;
        $itemQuantity = $item['quantity'] ?? 0;

        // Fetch item details from the cart
        $itemStmt = $conn->prepare('SELECT * FROM cart WHERE id=? AND email=?');
        $itemStmt->bind_param('is', $itemId, $email);
        $itemStmt->execute();
        $itemResult = $itemStmt->get_result();
        $itemDetails = $itemResult->fetch_assoc();

        if ($itemDetails === null) {
            throw new Exception('Item not found in cart.');
        }

        $itemName = $itemDetails['itemName'];
        $itemPrice = $itemDetails['price'];
        $totalPrice = $itemPrice * $itemQuantity;
        $itemImage = $itemDetails['image'];

        $stmt->bind_param('issdds', $orderId, $itemName, $itemQuantity, $itemPrice, $totalPrice, $itemImage);
        $stmt->execute();

        // Remove each item from the cart
        $deleteStmt = $conn->prepare('DELETE FROM cart WHERE id=? AND email=?');
        $deleteStmt->bind_param('is', $itemId, $email);
        $deleteStmt->execute();
    }

    // Commit transaction
    $conn->commit();

    // Redirect to confirmation page with the order ID
    header('Location: order_confirm.php?order_id=' . $orderId);
    exit;

} catch (Exception $e) {
    // Rollback transaction in case of error
    $conn->rollback();
    echo 'Error: ' . $e->getMessage();
}
?>
