<?php
// Include database connection (update with your own details)
include 'db_connect.php'; 

// Initialize variables
$updateSuccess = false;
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $membershipPlan = htmlspecialchars(trim($_POST['membership-plan']));
    $joinDate = htmlspecialchars(trim($_POST['join-date']));
    $status = htmlspecialchars(trim($_POST['status']));

    // Update user details in the database
    try {
        $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email, membership_plan = :membership_plan, join_date = :join_date, status = :status WHERE id = :user_id");
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'membership_plan' => $membershipPlan,
            'join_date' => $joinDate,
            'status' => $status,
            'user_id' => $_SESSION['user_id']  // Assuming user_id is stored in session
        ]);

        $updateSuccess = true;
    } catch (Exception $e) {
        $error_message = 'Error updating details: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Basic styles for layout */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('i.jpg'); /* Add your background image here */
            background-size: cover; /* Ensure the image covers the entire background */
            background-position: center; /* Center the image */
            background-repeat: no-repeat; /* Prevent the image from repeating */
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        nav ul li {
            display: inline;
            margin: 0 10px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
        nav ul li a:hover {
            text-decoration: underline;
        }
        .user-details {
            padding: 20px;
            max-width: 800px;
            margin: 20px auto;
            background: rgba(255, 255, 255, 0.9); /* Slightly transparent background */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .user-details h1 {
            margin-top: 0;
            color: #333;
        }
        .user-details label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }
        .user-details input[type="text"], 
        .user-details input[type="email"],
        .user-details input[type="date"],
        .user-details select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .user-details .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            margin-right: 10px; /* Add space between back and save buttons */
        }
        .user-details .btn:hover {
            background-color: #0056b3;
        }
        /* Popup and overlay styles */
        .popup, .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .popup-content {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            width: 300px;
        }
        .popup.show, .overlay.show {
            display: flex;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="user-details.php">User Details</a></li>
                <li><a href="membership.html">Membership</a></li>
                <li><a href="classes.html">Classes</a></li>
                <li><a href="trainers.html">Trainers</a></li>
                <li><a href="payment.html">Payment</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="about-us.html">About Us</a></li>
                <li><a href="feedback.html">Feedback</a></li>
                <li><a href="logout.html">Logout</a></li>
            </ul>
        </nav>
    </header>
    <section class="user-details">
        <h1>Update Your Details</h1>
        <form id="user-details-form" action="update-details.php" method="post">
            <!-- Input for Name -->
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
    
            <!-- Input for Email -->
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
    
            <!-- Dropdown for Membership Plan -->
            <label for="membership-plan">Membership Plan</label>
            <select id="membership-plan" name="membership-plan" required>
                <option value="Gold" <?php if ($membershipPlan == 'Gold') echo 'selected'; ?>>Gold</option>
                <option value="Silver" <?php if ($membershipPlan == 'Silver') echo 'selected'; ?>>Silver</option>
                <option value="Bronze" <?php if ($membershipPlan == 'Bronze') echo 'selected'; ?>>Bronze</option>
            </select>
    
            <!-- Input for Join Date -->
            <label for="join-date">Join Date</label>
            <input type="date" id="join-date" name="join-date" value="<?php echo htmlspecialchars($joinDate); ?>" required>
    
            <!-- Input for Status -->
            <label for="status">Status</label>
            <input type="text" id="status" name="status" value="<?php echo htmlspecialchars($status); ?>" required>
    
            <!-- Back Button -->
            <button type="button" class="btn" id="back-button">Back</button>
            <!-- Save Button -->
            <button type="submit" class="btn">Save</button>
        </form>
    </section>

    <!-- Popup -->
    <div id="popup" class="popup <?php echo $updateSuccess ? 'show' : ''; ?>">
        <div class="popup-content">
            <h2><?php echo $updateSuccess ? 'Details Saved' : htmlspecialchars($error_message); ?></h2>
            <button onclick="closePopup()">OK</button>
        </div>
    </div>
    <div id="overlay" class="overlay <?php echo $updateSuccess ? 'show' : ''; ?>"></div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            function showPopup() {
                const popup = document.getElementById('popup');
                const overlay = document.getElementById('overlay');
                if (popup && overlay) {
                    overlay.classList.add('show');
                    popup.classList.add('show');
                }
            }

            function closePopup() {
                const popup = document.getElementById('popup');
                const overlay = document.getElementById('overlay');
                if (popup && overlay) {
                    popup.classList.remove('show');
                    overlay.classList.remove('show');
                }
            }

            document.getElementById('back-button').addEventListener('click', () => {
                window.history.back();
            });

            // Show popup if the update was successful
            <?php if ($updateSuccess): ?>
                setTimeout(() => {
                    showPopup();
                    setTimeout(() => {
                        window.location.href = 'membership.html';
                    }, 1000);
                }, 100);
            <?php endif; ?>
        });
    </script>
</body>
</html>
