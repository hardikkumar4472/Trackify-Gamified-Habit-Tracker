<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stay Hydrated - Health Benefits</title>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        'abril': ['Abril Fatface', 'serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.5s ease-out',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes waterWave {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }
        .water-wave {
            animation: waterWave 3s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gray-900 min-h-screen transition-colors duration-300">
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-end mb-4">
            <button id="darkModeToggle" class="p-2 rounded-full bg-blue-100 dark:bg-gray-700 text-blue-700 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-gray-600 transition-colors duration-300">
                <svg id="sunIcon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <svg id="moonIcon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            </button>
        </div>

        <header class="text-center mb-12 animate-fade-in">
            <h1 class="text-4xl font-bold text-orange-400 mb-4 flex justify-center items-center font-abril">
                <span class="water-wave">💧</span> Stay Hydrated <span class="water-wave">💧</span>
            </h1>
            <p class="text-xl text-green-300 animate-slide-up font-abril">The Key to Better Health and Wellness</p>
        </header>

        <main class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <section class="md:col-span-2 bg-gray-800 rounded-lg shadow-lg p-6 transition-all duration-300 hover:shadow-xl animate-slide-up">
                <h2 class="text-2xl font-semibold text-blue-400 mb-4 font-abril">Why Hydration Matters</h2>
                
                <div class="space-y-6">
                    <div class="p-4 bg-gray-700 rounded-lg transition-transform duration-300 hover:scale-[1.01]">
                        <h3 class="text-xl font-medium text-white mb-2 font-abril">1. Boosts Energy Levels</h3>
                        <p class="text-gray-300">Water helps transport nutrients to your cells and removes waste, keeping your energy levels high throughout the day.</p>
                    </div>
                    
                    <div class="p-4 bg-gray-700 rounded-lg transition-transform duration-300 hover:scale-[1.01]">
                        <h3 class="text-xl font-medium text-white mb-2 font-abril">2. Improves Brain Function</h3>
                        <p class="text-gray-300">Even mild dehydration can impair concentration, memory, and mood. Staying hydrated keeps your mind sharp.</p>
                    </div>
                    
                    <div class="p-4 bg-gray-700 rounded-lg transition-transform duration-300 hover:scale-[1.01]">
                        <h3 class="text-xl font-medium text-white mb-2 font-abril">3. Supports Digestion</h3>
                        <p class="text-gray-300">Water is essential for proper digestion and helps prevent constipation by keeping things moving smoothly.</p>
                    </div>
                    
                    <div class="p-4 bg-gray-700 rounded-lg transition-transform duration-300 hover:scale-[1.01]">
                        <h3 class="text-xl font-medium text-white mb-2 font-abril">4. Regulates Body Temperature</h3>
                        <p class="text-gray-300">Sweating is your body's cooling mechanism. Proper hydration ensures this system works effectively.</p>
                    </div>
                </div>
                
                <div class="mt-8">
                    <h3 class="text-xl font-semibold text-blue-400 mb-3 font-abril">Daily Water Intake Recommendation</h3>
                    <div class="bg-gray-700 p-4 rounded-lg transition-colors duration-300">
                        <p class="text-gray-200">The general recommendation is about <span class="font-bold text-green-300">3.7 liters (125 oz)</span> for men and <span class="font-bold text-green-300">2.7 liters (91 oz)</span> for women daily, including fluids from all beverages and foods.</p>
                    </div>
                </div>
            </section>

            <section class="bg-gray-800 rounded-lg shadow-lg p-6 transition-all duration-300 hover:shadow-xl animate-slide-up">
                <h2 class="text-2xl font-semibold text-blue-400 mb-4 font-abril">Track Your Hydration</h2>
                
                <form id="hydrationForm" method="POST" class="space-y-4">
                    <div class="animate-fade-in">
                        <label for="name" class="block text-gray-300 mb-2">Your Name</label>
                        <input type="text" id="name" name="name" required 
                               class="w-full px-4 py-2 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-700 text-gray-200 transition-colors duration-300">
                    </div>
                    
                    <div class="animate-fade-in" style="animation-delay: 0.1s;">
                        <label for="email" class="block text-gray-300 mb-2">Email</label>
                        <input type="email" id="email" name="email" required 
                               class="w-full px-4 py-2 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-700 text-gray-200 transition-colors duration-300">
                    </div>
                    
                    <div class="animate-fade-in" style="animation-delay: 0.2s;">
                        <label for="waterIntake" class="block text-gray-300 mb-2">Today's Water Intake (ml)</label>
                        <input type="number" id="waterIntake" name="waterIntake" min="0" max="5000" required 
                               class="w-full px-4 py-2 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-700 text-gray-200 transition-colors duration-300">
                    </div>
                    
                    <div class="animate-fade-in" style="animation-delay: 0.3s;">
                        <label for="hydrationGoal" class="block text-gray-300 mb-2">Daily Goal (ml)</label>
                        <select id="hydrationGoal" name="hydrationGoal" 
                                class="w-full px-4 py-2 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-700 text-gray-200 transition-colors duration-300">
                            <option value="2000">2000 ml (Standard)</option>
                            <option value="2500">2500 ml</option>
                            <option value="3000">3000 ml (Active)</option>
                            <option value="3500">3500 ml</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-[1.01] animate-fade-in" style="animation-delay: 0.4s;">
                        Log Your Hydration
                    </button>
                </form>
                
                <div id="progressDisplay" class="mt-6 hidden animate-slide-up">
                    <h3 class="text-lg font-medium text-blue-400 mb-2 font-abril">Your Progress</h3>
                    <div class="bg-gray-600 rounded-full h-6 mb-2 overflow-hidden">
                        <div id="progressBar" class="bg-green-500 h-6 rounded-full text-white text-xs flex items-center justify-center transition-all duration-1000 ease-out" style="width: 0%">0%</div>
                    </div>
                    <p id="progressText" class="text-gray-300 text-center"></p>
                </div>
                
                <div class="mt-8 animate-fade-in" style="animation-delay: 0.5s;">
                    <h3 class="text-xl font-semibold text-blue-400 mb-3 font-abril">Hydration Tips</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li class="flex items-start transition-transform duration-300 hover:translate-x-1">
                            <span class="text-orange-400 mr-2">•</span> Start your day with a glass of water
                        </li>
                        <li class="flex items-start transition-transform duration-300 hover:translate-x-1">
                            <span class="text-orange-400 mr-2">•</span> Carry a reusable water bottle
                        </li>
                        <li class="flex items-start transition-transform duration-300 hover:translate-x-1">
                            <span class="text-orange-400 mr-2">•</span> Eat water-rich fruits and vegetables
                        </li>
                        <li class="flex items-start transition-transform duration-300 hover:translate-x-1">
                            <span class="text-orange-400 mr-2">•</span> Set reminders to drink water
                        </li>
                    </ul>
                </div>
            </section>
        </main>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "trackify";
            
            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $name = $_POST['name'];
                $email = $_POST['email'];
                $waterIntake = $_POST['waterIntake'];
                $hydrationGoal = $_POST['hydrationGoal'];
                $date = date('Y-m-d H:i:s');
                
                $stmt = $conn->prepare("INSERT INTO hydration_logs (name, email, water_intake, daily_goal, log_date) 
                                       VALUES (:name, :email, :waterIntake, :hydrationGoal, :logDate)");
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':waterIntake', $waterIntake);
                $stmt->bindParam(':hydrationGoal', $hydrationGoal);
                $stmt->bindParam(':logDate', $date);
                
                $stmt->execute();
                
                echo "<script>console.log('Data saved successfully');</script>";
                
            } catch(PDOException $e) {
                echo "<script>console.error('Connection failed: " . $e->getMessage() . "');</script>";
            }
            
            $conn = null;
            
            $progress = round(($_POST['waterIntake'] / $_POST['hydrationGoal']) * 100);
            echo "<script>
                    document.getElementById('progressDisplay').classList.remove('hidden');
                    document.getElementById('progressBar').style.width = '{$progress}%';
                    document.getElementById('progressBar').textContent = '{$progress}%';
                  </script>";
        }
        ?>
    </div>

    <script>
        const darkModeToggle = document.getElementById('darkModeToggle');
        const sunIcon = document.getElementById('sunIcon');
        const moonIcon = document.getElementById('moonIcon');
        
        if (localStorage.getItem('darkMode') === 'true' || 
            (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            sunIcon.classList.add('hidden');
            moonIcon.classList.remove('hidden');
        }
        
        darkModeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            const isDark = document.documentElement.classList.contains('dark');
            localStorage.setItem('darkMode', isDark);
            
            if (isDark) {
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            } else {
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
            }
        });
        
        document.getElementById('hydrationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Saving...
            `;
            
            setTimeout(() => {
                submitBtn.innerHTML = `
                    <svg class="w-5 h-5 text-white inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Data Saved!
                `;
                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'Log Your Hydration';
                }, 1500);
            }, 1000);
            
            this.submit();
        });
        
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('progressDisplay').classList.remove('hidden');
            });
        <?php endif; ?>
        
        document.querySelectorAll('section').forEach(section => {
            section.addEventListener('mouseenter', () => {
                const waterEmoji = document.querySelector('.water-wave');
                if (waterEmoji) {
                    waterEmoji.classList.add('animate-pulse-slow');
                }
            });
            
            section.addEventListener('mouseleave', () => {
                const waterEmoji = document.querySelector('.water-wave');
                if (waterEmoji) {
                    waterEmoji.classList.remove('animate-pulse-slow');
                }
            });
        });
    </script>
</body>
</html>