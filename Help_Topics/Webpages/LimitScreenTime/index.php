<?php
$conn = new mysqli('localhost', 'root', '', 'trackify');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$conn->query("CREATE TABLE IF NOT EXISTS screen_time (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    social INT NOT NULL DEFAULT 0,
    entertainment INT NOT NULL DEFAULT 0,
    work INT NOT NULL DEFAULT 0,
    UNIQUE KEY (email, date)
)");

$conn->query("CREATE TABLE IF NOT EXISTS daily_limits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(50) NOT NULL,
    recommended_limit INT NOT NULL,
    description TEXT
)");

if ($conn->query("SELECT COUNT(*) as count FROM daily_limits")->fetch_assoc()['count'] == 0) {
    $conn->query("INSERT INTO daily_limits (category, recommended_limit, description) VALUES
        ('social', 60, 'Social media usage including Facebook, Instagram, Twitter, etc.'),
        ('entertainment', 90, 'Video streaming, gaming, and other entertainment'),
        ('work', 240, 'Productivity and work-related screen time')");
}

$email = 'abc@example.com'; // Define email at the top

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) ?: $email;
        $date = $_POST['date'];
        $social = (int)$_POST['social'];
        $entertainment = (int)$_POST['entertainment'];
        $work = (int)$_POST['work'];
        
        $stmt = $conn->prepare("INSERT INTO screen_time (email, date, social, entertainment, work) 
                               VALUES (?, ?, ?, ?, ?) 
                               ON DUPLICATE KEY UPDATE 
                               social=VALUES(social), entertainment=VALUES(entertainment), work=VALUES(work)");
        $stmt->bind_param("ssiii", $email, $date, $social, $entertainment, $work);
        $stmt->execute();
    } elseif (isset($_POST['delete'])) {
        $id = (int)$_POST['id'];
        $conn->query("DELETE FROM screen_time WHERE id = $id");
    }
}

$limits = $conn->query("SELECT * FROM daily_limits")->fetch_all(MYSQLI_ASSOC);
$recent_entries = $conn->query("SELECT * FROM screen_time 
                               WHERE email = '$email' 
                               ORDER BY date DESC LIMIT 10");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Screen Time Tracker</title>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Abril Fatface', cursive;
            background-color: #111827;
            color: #f3f4f6;
        }
        h1, h2, h3 {
            color: #f97316;
        }
        .form-container {
            background-color: #1f2937;
            border: 1px solid #374151;
        }
        label {
            color: #93c5fd;
        }
        input, select {
            background-color: #374151;
            color: white;
            border: 1px solid #4b5563;
        }
        button {
            background-color: #f97316;
            color: white;
        }
        button:hover {
            background-color: #ea580c;
        }
        table {
            color: white;
        }
        th {
            background-color: #1f2937;
            color: #f97316;
        }
        td {
            background-color: #374151;
        }
        .limit-card {
            background-color: #1e40af;
            border-left: 4px solid #f97316;
        }
    </style>
</head>
<body class="max-w-4xl mx-auto p-6">
    <h1 class="text-4xl mb-6">Screen Time Tracker</h1>
    
    <section class="mb-8">
        <h2 class="text-2xl mb-4">Recommended Daily Limits</h2>
        <div class="grid md:grid-cols-3 gap-4">
            <?php foreach ($limits as $limit): ?>
                <div class="limit-card p-4 rounded-lg">
                    <h3 class="text-xl font-bold mb-2"><?= ucfirst($limit['category']) ?></h3>
                    <p class="text-blue-200 text-2xl mb-2">≤ <?= $limit['recommended_limit'] ?> min</p>
                    <p class="text-blue-100"><?= $limit['description'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <form method="POST" class="form-container p-6 rounded-lg mb-8">
        <h2 class="text-2xl mb-4">Add Today's Screen Time</h2>
        
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block mb-2">Email</label>
                <input type="email" name="email" required class="w-full p-2 rounded" value="<?= htmlspecialchars($email) ?>">
            </div>
            <div>
                <label class="block mb-2">Date</label>
                <input type="date" name="date" required class="w-full p-2 rounded" value="<?= date('Y-m-d') ?>">
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-6 mt-4">
            <div>
                <label class="block mb-2">Social Media (minutes)</label>
                <input type="number" name="social" required class="w-full p-2 rounded" min="0">
            </div>
            <div>
                <label class="block mb-2">Entertainment (minutes)</label>
                <input type="number" name="entertainment" required class="w-full p-2 rounded" min="0">
            </div>
            <div>
                <label class="block mb-2">Work/Productivity (minutes)</label>
                <input type="number" name="work" required class="w-full p-2 rounded" min="0">
            </div>
        </div>

        <button type="submit" name="add" class="mt-6 px-6 py-3 rounded-lg text-lg">
            Save Today's Screen Time
        </button>
    </form>
    <section>
        <h2 class="text-2xl mb-4">Recent Entries</h2>
        <div class="overflow-x-auto">
            <table class="w-full rounded-lg overflow-hidden">
                <thead>
                    <tr>
                        <th class="p-3">Date</th>
                        <th class="p-3">Social</th>
                        <th class="p-3">Entertainment</th>
                        <th class="p-3">Work</th>
                        <th class="p-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($recent_entries->num_rows > 0): ?>
                        <?php while ($row = $recent_entries->fetch_assoc()): ?>
                        <tr>
                            <td class="p-3"><?= $row['date'] ?></td>
                            <td class="p-3 <?= $row['social'] > $limits[0]['recommended_limit'] ? 'text-red-400' : 'text-green-400' ?>">
                                <?= $row['social'] ?> min
                            </td>
                            <td class="p-3 <?= $row['entertainment'] > $limits[1]['recommended_limit'] ? 'text-red-400' : 'text-green-400' ?>">
                                <?= $row['entertainment'] ?> min
                            </td>
                            <td class="p-3 <?= $row['work'] > $limits[2]['recommended_limit'] ? 'text-red-400' : 'text-green-400' ?>">
                                <?= $row['work'] ?> min
                            </td>
                            <td class="p-3">
                                <form method="POST" class="inline">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button type="submit" name="delete" class="px-3 py-1 bg-red-600 hover:bg-red-700 rounded">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="p-3 text-center">No entries yet. Add your first entry above!</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>