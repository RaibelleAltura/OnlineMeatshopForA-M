<?php
session_start();
if (!isset($_SESSION['adminloggedin'])) {
    header("Location: ../login.php");
    exit();
}

include 'db_connection.php'; // Include your database connection

$statusFilter = isset($_GET['statusFilter']) ? $_GET['statusFilter'] : '';
$searchOrderId = isset($_GET['searchOrderId']) ? $_GET['searchOrderId'] : '';

$query = "SELECT order_id, order_date, firstName, lastName, phone, grand_total, order_status, pmode, cancel_reason, proof_of_payment FROM orders";
$conditions = [];

if (!empty($statusFilter)) {
    $conditions[] = "order_status = '" . $conn->real_escape_string($statusFilter) . "'";
}

if (!empty($searchOrderId)) {
    $conditions[] = "order_id LIKE '%" . $conn->real_escape_string($searchOrderId) . "%'";
}

if (!empty($conditions)) {
    $query .= " WHERE " . implode(' AND ', $conditions);
}

$query .= " ORDER BY order_id DESC";

$result = $conn->query($query);
?>

<?php include 'sidebar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders</title>
    <!--poppins-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="admin_orders.css">
    <style>
        .content {
            margin-bottom: 40px;
        }
        .status {
            font-weight: bold;
        }
        .status-pending { color: orange; }
        .status-processing { color: blue; }
        .status-completed { color: green; }
        .status-cancelled { color: red; }
        .status-ontheway { color: purple; }
    </style>
</head>
<body>
    <div class="sidebar">
        <button class="close-sidebar" id="closeSidebar">&times;</button>
        <!-- Profile Section -->
        <div class="profile-section">
            <img src="../uploads/<?php echo htmlspecialchars($admin_info['profile_image']); ?>" alt="Profile Picture">
            <div class="info">
                <h3>Welcome Back!</h3>
                <p><?php echo htmlspecialchars($admin_info['firstName']) . ' ' . htmlspecialchars($admin_info['lastName']); ?></p>
            </div>
        </div>

        <!-- Navigation Items -->
        <ul>
            <li><a href="index.php"><i class="fas fa-chart-line"></i> Overview</a></li>
            <li><a href="admin_menu.php"><i class="fas fa-utensils"></i> Products</a></li>
            <li><a href="reservations.php"><i class="fas fa-calendar-alt"></i> Reservations</a></li>
            <li><a href="admin_orders.php" class="active"><i class="fas fa-shopping-cart"></i> Order Management</a></li>
            <li><a href="users.php"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="reviews.php"><i class="fas fa-star"></i> Reviews</a></li>
            <li><a href="staffs.php"><i class="fas fa-users"></i> Staffs</a></li>
            <li><a href="profile.php"><i class="fas fa-user"></i> Profile Setting</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <div class="header">
            <button id="toggleSidebar" class="toggle-button">
                <i class="fas fa-bars"></i>
            </button>
            <h2><i class="fas fa-shopping-cart"></i> Orders</h2>
        </div>

        <div class="actions">
            <div>
                <button id="refreshButton" onclick="refreshPage()" title="Refresh">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
            <div class="filter-orders">
                <select id="statusFilter" name="statusFilter" onchange="filterByStatus()">
                    <option value="">All Orders</option>
                    <option value="Pending">Pending</option>
                    <option value="On Process">Process</option>
                    <option value="On the way">Out for Delivery</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
                <input type="text" id="searchOrderId" placeholder="Search by Order ID" oninput="searchByOrderId()">
            </div>
        </div>

        <table>
    <tr>
        <th>Order ID</th>
        <th>Customer Name</th>
        <th>Contact</th>
        <th>Total</th>
        <th>Order Status</th>
        <th>Payment Mode</th>
        <th>Cancel Reason</th>
        <th>Proof of Payment</th>
        <th>Action</th>
    </tr>
    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $statusClass = '';
            switch ($row['order_status']) {
                case 'Pending':
                    $statusClass = 'status-pending';
                    break;
                case 'Processing':
                    $statusClass = 'status-processing';
                    break;
                case 'Completed':
                    $statusClass = 'status-completed';
                    break;
                case 'Cancelled':
                    $statusClass = 'status-cancelled';
                    break;
                case 'On the way':
                    $statusClass = 'status-ontheway';
                    break;
            }

            echo "<tr>
                    <td>{$row['order_id']}</td>
                    <td>" . htmlspecialchars($row['firstName'] . " " . $row['lastName']) . "</td>
                    <td>" . htmlspecialchars($row['phone']) . "</td>
                    <td>₱ " . number_format($row['grand_total'], 2) . "</td>
                    <td><span class='status $statusClass'>" . htmlspecialchars($row['order_status']) . "</span></td>
                    <td>" . htmlspecialchars($row['pmode']) . "</td>
                    <td>" . ($row['order_status'] == 'Cancelled' ? htmlspecialchars($row['cancel_reason']) : '-') . "</td>
                    <td>";
                    
            // Check for "Store Pick Up" or "Cash on Delivery" payment mode
            if ($row['pmode'] == 'Store Pick Up' || $row['pmode'] == 'Cash on Delivery') {
                echo "No Proof Needed";
            } elseif (!empty($row['proof_of_payment'])) {
                echo "<a href='../uploads/" . htmlspecialchars($row['proof_of_payment']) . "' target='_blank'>View Proof</a>";
            } else {
                echo "No proof Needed";
            }
            
            echo "</td>
                    <td><button id='viewbtn' onclick=\"viewDetails({$row['order_id']})\">View Details</button></td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='9' style='text-align: center;'>No Orders Found</td></tr>";
    }
    ?>
</table>


    </div>

    <?php include_once('footer.html'); ?>

    <script src="sidebar.js"></script>
    <script>
        function viewDetails(orderId) {
            window.location.href = 'view_order.php?orderId=' + orderId;
        }

        const modal = document.querySelector('.modal');
        const buttons = document.querySelectorAll('.toggle-button');
        buttons.forEach(button => {
            button.addEventListener('click', () => {
                modal.classList.toggle('open');
            });
        });

        function filterByStatus() {
            var statusFilter = document.getElementById('statusFilter').value;
            var searchOrderId = document.getElementById('searchOrderId').value.trim();
            window.location.href = 'admin_orders.php?statusFilter=' + encodeURIComponent(statusFilter) + '&searchOrderId=' + encodeURIComponent(searchOrderId);
        }

        function searchByOrderId() {
            filterByStatus(); // Call filterByStatus to update results based on search input
        }

        function refreshPage() {
            window.location.href = 'admin_orders.php'; // Reload the page
        }

        // Set the status filter select value based on the query parameter
        document.getElementById('statusFilter').value = "<?= isset($_GET['statusFilter']) ? htmlspecialchars($_GET['statusFilter']) : ''; ?>";
    </script>
</body>
</html>
