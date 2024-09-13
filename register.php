<?php
// Include database connection (update with your own details)
include 'db_connect.php';

// Initialize variables
$name = $email = $password = $confirm_password = '';
$errors = [];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Password validation
    $password_regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
    if (!preg_match($password_regex, $password)) {
        $errors[] = 'Password must be at least 8 characters long and include one uppercase letter, one lowercase letter, one number, and one special character.';
    }

    if ($password !== $confirm_password) {
        $errors[] = 'Passwords do not match.';
    }

    if (empty($errors)) {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert into database
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $hashed_password]);

        // Redirect to login page
        header('Location: login.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Gym Management System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            padding: 10px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
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

        .contact-us {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .contact-us h1 {
            color: black;
            text-align: center;
            margin-bottom: 20px;
        }

        .contact-us label {
            display: block;
            margin-bottom: 5px;
            color: black;
        }

        .contact-us input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid black;
            border-radius: 4px;
        }

        .contact-us button {
            background-color: green;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        .contact-us button:hover {
            background-color: darkgreen;
        }

        .contact-us p {
            text-align: center;
        }

        .contact-us a {
            color: blue;
            text-decoration: underline;
        }

        .contact-us a:hover {
            text-decoration: none;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            z-index: 1000;
        }

        .popup h2 {
            margin-top: 0;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <!-- Navigation options omitted for registration page -->
        </nav>
    </header>
    
    <section class="contact-us">
        <h1>Register</h1>
        <?php if (!empty($errors)): ?>
            <div class="error-messages">
                <?php foreach ($errors as $error): ?>
                    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="register.php" method="post" id="register-form">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirm-password" required>
            <button type="submit" id="register-btn">Register</button>
        </form>
        <p>Already registered? <a href="login.php">Login here</a></p>
    </section>

    <!-- Popup for registration success -->
    <div id="popup" class="popup">
        <h2>Registration Successful!</h2>
        <button onclick="window.location.href='login.php'">Proceed to Login</button>
    </div>
    <div id="overlay" class="overlay"></div>

    <script>
        // JavaScript for showing the popup
        document.addEventListener('DOMContentLoaded', function() {
            const popup = document.getElementById('popup');
            const overlay = document.getElementById('overlay');

            if (<?php echo !empty($success) ? 'true' : 'false'; ?>) {
                popup.style.display = 'block';
                overlay.style.display = 'block';

                // Redirect to login page after a few seconds
                setTimeout(function() {
                    window.location.href = 'login.php';
                }, 2000); // 2000 milliseconds = 2 seconds
            }
        });
    </script>
</body>
</html>
