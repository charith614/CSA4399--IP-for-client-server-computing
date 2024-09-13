<?php
// Include the header
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainers</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* General styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4; /* Background color */
            color: #333;
        }

        header {
            background-color: #333;
            padding: 10px 0;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 1rem;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        .trainer-list {
            max-width: 1200px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .trainer {
            border-bottom: 1px solid #ddd;
            padding: 20px 0;
        }

        .trainer:last-child {
            border-bottom: none;
        }

        .trainer h2 {
            margin: 0 0 10px;
        }

        .trainer p {
            margin: 0;
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
            margin: 0 auto 20px;
            width: 150px;
            font-size: 1rem;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="user-details.php">User Details</a></li>
                <li><a href="membership.php">Membership</a></li>
                <li><a href="classes.php">Classes</a></li>
                <li><a href="trainers.php">Trainers</a></li>
                <li><a href="payment.php">Payment</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="about-us.php">About Us</a></li>
                <li><a href="feedback.php">Feedback</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="trainer-list">
        <button class="back-button" id="back-button">Back</button>
        <h1>Our Trainers</h1>
        
        <!-- Trainer 1 -->
        <div class="trainer">
            <h2>John Doe</h2>
            <p>Specialization: Personal Training</p>
        </div>

        <!-- Trainer 2 -->
        <div class="trainer">
            <h2>Sarah Smith</h2>
            <p>Specialization: Yoga and Meditation</p>
        </div>

        <!-- Trainer 3 -->
        <div class="trainer">
            <h2>Anna Lee</h2>
            <p>Specialization: Dance and Zumba</p>
        </div>

        <!-- New Trainer 4 -->
        <div class="trainer">
            <h2>Chris Evans</h2>
            <p>Specialization: Spin Classes and Cycling</p>
        </div>

        <!-- New Trainer 5 -->
        <div class="trainer">
            <h2>Emily Johnson</h2>
            <p>Specialization: Strength and Conditioning</p>
        </div>

        <!-- New Trainer 6 -->
        <div class="trainer">
            <h2>David Brown</h2>
            <p>Specialization: CrossFit</p>
        </div>

        <!-- New Trainer 7 -->
        <div class="trainer">
            <h2>Jessica Williams</h2>
            <p>Specialization: Kickboxing</p>
        </div>

        <!-- New Trainer 8 -->
        <div class="trainer">
            <h2>Mike Tyson</h2>
            <p>Specialization: Boxing and Martial Arts</p>
        </div>

    </section>

    <script>
        document.getElementById('back-button').addEventListener('click', () => {
            // Go to the previous page
            window.history.back();
        });
    </script>
</body>
</html>
