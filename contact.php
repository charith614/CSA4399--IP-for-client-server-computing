<?php
// Initialize variables for form data and errors
$name = $email = $message = "";
$errors = [];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate form data
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email is required.";
    }
    if (empty($message)) {
        $errors[] = "Message cannot be empty.";
    }

    // If no errors, process the form
    if (empty($errors)) {
        // Example: send email
        $to = "your-email@example.com"; // Replace with your email address
        $subject = "Contact Form Submission from $name";
        $body = "Name: $name\nEmail: $email\nMessage:\n$message";
        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            $success = "Your message has been sent successfully.";
        } else {
            $errors[] = "Failed to send message. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="style.css">
    <script src="scripts.js" defer></script>
    <style>
        /* Additional styles for the back button */
        .back-button {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-align: center;
            display: block;
            margin: 20px auto;
            width: 150px;
            font-size: 1rem;
            text-decoration: none;
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
                <li><a href="home.html">Home</a></li>
                <li><a href="user details.html">User-details</a></li>
                <li><a href="membership.html">Membership</a></li>
                <li><a href="classes.html">Classes</a></li>
                <li><a href="trainers.html">Trainers</a></li>
                <li><a href="payment.html">Payment</a></li> <!-- Added Payment link -->
                <li><a href="contact.php">Contact</a></li>
                <li><a href="about -us.html">About Us</a></li>
                <li><a href="feedback.html">Feedback</a></li>
                <li><a href="logout.html">Logout</a></li> <!-- Login link after logging out -->
            </ul>
        </nav>
    </header>
    <section class="contact-us">
        <a href="javascript:history.back()" class="back-button">Back</a>
        <h1>Contact Us</h1>
        <?php if (!empty($success)): ?>
            <p style="color: green;"><?php echo htmlspecialchars($success); ?></p>
        <?php endif; ?>
        <?php if (!empty($errors)): ?>
            <ul style="color: red;">
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <form id="contact-form" action="contact.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" value="<?php echo htmlspecialchars($name); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($email); ?>" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" placeholder="Your message" required><?php echo htmlspecialchars($message); ?></textarea>

            <button type="submit">Send Message</button>
        </form>
    </section>
</body>
</html>
