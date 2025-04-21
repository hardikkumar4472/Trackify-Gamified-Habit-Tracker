<?php
session_start();

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

$login_error = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    
    if (empty($email) || empty($password)) {
        $login_error = "Email and password are required";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_firstname'] = $user['firstname'];
            
            header("Location: ../MainPage/mainpage.php");
            exit();
        } else {
            $login_error = "Invalid email or password";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Trackify - Sign In</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet"/>
    <link rel="shortcut icon" href="../MainPage/static/TrackifylogoNobackground.png" type="image/x-icon">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .font-bold {
            font-family: 'Abril Fatface', cursive;
        }
        body, p, span, h1, h2, h3, h4, h5, h6 {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: rgb(1, 1, 1)
            min-width: 160px;
            z-index: 1;
        }
        .dropdown-content a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #030303;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        #img{
            height: 500px;
            width: 500px;
            filter: drop-shadow(4px 0px 70px rgb(24, 62, 255));
        }
    </style>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen">
    <div class="bg-gray-900 rounded-3xl shadow-lg p-4 sm:p-8 max-w-6xl w-full border-2 border-green-500" id="outer">
        <nav class="flex flex-col sm:flex-row justify-between items-center mb-8">
            <div class="flex items-center mb-4 sm:mb-0">
                <img alt="HealthyMe logo" class="mr-2" height="40" src="assets/TrackifylogoNobackground.png" width="40"/>
                <span class="text-lg font-bold text-blue-600">Trackify</span>
            </div>
            <div class="flex items-center space-x-4 mt-4 sm:mt-0 text-sm">
                <div class="relative dropdown">
                    <button class="text-orange-500 hover:text-blue-600 transition duration-300">
                        English
                        <i class="fas fa-chevron-down ml-1"></i>
                    </button>
                    <div class="dropdown-content bg-amber-950">
                        <a href="#" onclick="changeLanguage('en')">English</a>
                        <a href="#" onclick="changeLanguage('es')">Spanish</a>
                        <a href="#" onclick="changeLanguage('fr')">French</a>
                        <a href="#" onclick="changeLanguage('de')">German</a>
                        <a href="#" onclick="changeLanguage('it')">Italian</a>
                        <a href="#" onclick="changeLanguage('pt')">Portuguese</a>
                        <a href="#" onclick="changeLanguage('ru')">Russian</a>
                        <a href="#" onclick="changeLanguage('zh')">Chinese</a>
                        <a href="#" onclick="changeLanguage('ja')">Japanese</a>
                        <a href="#" onclick="changeLanguage('ko')">Korean</a>
                    </div>
                </div>
                <a class="text-white hover:text-blue-600 transition duration-300" href="login.php">Sign in</a>
                <a class="bg-blue-600 text-white px-4 py-1.5 rounded-lg hover:bg-blue-700 transition duration-300" href="signup.php">Register</a>
            </div>
        </nav>
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 flex flex-col justify-center items-start p-4 sm:p-8 relative">
                <div class="absolute inset-0 bg-grey-900 rounded-lg -z-10"></div>
                <h1 class="text-2xl text-white sm:text-3xl font-bold mb-4 font-bold" id="signInText">Sign In to get Personalized Trcaker</h1>
                <p class="text-sm text-green-500 mb-4" id="registerText">
                    if you don't have an account you can
                    <a class="text-blue-600 hover:text-orange-500" href="signup.php">Register here!</a>
                </p>
            </div>
            <div class="hidden md:block">
                <img id="img" alt="Fit man exercising" class="h-96" src="assets/Manexerciselogin.png"/>
            </div>
            <div class="md:w-1/2 flex flex-col justify-center items-center p-4 sm:p-8">
                <h2 class="text-xl sm:text-2xl font-bold mb-6 font-bold text-white" id="welcomeBackText">Welcome Back</h2>
                <?php if (!empty($login_error)): ?>
                    <div class="mb-4 text-red-500 text-sm"><?php echo $login_error; ?></div>
                <?php endif; ?>
                <form class="w-full max-w-sm" id="loginForm" method="POST" action="login.php">
                    <div class="mb-4">
                        <input class="text-white w-full px-4 py-2 border rounded-2xl bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-600 hover:bg-gray-700 hover:scale-105 transition duration-300" 
                               id="email" name="email" placeholder="Enter Email" type="email" required/>
                    </div>
                    <div class="mb-4">
                        <input class="text-white w-full px-4 py-2 border rounded-2xl bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-600 hover:bg-gray-700 hover:scale-105 transition duration-300" 
                               id="password" name="password" placeholder="Password" type="password" required/>
                    </div>
                    <div class="flex justify-between items-center mb-6">
                        <a class="text-xs text-white" href="#">Recover Password?</a>
                    </div>
                    <button class="w-full bg-orange-500 text-white py-1.5 rounded-3xl hover:bg-green-700 transition duration-300" 
                            type="submit">Sign In</button>
                </form>
                <div class="my-6 text-sm text-white" id="continueWithText">Or continue with</div>
                <div class="flex space-x-4">
                    <button class="bg-grey-900 border rounded-lg p-2 flex items-center justify-center w-12 h-12">
                        <img alt="Google logo" height="24" src="assets/googlelogo-removebg-preview.png" width="24"/>
                    </button>
                    <button class="bg-grey-900 border rounded-lg p-2 flex items-center justify-center w-12 h-12">
                        <img alt="Apple logo" height="70" src="assets/apple-logooooooo-removebg-preview.png" width="70"/>
                    </button>
                    <button class="bg-grey-900 border rounded-lg p-2 flex items-center justify-center w-12 h-12">
                        <img alt="Facebook logo" height="24" src="assets/fblogo.png" width="24"/>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const translations = {
            en: {
                signInText: "Sign In to get your nutrients",
                registerText: "if you don't have an account you can Register here!",
                welcomeBackText: "Welcome Back",
                continueWithText: "Or continue with"
            },
            es: {
                signInText: "Inicia sesión para obtener tus nutrientes",
                registerText: "si no tienes una cuenta puedes Registrarte aquí!",
                welcomeBackText: "Bienvenido de nuevo",
                continueWithText: "O continúa con"
            },
            fr: {
                signInText: "Connectez-vous para obtener tus nutrientes",
                registerText: "si vous n'avez pas de compte, vous pouvez vous inscrire ici!",
                welcomeBackText: "Bon retour",
                continueWithText: "Ou continuez avec"
            },
            de: {
                signInText: "Melden Sie sich an, um Ihre Nährstoffe zu erhalten",
                registerText: "wenn Sie kein Konto haben, können Sie sich hier registrieren!",
                welcomeBackText: "Willkommen zurück",
                continueWithText: "Oder weiter mit"
            },
            it: {
                signInText: "Accedi per ottenere i tuoi nutrienti",
                registerText: "se non hai un account puoi registrarti qui!",
                welcomeBackText: "Bentornato",
                continueWithText: "O continua con"
            },
            pt: {
                signInText: "Faça login para obter seus nutrientes",
                registerText: "se você não tem uma conta, pode se registrar aqui!",
                welcomeBackText: "Bem-vindo de volta",
                continueWithText: "Ou continue com"
            },
            ru: {
                signInText: "Войдите, чтобы получить свои питательные вещества",
                registerText: "если у вас нет учетной записи, вы можете зарегистрироваться здесь!",
                welcomeBackText: "Добро пожаловать обратно",
                continueWithText: "Или продолжить с"
            },
            zh: {
                signInText: "登录以获取您的营养",
                registerText: "如果您没有帐户，可以在这里注册!",
                welcomeBackText: "欢迎回来",
                continueWithText: "或继续使用"
            },
            ja: {
                signInText: "栄養を摂取するためにサインイン",
                registerText: "アカウントをお持ちでない場合は、ここで登録できます!",
                welcomeBackText: "お帰りなさい",
                continueWithText: "または続行"
            },
            ko: {
                signInText: "영양소를 얻으려면 로그인하세요",
                registerText: "계정이 없으시면 여기에서 등록하세요!",
                welcomeBackText: "다시 오신 것을 환영합니다",
                continueWithText: "또는 계속"
            }
        };

        function changeLanguage(lang) {
            document.getElementById('signInText').innerText = translations[lang].signInText;
            document.getElementById('registerText').innerHTML = translations[lang].registerText;
            document.getElementById('welcomeBackText').innerText = translations[lang].welcomeBackText;
            document.getElementById('continueWithText').innerText = translations[lang].continueWithText;
        }

        document.getElementById('toggle-dark-mode').addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            this.textContent = document.body.classList.contains('dark-mode') ? 'Go Light' : 'Go Dark';
        });
    </script>
</body>
</html>