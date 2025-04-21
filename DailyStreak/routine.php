<!-- 🔥 ENHANCED DAILY STREAK TRACKER UI -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daily Streak Tracker</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Inter:wght@400;600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #1f2237, #2d2f5f);
      color: white;
    }

    .heatmap-cell {
      width: 30px;
      height: 30px;
      border-radius: 6px;
      margin: 2px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }

    .heatmap-0 { background-color: #444c5e; }
    .heatmap-1 { background-color: #9be9a8; }
    .heatmap-2 { background-color: #40c463; }
    .heatmap-3 { background-color: #30a14e; }
    .heatmap-4 { background-color: #216e39; }

    .current-day {
      box-shadow: 0 0 0 3px #3b82f6;
      position: relative;
    }
    .current-day::after {
      content: '';
      position: absolute;
      top: -3px;
      right: -3px;
      width: 8px;
      height: 8px;
      background: #3b82f6;
      border-radius: 50%;
    }

    .floating-container {
      transition: all 0.3s ease;
      transform: translateY(0);
    }
    .floating-container:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }

    .stat-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 18px rgba(0, 0, 0, 0.15);
    }

    .pulse {
      animation: pulse 0.5s ease;
    }
    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.1); }
      100% { transform: scale(1); }
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center">
  <div class="container mx-auto px-4 py-10">
    <!-- Header -->
    <div class="flex justify-between items-center mb-10">
      <h1 class="text-4xl font-bold text-white tracking-wider" style="font-family: 'Abril Fatface', cursive;">
        🔥 Daily Streak Tracker
      </h1>
    </div>

    <!-- Streak Display -->
    <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl shadow-lg p-6 mb-8 transition-all duration-300 floating-container">
      <div class="flex flex-col items-center text-center">
        <!-- Counter -->
        <div class="flex items-center mb-6 space-x-3">
          <div class="text-5xl font-extrabold text-blue-400 pulse" id="streakCount">0</div>
          <div class="text-gray-300 text-lg">day streak</div>
        </div>

        <!-- Heatmap -->
        <div class="w-full mb-8 overflow-x-auto">
          <div class="text-center text-sm text-gray-400 mb-2 font-semibold uppercase tracking-wide" id="currentMonth">April 2024</div>
          <div class="flex flex-wrap justify-center gap-1" id="heatmap"></div>
          <div class="flex justify-center gap-7 mt-2 text-xs text-gray-500 font-mono">
            <span>S</span><span>M</span><span>T</span><span>W</span><span>T</span><span>F</span><span>S</span>
          </div>
        </div>

        <!-- Complete Button -->
        <button id="completeBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-10 rounded-full shadow-lg transform transition hover:scale-105 active:scale-95 duration-300">
          ✅ Complete Today
        </button>
      </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-gray-800 rounded-xl shadow-md p-5 stat-card transition duration-300">
        <div class="text-gray-400 mb-1 text-sm uppercase">Longest Streak</div>
        <div class="text-3xl font-bold text-green-400" id="longestStreak">0</div>
      </div>
      <div class="bg-gray-800 rounded-xl shadow-md p-5 stat-card transition duration-300">
        <div class="text-gray-400 mb-1 text-sm uppercase">Total Days</div>
        <div class="text-3xl font-bold text-yellow-400" id="totalCompleted">0</div>
      </div>
      <div class="bg-gray-800 rounded-xl shadow-md p-5 stat-card transition duration-300">
        <div class="text-gray-400 mb-1 text-sm uppercase">Current Week</div>
        <div class="text-3xl font-bold text-purple-400" id="currentWeek">0/7</div>
      </div>
    </div>
  </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let habitData = {
                currentStreak: 0,
                longestStreak: 0,
                totalCompleted: 0,
                currentWeekCompleted: 0,
                history: {},
                streakHistory: {},
                lastCompleted: null
            };

            // DOM elements
            const heatmap = document.getElementById('heatmap');
            const streakCount = document.getElementById('streakCount');
            const longestStreak = document.getElementById('longestStreak');
            const totalCompleted = document.getElementById('totalCompleted');
            const currentWeek = document.getElementById('currentWeek');
            const completeBtn = document.getElementById('completeBtn');
            const currentMonth = document.getElementById('currentMonth');

            // Initialize
            renderHeatmap();
            updateStats();

            // Button click handler
            completeBtn.addEventListener('click', function() {
                const today = new Date();
                const todayKey = formatDate(today);
                
                // Don't allow multiple completions per day
                if (habitData.history[todayKey]) return;
                
                // Update streak
                const yesterday = new Date(today);
                yesterday.setDate(yesterday.getDate() - 1);
                const yesterdayKey = formatDate(yesterday);
                
                if (habitData.history[yesterdayKey]) {
                    // Continuing streak
                    habitData.currentStreak++;
                } else {
                    // New streak
                    habitData.currentStreak = 1;
                }
                
                // Update streak history
                habitData.streakHistory[todayKey] = habitData.currentStreak;
                
                // Update longest streak
                if (habitData.currentStreak > habitData.longestStreak) {
                    habitData.longestStreak = habitData.currentStreak;
                }
                
                // Update history
                habitData.history[todayKey] = true;
                habitData.totalCompleted = Object.keys(habitData.history).length;
                habitData.lastCompleted = today;
                
                // Update current week count
                updateCurrentWeekCount();
                
                // Update UI
                updateStats();
                renderHeatmap();
                
                // Visual feedback
                completeBtn.textContent = 'Completed!';
                completeBtn.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                completeBtn.classList.add('bg-green-500', 'cursor-not-allowed');
                
                // Pulse animation on streak counter
                streakCount.classList.add('pulse');
                setTimeout(() => streakCount.classList.remove('pulse'), 500);
            });

            // Helper functions
            function formatDate(date) {
                return date.toISOString().split('T')[0];
            }

            function updateStats() {
                streakCount.textContent = habitData.currentStreak;
                longestStreak.textContent = habitData.longestStreak;
                totalCompleted.textContent = habitData.totalCompleted;
                currentWeek.textContent = `${habitData.currentWeekCompleted}/7`;
                
                // Update button text based on streak
                if (habitData.currentStreak === 0) {
                    completeBtn.textContent = 'Start Today';
                } else {
                    completeBtn.textContent = 'Complete Today';
                }
            }

            function updateCurrentWeekCount() {
                const today = new Date();
                const dayOfWeek = today.getDay(); // 0 (Sun) to 6 (Sat)
                const startOfWeek = new Date(today);
                startOfWeek.setDate(today.getDate() - dayOfWeek);
                
                let count = 0;
                for (let i = 0; i <= dayOfWeek; i++) {
                    const date = new Date(startOfWeek);
                    date.setDate(startOfWeek.getDate() + i);
                    if (habitData.history[formatDate(date)]) {
                        count++;
                    }
                }
                
                habitData.currentWeekCompleted = count;
            }

            function renderHeatmap() {
                heatmap.innerHTML = '';
                
                const daysToShow = 84; // 12 weeks
                const today = new Date();
                const startDate = new Date(today);
                startDate.setDate(startDate.getDate() - daysToShow + 1);
                
                // Create day cells
                for (let i = 0; i < daysToShow; i++) {
                    const date = new Date(startDate);
                    date.setDate(startDate.getDate() + i);
                    
                    const dayElement = document.createElement('div');
                    dayElement.className = 'heatmap-cell heatmap-0';
                    dayElement.title = date.toDateString();
                    
                    const dateKey = formatDate(date);
                    if (habitData.history[dateKey]) {
                        // Get streak length for this day
                        const streakLength = habitData.streakHistory[dateKey] || 1;
                        
                        // Set heatmap color based on streak length
                        let intensity;
                        if (streakLength === 1) intensity = 1;
                        else if (streakLength <= 3) intensity = 2;
                        else if (streakLength <= 5) intensity = 3;
                        else intensity = 4;
                        
                        dayElement.classList.remove('heatmap-0');
                        dayElement.classList.add(`heatmap-${intensity}`);
                        
                        // Add checkmark for completed days
                        dayElement.innerHTML = '<i class="fas fa-check text-white text-xs"></i>';
                    }
                    
                    // Highlight today
                    if (date.toDateString() === today.toDateString()) {
                        dayElement.classList.add('current-day');
                    }
                    
                    // Skip future dates
                    if (date > today) {
                        dayElement.style.visibility = 'hidden';
                    }
                    
                    heatmap.appendChild(dayElement);
                }
                
                // Update month display
                currentMonth.textContent = today.toLocaleString('default', { month: 'long', year: 'numeric' });
            }
        });
    </script>
</body>
</html>