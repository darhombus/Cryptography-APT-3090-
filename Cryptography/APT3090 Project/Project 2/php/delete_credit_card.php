<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cardid = $_POST['cardid'];

    // Sanitize input data
    $cardid = $conn->real_escape_string($cardid);

    $sql = "DELETE FROM credit_cards WHERE cardid = '$cardid'";

    if ($conn->query($sql) === TRUE) {
        header("Location: merchant_dashboard.php");
        exit(); // Ensure that the script stops executing after redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
