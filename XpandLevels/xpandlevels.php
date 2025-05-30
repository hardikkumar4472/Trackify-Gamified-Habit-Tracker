<?php
session_start();
if (!isset($_SESSION['user_firstname'])) {
    header("Location: ../login.php");
    exit();
}

$user_firstname = $_SESSION['user_firstname'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>XP and Levels Module</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Winky+Sans:wght@400;500;600&display=swap" rel="stylesheet"/>
  
  <style>
    
    body {
      font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
      background-color: #111827 !important; 
      color: #f97316; 
    }
    .card {
      transition: transform 0.3s, box-shadow 0.3s, width 0.3s;
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }
    .card:hover {
      transform: translateY(-15px);
      box-shadow: 0 24px 48px rgba(0, 0, 0, 0.4);
      background-color: #1f2937 !important;
    }
    .card.expanded {
      width: 120%;
    }
    .badge {
      transition: transform 0.3s, box-shadow 0.3s;
      box-shadow: 0 25px 24px rgba(0, 0, 0, 0.2);
    }
    .badge:hover {
      transform: scale(1.1);
      box-shadow: 0 24px 48px rgba(0, 0, 0, 0.3);
    }
    .sidebar {
      transition: transform 0.3s, box-shadow 0.3s, width 0.3s, opacity 0.3s;
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
      transform: translateX(0);
      width: 20%;
    }
    .sidebar.collapsed {
      transform: translateX(-80%);
      width: 5%;
      opacity: 0.8;
    }
    .sidebar.collapsed .nav-text, .sidebar.collapsed .logo {
      display: none;
    }
    .sidebar:hover {
      transform: translateX(-10px);
      box-shadow: 0 24px 48px rgba(0, 0, 0, 0.3);
    }
    .main-content {
      transition: width 0.3s;
    }
    .main-content.expanded {
      width: 100%;
    }
    .menu-icon {
      cursor: pointer;
      transition: transform 0.3s, color 0.3s;
    }
    .menu-icon:hover {
      transform: scale(1.1);
      color: #22c55e; /* Tailwind green-500 */
    }
    .badge-earned {
      animation: pulse 2s infinite;
    }
    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.1); }
      100% { transform: scale(1); }
    }
    .level-up-notification {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: #1f2937 !important;
      border: 2px solid #22c55e;
      color: #f97316;
      padding: 20px;
      border-radius: 10px;
      z-index: 1000;
      display: none;
      text-align: center;
      animation: fadeIn 0.5s;
    }
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    .confetti {
      position: fixed;
      width: 10px;
      height: 10px;
      background-color: #f00;
      animation: fall 3s linear forwards;
      z-index: 999;
    }
    @keyframes fall {
      to {
        transform: translateY(100vh);
      }
    }
    .habit-item {
      background-color: #1f2937 !important;
      cursor: pointer;
      transition: transform 0.3s;
    }
    .habit-item:hover {
      background-color: #1f2937 !important;
      transform: translateX(10px);
    }
    .streak-badge {
      background-color: #22c55e !important;
      color: white !important;
      padding: 2px 6px;
      border-radius: 9999px;
      font-size: 0.75rem;
      margin-left: 8px;
    }
    h1, h2, h3, h4, h5, h6 {
      font-family: 'Abril Fatface', cursive !important;
      color: #22c55e !important; /* Tailwind green-500 */
    }
    .text-gray-600 {
      color: #f97316 !important; /* orange-400 */
    }
    .text-blue-600 {
      color: #22c55e !important; /* green-500 */
    }
    .bg-blue-600, #add-habit-btn, #close-notification {
      background-color: #22c55e !important; /* green-500 */
      color: white !important;
    }
    input[type="text"], 
    input[type="search"], 
    .search-input, 
    .bg-gray-200 {
      background-color: #1f2937 !important;
      border: 1px solid #374151;
      color: #f97316 !important;
    }
    input[type="text"]:focus,
    input[type="search"]:focus,
    .search-input:focus {
      background-color: #1f2937 !important;
      border-color: #22c55e;
      outline: none;
      box-shadow: 0 0 0 2px rgba(34, 197, 94, 0.2);
    }
    .progress-bar, .bg-gray-200 {
      background-color: #1f2937 !important;
    }
    .progress-fill, 
    #progress-bar {
      background-color: #22c55e !important;
    }
    .text-green-600 {
      color: #22c55e !important;
    }
    .text-red-600 {
      color: #f97316 !important;
    }
    #xp-chart {
      background-color: #1f2937 !important;
    }
    .sidebar a {
      color: #f97316 !important;
      transition: transform 0.3s;
    }
    .sidebar a:hover {
      color: #22c55e !important;
      transform: translateX(5px);
    }
    .menu-icon i {
      color: #f97316 !important;
    }
    .menu-icon:hover i {
      color: #22c55e !important;
    }
    #notification-bell {
      color: #f97316 !important;
    }
    #notification-badge {
      background-color: #22c55e !important;
    }
    [class*="bg-white"] {
      background-color: #1f2937 !important;
    }
    .level-up-notification {
      background-color: #1f2937 !important;
      border: 2px solid #22c55e;
    }
    .bg-blue-600.card {
      background-color: #1f2937 !important;
    }
    .badge:hover {
      transform: scale(1.1);
      box-shadow: 0 24px 48px rgba(0, 0, 0, 0.3);
      background-color: #1f2937 !important;
    }
    .text-gray-500 {
      color: #f97316 !important;
    }
    #add-habit-btn:hover,
    #close-notification:hover {
      background-color: #1b9d4d !important;
      transform: translateY(-2px);
    }
    .habit-input-container {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
      width: 100%;
    }
    #new-habit-input {
      width: 100%;
    }
    #add-habit-btn {
      width: 100%;
    }
    #popup-container {
      display: flex;
      flex-direction: column;
      align-items: flex-end;
    }
    .popup {
      background-color: #1f2937; /* Dark background */
      color: #f97316; /* Orange text */
      padding: 10px 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      animation: fadeIn 0.5s, fadeOut 0.5s 3.5s;
      opacity: 0;
      transform: translateY(-10px);
      transition: opacity 0.3s, transform 0.3s;
    }
    .popup.show {
      opacity: 1;
      transform: translateY(0);
    }
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    @keyframes fadeOut {
      from {
        opacity: 1;
        transform: translateY(0);
      }
      to {
        opacity: 0;
        transform: translateY(-10px);
      }
    }
  </style>
