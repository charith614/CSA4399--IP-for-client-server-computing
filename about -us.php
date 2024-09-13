<?php
// about-us.php

// Include the header
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Gym Management System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Add your styles here */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-image: url('k.jpg'); /* Add your background image here */
            background-size: cover; /* Ensure the image covers the entire background */
            background-position: center; /* Center the image */
            background-repeat: no-repeat; /* Prevent the image from repeating */
        }
        header {
            background: rgba(51, 51, 51, 0.8); /* Slightly transparent header background */
            color: #fff;
            padding: 10px 0;
        }
        nav ul {
            list-style: none;
            padding: 0;
            text-align: center;
        }
        nav ul li {
            display: inline;
            margin: 0 15px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
        }
        nav ul li a:hover {
            text-decoration: underline;
        }
        .about-us {
            padding: 20px;
            max-width: 800px;
            margin: 20px auto;
            background: rgba(255, 255, 255, 0.9); /* Slightly transparent background */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            position: relative;
        }
        .back-button {
            display: block;
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            width: 150px;
            margin: 20px auto;
            font-size: 1rem;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
        .about-us h1, .about-us h2 {
            color: #333;
        }
        .about-us ul {
            list-style: disc;
            margin: 20px 0;
            padding-left: 20px;
        }
        .team-members {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .member {
            text-align: center;
            background: #f4f4f4;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        .member h3 {
            margin: 0;
            color: #333;
        }
        .member p {
            margin: 5px 0;
            color: #666;
        }
        footer {
            background: rgba(51, 51, 51, 0.8); /* Slightly transparent footer background */
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <section class="about-us">
        <h1>About Our Gym</h1>
        <p>Welcome to the Gym Management System! We are dedicated to helping you achieve your fitness goals in a supportive and motivating environment.</p>

        <h2>Our Mission</h2>
        <p>Our mission is to empower individuals to live healthier, more active lives through accessible, high-quality fitness programs, expert trainers, and state-of-the-art facilities.</p>

        <h2>Why Choose Us?</h2>
        <ul>
            <li>State-of-the-art equipment and facilities</li>
            <li>A wide variety of fitness classes and programs</li>
            <li>Certified and experienced trainers</li>
            <li>Personalized training plans and consultations</li>
            <li>A supportive and welcoming fitness community</li>
        </ul>

        <h2>Meet Our Team</h2>
        <p>Our team of certified trainers and fitness experts are here to guide you through every step of your fitness journey. Whether you are a beginner or a seasoned athlete, we have the right program for you.</p>

        <div class="team-members">
            <div class="member">
                <h3>Sarah</h3>
                <p>Yoga Instructor</p>
            </div>
            <div class="member">
                <h3>John</h3>
                <p>HIIT Trainer</p>
            </div>
            <div class="member">
                <h3>Anna</h3>
                <p>Zumba Coach</p>
            </div>
        </div>

        <!-- Back Button -->
        <a href="javascript:history.back()" class="back-button">Back</a>
    </section>

    <?php
    // Include the footer
    include('footer.php');
    ?>
</body>
</html>
