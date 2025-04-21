
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sleep Well - Prioritize Quality Rest</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'sleep-green': '#10B981',
                        'sleep-blue': '#3B82F6',
                        'sleep-light': '#E5E7EB',
                    },
                    fontFamily: {
                        'abril': ['Abril Fatface', 'serif'],
                        'sans': ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        .sleep-gradient {
            background: linear-gradient(135deg, #1F2937 0%, #111827 100%);
        }
        .sleep-card {
            transition: all 0.3s ease;
        }
        .sleep-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="font-sans bg-gray-900 text-gray-100">
    <!-- Header -->
    <header class="sleep-gradient text-white py-16 px-4 md:px-0">
        <div class="container mx-auto max-w-4xl text-center">
            <h1 class="font-abril text-4xl md:text-5xl font-bold mb-4 text-sleep-green">Sleep Well</h1>
            <p class="text-xl md:text-2xl mb-8">Prioritize quality rest for better performance and mood</p>
            <button id="trackSleepBtn" class="bg-sleep-green text-white px-6 py-3 rounded-full font-semibold hover:bg-green-600 transition duration-300">
                Start Tracking Your Sleep
            </button>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto max-w-6xl py-12 px-4">
        <!-- Benefits Section -->
        <section class="mb-16">
            <h2 class="font-abril text-3xl font-bold text-sleep-blue mb-8 text-center">Why Quality Sleep Matters</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="sleep-card bg-gray-800 p-6 rounded-xl shadow-md">
                    <div class="text-sleep-green text-4xl mb-4">💪</div>
                    <h3 class="text-xl font-semibold mb-2">Physical Performance</h3>
                    <p class="text-gray-400">Quality sleep enhances muscle recovery, coordination, and athletic performance by 20-30%.</p>
                </div>
                <div class="sleep-card bg-gray-800 p-6 rounded-xl shadow-md">
                    <div class="text-sleep-blue text-4xl mb-4">🧠</div>
                    <h3 class="text-xl font-semibold mb-2">Cognitive Function</h3>
                    <p class="text-gray-400">Sleep improves memory consolidation, problem-solving skills, and creativity.</p>
                </div>
                <div class="sleep-card bg-gray-800 p-6 rounded-xl shadow-md">
                    <div class="text-sleep-green text-4xl mb-4">😊</div>
                    <h3 class="text-xl font-semibold mb-2">Emotional Wellbeing</h3>
                    <p class="text-gray-400">Proper rest regulates emotions, reduces stress, and decreases risk of depression.</p>
                </div>
            </div>
        </section>

        <!-- Sleep Stages Visualization -->
        <section class="mb-16">
            <h2 class="font-abril text-3xl font-bold text-sleep-blue mb-8 text-center">Understanding Sleep Cycles</h2>
            <div class="bg-gray-800 p-6 rounded-xl shadow-md">
                <div class="h-64 mb-6 relative" id="sleepChartContainer">
                    <canvas id="sleepChart"></canvas>
                </div>
                <div class="grid md:grid-cols-4 gap-4">
                    <div class="p-4 border-l-4 border-sleep-light">
                        <h4 class="font-semibold">Awake</h4>
                        <p class="text-sm text-gray-400">Transition periods</p>
                    </div>
                    <div class="p-4 border-l-4 border-sleep-blue">
                        <h4 class="font-semibold">Light Sleep</h4>
                        <p class="text-sm text-gray-400">50-60% of night</p>
                    </div>
                    <div class="p-4 border-l-4 border-sleep-green">
                        <h4 class="font-semibold">Deep Sleep</h4>
                        <p class="text-sm text-gray-400">Physical restoration</p>
                    </div>
                    <div class="p-4 border-l-4 border-purple-400">
                        <h4 class="font-semibold">REM Sleep</h4>
                        <p class="text-sm text-gray-400">Mental restoration</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sleep Tracker Form -->
        <section class="bg-gray-800 text-white p-8 rounded-xl shadow-lg">
            <h2 class="font-abril text-2xl font-bold mb-6 text-sleep-green">Track Your Sleep</h2>
            <form id="sleepForm" action="process_sleep.php" method="POST" class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="bedtime" class="block mb-2">Bedtime</label>
                    <input type="time" id="bedtime" name="bedtime" class="w-full p-3 rounded text-gray-800" required>
                </div>
                <div>
                    <label for="waketime" class="block mb-2">Wake Time</label>
                    <input type="time" id="waketime" name="waketime" class="w-full p-3 rounded text-gray-800" required>
                </div>
                <div>
                    <label for="quality" class="block mb-2">Sleep Quality (1-10)</label>
                    <input type="range" id="quality" name="quality" min="1" max="10" class="w-full" value="5">
                    <div class="flex justify-between text-xs text-gray-400">
                        <span>Poor</span>
                        <span>Excellent</span>
                    </div>
                </div>
                <div>
                    <label for="notes" class="block mb-2">Notes</label>
                    <textarea id="notes" name="notes" rows="2" class="w-full p-3 rounded text-gray-800"></textarea>
                </div>
                <div class="md:col-span-2">
                    <button type="submit" class="bg-sleep-green text-white px-6 py-3 rounded font-semibold hover:bg-green-600 transition duration-300 w-full">
                        Save Sleep Data
                    </button>
                </div>
            </form>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 py-8">
        <div class="container mx-auto max-w-6xl px-4 text-center text-gray-400">
            <p>© 2023 Sleep Well. All rights reserved.</p>
            <p class="mt-2 text-sm">Prioritizing rest for better health and performance</p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Sleep Chart Visualization
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('sleepChart').getContext('2d');
            const sleepChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: Array.from({length: 8}, (_, i) => `${i+10}pm`).concat(Array.from({length: 4}, (_, i) => `${i+6}am`)),
                    datasets: [{
                        label: 'Sleep Depth',
                        data: [0, 1, 2, 3, 2, 1, 2, 3, 4, 3, 2, 1, 0],
                        borderColor: '#10B981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    const stages = ['Awake', 'Light', 'Deep', 'REM'];
                                    return stages[value] || '';
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const stages = ['Awake', 'Light Sleep', 'Deep Sleep', 'REM Sleep'];
                                    return stages[context.raw] || '';
                                }
                            }
                        }
                    }
                }
            });

            // Track sleep button
            document.getElementById('trackSleepBtn').addEventListener('click', function() {
                document.getElementById('sleepForm').scrollIntoView({ behavior: 'smooth' });
            });
        });
    </script>
</body>
</html>