</head>
<body class="bg-gray-100">
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="sidebar bg-white p-6 overflow-y-auto h-screen" id="sidebar">
      <div class="flex items-center justify-between mb-8">
        <div class="flex items-center">
          <div class="menu-icon" onclick="collapseSidebar()">
            <i class="fas fa-bars text-gray-600 text-xl"></i>
          </div>
          <img  src="../XpandLevels/images/Trackifylogo.png" class="mr-3 ml-3 logo" style="width: 50px; height: 50px;" />
          <span class="text-xl font-semibold text-blue-600 nav-text">Habit Tracker</span>
        </div>
      </div>
      <nav class="space-y-4">
        <a class="flex items-center text-blue-600" href="#">
          <i class="fas fa-tachometer-alt mr-3"></i>
          <span class="nav-text">Dashboard</span>
        </a>
        <a class="flex items-center text-gray-600" href="#">
          <i class="fas fa-user mr-3"></i>
          <span class="nav-text">Profile</span>
        </a>
        <a class="flex items-center text-gray-600" href="#">
          <i class="fas fa-tasks mr-3"></i>
          <span class="nav-text">Habits</span>
        </a>
        <a class="flex items-center text-gray-600" href="#">
          <i class="fas fa-chart-line mr-3"></i>
          <span class="nav-text">XP & Levels</span>
        </a>
        <a class="flex items-center text-gray-600" href="../MainPage/mainpage.php">
          <i class="fas fa-home mr-3"></i>
          <span class="nav-text">Go Home</span>
        </a>
      </nav>
    </div>
    <!-- Main Content -->
    <div class="w-4/5 p-8 main-content" id="main-content">
      <div class="flex justify-between items-center mb-8">
        <div>
          <p class="text-gray-600">Hi <?php echo "Welcome, " . $user_firstname; ?><span id="username"></span>,</p>
          <h1 class="text-2xl font-semibold">Welcome to Your XP & Levels</h1>
        </div>
        <div class="flex items-center space-x-4">
          <div class="relative">
            <i class="fas fa-bell text-gray-600 cursor-pointer" id="notification-bell"></i>
            <span id="notification-badge" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center hidden">0</span>
          </div>
          <div class="relative badge">
            <span class="absolute bottom-0 right-0 bg-blue-600 text-white text-xs font-semibold px-2 py-1 rounded-full" id="user-rank">#1</span>
          </div>
          <input class="px-4 py-2 rounded-lg bg-gray-200" placeholder="Search" type="text"/>
        </div>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-lg mb-8 card" id="profile-card">
        <div class="flex items-center space-x-4 w-full">
          <img alt="Profile picture" class="rounded-full w-24 h-24" src="../XpandLevels/images/profile.jpg" id="profile-image"/>
          <div>
            <h2 class="text-2xl font-semibold" id="profile-username"><?php echo htmlspecialchars($user_firstname); ?></h2>
            <p class="text-gray-600">User ID: <span id="user-id">12345</span></p>
            <p class="text-gray-600">Current Level: <span id="current-level">5</span></p>
            <p class="text-gray-600">Total XP: <span id="total-xp">1250</span></p>
            <p class="text-gray-600">XP Needed for Next Level: <span id="xp-needed">250</span></p>
          </div>
          <div class="ml-auto relative badge" id="current-badge-container">
            <img  style="height: 120px; width: 120px; " src="../XpandLevels/images/rank.png" id="current-badge"/>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-6 mb-8">
        <div class="p-6 bg-white rounded-lg shadow-lg card">
          <h2 class="text-xl font-semibold mb-4">Habit Tracking</h2>
          <ul class="space-y-2" id="habit-list">
            <!-- Habits will be dynamically populated here -->
          </ul>
          <div class="mt-4">
            <div class="habit-input-container">
              <input type="text" id="new-habit-input" placeholder="Add new habit" class="px-4 py-2 rounded-lg bg-gray-200">
              <button id="add-habit-btn" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Add</button>
            </div>
          </div>
        </div>
        <div class="p-6 bg-white rounded-lg shadow-lg card">
          <h2 class="text-xl font-semibold mb-4">XP System</h2>
          <p class="text-gray-600">XP per Habit: <span id="xp-per-habit">10</span> XP</p>
          <p class="text-gray-600">Bonus XP for Streaks: <span id="streak-bonus">50</span> XP</p>
          <p class="text-gray-600">Daily Login Bonus: <span id="login-bonus">5</span> XP</p>
          <div class="mt-4">
            <h3 class="font-semibold">Recent XP Activity</h3>
            <ul class="mt-2 space-y-1 text-sm" id="xp-activity-log">
              <!-- XP activity will be dynamically populated here -->
            </ul>
          </div>
        </div>
        <div class="p-6 bg-white rounded-lg shadow-lg card">
          <h2 class="text-xl font-semibold mb-4">Leveling System</h2>
          <div id="level-thresholds">
            <p class="text-gray-600">Level 1: 0-99 XP</p>
            <p class="text-gray-600">Level 2: 100-249 XP</p>
            <p class="text-gray-600">Level 3: 250-499 XP</p>
            <p class="text-gray-600">Level 4: 500-999 XP</p>
            <p class="text-gray-600">Level 5: 1000-1499 XP</p>
            <p class="text-gray-600">Level 6: 1500-2499 XP</p>
            <p class="text-gray-600">Level 7: 2500-3999 XP</p>
            <p class="text-gray-600">Level 8: 4000-5999 XP</p>
            <p class="text-gray-600">Level 9: 6000-8999 XP</p>
            <p class="text-gray-600">Level 10: 9000+ XP</p>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-6 mb-8">
        <div class="p-6 bg-white rounded-lg shadow-lg card">
          <h2 class="text-xl font-semibold mb-4">Rewards System</h2>
          <div id="rewards-list">
            <p class="text-gray-600">Level 1: Novice Badge</p>
            <p class="text-gray-600">Level 2: New Theme</p>
            <p class="text-gray-600">Level 3: Extra Features</p>
            <p class="text-gray-600">Level 4: Custom Badge</p>
            <p class="text-gray-600">Level 5: Premium Access</p>
          </div>
          <div class="mt-4">
            <h3 class="font-semibold">Your Badges</h3>
            <div class="flex flex-wrap gap-2 mt-2" id="earned-badges">
              <!-- Badges will be dynamically populated here -->
            </div>
          </div>
        </div>
        <div class="p-6 bg-white rounded-lg shadow-lg card">
          <h2 class="text-xl font-semibold mb-4">Progress Visualization</h2>
          <div class="relative w-full h-4 bg-gray-200 rounded-full">
            <div class="absolute top-0 left-0 h-4 bg-blue-600 rounded-full" id="progress-bar" style="width: 83%;"></div>
          </div>
          <p class="text-gray-600 mt-2"><span id="progress-percentage">83</span>% to next level</p>
          <div class="mt-4">
            <canvas id="xp-chart" width="300" height="200"></canvas>
          </div>
        </div>
        <div class="p-6 bg-blue-600 rounded-lg shadow-lg text-white card">
          <h2 class="text-xl font-semibold mb-4">Achievements</h2>
          <div id="achievements-container">
            <div class="flex items-center justify-between mb-2">
              <p class="text-lg">First Habit Completed</p>
              <div class="relative w-10 h-10 badge">
                <img alt="Achievement badge" src="../XpandLevels/images/habit.png" id="first-habit-badge"/>
              </div>
            </div>
            <div class="flex items-center justify-between mb-2">
              <p class="text-lg">7-Day Streak</p>
              <div class="relative w-10 h-10 badge">
                <img alt="Achievement badge" src="../XpandLevels/images/streak.png" id="streak-badge"/>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <p class="text-lg">Level 5 Reached</p>
              <div class="relative w-10 h-10 badge">
                <img alt="Achievement badge" src="../XpandLevels/images/level.png" id="level5-badge"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="level-up-notification" class="level-up-notification">
    <h2 class="text-2xl font-bold mb-2">Level Up!</h2>
    <p>Congratulations! You've reached level <span id="new-level">6</span>!</p>
    <div class="mt-4">
      <img id="level-up-badge"  style="height: 100px; width: 120px;" src="../XpandLevels/rank.png" alt="New badge" >
    </div>
    <button id="close-notification" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg">Continue</button>
  </div>

  <div id="popup-container" class="fixed top-5 right-5 space-y-2 z-50"></div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script >
    
    // XP and Level System
    const xpSystem = {
      // Configuration
      config: {
        xpPerHabit: 10,
        streakBonus: 50,
        loginBonus: 5,
        levelThresholds: [
          0, 100, 250, 500, 1000, 1500, 2500, 4000, 6000, 9000
        ],
        badges: {
          level1: "https://placehold.co/100x100?text=Lvl1",
          level3: "https://placehold.co/100x100?text=Lvl3",
          level5: "https://placehold.co/100x100?text=Lvl5",
          level10: "https://placehold.co/100x100?text=Lvl10",
          streak7: "https://placehold.co/100x100?text=7Day",
          streak30: "https://placehold.co/100x100?text=30Day",
          firstHabit: "/XpandLevels/images/rank.png"
        }
      },

      // User data
      userData: {
        username: "<?php echo htmlspecialchars($user_firstname); ?>",
        userId: "12345",
        totalXp: 1250,
        level: 5,
        habits: [],
        completedHabits: [],
        streaks: {},
        earnedBadges: [],
        xpHistory: [
          { date: '2023-01-01', xp: 1100 },
          { date: '2023-01-02', xp: 1150 },
          { date: '2023-01-03', xp: 1200 },
          { date: '2023-01-04', xp: 1250 }
        ],
        lastLogin: null,
        notifications: []
      },

      // Initialize the system
      init() {
        // Load data from localStorage if available
        this.loadUserData();
        
        // Update UI
        this.updateUI();
        
        // Add event listeners
        this.setupEventListeners();
        
        // Check for daily login bonus
        this.checkDailyLoginBonus();
        
        // Initialize chart
        this.initializeChart();
      },

      // Load user data from localStorage
      loadUserData() {
        const savedData = localStorage.getItem('habitTrackerUserData');
        if (savedData) {
          this.userData = JSON.parse(savedData);
        } else {
          // Initialize with default habits if no data exists
          this.userData.habits = [
            { id: 1, name: "Exercise", completed: false, streak: 0 },
            { id: 2, name: "Read", completed: false, streak: 0 },
            { id: 3, name: "Meditate", completed: false, streak: 0 }
          ];
          this.saveUserData();
        }
      },

      // Save user data to localStorage
      saveUserData() {
        localStorage.setItem('habitTrackerUserData', JSON.stringify(this.userData));
      },

      // Update all UI elements
      updateUI() {
        // Update profile information
        document.getElementById('username').textContent = this.userData.$username;
        document.getElementById('profile-username').textContent = this.userData.$username;
        document.getElementById('user-id').textContent = this.userData.userId;
        document.getElementById('current-level').textContent = this.userData.level;
        document.getElementById('total-xp').textContent = this.userData.totalXp;
        
        // Calculate XP needed for next level
        const nextLevelThreshold = this.getNextLevelThreshold();
        const xpNeeded = nextLevelThreshold - this.userData.totalXp;
        document.getElementById('xp-needed').textContent = xpNeeded;
        
        // Update progress bar
        const currentLevelThreshold = this.config.levelThresholds[this.userData.level - 1];
        const progressPercentage = Math.min(
          Math.round(((this.userData.totalXp - currentLevelThreshold) / (nextLevelThreshold - currentLevelThreshold)) * 100),
          100
        );
        document.getElementById('progress-bar').style.width = `${progressPercentage}%`;
        document.getElementById('progress-percentage').textContent = progressPercentage;
        
        // Update XP system information
        document.getElementById('xp-per-habit').textContent = this.config.xpPerHabit;
        document.getElementById('streak-bonus').textContent = this.config.streakBonus;
        document.getElementById('login-bonus').textContent = this.config.loginBonus;
        
        // Update habits list
        this.updateHabitsList();
        
        // Update badges
        this.updateBadges();
        
        // Update XP activity log
        this.updateXpActivityLog();
        
        // Update chart
        this.updateChart();
        
        // Update rank
        document.getElementById('user-rank').textContent = `#${this.calculateRank()}`;
        
        // Check for notifications
        this.checkNotifications();
      },

      // Set up event listeners
      setupEventListeners() {
        // Add habit button
        document.getElementById('add-habit-btn').addEventListener('click', () => {
          const habitInput = document.getElementById('new-habit-input');
          const habitName = habitInput.value.trim();
          
          if (habitName) {
            this.addHabit(habitName);
            habitInput.value = '';
          }
        });
        
        // Close level up notification
        document.getElementById('close-notification').addEventListener('click', () => {
          document.getElementById('level-up-notification').style.display = 'none';
        });
        
        // Notification bell
        document.getElementById('notification-bell').addEventListener('click', () => {
          this.showNotifications();
        });
      },

      // Add a new habit
      addHabit(habitName) {
        const newId = this.userData.habits.length > 0 
          ? Math.max(...this.userData.habits.map(h => h.id)) + 1 
          : 1;
        
        this.userData.habits.push({
          id: newId,
          name: habitName,
          completed: false,
          streak: 0
        });
        
        this.saveUserData();
        this.updateHabitsList();
        
        // Add notification
        this.addNotification(`New habit "${habitName}" added`);
      },

      // Update the habits list in the UI
      updateHabitsList() {
        const habitsList = document.getElementById('habit-list');
        habitsList.innerHTML = '';

        // Filter out completed habits
        const incompleteHabits = this.userData.habits.filter(habit => !habit.completed);

        incompleteHabits.forEach(habit => {
            const li = document.createElement('li');
            li.className = 'flex justify-between items-center p-2 rounded habit-item';

            const nameSpan = document.createElement('span');
            nameSpan.textContent = habit.name;

            const statusSpan = document.createElement('span');
            statusSpan.className = habit.completed ? 'text-green-600' : 'text-red-600';
            statusSpan.textContent = habit.completed ? 'Completed' : 'Not Completed';

            li.appendChild(nameSpan);
            li.appendChild(statusSpan);

            li.addEventListener('click', () => {
                this.toggleHabitCompletion(habit.id);
            });

            habitsList.appendChild(li);
        });
      },

      // Toggle habit completion status
      toggleHabitCompletion(habitId) {
        const habitIndex = this.userData.habits.findIndex(h => h.id === habitId);
        if (habitIndex === -1) return;
        
        const habit = this.userData.habits[habitIndex];
        const wasCompleted = habit.completed;
        
        // Toggle completion status
        habit.completed = !habit.completed;
        
        if (habit.completed && !wasCompleted) {
          // Habit was just completed
          this.addXp(this.config.xpPerHabit, `Completed habit: ${habit.name}`);
          
          // Check if this is the first time completing any habit
          if (!this.userData.earnedBadges.includes('firstHabit')) {
            this.awardBadge('firstHabit', 'First Habit Completed');
          }
          
          // Increment streak
          habit.streak++;
          
          // Check for streak milestones
          if (habit.streak === 7 && !this.userData.earnedBadges.includes('streak7')) {
            this.awardBadge('streak7', '7-Day Streak');
            this.addXp(this.config.streakBonus, '7-Day Streak bonus');
          } else if (habit.streak === 30 && !this.userData.earnedBadges.includes('streak30')) {
            this.awardBadge('streak30', '30-Day Streak');
            this.addXp(this.config.streakBonus * 2, '30-Day Streak bonus');
          }
          
          // Add to completed habits for today
          const today = new Date().toISOString().split('T')[0];
          if (!this.userData.completedHabits) {
            this.userData.completedHabits = [];
          }
          this.userData.completedHabits.push({
            habitId,
            date: today
          });
        } else if (!habit.completed && wasCompleted) {
          // Habit was uncompleted
          this.addXp(-this.config.xpPerHabit, `Uncompleted habit: ${habit.name}`);
          
          // Decrement streak
          habit.streak = Math.max(0, habit.streak - 1);
          
          // Remove from completed habits
          if (this.userData.completedHabits) {
            const today = new Date().toISOString().split('T')[0];
            this.userData.completedHabits = this.userData.completedHabits.filter(
              ch => !(ch.habitId === habitId && ch.date === today)
            );
          }
        }
        
        if (habit.completed) {
            this.addNotification(`Habit "${habit.name}" completed and removed from the list.`);
        }
        
        this.saveUserData();
        this.updateUI();
      },

      // Add XP to user
      addXp(amount, reason) {
        const oldLevel = this.userData.level;
        this.userData.totalXp = Math.max(0, this.userData.totalXp + amount);
        
        // Add to XP history
        const today = new Date().toISOString().split('T')[0];
        const historyEntry = this.userData.xpHistory.find(entry => entry.date === today);
        
        if (historyEntry) {
          historyEntry.xp = this.userData.totalXp;
        } else {
          this.userData.xpHistory.push({
            date: today,
            xp: this.userData.totalXp
          });
        }
        
        // Limit history to last 30 days
        if (this.userData.xpHistory.length > 30) {
          this.userData.xpHistory = this.userData.xpHistory.slice(-30);
        }
        
        // Check for level up
        const newLevel = this.calculateLevel();
        if (newLevel > oldLevel) {
          this.levelUp(newLevel);
        }
        
        // Add to activity log
        if (!this.userData.activityLog) {
          this.userData.activityLog = [];
        }
        
        this.userData.activityLog.unshift({
          date: new Date().toISOString(),
          action: reason,
          xp: amount
        });
        
        // Limit activity log to last 20 entries
        if (this.userData.activityLog.length > 20) {
          this.userData.activityLog = this.userData.activityLog.slice(0, 20);
        }
        
        this.saveUserData();
      },

      // Calculate user's level based on XP
      calculateLevel() {
        const { levelThresholds } = this.config;
        let level = 1;
        
        for (let i = 1; i < levelThresholds.length; i++) {
          if (this.userData.totalXp >= levelThresholds[i]) {
            level = i + 1;
          } else {
            break;
          }
        }
        
        return level;
      },

      // Get the XP threshold for the next level
      getNextLevelThreshold() {
        const currentLevel = this.userData.level;
        const { levelThresholds } = this.config;
        
        if (currentLevel >= levelThresholds.length) {
          // For max level, set a higher goal
          return levelThresholds[levelThresholds.length - 1] * 1.5;
        }
        
        return levelThresholds[currentLevel];
      },

      // Handle level up
      levelUp(newLevel) {
        this.userData.level = newLevel;
        
        // Check for level-based badges
        if (newLevel >= 1 && !this.userData.earnedBadges.includes('level1')) {
          this.awardBadge('level1', 'Reached Level 1');
        }
        if (newLevel >= 3 && !this.userData.earnedBadges.includes('level3')) {
          this.awardBadge('level3', 'Reached Level 3');
        }
        if (newLevel >= 5 && !this.userData.earnedBadges.includes('level5')) {
          this.awardBadge('level5', 'Reached Level 5');
        }
        if (newLevel >= 10 && !this.userData.earnedBadges.includes('level10')) {
          this.awardBadge('level10', 'Reached Level 10');
        }
        
        // Show level up notification
        this.showLevelUpNotification(newLevel);
        
        // Create confetti effect
        this.createConfetti();
        
        // Add notification
        this.addNotification(`Congratulations! You've reached level ${newLevel}!`);
      },

      // Show level up notification
      showLevelUpNotification(newLevel) {
        const notification = document.getElementById('level-up-notification');
        document.getElementById('new-level').textContent = newLevel;
        
        // Set appropriate badge for the level
        let badgeUrl = "https://placehold.co/100x100?text=Level" + newLevel;
        if (newLevel === 1) badgeUrl = this.config.badges.level1;
        else if (newLevel === 3) badgeUrl = this.config.badges.level3;
        else if (newLevel === 5) badgeUrl = this.config.badges.level5;
        else if (newLevel === 10) badgeUrl = this.config.badges.level10;
        
        document.getElementById('level-up-badge').src = badgeUrl;
        
        notification.style.display = 'block';
        
        // Auto-hide after 5 seconds
        setTimeout(() => {
          notification.style.display = 'none';
        }, 5000);
      },

      // Award a badge to the user
      awardBadge(badgeId, reason) {
        if (!this.userData.earnedBadges.includes(badgeId)) {
          this.userData.earnedBadges.push(badgeId);
          
          // Add notification
          this.addNotification(`New badge earned: ${reason}`);
          
          // Update current badge display
          document.getElementById('current-badge').src = this.config.badges[badgeId];
          
          // Add animation to the badge
          document.getElementById('current-badge-container').classList.add('badge-earned');
          setTimeout(() => {
            document.getElementById('current-badge-container').classList.remove('badge-earned');
          }, 3000);
        }
      },

      // Update badges display
      updateBadges() {
        const badgesContainer = document.getElementById('earned-badges');
        badgesContainer.innerHTML = '';
        
        if (!this.userData.earnedBadges || this.userData.earnedBadges.length === 0) {
          const noBadges = document.createElement('p');
          noBadges.className = 'text-gray-500 text-sm';
          noBadges.textContent = 'No badges earned yet';
          badgesContainer.appendChild(noBadges);
          return;
        }
        
        this.userData.earnedBadges.forEach(badgeId => {
          const badgeImg = document.createElement('img');
          badgeImg.src = this.config.badges[badgeId];
          badgeImg.alt = 'Earned badge';
          badgeImg.className = 'w-10 h-10 rounded-full';
          badgeImg.title = this.getBadgeName(badgeId);
          
          badgesContainer.appendChild(badgeImg);
        });
        
        // Update current badge (most recent)
        if (this.userData.earnedBadges.length > 0) {
          const latestBadgeId = this.userData.earnedBadges[this.userData.earnedBadges.length - 1];
          document.getElementById('current-badge').src = this.config.badges[latestBadgeId];
        }
      },

      // Get badge name from ID
      getBadgeName(badgeId) {
        const badgeNames = {
          level1: 'Level 1 Novice',
          level3: 'Level 3 Apprentice',
          level5: 'Level 5 Expert',
          level10: 'Level 10 Master',
          streak7: '7-Day Streak',
          streak30: '30-Day Streak',
          firstHabit: 'First Habit Completed'
        };
        
        return badgeNames[badgeId] || 'Badge';
      },

      // Update XP activity log
      updateXpActivityLog() {
        const activityLog = document.getElementById('xp-activity-log');
        activityLog.innerHTML = '';
        
        if (!this.userData.activityLog || this.userData.activityLog.length === 0) {
          const noActivity = document.createElement('li');
          noActivity.className = 'text-gray-500';
          noActivity.textContent = 'No recent activity';
          activityLog.appendChild(noActivity);
          return;
        }
        
        this.userData.activityLog.slice(0, 5).forEach(activity => {
          const li = document.createElement('li');
          const date = new Date(activity.date);
          const timeStr = date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
          
          li.className = 'flex justify-between';
          
          const actionSpan = document.createElement('span');
          actionSpan.textContent = activity.action;
          
          const xpSpan = document.createElement('span');
          xpSpan.className = activity.xp >= 0 ? 'text-green-600' : 'text-red-600';
          xpSpan.textContent = `${activity.xp >= 0 ? '+' : ''}${activity.xp} XP`;
          
          li.appendChild(actionSpan);
          li.appendChild(xpSpan);
          
          activityLog.appendChild(li);
        });
      },

      // Check for daily login bonus
      checkDailyLoginBonus() {
        const today = new Date().toISOString().split('T')[0];
        
        if (this.userData.lastLogin !== today) {
          this.userData.lastLogin = today;
          this.addXp(this.config.loginBonus, 'Daily login bonus');
          this.addNotification('Daily login bonus: +5 XP');
          this.saveUserData();
        }
      },

      // Calculate user rank (simplified)
      calculateRank() {
        // In a real app, this would compare against other users
        // For now, we'll use a simple formula based on level and XP
        const baseRank = 100 - (this.userData.level * 10);
        return Math.max(1, Math.min(99, baseRank));
      },

      // Add notification
      addNotification(message) {
        if (!this.userData.notifications) {
          this.userData.notifications = [];
        }
        
        this.userData.notifications.unshift({
          id: Date.now(),
          message,
          read: false,
          date: new Date().toISOString()
        });
        
        // Limit to 10 notifications
        if (this.userData.notifications.length > 10) {
          this.userData.notifications = this.userData.notifications.slice(0, 10);
        }
        
        this.checkNotifications();
        this.saveUserData();
      },

      // Check notifications
      checkNotifications() {
        if (!this.userData.notifications) return;
        
        const unreadCount = this.userData.notifications.filter(n => !n.read).length;
        const badge = document.getElementById('notification-badge');
        
        if (unreadCount > 0) {
          badge.textContent = unreadCount;
          badge.classList.remove('hidden');
        } else {
          badge.classList.add('hidden');
        }
      },

      // Show notifications
      showNotifications() {
        if (!this.userData.notifications || this.userData.notifications.length === 0) {
          alert('No notifications');
          return;
        }
        
        // Mark all as read
        this.userData.notifications.forEach(n => n.read = true);
        this.checkNotifications();
        this.saveUserData();
        
        // For simplicity, just show an alert with the latest notification
        // In a real app, you'd show a dropdown or modal with all notifications
        alert(this.userData.notifications[0].message);
      },

      // Initialize chart
      initializeChart() {
        const ctx = document.getElementById('xp-chart').getContext('2d');
        
        this.chart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: [],
            datasets: [{
              label: 'XP Progress',
              data: [],
              borderColor: '#2563EB',
              backgroundColor: 'rgba(37, 99, 235, 0.1)',
              tension: 0.3,
              fill: true
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
              y: {
                beginAtZero: false
              }
            }
          }
        });
        
        this.updateChart();
      },

      // Update chart with latest data
      updateChart() {
        if (!this.chart || !this.userData.xpHistory) return;
        
        const labels = this.userData.xpHistory.map(entry => {
          const date = new Date(entry.date);
          return date.toLocaleDateString([], { month: 'short', day: 'numeric' });
        });
        
        const data = this.userData.xpHistory.map(entry => entry.xp);
        
        this.chart.data.labels = labels;
        this.chart.data.datasets[0].data = data;
        this.chart.update();
      },

      // Create confetti effect for celebrations
      createConfetti() {
        const colors = ['#ff0000', '#00ff00', '#0000ff', '#ffff00', '#ff00ff', '#00ffff'];
        
        for (let i = 0; i < 100; i++) {
          const confetti = document.createElement('div');
          confetti.className = 'confetti';
          confetti.style.left = Math.random() * 100 + 'vw';
          confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
          confetti.style.width = Math.random() * 10 + 5 + 'px';
          confetti.style.height = Math.random() * 10 + 5 + 'px';
          confetti.style.opacity = Math.random() + 0.5;
          
          document.body.appendChild(confetti);
          
          // Remove after animation completes
          setTimeout(() => {
            confetti.remove();
          }, 3000);
        }
      },

      // Connect with To-Do List module
      connectToToDoList() {
        // Check if To-Do List data exists in localStorage
        const todoData = localStorage.getItem('todoListData');
        if (todoData) {
          try {
            const parsedData = JSON.parse(todoData);
            
            // Check for newly completed tasks
            if (parsedData.completedTasks && Array.isArray(parsedData.completedTasks)) {
              const newlyCompleted = parsedData.completedTasks.filter(task => {
                // Check if this task was completed today and we haven't given XP for it yet
                const today = new Date().toISOString().split('T')[0];
                return task.completedDate === today && 
                       (!this.userData.processedTasks || !this.userData.processedTasks.includes(task.id));
              });
              
              // Award XP for newly completed tasks
              if (newlyCompleted.length > 0) {
                newlyCompleted.forEach(task => {
                  this.addXp(this.config.xpPerHabit, `Completed to-do: ${task.title}`);
                  
                  // Mark as processed
                  if (!this.userData.processedTasks) {
                    this.userData.processedTasks = [];
                  }
                  this.userData.processedTasks.push(task.id);
                });
                
                this.saveUserData();
                this.updateUI();
              }
            }
          } catch (e) {
            console.error('Error parsing To-Do List data:', e);
          }
        }
      },

      // Show popup message
      showPopup(message) {
        const popupContainer = document.getElementById('popup-container');
        const popup = document.createElement('div');
        popup.className = 'popup show';
        popup.textContent = message;

        popupContainer.appendChild(popup);

        // Remove the popup after 4 seconds
        setTimeout(() => {
            popup.classList.remove('show');
            setTimeout(() => popup.remove(), 500); // Wait for fade-out animation
        }, 4000);
      }
    };

    // Initialize the XP system when the page loads
    document.addEventListener('DOMContentLoaded', () => {
      xpSystem.init();
      
      // Check for To-Do List connections every minute
      xpSystem.connectToToDoList();
      setInterval(() => {
        xpSystem.connectToToDoList();
      }, 60000);
    });

    // Sidebar toggle function
    function collapseSidebar() {
      document.getElementById('sidebar').classList.toggle('collapsed');
      document.getElementById('main-content').classList.toggle('expanded');
      document.getElementById('profile-card').classList.toggle('expanded');
    }

  </script>
</body>
</html>