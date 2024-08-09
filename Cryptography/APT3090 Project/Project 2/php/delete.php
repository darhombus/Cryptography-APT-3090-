<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

include 'db.php';

// Check if the required parameters are set
if (isset($_GET['role']) && isset($_GET['name'])) {
    $role = $_GET['role'];
    $name = $_GET['name'];

    // Sanitize input data
    $role = $conn->real_escape_string($role);
    $name = $conn->real_escape_string($name);

    // Define SQL based on role
    if ($role === 'customer') {
        // Prepare and execute the SQL statement
        $stmt = $conn->prepare("DELETE FROM customer WHERE name = ?");
        $stmt->bind_param("s", $name);
    } elseif ($role === 'merchant') {
        // Prepare and execute the SQL statement
        $stmt = $conn->prepare("DELETE FROM merchant WHERE name = ?");
        $stmt->bind_param("s", $name);
    } else {
        // Invalid role
        header("Location: admin_dashboard.php");
        exit();
    }

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
} else {
    // Missing parameters
    header("Location: admin_dashboard.php");
    exit();
}
?>
