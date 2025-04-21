<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keep Learning - Growth Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #111827;
            color: #f3f4f6;
        }
        .abril {
            font-family: 'Abril Fatface', serif;
        }
        .learning-path {
            stroke-dasharray: 1000;
            stroke-dashoffset: 1000;
            animation: dash 5s linear forwards;
        }
        @keyframes dash {
            to {
                stroke-dashoffset: 0;
            }
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
        }
        .progress-bar {
            height: 6px;
            border-radius: 3px;
            background-color: #374151;
        }
        .progress-fill {
            height: 100%;
            border-radius: 3px;
            transition: width 0.5s ease;
        }
    </style>
</head>
<body class="min-h-screen bg-gray-900">
    <div class="container mx-auto px-4 py-12">
        <header class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-orange-400 mb-4 abril">Keep Learning</h1>
            <p class="text-xl text-blue-300 max-w-2xl mx-auto abril">Continuously acquire new skills to grow personally and professionally in today's evolving world.</p>
        </header>

        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="bg-gray-800 p-8 rounded-2xl shadow-lg border border-gray-700 card-hover">
                <svg viewBox="0 0 400 300" class="w-full h-auto">
                    <path d="M100,150 Q200,50 300,150 Q200,250 100,150 Z" 
                          fill="#1e1b4b" stroke="#6366F1" stroke-width="3"/>
                    <path class="learning-path" d="M50,150 Q100,100 150,120 Q200,80 250,130 Q300,100 350,150" 
                          fill="none" stroke="#6366F1" stroke-width="4" stroke-linecap="round"/>
                    <g transform="translate(50,150)">
                        <circle cx="0" cy="0" r="8" fill="#6366F1"/>
                        <text x="0" y="-15" text-anchor="middle" class="text-xs font-bold fill-current text-gray-300">Start</text>
                    </g>
                    <g transform="translate(150,120)">
                        <circle cx="0" cy="0" r="8" fill="#6366F1"/>
                        <text x="0" y="-15" text-anchor="middle" class="text-xs font-bold fill-current text-gray-300">Skills</text>
                    </g>
                    <g transform="translate(250,130)">
                        <circle cx="0" cy="0" r="8" fill="#6366F1"/>
                        <text x="0" y="-15" text-anchor="middle" class="text-xs font-bold fill-current text-gray-300">Growth</text>
                    </g>
                    <g transform="translate(350,150)">
                        <circle cx="0" cy="0" r="8" fill="#6366F1"/>
                        <text x="0" y="-15" text-anchor="middle" class="text-xs font-bold fill-current text-gray-300">Success</text>
                    </g>
                </svg>
            </div>

            <div class="space-y-6">
                <div class="bg-gray-800 p-6 rounded-xl shadow-md border border-gray-700 card-hover">
                    <div class="flex items-start mb-3">
                        <div class="bg-orange-500/20 p-2 rounded-lg mr-4">
                            <i class="fas fa-brain text-orange-400 text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-orange-400 abril">Continuous Learning</h2>
                            <p class="text-gray-300 mt-2">The ongoing process of acquiring new knowledge and skills throughout one's life to adapt to changing environments and improve capabilities.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-800 p-6 rounded-xl shadow-md border border-gray-700 card-hover">
                    <div class="flex items-start mb-3">
                        <div class="bg-green-500/20 p-2 rounded-lg mr-4">
                            <i class="fas fa-chart-line text-green-400 text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-green-400 abril">Personal Growth</h2>
                            <p class="text-gray-300 mt-2">Development of self-awareness, identity, talents, and potential to improve quality of life and contribute to personal aspirations.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-800 p-6 rounded-xl shadow-md border border-gray-700 card-hover">
                    <div class="flex items-start mb-3">
                        <div class="bg-blue-500/20 p-2 rounded-lg mr-4">
                            <i class="fas fa-briefcase text-blue-400 text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-blue-400 abril">Professional Development</h2>
                            <p class="text-gray-300 mt-2">Enhancing skills and gaining knowledge to advance in one's career, increase job performance, and achieve career goals.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="mt-20">
            <h2 class="text-2xl font-bold text-center text-orange-400 mb-8 abril">Learning Resources</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-gray-800 p-6 rounded-xl shadow-md border border-gray-700 card-hover">
                    <div class="bg-blue-500/10 p-3 rounded-lg w-12 h-12 flex items-center justify-center mb-4">
                        <i class="fas fa-laptop-code text-blue-400 text-2xl"></i>
                    </div>
                    <h3 class="font-semibold text-lg mb-3 text-blue-400 abril">Online Courses</h3>
                    <p class="text-gray-300 mb-4">Structured learning paths from platforms like Coursera, Udemy, and edX.</p>
                    <div class="mb-4">
                        <div class="flex justify-between text-sm text-gray-500 mb-1">
                            <span>Popularity</span>
                            <span>85%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill bg-blue-500" style="width: 85%"></div>
                        </div>
                    </div>
                    <button class="btn-explore bg-blue-500/20 text-blue-400 hover:bg-blue-500/30 px-4 py-2 rounded-md text-sm font-medium transition-colors">Explore Courses</button>
                </div>
                
                <div class="bg-gray-800 p-6 rounded-xl shadow-md border border-gray-700 card-hover">
                    <div class="bg-green-500/10 p-3 rounded-lg w-12 h-12 flex items-center justify-center mb-4">
                        <i class="fas fa-book text-green-400 text-2xl"></i>
                    </div>
                    <h3 class="font-semibold text-lg mb-3 text-green-400 abril">Books & Articles</h3>
                    <p class="text-gray-300 mb-4">In-depth knowledge from experts in various fields and curated reading lists.</p>
                    <div class="mb-4">
                        <div class="flex justify-between text-sm text-gray-500 mb-1">
                            <span>Popularity</span>
                            <span>72%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill bg-green-500" style="width: 72%"></div>
                        </div>
                    </div>
                    <button class="btn-explore bg-green-500/20 text-green-400 hover:bg-green-500/30 px-4 py-2 rounded-md text-sm font-medium transition-colors">Explore Books</button>
                </div>
                
                <div class="bg-gray-800 p-6 rounded-xl shadow-md border border-gray-700 card-hover">
                    <div class="bg-orange-500/10 p-3 rounded-lg w-12 h-12 flex items-center justify-center mb-4">
                        <i class="fas fa-chalkboard-teacher text-orange-400 text-2xl"></i>
                    </div>
                    <h3 class="font-semibold text-lg mb-3 text-orange-400 abril">Workshops</h3>
                    <p class="text-gray-300 mb-4">Interactive sessions for hands-on learning experiences and networking.</p>
                    <div class="mb-4">
                        <div class="flex justify-between text-sm text-gray-500 mb-1">
                            <span>Popularity</span>
                            <span>68%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill bg-orange-500" style="width: 68%"></div>
                        </div>
                    </div>
                    <button class="btn-explore bg-orange-500/20 text-orange-400 hover:bg-orange-500/30 px-4 py-2 rounded-md text-sm font-medium transition-colors">Explore Workshops</button>
                </div>
            </div>
        </section>

        <section class="mt-20">
            <h2 class="text-2xl font-bold text-center text-orange-400 mb-8 abril">Recommended Learning Paths</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-gray-800 p-6 rounded-xl shadow-md border border-gray-700 card-hover">
                    <div class="flex items-start">
                        <div class="bg-blue-500/10 p-3 rounded-lg mr-4">
                            <i class="fas fa-code text-blue-400 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg mb-2 text-blue-400 abril">Web Development</h3>
                            <p class="text-gray-300 mb-4">Master modern web development with HTML, CSS, JavaScript, and frameworks.</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="bg-gray-700 text-gray-300 px-3 py-1 rounded-full text-xs">HTML/CSS</span>
                                <span class="bg-gray-700 text-gray-300 px-3 py-1 rounded-full text-xs">JavaScript</span>
                                <span class="bg-gray-700 text-gray-300 px-3 py-1 rounded-full text-xs">React</span>
                                <span class="bg-gray-700 text-gray-300 px-3 py-1 rounded-full text-xs">Node.js</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-800 p-6 rounded-xl shadow-md border border-gray-700 card-hover">
                    <div class="flex items-start">
                        <div class="bg-green-500/10 p-3 rounded-lg mr-4">
                            <i class="fas fa-robot text-green-400 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg mb-2 text-green-400 abril">Data Science</h3>
                            <p class="text-gray-300 mb-4">Learn data analysis, visualization, and machine learning techniques.</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="bg-gray-700 text-gray-300 px-3 py-1 rounded-full text-xs">Python</span>
                                <span class="bg-gray-700 text-gray-300 px-3 py-1 rounded-full text-xs">Pandas</span>
                                <span class="bg-gray-700 text-gray-300 px-3 py-1 rounded-full text-xs">TensorFlow</span>
                                <span class="bg-gray-700 text-gray-300 px-3 py-1 rounded-full text-xs">SQL</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-20 bg-gray-800 rounded-2xl p-8 border border-gray-700">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-2xl font-bold mb-4 text-orange-400 abril">Stay Updated on Learning Opportunities</h2>
                <p class="mb-6 text-gray-300">Join our newsletter to receive monthly learning resources, tips, and curated content.</p>
                <form id="newsletterForm" class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                    <input type="email" placeholder="Your email address" class="flex-grow px-4 py-3 rounded-md text-gray-900 bg-gray-200 focus:bg-white focus:ring-2 focus:ring-blue-500" required>
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-md font-medium transition-colors">Subscribe</button>
                </form>
                <p class="text-xs text-gray-500 mt-4">We respect your privacy. Unsubscribe at any time.</p>
            </div>
        </section>

        <section class="mt-20">
            <h2 class="text-2xl font-bold text-center text-orange-400 mb-8 abril">What Our Learners Say</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-gray-800 p-6 rounded-xl shadow-md border border-gray-700 card-hover">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-blue-500/20 flex items-center justify-center mr-4">
                            <span class="text-xl">👩‍💻</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-blue-400 abril">Sarah K.</h4>
                            <p class="text-sm text-gray-500">Web Developer</p>
                        </div>
                    </div>
                    <p class="text-gray-300 italic">"The learning resources helped me transition careers into tech. The structured paths made it easy to know what to learn next."</p>
                </div>
                <div class="bg-gray-800 p-6 rounded-xl shadow-md border border-gray-700 card-hover">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-green-500/20 flex items-center justify-center mr-4">
                            <span class="text-xl">👨‍💼</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-green-400 abril">Michael T.</h4>
                            <p class="text-sm text-gray-500">Product Manager</p>
                        </div>
                    </div>
                    <p class="text-gray-300 italic">"The newsletter consistently delivers high-quality content that helps me stay ahead in my field. Highly recommended!"</p>
                </div>
                <div class="bg-gray-800 p-6 rounded-xl shadow-md border border-gray-700 card-hover">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-orange-500/20 flex items-center justify-center mr-4">
                            <span class="text-xl">👩‍🎓</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-orange-400 abril">Priya M.</h4>
                            <p class="text-sm text-gray-500">Student</p>
                        </div>
                    </div>
                    <p class="text-gray-300 italic">"The workshop recommendations helped me gain practical skills that weren't covered in my university courses."</p>
                </div>
            </div>
        </section>
    </div>

    <footer class="bg-gray-900 border-t border-gray-800 mt-20 py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h3 class="text-xl font-bold text-orange-400 abril">Keep Learning</h3>
                    <p class="text-gray-500 text-sm">Your gateway to continuous growth</p>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-green-400 transition-colors"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="text-gray-400 hover:text-orange-400 transition-colors"><i class="fab fa-github"></i></a>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-6 pt-6 text-center text-gray-500 text-sm">
                <p>© 2023 Keep Learning. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-explore').forEach(button => {
                button.addEventListener('click', function() {
                    const resource = this.parentElement.querySelector('h3').textContent;
                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'fixed top-4 right-4 bg-gray-800 border border-gray-700 text-blue-400 px-6 py-4 rounded-lg shadow-lg z-50 max-w-xs';
                    alertDiv.innerHTML = `
                        <div class="flex items-start">
                            <div class="mr-3 mt-1">
                                <i class="fas fa-info-circle text-blue-400"></i>
                            </div>
                            <div>
                                <p>Opening <strong>${resource}</strong> resources...</p>
                                <div class="progress-bar mt-2">
                                    <div class="progress-fill bg-blue-500" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                    `;
                    document.body.appendChild(alertDiv);
                    
                    const fill = alertDiv.querySelector('.progress-fill');
                    let width = 0;
                    const interval = setInterval(() => {
                        if (width >= 100) {
                            clearInterval(interval);
                            setTimeout(() => {
                                alertDiv.remove();
                            }, 500);
                        } else {
                            width += 10;
                            fill.style.width = width + '%';
                        }
                    }, 50);
                });
            });

            const newsletterForm = document.getElementById('newsletterForm');
            if (newsletterForm) {
                newsletterForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const emailInput = this.querySelector('input[type="email"]');
                    const email = emailInput.value;
                    const submitBtn = this.querySelector('button[type="submit"]');
                    
                    const originalBtnText = submitBtn.textContent;
                    
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Subscribing...';
                    
                    setTimeout(() => {
                        const notification = document.createElement('div');
                        notification.className = 'fixed top-4 right-4 bg-gray-800 border border-gray-700 text-green-400 px-6 py-4 rounded-lg shadow-lg z-50 max-w-xs';
                        notification.innerHTML = `
                            <div class="flex items-start">
                                <div class="mr-3 mt-1">
                                    <i class="fas fa-check-circle text-green-400"></i>
                                </div>
                                <div>
                                    <p>Thank you for subscribing with <strong>${email}</strong>!</p>
                                    <p class="text-sm text-gray-400 mt-1">We'll send you our next learning newsletter.</p>
                                </div>
                            </div>
                        `;
                        document.body.appendChild(notification);
                        
                        setTimeout(() => {
                            notification.classList.add('opacity-0', 'transition-opacity', 'duration-300');
                            setTimeout(() => {
                                notification.remove();
                            }, 300);
                        }, 5000);
                        
                        this.reset();
                        submitBtn.disabled = false;
                        submitBtn.textContent = originalBtnText;
                    }, 1500);
                });
            }

            const animateOnScroll = () => {
                const elements = document.querySelectorAll('.card-hover');
                elements.forEach(el => {
                    const rect = el.getBoundingClientRect();
                    const isVisible = (rect.top <= window.innerHeight * 0.8);
                    
                    if (isVisible) {
                        el.style.opacity = '1';
                        el.style.transform = 'translateY(0)';
                    }
                });
            };

            document.querySelectorAll('.card-hover').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            });

            animateOnScroll();
            
            window.addEventListener('scroll', animateOnScroll);
        });
    </script>
</body>
</html>