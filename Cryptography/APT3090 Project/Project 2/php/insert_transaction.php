<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customername = $_POST['customername'];
    $itembought = $_POST['itembought'];
    $amount = $_POST['amount'];

    $sql = "INSERT INTO transactions (customername, itembought, amount) VALUES ('$customername', '$itembought', '$amount')";

    if ($conn->query($sql) === TRUE) {
        header("Location: merchant_dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
