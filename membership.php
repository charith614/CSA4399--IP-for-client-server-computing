<?php
// Include the header
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Membership</title>
    <style>
        /* General styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('chari.jpg'); /* Replace with your background image */
            background-size: cover;
            background-position: center;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.299); /* Semi-transparent background */
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(122, 119, 119, 0.727);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #fcf7f7;
        }

        .membership-options {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .membership-card {
            flex: 1 1 calc(33.333% - 40px); /* Responsive width with gap */
            max-width: calc(33.333% - 40px);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .membership-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .membership-card input[type="radio"] {
            display: none;
        }

        .membership-card input[type="radio"]:checked + .card-content {
            border: 2px solid #28a745;
        }

        .card-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            border: 2px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            transition: border-color 0.3s ease;
        }

        .card-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #333;
        }

        .card-price {
            font-size: 1.2rem;
            color: #555;
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
            width: 100%;
            margin-top: 20px;
        }

        button[type="submit"]:hover {
            background-color: #218838;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .membership-card {
                flex: 1 1 calc(50% - 20px); /* Two cards per row on smaller screens */
                max-width: calc(50% - 20px);
            }
        }

        @media (max-width: 480px) {
            .membership-card {
                flex: 1 1 100%; /* One card per row on very small screens */
                max-width: 100%;
            }
        }

        /* Navigation styling */
        nav {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 10px 20px;
        }

        .nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        .nav-list li {
            margin: 0 10px;
        }

        .nav-list a {
            color: #fcf7f7;
            text-decoration: none;
            font-size: 1rem;
        }

        .nav-list a:hover {
            text-decoration: underline;
        }

        /* Back button styling */
        .back-button {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-align: center;
            display: block;
            margin: 0 auto;
            width: 150px;
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <nav>
        <ul class="nav-list">
            <li><a href="home.php">Home</a></li>
            <li><a href="user-details.php">User Details</a></li>
            <li><a href="membership.php">Membership</a></li>
            <li><a href="classes.php">Classes</a></li>
            <li><a href="trainers.php">Trainers</a></li>
            <li><a href="payment.php">Payment</a></li> <!-- Updated link to PHP file -->
            <li><a href="contact.php">Contact</a></li>
            <li><a href="about-us.php">About Us</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <button class="back-button" id="back-button">Back</button>
        <h1>Select Your Membership</h1>
        <form id="membership-form" method="post" action="payment.php">
            <div class="membership-options">
                <label class="membership-card">
                    <input type="radio" name="membership" value="Gold Membership" data-price="120">
                    <div class="card-content">
                        <div class="card-title">Gold Membership</div>
                        <div class="card-price">$120</div>
                        <p>Access to all classes and premium features.</p>
                    </div>
                </label>
                <label class="membership-card">
                    <input type="radio" name="membership" value="Silver Membership" data-price="80">
                    <div class="card-content">
                        <div class="card-title">Silver Membership</div>
                        <div class="card-price">$80</div>
                        <p>Access to most classes and features.</p>
                    </div>
                </label>
                <label class="membership-card">
                    <input type="radio" name="membership" value="Bronze Membership" data-price="50">
                    <div class="card-content">
                        <div class="card-title">Bronze Membership</div>
                        <div class="card-price">$50</div>
                        <p>Access to basic classes and features.</p>
                    </div>
                </label>
            </div>
            <button type="submit">Save Membership and Continue</button>
        </form>
    </div>

    <script>
        document.getElementById('membership-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const selectedMembership = document.querySelector('input[name="membership"]:checked');
            if (selectedMembership) {
                const membership = selectedMembership.value;
                const price = selectedMembership.getAttribute('data-price');

                // Save selected membership and price in localStorage
                localStorage.setItem('selectedMembership', membership);
                localStorage.setItem('membershipPrice', price);

                // Redirect to the payment page
                window.location.href = 'payment.php'; // Updated link to PHP file
            } else {
                alert('Please select a membership.');
            }
        });

        document.getElementById('back-button').addEventListener('click', () => {
            // Go to the previous page
            window.history.back();
        });
    </script>
</body>
</html>
