<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/adminstyle.css">
    <script>
        function showSection(sectionId) {
            document.getElementById('customers-section').classList.add('hidden');
            document.getElementById('merchants-section').classList.add('hidden');
            document.getElementById('transactions-section').classList.add('hidden');
            document.getElementById('add-customer-section').classList.add('hidden');
            document.getElementById('add-merchant-section').classList.add('hidden');
            document.getElementById(sectionId).classList.remove('hidden');
        }
    </script>
</head>
<body>
    <div class="header">
        <h1>Admin Dashboard</h1>
        <a href="logout.php" class="logout-link"><button class="logout-btn">Logout</button></a>
    </div>
    <div class="container">
        <div class="button-container">
            <button onclick="showSection('customers-section')">View Customer Table</button>
            <button onclick="showSection('merchants-section')">View Merchants Table</button>
            <button onclick="showSection('transactions-section')">View Transactions Table</button>
            <button onclick="showSection('add-customer-section')">Add New Customer</button>
            <button onclick="showSection('add-merchant-section')">Add New Merchant</button>
        </div>
        <div class="content">
            <!-- Customers Section -->
            <div id="customers-section" class="hidden">
                <h2>Customers</h2>
                <table>
                    <tr><th>Name</th><th>Email</th><th>Phone</th><th>Action</th></tr>
                    <?php
                    $sql = "SELECT * FROM customer";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone']}</td>
                            <td>
                                <a href='delete.php?role=customer&name=" . urlencode($row['name']) . "' onclick='return confirm(\"Are you sure you want to delete this customer?\")'>Delete</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </table>
            </div>

            <!-- Merchants Section -->
            <div id="merchants-section" class="hidden">
                <h2>Merchants</h2>
                <table>
                    <tr><th>Name</th><th>Email</th><th>Phone</th><th>Action</th></tr>
                    <?php
                    $sql = "SELECT * FROM merchant";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone']}</td>
                            <td>
                                <a href='delete.php?role=merchant&name=" . urlencode($row['name']) . "' onclick='return confirm(\"Are you sure you want to delete this merchant?\")'>Delete</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </table>
            </div>

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
            
            <!-- Add New Customer Section -->
            <div id="add-customer-section" class="hidden">
                <h2>Add New Customer</h2>
                <form action="insert_customer.php" method="post">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required placeholder="Enter customer's name">
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required placeholder="Enter customer's email">
                    
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" required placeholder="Enter customer's phone">
                    
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required placeholder="Enter a password">
                    
                    <input type="submit" value="Add Customer">
                </form>
            </div>

            <!-- Add New Merchant Section -->
            <div id="add-merchant-section" class="hidden">
                <h2>Add New Merchant</h2>
                <form action="insert_merchant.php" method="post">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required placeholder="Enter merchant's name">
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required placeholder="Enter merchant's email">
                    
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" required placeholder="Enter merchant's phone">
                    
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required placeholder="Enter a password">
                    
                    <input type="submit" value="Add Merchant">
                </form>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>&copy; 2024 Final Project</p>
    </div>
</body>
</html>
