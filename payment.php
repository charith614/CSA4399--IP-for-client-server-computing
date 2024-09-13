<?php
// Include database connection (update with your own details)
include 'db_connect.php';

// Initialize variables
$selectedClasses = [];
$classPrices = [];
$selectedMembership = '';
$membershipPrice = 0;
$totalAmount = 0;
$paymentSuccess = false;
$error_message = '';

// Retrieve data from localStorage (if needed)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $paymentMethod = $_POST['payment-method'];
    $paymentDetails = '';
    
    if ($paymentMethod === 'card') {
        $cardNumber = htmlspecialchars(trim($_POST['card-number']));
        $expiry = htmlspecialchars(trim($_POST['expiry']));
        $cvv = htmlspecialchars(trim($_POST['cvv']));
        $paymentDetails = "Credit Card: $cardNumber (Expiry: $expiry, CVV: $cvv)";
    } elseif ($paymentMethod === 'phonepe') {
        $paymentDetails = 'PhonePe';
    } elseif ($paymentMethod === 'googlepay') {
        $paymentDetails = 'Google Pay';
    } elseif ($paymentMethod === 'cod') {
        $paymentDetails = 'Cash on Delivery';
    }

    // Insert payment details into database
    $stmt = $pdo->prepare("INSERT INTO payment_history (date, amount, method, details) VALUES (NOW(), :amount, :method, :details)");
    $stmt->execute([
        'amount' => $totalAmount,
        'method' => $paymentMethod,
        'details' => $paymentDetails
    ]);

    // If payment insertion is successful
    if ($stmt->rowCount()) {
        $paymentSuccess = true;
    } else {
        $error_message = 'Payment failed. Please try again.';
    }
}

