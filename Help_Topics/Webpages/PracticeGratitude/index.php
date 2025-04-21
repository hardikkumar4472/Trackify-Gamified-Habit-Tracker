<?php
require 'config.php';
$entries = [];
$result = $conn->query("SELECT * FROM gratitude_entries ORDER BY entry_date DESC");
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $entries[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gratitude Journal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #111827;
        }
        .gratitude-card {
            transition: all 0.3s ease;
        }
        .gratitude-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        }
        .mood-1 { background-color: #450a0a; color: white; } /* Sad */
        .mood-2 { background-color: #78350f; color: white; } /* Neutral */
        .mood-3 { background-color: #064e3b; color: white; } /* Happy */
        .mood-4 { background-color: #1e40af; color: white; } /* Very Happy */
        .mood-5 { background-color: #5b21b6; color: white; } /* Excited */
        .abril-font {
            font-family: 'Abril Fatface', serif;
        }
    </style>
</head>
<body class="min-h-screen bg-gray-900">
    <div class="container mx-auto px-4 py-12">
        <!-- Header -->
        <header class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-blue-400 mb-4 abril-font">
                <i class="fas fa-heart text-orange-400 mr-2"></i> Gratitude Journal
            </h1>
            <p class="text-xl text-white max-w-2xl mx-auto abril-font">
                "Gratitude turns what we have into enough." - Aesop
            </p>
        </header>

        <!-- Benefits Section -->
        <section class="bg-gray-800 rounded-xl shadow-md p-6 mb-12">
            <h2 class="text-2xl font-bold text-orange-400 mb-4 abril-font">Why Practice Gratitude?</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-gray-700 p-4 rounded-lg">
                    <div class="text-blue-400 text-2xl mb-2">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3 class="font-semibold text-white mb-2 abril-font">Improves Mental Health</h3>
                    <p class="text-gray-300">Regular gratitude practice reduces stress, anxiety, and depression while increasing happiness.</p>
                </div>
                <div class="bg-gray-700 p-4 rounded-lg">
                    <div class="text-orange-400 text-2xl mb-2">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h3 class="font-semibold text-white mb-2 abril-font">Better Physical Health</h3>
                    <p class="text-gray-300">Grateful people experience fewer aches and pains and report feeling healthier.</p>
                </div>
                <div class="bg-gray-700 p-4 rounded-lg">
                    <div class="text-blue-400 text-2xl mb-2">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="font-semibold text-white mb-2 abril-font">Stronger Relationships</h3>
                    <p class="text-gray-300">Expressing appreciation improves relationships and helps you make new friends.</p>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Gratitude Form -->
            <div class="bg-gray-800 p-6 rounded-xl shadow-md">
                <h2 class="text-2xl font-bold text-blue-400 mb-4 abril-font">Today's Gratitude Entry</h2>
                <form id="gratitudeForm" action="process_entry.php" method="POST">
                    <div class="mb-4">
                        <label for="entry_date" class="block text-white mb-2">Date</label>
                        <input type="date" id="entry_date" name="entry_date" 
                               class="w-full px-4 py-2 bg-gray-700 text-white border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="entry_text" class="block text-white mb-2">What are you grateful for today?</label>
                        <textarea id="entry_text" name="entry_text" rows="4"
                                  class="w-full px-4 py-2 bg-gray-700 text-white border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="I'm grateful for..." required></textarea>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-white mb-2">How was your day?</label>
                        <div class="flex justify-between">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <label class="flex flex-col items-center cursor-pointer">
                                    <input type="radio" name="mood" value="<?php echo $i; ?>" 
                                           class="mb-1" <?php echo $i == 3 ? 'checked' : ''; ?>>
                                    <span class="text-2xl">
                                        <?php 
                                        switch($i) {
                                            case 1: echo '😞'; break;
                                            case 2: echo '😐'; break;
                                            case 3: echo '🙂'; break;
                                            case 4: echo '😊'; break;
                                            case 5: echo '😁'; break;
                                        }
                                        ?>
                                    </span>
                                </label>
                            <?php endfor; ?>
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-medium transition-colors abril-font">
                        <i class="fas fa-save mr-2"></i> Save Entry
                    </button>
                </form>
            </div>

            <!-- Gratitude Statistics -->
            <div class="bg-gray-800 p-6 rounded-xl shadow-md">
                <h2 class="text-2xl font-bold text-orange-400 mb-4 abril-font">Your Gratitude Journey</h2>
                
                <?php if (count($entries) > 0): ?>
                    <!-- Mood Chart -->
                    <div class="mb-8">
                        <canvas id="moodChart" height="200"></canvas>
                    </div>
                    
                    <!-- Recent Entries -->
                    <h3 class="text-xl font-semibold text-white mb-3 abril-font">Recent Entries</h3>
                    <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
                        <?php foreach (array_slice($entries, 0, 5) as $entry): ?>
                            <div class="gratitude-card p-4 rounded-lg border border-gray-700 mood-<?php echo $entry['mood']; ?>">
                                <div class="flex justify-between items-start mb-1">
                                    <span class="font-medium text-white">
                                        <?php echo date('M j, Y', strtotime($entry['entry_date'])); ?>
                                    </span>
                                    <span class="text-2xl">
                                        <?php 
                                        switch($entry['mood']) {
                                            case 1: echo '😞'; break;
                                            case 2: echo '😐'; break;
                                            case 3: echo '🙂'; break;
                                            case 4: echo '😊'; break;
                                            case 5: echo '😁'; break;
                                        }
                                        ?>
                                    </span>
                                </div>
                                <p class="text-gray-200"><?php echo htmlspecialchars($entry['entry_text']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <?php if (count($entries) > 5): ?>
                        <a href="#" id="showAllEntries" class="block text-center mt-4 text-blue-400 hover:text-blue-300 abril-font">
                            Show all <?php echo count($entries); ?> entries <i class="fas fa-chevron-down ml-1"></i>
                        </a>
                        <div id="allEntries" class="hidden space-y-4 mt-4 max-h-96 overflow-y-auto pr-2">
                            <?php foreach (array_slice($entries, 5) as $entry): ?>
                                <div class="gratitude-card p-4 rounded-lg border border-gray-700 mood-<?php echo $entry['mood']; ?>">
                                    <div class="flex justify-between items-start mb-1">
                                        <span class="font-medium text-white">
                                            <?php echo date('M j, Y', strtotime($entry['entry_date'])); ?>
                                        </span>
                                        <span class="text-2xl">
                                            <?php 
                                            switch($entry['mood']) {
                                                case 1: echo '😞'; break;
                                                case 2: echo '😐'; break;
                                                case 3: echo '🙂'; break;
                                                case 4: echo '😊'; break;
                                                case 5: echo '😁'; break;
                                            }
                                            ?>
                                        </span>
                                    </div>
                                    <p class="text-gray-200"><?php echo htmlspecialchars($entry['entry_text']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="text-center py-8">
                        <div class="text-5xl mb-4 text-white">📝</div>
                        <h3 class="text-xl font-medium text-white mb-2 abril-font">No entries yet</h3>
                        <p class="text-gray-400">Start your gratitude journey by making your first entry!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show all entries toggle
            const showAllBtn = document.getElementById('showAllEntries');
            if (showAllBtn) {
                showAllBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const allEntries = document.getElementById('allEntries');
                    allEntries.classList.toggle('hidden');
                    this.innerHTML = allEntries.classList.contains('hidden') ? 
                        `Show all <?php echo count($entries); ?> entries <i class="fas fa-chevron-down ml-1"></i>` : 
                        `Show less <i class="fas fa-chevron-up ml-1"></i>`;
                });
            }

            // Mood Chart
            <?php if (count($entries) > 0): ?>
                const moodCtx = document.getElementById('moodChart').getContext('2d');
                const moodChart = new Chart(moodCtx, {
                    type: 'line',
                    data: {
                        labels: <?php echo json_encode(array_map(function($e) { 
                            return date('M j', strtotime($e['entry_date'])); 
                        }, array_slice($entries, 0, 14))); ?>,
                        datasets: [{
                            label: 'Daily Mood',
                            data: <?php echo json_encode(array_map(function($e) { 
                                return $e['mood']; 
                            }, array_slice($entries, 0, 14))); ?>,
                            backgroundColor: 'rgba(59, 130, 246, 0.2)',
                            borderColor: 'rgba(59, 130, 246, 1)',
                            borderWidth: 2,
                            tension: 0.3,
                            pointBackgroundColor: function(context) {
                                const value = context.dataset.data[context.dataIndex];
                                const colors = [
                                    'rgba(239, 68, 68, 1)', // 1
                                    'rgba(234, 179, 8, 1)',  // 2
                                    'rgba(34, 197, 94, 1)',  // 3
                                    'rgba(59, 130, 246, 1)', // 4
                                    'rgba(139, 92, 246, 1)'  // 5
                                ];
                                return colors[value - 1];
                            },
                            pointRadius: 6
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: false,
                                min: 1,
                                max: 5,
                                ticks: {
                                    stepSize: 1,
                                    callback: function(value) {
                                        const emojis = ['😞', '😐', '🙂', '😊', '😁'];
                                        return emojis[value - 1];
                                    }
                                },
                                grid: {
                                    color: 'rgba(255, 255, 255, 0.1)'
                                }
                            },
                            x: {
                                grid: {
                                    color: 'rgba(255, 255, 255, 0.1)'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                labels: {
                                    color: 'white'
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const moods = [
                                            'Very Bad',
                                            'Not Great',
                                            'Neutral',
                                            'Good',
                                            'Excellent'
                                        ];
                                        return moods[context.raw - 1];
                                    }
                                }
                            }
                        }
                    }
                });
            <?php endif; ?>

            // Form submission with feedback
            const form = document.getElementById('gratitudeForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(this);
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalBtnText = submitBtn.innerHTML;
                    
                    // Show loading state
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Saving...';
                    
                    fetch(this.action, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Show success message
                            const successDiv = document.createElement('div');
                            successDiv.className = 'fixed top-4 right-4 bg-green-800 border border-green-600 text-white px-6 py-4 rounded-lg shadow-lg z-50';
                            successDiv.innerHTML = `
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle text-green-300 mr-2"></i>
                                    <span>${data.message}</span>
                                </div>
                            `;
                            document.body.appendChild(successDiv);

                            setTimeout(() => {
                                successDiv.classList.add('opacity-0', 'transition-opacity', 'duration-300');
                                setTimeout(() => successDiv.remove(), 300);
                            }, 3000);
                            
                            this.reset();
                            document.getElementById('entry_date').value = '<?php echo date('Y-m-d'); ?>';

                            setTimeout(() => location.reload(), 1000);
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred. Please try again.');
                    })
                    .finally(() => {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalBtnText;
                    });
                });
            }
        });
    </script>
</body>
</html>