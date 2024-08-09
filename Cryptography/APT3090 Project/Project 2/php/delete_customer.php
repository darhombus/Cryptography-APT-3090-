<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerid = $_POST['customerid'];

    // Sanitize input data
    $customerid = $conn->real_escape_string($customerid);

    $sql = "DELETE FROM customer WHERE customerid = '$customerid'";

    if ($conn->query($sql) === TRUE) {
        header("Location: merchant_dashboard.php");
        exit(); // Ensure that the script stops executing after redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