// Fetch payment history from database
$payments = $pdo->query("SELECT * FROM payment_history ORDER BY date DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment and Billing</title>
    <style>
        /* General styling */
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('charith1.jpg');
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: rgba(30, 32, 34, 0.8);
            padding: 20px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            text-align: center;
        }

        nav ul li {
            display: inline;
            margin-right: 15px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        nav ul li a:hover {
            color: #ffa500;
        }

        .payment-section {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .payment-section h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5rem;
        }

        #selected-items {
            background-color: #f7f7f7;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        #selected-items h2 {
            font-size: 1.5rem;
            color: #333;
        }

        #selected-items p {
            font-size: 1.1rem;
            color: #555;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        label {
            font-size: 1.1rem;
            color: #333;
        }

        input[type="text"],
        input[type="month"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
        }

        button[type="submit"] {
            background-color: #28a745;
            color: #fff;
            padding: 12px;
            font-size: 1.1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #218838;
        }

        #payment-success {
            text-align: center;
            color: #28a745;
        }

        #payment-success h2 {
            font-size: 2rem;
        }

        #card-payment,
        #phonepe-payment,
        #googlepay-payment,
        #cod-payment {
            display: none;
        }

        .payment-history {
            margin-top: 30px;
        }

        .payment-history h2 {
            font-size: 1.5rem;
            color: #333;
        }

        .payment-history ul {
            list-style-type: none;
            padding: 0;
        }

        .payment-history li {
            background-color: #f7f7f7;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .delete-button {
            position: absolute;
            right: 10px;
            top: 10px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 5px 10px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .delete-button:hover {
            background-color: #c82333;
        }

        .back-button {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-align: center;
            display: block;
            margin: 0 auto 20px;
            width: 150px;
            font-size: 1rem;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .payment-section {
                padding: 20px;
                margin: 20px;
            }

            .payment-section h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="user_details.php">User Details</a></li>
                <li><a href="membership.php">Membership</a></li>
                <li><a href="classes.php">Classes</a></li>
                <li><a href="trainers.php">Trainers</a></li>
                <li><a href="payment.php">Payment</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="about_us.php">About Us</a></li>
                <li><a href="feedback.php">Feedback</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="payment-section">
        <button class="back-button" id="back-button">Back</button>
        <h1>Manage Your Payments</h1>

        <!-- Section to display selected classes and membership details -->
        <div id="selected-items">
            <h2>Selected Items</h2>
            <p id="selected-classes">Selected Classes: </p>
            <p id="selected-membership">Selected Membership: </p>
            <p id="total-amount">Total Amount: </p>
        </div>

        <!-- Payment Method Form -->
        <form id="payment-form" action="payment.php" method="post">
            <label for="payment-method">Select Payment Method:</label>
            <select id="payment-method" name="payment-method">
                <option value="card">Credit/Debit Card</option>
                <option value="phonepe">PhonePe</option>
                <option value="googlepay">Google Pay</option>
                <option value="cod">Cash on Delivery (COD)</option>
            </select>

            <!-- Card Payment Section -->
            <div id="card-payment">
                <label for="card-number">Card Number:</label>
                <input type="text" id="card-number" name="card-number" placeholder="Enter your card number" required>

                <label for="expiry">Expiry Date:</label>
                <input type="month" id="expiry" name="expiry" required>

                <label for="cvv">CVV:</label>
                <input type="password" id="cvv" name="cvv" placeholder="Enter CVV" required>
            </div>

            <!-- PhonePe Payment Section -->
            <div id="phonepe-payment">
                <p>Please scan the QR code with your PhonePe app to make the payment.</p>
                <img src="phonepe-qr.png" alt="PhonePe QR Code">
            </div>

            <!-- Google Pay Payment Section -->
            <div id="googlepay-payment">
                <p>Please scan the QR code with your Google Pay app to make the payment.</p>
                <img src="googlepay-qr.png" alt="Google Pay QR Code">
            </div>

            <!-- COD Payment Section -->
            <div id="cod-payment">
                <p>You have chosen Cash on Delivery. Please have the exact amount ready at the time of delivery.</p>
            </div>

            <button type="submit">Make Payment</button>
        </form>

        <!-- Payment Success Message -->
        <?php if ($paymentSuccess): ?>
            <div id="payment-success">
                <h2>Payment Successful!</h2>
                <p>Thank you for your payment. Your transaction was successful.</p>
            </div>
        <?php elseif ($error_message): ?>
            <div id="payment-success">
                <h2><?php echo htmlspecialchars($error_message); ?></h2>
            </div>
        <?php endif; ?>

        <!-- Payment History Section -->
        <div class="payment-history">
            <h2>Payment History</h2>
            <ul id="payment-history-list">
                <?php foreach ($payments as $payment): ?>
                    <li>
                        Date: <?php echo htmlspecialchars($payment['date']); ?>, Amount: $<?php echo htmlspecialchars($payment['amount']); ?>, Method: <?php echo htmlspecialchars($payment['method']); ?> (<?php echo htmlspecialchars($payment['details']); ?>)
                        <!-- No delete button here, as deletion should be handled separately -->
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <script>
        // Handle payment method selection
        const paymentMethodSelect = document.getElementById('payment-method');
        const cardPayment = document.getElementById('card-payment');
        const phonepePayment = document.getElementById('phonepe-payment');
        const googlepayPayment = document.getElementById('googlepay-payment');
        const codPayment = document.getElementById('cod-payment');
        const paymentForm = document.getElementById('payment-form');
        
        // Hide all payment options initially
        cardPayment.style.display = 'none';
        phonepePayment.style.display = 'none';
        googlepayPayment.style.display = 'none';
        codPayment.style.display = 'none';

        // Show the selected payment option when user changes the method
        paymentMethodSelect.addEventListener('change', function() {
            const selectedMethod = paymentMethodSelect.value;

            // Hide all sections
            cardPayment.style.display = 'none';
            phonepePayment.style.display = 'none';
            googlepayPayment.style.display = 'none';
            codPayment.style.display = 'none';

            // Show the relevant section based on the selected payment method
            if (selectedMethod === 'card') {
                cardPayment.style.display = 'block';
            } else if (selectedMethod === 'phonepe') {
                phonepePayment.style.display = 'block';
            } else if (selectedMethod === 'googlepay') {
                googlepayPayment.style.display = 'block';
            } else if (selectedMethod === 'cod') {
                codPayment.style.display = 'block';
            }
        });

        // Handle back button click
        document.getElementById('back-button').addEventListener('click', function() {
            window.history.back(); // Navigate to the previous page
        });
    </script>
</body>
</html>
