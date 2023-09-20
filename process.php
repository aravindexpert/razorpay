<?php
require('Razorpay.php'); // Include the Razorpay PHP SDK

$razorpay_key = 'rzp_test_y1TR7Aev8L2lYb'; // Replace with your Razorpay Key ID
$razorpay_secret = '6txE3mFT0hMzMSdXSiaaIrug'; // Replace with your Razorpay Key Secret

use Razorpay\Api\Api;

$api = new Api($razorpay_key, $razorpay_secret);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $amount_paise = $_POST["amount"]; // The actual amount entered by the user in paise

    // Verify the payment
    $payment_id = $_POST['razorpay_payment_id'];
    $payment = $api->payment->fetch($payment_id);

    if ($payment->status == 'captured' && $payment->amount == $amount_paise) {
        // Payment successful, process your form data or take any other required actions
        // You can also save the payment details in your database

        // Example: Display the collected data and payment details
        echo "<h2>Collected Data:</h2>";
        echo "<p>Email: " . htmlspecialchars($email) . "</p>";
        echo "<p>Contact: " . htmlspecialchars($contact) . "</p>";
        echo "<p>Amount: " . ($amount_paise / 100) . " INR</p>"; // Convert paise to INR
        echo "<h2>Payment Details:</h2>";
        echo "<p>Payment ID: " . $payment->id . "</p>";
        echo "<p>Payment Status: " . $payment->status . "</p>";
        
        // Add your database insertion code here
        
        // Redirect to success.php
        echo "<script>window.location.href = 'payment-success.php';</script>";
    } else {
        // Payment failed or amount mismatch, handle accordingly
        echo "Payment failed or amount mismatch. Please try again.";
    }
}
?>
