<?php
session_start();
include 'db.php'; // Ensure this contains the database connection

// Check if the user is logged in and has the role of 'customer'
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'customer') {
    header("Location: ../index.php"); // Redirect to the login page if not logged in
    exit();
}

$customer_name = $_SESSION['name']; // Get the customer's name from the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/adminstyle.css">
    <script>
        function showSection(sectionId) {
            document.getElementById('cards-section').classList.add('hidden');
            document.getElementById('transactions-section').classList.add('hidden');
            document.getElementById(sectionId).classList.remove('hidden');
        }

        window.onload = function() {
            showSection('cards-section'); // Default to showing cards-section
        };
    </script>
</head>
<body>
    <div class="header">
        <h1>Customer Dashboard</h1>
        <a href="logout.php"><button class="logout-btn">Logout</button></a>
    </div>
    <div class="container">
        <div class="button-container">
            <button onclick="showSection('cards-section')">View Credit Cards</button>
            <button onclick="showSection('transactions-section')">View Transactions</button>
        </div>
        <div class="content">
            <!-- Credit Cards Section -->
            <div id="cards-section" class="hidden">
                <h2>My Credit Cards</h2>
                <table>
                    <tr><th>Card Number</th><th>Cardholder</th><th>Expiry Date</th></tr>
                    <?php
                    $sql = "SELECT * FROM credit_cards WHERE cardholder = ?";
                    if ($stmt = $conn->prepare($sql)) {
                        $stmt->bind_param("s", $customer_name); // Bind the customer name
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>{$row['cardnumber']}</td><td>{$row['cardholder']}</td><td>{$row['expiry_date']}</td></tr>";
                        }
                        $stmt->close();
                    } else {
                        echo "Error preparing statement: " . $conn->error;
                    }
                    ?>
                </table>
            </div>

            <!-- Transactions Section -->
            <div id="transactions-section" class="hidden">
                <h2>My Transactions</h2>
                <table>
                    <tr><th>Item Bought</th><th>Amount</th></tr>
                    <?php
                    $sql = "SELECT * FROM transactions WHERE customername = ?";
                    if ($stmt = $conn->prepare($sql)) {
                        $stmt->bind_param("s", $customer_name); // Bind the customer name
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>{$row['itembought']}</td><td>{$row['amount']}</td></tr>";
                        }
                        $stmt->close();
                    } else {
                        echo "Error preparing statement: " . $conn->error;
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>&copy; 2024 Final Project</p>
    </div>
</body>
</html>
