<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Quote & Challenge of the Day</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
  <style>
    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }
    @keyframes pulse {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.8; }
    }
    @keyframes textGlow {
      0%, 100% { text-shadow: 0 0 8px rgba(74, 222, 128, 0.3); }
      50% { text-shadow: 0 0 12px rgba(74, 222, 128, 0.6); }
    }
    @keyframes borderPulse {
      0%, 100% { border-color: #4ade80; }
      50% { border-color: #86efac; }
    }
    .floating-container {
      transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
      transform: translateY(0);
      border: 2px solid #4ade80;
      background: linear-gradient(145deg, #1f2937, #111827);
      position: relative;
      overflow: hidden;
      animation: float 6s ease-in-out infinite, borderPulse 4s ease-in-out infinite;
    }
    .floating-container::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(74, 222, 128, 0.1) 0%, transparent 70%);
      transform: rotate(30deg);
      z-index: 0;
      animation: rotate 60s linear infinite;
    }
    @keyframes rotate {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    .floating-container:hover {
      transform: translateY(-10px) scale(1.02);
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
    }
    .quote-card {
      position: relative;
      z-index: 1;
    }
    .divider {
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(74, 222, 128, 0.5), transparent);
      margin: 1.5rem 0;
      animation: pulse 3s ease-in-out infinite;
    }
    .glow-text {
      animation: textGlow 3s ease-in-out infinite;
    }
    .btn-press {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      transform: translateY(0);
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .btn-press:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
    }
    .btn-press:active {
      transform: scale(0.95) translateY(0);
    }
    .fade-in {
      animation: fadeIn 0.8s ease-out forwards;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .particles {
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      z-index: 0;
      overflow: hidden;
    }
    .particle {
      position: absolute;
      background: rgba(74, 222, 128, 0.3);
      border-radius: 50%;
      animation: floatParticle 15s linear infinite;
    }
    @keyframes floatParticle {
      0% { transform: translateY(0) translateX(0); opacity: 0; }
      10% { opacity: 1; }
      90% { opacity: 1; }
      100% { transform: translateY(-100vh) translateX(20px); opacity: 0; }
    }
  </style>
</head>
<body class="bg-gray-900 flex flex-col justify-center items-center h-screen transition-colors">
  <div class="text-gray-800 p-8 rounded-2xl w-11/12 max-w-lg text-center transition-all duration-300 shadow-2xl floating-container">
    <div class="particles" id="particles"></div>
    <div class="quote-card">
      <h1 class="text-2xl text-red-300 mb-5 font-serif glow-text" style="font-family: 'Abril Fatface', cursive;">Quote of the Day:</h1>
      <p class="quote text-lg my-5 text-gray-100 font-medium fade-in" id="quoteText" style="font-family: 'Montserrat', sans-serif;">Click a button below to get inspired.</p>
      <p class="author italic mt-2 text-green-400 font-semibold fade-in" id="authorText" style="font-family: 'Montserrat', sans-serif;">— Unknown</p>

      <div class="divider"></div>

      <div class="mt-6">
        <h2 class="text-red-300 font-serif text-2xl mb-2 glow-text" style="font-family: 'Abril Fatface', cursive;">Challenge for Today:</h2>
        <p class="challenge text-lg my-5 text-gray-100 font-medium fade-in" id="challengeText" style="font-family: 'Montserrat', sans-serif;">Click a button to get your challenge.</p>
      </div>
      <div class="flex justify-center items-center mt-8 flex-wrap gap-3">
        <button onclick="getDailyInspiration()" class="btn-press bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-full py-3 px-6 text-sm transition-all duration-300 hover:from-blue-600 hover:to-blue-700 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50" style="font-family: 'Abril Fatface', cursive;">
          New Quote
        </button>
      </div>
    </div>
  </div>
  <script>
    const quotes = [
      { quote: "We are what we repeatedly do. Excellence, then, is not an act, but a habit.", author: "Will Durant" },
      { quote: "Motivation gets you going, but discipline keeps you growing.", author: "John C. Maxwell" },
      { quote: "Success is the product of daily habits—not once-in-a-lifetime transformations.", author: "James Clear" },
      { quote: "Small daily improvements over time lead to stunning results.", author: "Robin Sharma" },
      { quote: "First we make our habits, then our habits make us.", author: "John Dryden" },
      { quote: "Habits are the compound interest of self-improvement.", author: "James Clear" },
      { quote: "The chains of habit are too weak to be felt until they are too strong to be broken.", author: "Samuel Johnson" },
      { quote: "Change might not be fast and it isn't always easy. But with time and effort, almost any habit can be reshaped.", author: "Charles Duhigg" },
      { quote: "The secret of your future is hidden in your daily routine.", author: "Mike Murdock" },
      { quote: "The difference between who you are and who you want to be is what you do.", author: "Unknown" },
      { quote: "Fall in love with the process and the results will come.", author: "Eric Thomas" },
      { quote: "What you do every day matters more than what you do once in a while.", author: "Gretchen Rubin" },
      { quote: "Success is nothing more than a few simple disciplines, practiced every day.", author: "Jim Rohn" },
      { quote: "The journey of a thousand miles begins with one step.", author: "Lao Tzu" },
      { quote: "Action is the foundational key to all success.", author: "Pablo Picasso" },
      { quote: "Start where you are. Use what you have. Do what you can.", author: "Arthur Ashe" }
    ];
    const challenges = [
      "Drink at least 2 liters of water today.",
      "Wake up before 7 AM.",
      "Avoid phone usage for the first hour after waking up.",
      "Read 10 pages of a book.",
      "Write in a journal for 5 minutes.",
      "Do 15 minutes of physical activity.",
      "Plan your meals for the day.",
      "Spend 10 minutes organizing your space.",
      "Meditate for 5 minutes.",
      "Practice gratitude—list 3 things you're thankful for.",
      "Go for a 15-minute walk.",
      "Avoid junk food for the entire day.",
      "Check off every item in your to-do list.",
      "Take 3 deep breaths every hour.",
      "Avoid social media for at least 2 hours.",
      "Track every expense you make today.",
      "Sleep for at least 7 hours tonight.",
      "Declutter one drawer or shelf.",
      "Compliment someone sincerely.",
      "Write down tomorrow's top 3 priorities before bed."
    ];

    const quoteText = document.getElementById("quoteText");
    const authorText = document.getElementById("authorText");
    const challengeText = document.getElementById("challengeText");

    function createParticles() {
      const particlesContainer = document.getElementById('particles');
      for (let i = 0; i < 20; i++) {
        const particle = document.createElement('div');
        particle.classList.add('particle');
        const size = Math.random() * 5 + 2;
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        particle.style.left = `${Math.random() * 100}%`;
        particle.style.top = `${Math.random() * 100}%`;
        particle.style.animationDelay = `${Math.random() * 15}s`;
        particle.style.opacity = Math.random() * 0.5;
        particlesContainer.appendChild(particle);
      }
    }

    function animateText(element) {
      element.classList.remove('fade-in');
      void element.offsetWidth;
      element.classList.add('fade-in');
    }

    function getQuote() {
      const random = Math.floor(Math.random() * quotes.length);
      quoteText.textContent = `"${quotes[random].quote}"`;
      authorText.textContent = `— ${quotes[random].author}`;
      animateText(quoteText);
      animateText(authorText);
    }
    
    function getChallenge() {
      const random = Math.floor(Math.random() * challenges.length);
      challengeText.textContent = challenges[random];
      animateText(challengeText);
    }
    
    function getDailyInspiration() {
      getQuote();
      getChallenge();
      document.querySelector('.floating-container').classList.add('animate-pulse');
      setTimeout(() => {
        document.querySelector('.floating-container').classList.remove('animate-pulse');
      }, 1000);
    }

    window.onload = () => {
      createParticles();
      getDailyInspiration();
      setInterval(() => {
        document.querySelector('.glow-text').classList.add('animate-pulse');
        setTimeout(() => {
          document.querySelector('.glow-text').classList.remove('animate-pulse');
        }, 1000);
      }, 5000);
    };
  </script>
</body>
</html>