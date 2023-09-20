<!DOCTYPE html>
<html>
<head>
    <title>Contact Form with Razorpay</title>
    <!-- Include Razorpay.js -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <!-- Include jQuery (if not already included) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     <!-- Add the CSS styles -->
     <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        form {
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 300px;
    margin: 0 auto; /* Center the form horizontally */
    margin-left : -250px;
    margin-top: 100px; /* Move the form down by 600px */
}

        h2 {
            text-align: center;
            margin-bottom: 500px;
            margin-left : 600px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Payment Form</h2>
    <form method="POST" action="process.php" id="paymentForm">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>
        
        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" required><br><br>
        
        <label for="amount">Amount (in INR):</label>
        <input type="number" name="amount" id="amount" min="1" required><br><br>

        <!-- Payment button -->
        <button type="submit" id="rzp-button">Pay with Razorpay</button>
    </form>

    <script>
        $('body').on('submit', '#paymentForm', function(e){
            e.preventDefault();

            var name = $("#name").val();
            var email = $("#email").val();
            var phone = $("#phone").val();
            var amount = $("#amount").val() * 100; // Convert amount to paise (1 INR = 100 paise)

            var options = {
                "key": "rzp_test_y1TR7Aev8L2lYb",
                "amount": amount,
                "name": "Aravind",
                "description": "Payment",
                "image": "Web-App-Development.png",
                "handler": function (response) {
                    $.ajax({
                        url: 'process.php',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            razorpay_payment_id: response.razorpay_payment_id,
                            name: name,
                            email: email,
                            phone: phone,
                            amount: amount
                        },
                        success: function (msg) {
    console.log('Success!');
    console.log(msg);
    window.location.href = 'payment-success.php';
}

                    });
                },
                "theme": {
                    "color": "#528FF0"
                }
            };

            var rzp1 = new Razorpay(options);
            rzp1.open();
            console.log("Razorpay payment initiated");
        });
    </script>
</body>
</html>
