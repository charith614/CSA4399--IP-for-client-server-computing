<?php
// Start the session
session_start();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables
    $selectedClasses = [];
    $classPrices = [];

    // Collect selected classes and their prices
    if (isset($_POST['class'])) {
        foreach ($_POST['class'] as $class) {
            // Assuming prices are passed as part of the form
            $classPrices[$class] = $_POST['class-price'][$class];
        }
        $selectedClasses = $_POST['class'];
        
        // Save selected classes and prices in session
        $_SESSION['selectedClasses'] = $selectedClasses;
        $_SESSION['classPrices'] = $classPrices;

        // Redirect to the membership page
        header('Location: membership.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Classes</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* General styling */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background: url('n.jpg') no-repeat center center fixed; /* Background image */
            background-size: cover; /* Make the background cover the entire screen */
        }

        h1 {
            text-align: center;
            color: #fff; /* Changed to white to stand out on the background */
            margin-top: 30px;
            font-size: 2.5rem;
            font-weight: bold;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.7); /* Deeper text shadow */
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 25px;
            background-color: rgba(255, 255, 255, 0.95); /* Slightly higher transparency */
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* Larger shadow for more depth */
        }

        .class-option {
            display: flex;
            align-items: center;
            background-color: #f9f9f9;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 10px;
            font-size: 1.2rem;
            color: #333;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .class-option:hover {
            background-color: #e0e7ff; /* Light blue on hover */
            transform: scale(1.02); /* Slightly enlarge on hover */
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .class-option img {
            width: 60px;
            height: 60px;
            margin-right: 20px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #007bff;
        }

        input[type="checkbox"] {
            margin-right: 15px;
            transform: scale(1.2); /* Larger checkboxes */
        }

        button {
            display: block;
            width: 100%;
            padding: 15px;
            background: linear-gradient(45deg, #007bff, #00aaff); /* Gradient background */
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        button:hover {
            background: linear-gradient(45deg, #0056b3, #007bff); /* Darker gradient on hover */
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2); /* Shadow on hover */
        }

        /* Grid layout for the class options */
        .class-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
        }

        /* Media queries for responsiveness */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            .container {
                margin: 20px;
                padding: 20px;
            }

            button {
                padding: 12px;
                font-size: 1rem;
            }

            .class-option img {
                width: 50px;
                height: 50px;
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

        /* Button styling for back button */
        .back-button {
            background: #6c757d; /* Gray background */
            margin-bottom: 10px; /* Space between back and continue buttons */
        }
    </style>
</head>
<body>
    <nav>
        <ul class="nav-list">
            <li><a href="home.html">Home</a></li>
            <li><a href="user-details.php">User Details</a></li>
            <li><a href="membership.php">Membership</a></li>
            <li><a href="classes.php">Classes</a></li>
            <li><a href="trainers.php">Trainers</a></li>
            <li><a href="payment.php">Payment</a></li> <!-- Added Payment link -->
            <li><a href="contact.php">Contact</a></li>
            <li><a href="about-us.php">About Us</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <h1>Select Your Classes</h1>
    <div class="container">
        <form id="classes-form" action="select-classes.php" method="post">
            <div class="class-grid">
                <label class="class-option">
                    <img src="yoga.jpg" alt="Yoga Class">
                    <input type="checkbox" name="class[]" value="Yoga Class" data-price="50"> Yoga Class ($50)
                </label>
                <label class="class-option">
                    <img src="zumba.jpg" alt="Zumba Class">
                    <input type="checkbox" name="class[]" value="Zumba Class" data-price="30"> Zumba Class ($30)
                </label>
                <label class="class-option">
                    <img src="pilates.jpg" alt="Pilates Class">
                    <input type="checkbox" name="class[]" value="Pilates Class" data-price="40"> Pilates Class ($40)
                </label>
                <label class="class-option">
                    <img src="boxing.jpg" alt="Boxing Class">
                    <input type="checkbox" name="class[]" value="Boxing Class" data-price="45"> Boxing Class ($45)
                </label>
                <label class="class-option">
                    <img src="spinning.jpg" alt="Spinning Class">
                    <input type="checkbox" name="class[]" value="Spinning Class" data-price="35"> Spinning Class ($35)
                </label>
                <label class="class-option">
                    <img src="crossfit.jpg" alt="CrossFit Class">
                    <input type="checkbox" name="class[]" value="CrossFit Class" data-price="60"> CrossFit Class ($60)
                </label>
            </div>
            <button type="button" class="back-button" id="back-button">Back</button>
            <button type="submit">Save Classes and Continue</button>
        </form>
    </div>

    <script>
        document.getElementById('classes-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const selectedClasses = [];
            const classPrices = {};

            // Collect selected classes and their prices
            document.querySelectorAll('input[name="class[]"]:checked').forEach(function(checkbox) {
                selectedClasses.push(checkbox.value);
                classPrices[checkbox.value] = checkbox.getAttribute('data-price');
            });

            // Append class prices to form
            selectedClasses.forEach(function(className) {
                const hiddenPriceInput = document.createElement('input');
                hiddenPriceInput.type = 'hidden';
                hiddenPriceInput.name = 'class-price[' + className + ']';
                hiddenPriceInput.value = classPrices[className];
                document.getElementById('classes-form').appendChild(hiddenPriceInput);
            });

            // Submit the form
            document.getElementById('classes-form').submit();
        });

        document.getElementById('back-button').addEventListener('click', function() {
            // Redirect to the previous page
            window.history.back();
        });
    </script>
</body>
</html>
