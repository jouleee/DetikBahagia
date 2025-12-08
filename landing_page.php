<?php
session_start();

// Check if user data exists
if (!isset($_SESSION['user_data'])) {
    header('Location: index.php');
    exit();
}

$userData = $_SESSION['user_data'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nitflix - DetikBahagia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Netflix+Sans:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    <link rel="icon" href="assets/images/logo n.webp" type="image/webp">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'netflix': ['Netflix Sans', 'Arial', 'sans-serif'],
                    },
                    colors: {
                        'netflix-red': '#E50914',
                        'netflix-dark': '#141414',
                        'netflix-gray': '#333333',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Netflix Sans', Arial, sans-serif;
            background: #000000;
            overflow-x: hidden;
            overflow-y: auto;
            min-height: 100vh;
            position: relative;
        }
        
        /* Background with red glow effects */
        body::before {
            content: '';
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: 
                radial-gradient(circle at 20% 30%, rgba(229, 9, 20, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(139, 0, 0, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(229, 9, 20, 0.08) 0%, transparent 70%);
            z-index: 1;
            pointer-events: none;
        }
        
        body::after {
            content: '';
            position: fixed;
            inset: 0;
            background: linear-gradient(180deg, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.8) 50%, rgba(0,0,0,0.95) 100%);
            z-index: 2;
            pointer-events: none;
        }
        
        /* Series card hover effects */
        .series-card {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            background: rgba(0, 0, 0, 0.6);
            border: 2px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }
        
        .series-card:hover {
            transform: translateY(-2px);
            border-color: rgba(229, 9, 20, 0.6);
            box-shadow: 0 15px 35px rgba(229, 9, 20, 0.4);
        }
        
        .series-banner {
            width: 100%;
            height: 180px;
            object-fit: cover;
            object-position: center center;
            transition: transform 0.3s ease;
        }
        
        /* Specific adjustments for Wednesday */
        .series-card[data-series="wednesday"] .series-banner {
            object-position: center 30%;
        }
        
        .series-card:hover .series-banner {
            transform: scale(1.02);
        }
        
        .series-logo {
            position: absolute;
            left: 24px;
            top: 50%;
            transform: translateY(-50%);
            max-width: 180px;
            max-height: 70px;
            object-fit: contain;
            filter: drop-shadow(0 6px 12px rgba(0, 0, 0, 0.9));
            z-index: 5;
        }
        
        /* Button styles */
        .choice-btn {
            transition: all 0.3s ease;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        
        .choice-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        }
        
        /* Responsive - Mobile */
        @media (max-width: 640px) {
            .series-banner {
                height: 120px;
            }
            
            .series-card[data-series="wednesday"] .series-banner {
                object-position: center 28%;
            }
            
            .series-logo {
                max-width: 100px;
                max-height: 45px;
                left: 16px;
            }
        }
        
        /* Responsive - Tablet */
        @media (min-width: 641px) and (max-width: 1024px) {
            .series-banner {
                height: 150px;
            }
            
            .series-card[data-series="wednesday"] .series-banner {
                object-position: center 30%;
            }
            
            .series-logo {
                max-width: 140px;
                max-height: 55px;
                left: 20px;
            }
        }
        
        /* Responsive - Desktop Large */
        @media (min-width: 1440px) {
            .series-banner {
                height: 200px;
            }
            
            .series-card[data-series="wednesday"] .series-banner {
                object-position: center 32%;
            }
            
            .series-logo {
                max-width: 220px;
                max-height: 85px;
                left: 28px;
            }
        }
        
        /* Landscape mobile */
        @media (max-height: 500px) and (orientation: landscape) {
            .series-banner {
                height: 80px;
            }
            
            .series-logo {
                max-width: 80px;
                max-height: 35px;
            }
        }
    </style>
</head>
<body class="text-white">
    <div class="min-h-screen flex flex-col relative" style="z-index: 3;">
        <!-- Netflix Logo Header -->
        <div class="relative z-10 pt-5 sm:pt-6 md:pt-8 pb-3 sm:pb-4 text-center flex-shrink-0">
            <img src="assets/images/logo nitflix.webp" alt="NETFLIX" class="h-10 sm:h-12 md:h-16 lg:h-18 mx-auto">
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col items-center justify-center px-4 sm:px-6 md:px-8 lg:px-10 max-w-6xl mx-auto w-full py-4 sm:py-6 md:py-8">
            <!-- Series Selection -->
            <div class="w-full space-y-3 sm:space-y-4 md:space-y-5 mb-6 sm:mb-8">
                <!-- Stranger Things -->
                <div class="series-card" data-series="stranger-things">
                    <div class="relative">
                        <img src="assets/images/Stranger Things Banner.webp" alt="Stranger Things" class="series-banner">
                        <img src="assets/images/Stranger logo.webp" alt="Stranger Things Logo" class="series-logo">
                    </div>
                </div>

                <!-- Wednesday -->
                <div class="series-card" data-series="wednesday">
                    <div class="relative">
                        <img src="assets/images/Wednesday banner.webp" alt="Wednesday" class="series-banner">
                        <img src="assets/images/Wednesday logo.webp" alt="Wednesday Logo" class="series-logo">
                    </div>
                </div>

                <!-- Squid Game -->
                <div class="series-card" data-series="squid-game">
                    <div class="relative">
                        <img src="assets/images/Squid Game Banner.webp" alt="Squid Game" class="series-banner">
                        <img src="assets/images/Squid logo.webp" alt="Squid Game Logo" class="series-logo">
                    </div>
                </div>
            </div>

            <!-- Question & Choices -->
            <div class="w-full max-w-3xl flex-shrink-0">
                <h2 class="text-white text-center text-lg sm:text-xl md:text-2xl font-bold mb-4 sm:mb-6 font-netflix">
                    Pernah Menonton Ketiga Series Ini?
                </h2>
                
                <div class="grid grid-cols-2 gap-4 sm:gap-5 md:gap-6">
                    <button 
                        onclick="handleChoice('belum')" 
                        class="choice-btn bg-gray-700 hover:bg-gray-600 text-white py-3 sm:py-4 md:py-5 px-5 sm:px-6 md:px-8 rounded-lg text-sm sm:text-base md:text-lg"
                    >
                        Belum
                    </button>
                    <button 
                        onclick="handleChoice('pernah')" 
                        class="choice-btn bg-netflix-red hover:bg-red-700 text-white py-3 sm:py-4 md:py-5 px-5 sm:px-6 md:px-8 rounded-lg text-sm sm:text-base md:text-lg"
                    >
                        Pernah
                    </button>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center py-4 sm:py-5 text-gray-400 text-xs sm:text-sm flex-shrink-0">
            <p>By:</p>
            <p class="font-semibold text-white">DetikBahagia Team</p>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-95 z-50 flex items-center justify-center hidden">
        <div class="text-center">
            <div class="inline-flex space-x-2 mb-6">
                <div class="w-4 h-4 bg-netflix-red rounded-full animate-bounce"></div>
                <div class="w-4 h-4 bg-netflix-red rounded-full animate-bounce delay-75"></div>
                <div class="w-4 h-4 bg-netflix-red rounded-full animate-bounce delay-150"></div>
            </div>
            <p class="text-white font-netflix text-lg">Memproses pilihan Anda...</p>
        </div>
    </div>

    <script>
        // Store user data in sessionStorage for client-side access
        const userData = {
            nama: '<?php echo htmlspecialchars($userData['nama']); ?>',
            usia: '<?php echo htmlspecialchars($userData['usia']); ?>',
            usia_label: '<?php echo htmlspecialchars($userData['usia_label']); ?>'
        };
        
        console.log('User Data:', userData);

        // Handle series card clicks
        document.querySelectorAll('.series-card').forEach(card => {
            card.addEventListener('click', function() {
                const series = this.dataset.series;
                console.log('Series clicked:', series);
                // Add selection visual feedback
                this.style.borderColor = 'rgba(229, 9, 20, 0.8)';
                this.style.transform = 'scale(1.02)';
                
                setTimeout(() => {
                    this.style.transform = '';
                }, 200);
            });
        });

        // Handle choice selection
        function handleChoice(choice) {
            console.log('Choice selected:', choice, 'User:', userData.nama);
            
            // Show loading
            document.getElementById('loadingOverlay').classList.remove('hidden');
            
            // If "Belum", go directly to duration questionnaire
            if (choice === 'belum') {
                // Initialize session with all "belum"
                fetch('includes/save_choice.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        choice: 'belum',
                        skip_quiz: true,
                        timestamp: new Date().toISOString()
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Choice saved:', data);
                    setTimeout(() => {
                        // Redirect to duration questionnaire
                        window.location.href = 'pages/kuisioner-durasi.php';
                    }, 1000);
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('loadingOverlay').classList.add('hidden');
                    showNotification('Terjadi kesalahan. Silakan coba lagi.', 'error');
                });
            } else {
                // If "Pernah", go to normal quiz flow
                fetch('includes/save_choice.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        choice: choice,
                        timestamp: new Date().toISOString()
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Choice saved:', data);
                    
                    setTimeout(() => {
                        // Redirect ke flow kuisioner - dimulai dari Stranger Things
                        window.location.href = 'pages/landing-stranger-things.php';
                    }, 1000);
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('loadingOverlay').classList.add('hidden');
                    showNotification('Terjadi kesalahan. Silakan coba lagi.', 'error');
                });
            }
        }

        // Notification system
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-green-600' : type === 'error' ? 'bg-red-600' : 'bg-blue-600';
            
            notification.className = `fixed top-5 right-5 ${bgColor} text-white px-6 py-4 rounded-xl shadow-xl z-50 transform translate-x-full transition-all duration-300`;
            notification.innerHTML = `
                <div class="flex items-center space-x-3">
                    <span class="font-medium">${message}</span>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-2 text-white hover:text-gray-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);

            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 5000);
        }

        // Add entrance animations
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.series-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                
                setTimeout(() => {
                    card.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 150);
            });
        });

        // Prevent going back
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
    </script>
</body>
</html>
