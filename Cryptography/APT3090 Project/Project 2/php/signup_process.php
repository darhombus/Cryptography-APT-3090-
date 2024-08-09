<?php
include 'db.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = hash('sha256', $_POST['password']);
    $role = $_POST['role'];

    if ($role == "admin") {
        $sql = "INSERT INTO admin (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";
    } elseif ($role == "customer") {
        $sql = "INSERT INTO customer (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";
    } else {
        $sql = "INSERT INTO merchant (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: ../login.php");
        exit(); // Ensure the script stops executing after redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
