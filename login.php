<?php
// Include database connection (update with your own details)
include 'db_connect.php';

// Initialize variables
$username = $password = '';
$error_message = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];

    // Username validation: only alphabets
    if (!preg_match('/^[A-Za-z]+$/', $username)) {
        $error_message = 'Username must contain only alphabets.';
    } else {
        // Prepare and execute the query
        $stmt = $pdo->prepare("SELECT password FROM users WHERE name = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Password is correct, redirect to home page
            header('Location: home.php');
            exit();
        } else {
            $error_message = 'Invalid username or password.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url('char.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        #login-form {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #login-form h2 {
            margin-bottom: 20px;
            font-weight: 700;
            color: #333;
        }

        #login-form input {
            display: block;
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        #login-form button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        #login-form button:hover {
            background-color: #0056b3;
        }

        #login-form button:active {
            background-color: #004494;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

        @media (max-width: 480px) {
            #login-form {
                width: 90%;
                padding: 15px;
            }

            #login-form input, #login-form button {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <!-- Login Form -->
    <form id="login-form" method="post" action="login.php">
        <h2>Login</h2>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required placeholder="Username">
        <input type="password" id="password" name="password" required placeholder="Password">
        <button type="submit">Login</button>
        <?php if (!empty($error_message)): ?>
            <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
    </form>

</body>
</html>
