<?php
session_start();
if ($_SESSION['role'] != 'merchant') {
    header("Location: ../index.php");
    exit();
}
include 'db.php';
include 'encryption.php'; // Include encryption functions
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchant Dashboard</title>
    <link rel="stylesheet" href="../css/merchantstyle.css">
    <script>
        function showSection(sectionId) {
            console.log("Showing section:", sectionId); // Debugging log
            document.getElementById('transactions-section').classList.add('hidden');
            document.getElementById('insert-transaction-section').classList.add('hidden');
            document.getElementById('customers-section').classList.add('hidden');
            document.getElementById('insert-customer-section').classList.add('hidden');
            document.getElementById('credit-cards-section').classList.add('hidden');
            document.getElementById(sectionId).classList.remove('hidden');
        }

        // Show the default section
        window.onload = function() {
            showSection('transactions-section');
        };
    </script>
</head>
<body>
    <div class="header">
        <h1>Merchant Dashboard</h1>
        <a href="logout.php" class="logout-link"><button class="logout-btn">Logout</button></a>
    </div>
    <br>
    <br>
    <div class="button-container">
        <button onclick="showSection('transactions-section')">View Transactions</button>
        <button onclick="showSection('insert-transaction-section')">Insert Transaction</button>
        <button onclick="showSection('customers-section')">View Customers</button>
        <button onclick="showSection('insert-customer-section')">Insert Customer</button>
        <button onclick="showSection('credit-cards-section')">View Credit Cards</button>
        <button onclick="showSection('insert-credit-card-section')">Insert Credit Card</button>
    </div>
    <div class="container">
        <div class="content">
            <!-- Transactions Section -->
            <div id="transactions-section" class="hidden">
                <h2>Transactions</h2>
                <table>
                    <tr><th>Customer Name</th><th>Item Bought</th><th>Amount</th></tr>
                    <?php
                    $sql = "SELECT * FROM transactions";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>{$row['customername']}</td><td>{$row['itembought']}</td><td>{$row['amount']}</td></tr>";
                    }
                    ?>
                </table>
            </div>

            <!-- Insert Transaction Section -->
            <div id="insert-transaction-section" class="hidden">
                <h2>Insert Transaction</h2>
                <form class="styled-form" action="insert_transaction.php" method="post">
                    <label for="customername">Customer Name:</label>
                    <input type="text" id="customername" name="customername" required placeholder="Enter customer's name">
                    
                    <label for="itembought">Item Bought:</label>
                    <input type="text" id="itembought" name="itembought" required placeholder="Enter item bought">
                    
                    <label for="amount">Amount:</label>
                    <input type="text" id="amount" name="amount" required placeholder="Enter amount">
                    
                    <input type="submit" value="Insert Transaction">
                </form>
            </div>

            <!-- Customers Section -->
            <div id="customers-section" class="hidden">
                <h2>Customers</h2>
                <table>
                    <tr><th>Name</th><th>Email</th><th>Phone</th></tr>
                    <?php
                    $sql = "SELECT * FROM customer";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['phone']}</td></tr>";
                    }
                    ?>
                </table>
            </div>
            
            <!-- Insert Customer Section -->
            <div id="insert-customer-section" class="hidden">
                <h2>Insert Customer</h2>
                <form class="styled-form" action="insert_customer.php" method="post">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required placeholder="Enter customer's name">
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required placeholder="Enter customer's email">
                    
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" required placeholder="Enter customer's phone">
                    
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required placeholder="Enter a password">
                    
                    <input type="submit" value="Insert Customer">
                </form>
            </div>
            
            <!-- Credit Cards Section -->
            <div id="credit-cards-section" class="hidden">
                <h2>Credit Cards</h2>
                <table>
                    <tr><th>Card Number</th><th>Cardholder</th><th>Expiry Date</th></tr>
                    <?php
                    $sql = "SELECT * FROM credit_cards";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>{$row['cardnumber']}</td><td>{$row['cardholder']}</td><td>{$row['expiry_date']}</td></tr>";
                    }
                    ?>
                </table>
            </div>
            
            <!-- Insert Credit Card Section -->
            <div id="insert-credit-card-section" class="hidden">
                <h2>Insert Credit Card</h2>
                <form class="styled-form" action="insert_credit_card.php" method="post">
                    <label for="cardnumber">Card Number:</label>
                    <input type="text" id="cardnumber" name="cardnumber" required placeholder="Enter card number">
                    
                    <label for="cardholder">Cardholder Name:</label>
                    <input type="text" id="cardholder" name="cardholder" required placeholder="Enter cardholder's name">
                    
                    <label for="expiry_date">Expiry Date:</label>
                    <input type="text" id="expiry_date" name="expiry_date" required placeholder="Enter expiry date (MM/YY)">
                    
                    <label for="cvv">CVV:</label>
                    <input type="text" id="cvv" name="cvv" required placeholder="Enter CVV">
                    
                    <input type="submit" value="Insert Credit Card">
                </form>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>&copy; 2024 Final Project</p>
    </div>
</body>
</html>