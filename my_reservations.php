<?php
session_start();
include('db_connection.php');

// Check if the user is logged in
if (!isset($_SESSION['userloggedin']) || $_SESSION['userloggedin'] !== true) {
    header('location:login.php');
    exit;
}

// Get the email from the session
$email = $_SESSION['email'];

// Fetch the reservations and user information for the logged-in user
$query = "SELECT users.firstName, users.lastName, users.email, users.contact, 
                 reservations.reservation_id, reservations.typeOfProduct, reservations.noOfBox, 
                 reservations.reservedDate, reservations.status, reservations.specificProduct
          FROM reservations 
          JOIN users ON reservations.email = users.email 
          WHERE users.email = ?";
$stmt = $conn->prepare($query);
if ($stmt === false) {
    die('Prepare failed: ' . $conn->error);
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Function to fetch specific products based on the selected type
function getSpecificProducts($conn, $type) {
    $query = "SELECT specificProduct FROM product_types WHERE typeOfProduct = ?";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("s", $type);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = htmlspecialchars($row['specificProduct']);
    }

    $stmt->close();
    return $products;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reservations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fdf1e8;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #ff9373;
            padding: 10px 20px;
            text-align: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }


        /* Add padding to the body to push content below the navbar */
        body {
            padding-top: 90px; /* Increased to create more space under the navbar */
        }

        h1 {
            text-align: center;
        }

        .container {
            padding: 20px;
            max-width: 500px;
            margin: 0 auto;
            margin-top: 20px; /* Optional: More spacing between the navbar and content */
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .customer-details h2 {
            font-size: 22px;
            margin-bottom: 10px;
            color: #ff9373;
        }

        .customer-details p {
            font-size: 16px;
            color: #555;
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        table th {
            background-color: #ff9373;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        .status-pending {
            color: #ff7f50;
            font-weight: bold;
        }

        .status-approved {
            color: #4CAF50;
            font-weight: bold;
        }
    </style>
</head>
<body>
<?php
  if (isset($_SESSION['userloggedin']) && $_SESSION['userloggedin']) {
    include 'nav-logged.php';
  } else {
    include 'navbar.php';
  }
  ?>
     <h1>My Reservations</h1>

<?php if ($result->num_rows > 0): ?>
    <?php $userInfo = $result->fetch_assoc(); ?>
    <h3>Customer Details</h3>
    <?php
    $firstName = isset($userInfo['firstName']) ? htmlspecialchars($userInfo['firstName']) : 'N/A';
    $lastName = isset($userInfo['lastName']) ? htmlspecialchars($userInfo['lastName']) : 'N/A';
    ?>
    <p><strong>Name:</strong> <?php echo $firstName . ' ' . $lastName; ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($userInfo['email']); ?></p>
    <p><strong>Contact Number:</strong> <?php echo htmlspecialchars($userInfo['contact']); ?></p>

    <table>
        <thead>
            <tr>
                <th>Reservation ID</th>
                <th>Type of Meat</th>
                <th>Specific Meat</th>
                <th>No. of Boxes</th>
                <th>Reserved Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php do { ?>
                <tr>
                    <td><?php echo htmlspecialchars($userInfo['reservation_id']); ?></td>
                    <td><?php echo htmlspecialchars($userInfo['typeOfProduct']); ?></td>
                    <td><?php echo htmlspecialchars($userInfo['specificProduct'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($userInfo['noOfBox']); ?></td>
                    <td><?php echo htmlspecialchars($userInfo['reservedDate']); ?></td>
                    <td><?php echo htmlspecialchars($userInfo['status']); ?></td>
                </tr>
            <?php } while ($userInfo = $result->fetch_assoc()); ?>
        </tbody>
    </table>
<?php else: ?>
    <p>You have no reservations at the moment.</p>
<?php endif; ?>

<?php
// Close the statement and connection
$stmt->close();
$conn->close();
?>
<?php
include_once ('footer.html');
?>
</body>
</html>