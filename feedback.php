<?php
// Start the session
session_start();

// Define file path for feedback storage
$feedbackFile = 'feedback.json';

// Function to load feedback history from JSON file
function loadFeedbackHistory($filePath) {
    if (file_exists($filePath)) {
        $json = file_get_contents($filePath);
        return json_decode($json, true) ?: [];
    }
    return [];
}

// Function to save feedback history to JSON file
function saveFeedbackHistory($filePath, $feedbackHistory) {
    file_put_contents($filePath, json_encode($feedbackHistory, JSON_PRETTY_PRINT));
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $feedback = htmlspecialchars($_POST['feedback']);

    // Retrieve existing feedback history
    $feedbackHistory = loadFeedbackHistory($feedbackFile);

    // Add new feedback to history
    $feedbackHistory[] = [
        'name' => $name,
        'email' => $email,
        'feedback' => $feedback
    ];

    // Save updated feedback history
    saveFeedbackHistory($feedbackFile, $feedbackHistory);

    // Redirect to avoid form resubmission on refresh
    header('Location: feedback.php');
    exit();
}

// Handle feedback deletion
if (isset($_GET['delete'])) {
    $index = intval($_GET['delete']);

    // Retrieve existing feedback history
    $feedbackHistory = loadFeedbackHistory($feedbackFile);

    // Remove feedback entry
    if (isset($feedbackHistory[$index])) {
        unset($feedbackHistory[$index]);
        $feedbackHistory = array_values($feedbackHistory); // Reindex array
        saveFeedbackHistory($feedbackFile, $feedbackHistory);
    }

    // Redirect to refresh page
    header('Location: feedback.php');
    exit();
}

// Load feedback history
$feedbackHistory = loadFeedbackHistory($feedbackFile);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Feedback</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('ni.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        nav {
            background-color: rgba(0, 0, 0, 0.8);
            width: 100%;
            padding: 10px 0;
            position: absolute;
            top: 0;
            left: 0;
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

        .feedback-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .back-button {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            display: block;
            margin: 20px auto 0;
            width: 150px;
            font-size: 1rem;
            text-decoration: none;
            text-align: center;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            cursor: pointer;
            border: none;
            padding: 12px;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .feedback-history {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        .feedback-entry {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            position: relative;
        }

        .feedback-entry p {
            margin: 5px 0;
        }

        .delete-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .delete-button:hover {
            background-color: #c82333;
        }

    </style>
</head>
<body>
    <nav>
        <ul class="nav-list">
            <li><a href="home.html">Home</a></li>
            <li><a href="user details.html">User Details</a></li>
            <li><a href="membership.html">Membership</a></li>
            <li><a href="classes.html">Classes</a></li>
            <li><a href="trainers.html">Trainers</a></li>
            <li><a href="payment.html">Payment</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="about -us.html">About Us</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <li><a href="logout.html">Logout</a></li>
        </ul>
    </nav>

    <div class="feedback-container">
        <h2>Feedback Form</h2>
        <form action="feedback.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="feedback">Feedback:</label>
            <textarea id="feedback" name="feedback" rows="5" required></textarea>

            <input type="submit" value="Submit Feedback">
        </form>
        <div class="feedback-history">
            <h3>Feedback History</h3>
            <?php foreach ($feedbackHistory as $index => $entry): ?>
                <div class="feedback-entry">
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($entry['name']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($entry['email']); ?></p>
                    <p><strong>Feedback:</strong> <?php echo htmlspecialchars($entry['feedback']); ?></p>
                    <a href="feedback.php?delete=<?php echo $index; ?>" class="delete-button">Delete</a>
                </div>
            <?php endforeach; ?>
        </div>
        <a href="javascript:history.back()" class="back-button">Back</a>
    </div>
</body>
</html>
