<?php
session_start();
include 'db.php'; // Ensure this contains your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']); // Escape input to prevent SQL injection
    $password = hash('sha256', $_POST['password']); // Hash the password

    $roles = ['admin', 'customer', 'merchant'];
    $userFound = false;

    foreach ($roles as $role) {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM $role WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['userid'] = $row[$role . 'id'];
            $_SESSION['role'] = $role;
            $_SESSION['name'] = $row['name'];

            // Redirect to the appropriate dashboard based on role
            header("Location: " . $role . "_dashboard.php");
            exit();
        }

        $stmt->close();
    }

    // If no user was found in any role
    echo "Invalid email or password";
    $conn->close();
}
?>
