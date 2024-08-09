<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cardnumber = $_POST['cardnumber'];
    $cardholder = $_POST['cardholder'];
    $expiry_date = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];

    // Sanitize input data
    $cardnumber = $conn->real_escape_string($cardnumber);
    $cardholder = $conn->real_escape_string($cardholder);
    $expiry_date = $conn->real_escape_string($expiry_date);
    $cvv = $conn->real_escape_string($cvv);

    // Hash card number and CVV
    $hashed_cardnumber = hash('sha256', $cardnumber);
    $hashed_cvv = hash('sha256', $cvv);

    $sql = "INSERT INTO credit_cards (cardnumber, cardholder, expiry_date, cvv) VALUES ('$hashed_cardnumber', '$cardholder', '$expiry_date', '$hashed_cvv')";

    if ($conn->query($sql) === TRUE) {
        header("Location: merchant_dashboard.php");
        exit(); // Ensure that the script stops executing after redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
