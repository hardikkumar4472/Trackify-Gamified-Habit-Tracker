<?php
$host = 'localhost';
$dbname = 'trackify';
$username = 'root';
$password = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $errors = [];

    if (empty($firstname)) {
        $errors[] = "First name is required";
    }

    if (empty($lastname)) {
        $errors[] = "Last name is required";
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    $stmt = $pdo->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $errors[] = "Email already registered";
    }

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$firstname, $lastname, $email, $hashed_password]);
        header("Location: login.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Trackify - Registration</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="../MainPage/static/TrackifylogoNobackground.png" type="image/x-icon"/>
    <style>
        body {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .registration-title {
            font-family: 'Abril Fatface', cursive;
        }
        #img {
            filter: drop-shadow(4px 0px 70px rgb(24, 62, 255));
        }
        .input-field {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .input-field:hover {
            transform: scale(1.05);
            box-shadow: 1px 1px 12px rgba(24, 62, 255, 0.6);
            color: white;
        }

        #btnn:hover {
            /* background-color: #000000; */
            transform: scale(1.05);
            box-shadow: 4px 10px 10px rgba(0, 0, 0, 0.2);
        }
        .form-container {
            max-width: 24rem; 
            width: 100%;
        }
    </style>
</head>
<body class="light-mode bg-gray-900 flex items-center justify-center min-h-screen border-gray-200">
    <div class="bg-gray-900 rounded-3xl shadow-lg p-4 sm:p-8 w-full max-w-6xl border-2 border-green-500"> <!-- Added border-8 border-gray-200 to match login page -->
        <div class="flex flex-col md:flex-row items-center">   
            <div class="md:w-1/2 flex flex-col justify-center items-center p-4 sm:p-8">
                <div class="form-container"> <!-- Added container for consistent width -->
                    <h2 class="text-white registration-title text-xl sm:text-2xl font-semibold mb-6 mx-20">Register Here</h2>
                    <?php if (!empty($errors)): ?>
                        <div class="mb-4 p-2 bg-red-100 text-red-700 rounded">
                            <?php foreach ($errors as $error): ?>
                                <p><?php echo $error; ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <form class="w-full" id="registrationForm" method="POST" action="signup.php">
                        <div class="mb-4">
                            <input class="input-field w-full px-4 py-2 border rounded-2xl bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-600 hover:bg-gray-700 text-white" name="firstname" placeholder="First Name" type="text" required>
                        </div>
                        <div class="mb-4">
                            <input class="input-field w-full px-4 py-2 border rounded-2xl bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-600 hover:bg-gray-700 text-white" name="lastname" placeholder="Last Name" type="text" required>
                        </div>
                        <div class="mb-4">
                            <input class="input-field w-full px-4 py-2 border rounded-2xl bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-600 hover:bg-gray-700 text-white" name="email" placeholder="Email Address" type="email" required>
                        </div>
                        <div class="mb-4">
                            <input class="input-field w-full px-4 py-2 border rounded-2xl bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-600 hover:bg-gray-700 text-white" name="password" placeholder="Password" type="password" required>
                        </div>
                        <div class="mb-4">
                            <input class="input-field w-full px-4 py-2 border rounded-2xl bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-600 hover:bg-gray-700 text-white" name="confirm_password" placeholder="Confirm Password" type="password" required>
                        </div>
                        
                        <button id="btnn" class="w-full bg-orange-500 text-white py-2 rounded-3xl hover:bg-green-500 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue" type="submit">Register</button>
                        <p class="mt-4 text-center text-sm text-green-500">Already have a Trackify account? <a class="text-orange-500 hover:underline" href="login.php">Login</a></p>
                    </form>
                </div>
            </div>

            <div class="md:w-1/2 w-full">
                <img id="img" src="assets/Manexerciselogin.png" class="w-full rounded-4xl"/>
            </div>
        </div>
    </div>
</body>
</html>