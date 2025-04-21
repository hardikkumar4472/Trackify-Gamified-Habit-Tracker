
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="MainPage/static/TrackifylogoNobackground.png" type="image/x-icon">
</head>
<body>
    <div class="loader">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="container">
        <h1>Welcome to Trackify</h1>
        <div class="typewriter">A personalized habit tracker. Join us today!</div>
        <div class="button-container">
            <a href="login-signup/login.php" class="button">Let's Begin</a>
        </div>
    </div>
    <script>
        window.onload = function() {
            const loader = document.querySelector('.loader');
            const container = document.querySelector('.container');
            loader.style.display = 'none'; 
            container.style.opacity = '2';
        };
    </script>
</body>
</html>