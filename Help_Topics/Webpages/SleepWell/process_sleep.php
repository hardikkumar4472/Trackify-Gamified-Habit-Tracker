<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "trackify";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bedtime = isset($_POST['bedtime']) ? $_POST['bedtime'] : '';
    $waketime = isset($_POST['waketime']) ? $_POST['waketime'] : '';
    $quality = isset($_POST['quality']) ? intval($_POST['quality']) : 0;
    $notes = isset($_POST['notes']) ? $_POST['notes'] : '';
    
    $duration = 0;
    if ($bedtime && $waketime) {
        $start = new DateTime($bedtime);
        $end = new DateTime($waketime);
        if ($end < $start) {
            $end->add(new DateInterval('P1D')); // Add 1 day if wake time is next day
        }
        $duration = $end->diff($start)->h + ($end->diff($start)->i / 60);
    }
    
    $sql = "INSERT INTO sleep_data (bedtime, waketime, duration, quality, notes, created_at)
            VALUES (?, ?, ?, ?, ?, NOW())";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdis", $bedtime, $waketime, $duration, $quality, $notes);
    
    if ($stmt->execute()) {
        echo "<script>alert('Sleep data saved successfully!'); window.location.href = 'SleepWell.php';</script>";
    } else {
        echo "<script>alert('Error saving data: " . $stmt->error . "'); window.location.href = 'SleepWell.php';</script>";
    }
    
    $stmt->close();
}

$conn->close();
?>