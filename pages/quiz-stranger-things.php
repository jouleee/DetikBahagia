<?php
session_start();

// Check if user data exists
if (!isset($_SESSION['user_data'])) {
    header('Location: ../index.php');
    exit();
}

$userData = $_SESSION['user_data'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuisioner Stranger Things - Netflix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Netflix+Sans:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    <link rel="icon" href="../assets/images/logo n.webp" type="image/webp">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'netflix': ['Netflix Sans', 'Arial', 'sans-serif'],
                    },
                    colors: {
                        'netflix-red': '#E50914',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Netflix Sans', Arial, sans-serif;
            background: linear-gradient(to bottom, rgba(0,0,0,0.9), rgba(0,0,0,0.95)), 
                        url('../assets/images/Stranger Things Banner.webp');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        .progress-bar {
            height: 4px;
            background: rgba(255,255,255,0.2);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
        }
        
        .progress-fill {
            height: 100%;
            background: #E50914;
            transition: width 0.3s ease;
        }
        
        .option-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .option-card:hover {
            transform: translateX(5px);
            border-color: rgba(229, 9, 20, 0.6);
        }
        
        .option-card.selected {
            background: rgba(229, 9, 20, 0.2);
            border-color: #E50914;
        }
    </style>
</head>
<body class="text-white min-h-screen">
    <!-- Progress Bar -->
    <div class="progress-bar">
        <div class="progress-fill" style="width: 16.66%"></div>
    </div>

    <!-- Netflix Logo -->
    <div class="absolute top-4 sm:top-6 left-4 sm:left-6 z-50">
        <img src="../assets/images/logo nitflix.webp" alt="NETFLIX" class="h-6 sm:h-8 lg:h-10">
    </div>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center px-3 sm:px-6 lg:px-8 py-16 sm:py-20">
        <div class="max-w-md sm:max-w-lg md:max-w-2xl lg:max-w-3xl xl:max-w-4xl w-full">
            <div class="bg-black bg-opacity-80 backdrop-blur-xl rounded-2xl sm:rounded-3xl p-6 sm:p-8 lg:p-10 xl:p-12 border border-red-900 border-opacity-30 shadow-2xl">
                <!-- Header -->
                <div class="text-center mb-6 sm:mb-8">
                    <img src="../assets/images/Stranger logo.webp" alt="Stranger Things" class="h-12 sm:h-16 lg:h-20 mx-auto mb-4 sm:mb-6">
                    <div class="text-xs sm:text-sm text-gray-400 mb-2">1/6</div>
                    <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-3 sm:mb-4 leading-tight">Pernah Nonton Stranger Things?</h2>
                </div>

                <!-- Options -->
                <form id="quizForm">
                    <input type="hidden" name="film" value="stranger-things">
                    <input type="hidden" name="question" value="watched">
                    
                    <div class="space-y-3 sm:space-y-4 mb-6 sm:mb-8">
                        <div class="option-card bg-gray-800 bg-opacity-50 border-2 border-gray-700 rounded-lg sm:rounded-xl p-4 sm:p-5" onclick="selectOption('pernah')">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="watched" value="pernah" class="hidden">
                                <div class="flex-1">
                                    <span class="text-base sm:text-lg lg:text-xl font-semibold">Pernah</span>
                                </div>
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-netflix-red opacity-0 check-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </label>
                        </div>

                        <div class="option-card bg-gray-800 bg-opacity-50 border-2 border-gray-700 rounded-lg sm:rounded-xl p-4 sm:p-5" onclick="selectOption('belum')">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="watched" value="belum" class="hidden">
                                <div class="flex-1">
                                    <span class="text-base sm:text-lg lg:text-xl font-semibold">Belum</span>
                                </div>
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-netflix-red opacity-0 check-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </label>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="flex justify-end">
                        <button 
                            type="submit"
                            id="nextBtn"
                            disabled
                            class="bg-netflix-red hover:bg-red-700 disabled:bg-gray-700 disabled:cursor-not-allowed text-white font-bold py-3 sm:py-4 px-6 sm:px-8 lg:px-10 rounded-lg sm:rounded-xl transition-all duration-300 inline-flex items-center space-x-2 text-sm sm:text-base"
                        >
                            <span>Selanjutnya</span>
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="text-center mt-4 sm:mt-6 text-gray-400 text-xs sm:text-sm">
                <p>By: <span class="font-semibold text-white">DetikBahagia Team</span></p>
            </div>
        </div>
    </div>

    <script>
        let selectedValue = null;

        function selectOption(value) {
            selectedValue = value;
            
            // Remove all selected states
            document.querySelectorAll('.option-card').forEach(card => {
                card.classList.remove('selected');
                card.querySelector('.check-icon').style.opacity = '0';
            });
            
            // Add selected state to clicked option
            const selectedCard = event.currentTarget;
            selectedCard.classList.add('selected');
            selectedCard.querySelector('.check-icon').style.opacity = '1';
            
            // Enable next button
            document.getElementById('nextBtn').disabled = false;
        }

        document.getElementById('quizForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!selectedValue) return;
            
            // Show loading overlay
            showLoading();
            
            // Save to session via AJAX
            fetch('../includes/save-quiz.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    film: 'stranger-things',
                    question: 'watched',
                    answer: selectedValue
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    setTimeout(() => {
                        // If belum, skip to next film
                        if (selectedValue === 'belum') {
                            window.location.href = 'landing-wednesday.php';
                        } else {
                            // If pernah, go to season selection
                            window.location.href = 'quiz-stranger-things-season.php';
                        }
                    }, 1000);
                }
            })
            .catch(error => {
                hideLoading();
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            });
        });
        
        function showLoading() {
            const loadingHTML = `
                <div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50">
                    <div class="text-center">
                        <div class="mb-4">
                            <div class="w-16 h-16 border-4 border-netflix-red border-t-transparent rounded-full animate-spin mx-auto"></div>
                        </div>
                        <div class="text-white text-lg font-semibold mb-2">Menyimpan Jawaban...</div>
                        <div class="text-gray-300 text-sm">Mohon tunggu sebentar</div>
                    </div>
                </div>
            `;
            document.body.insertAdjacentHTML('beforeend', loadingHTML);
        }
        
        function hideLoading() {
            const overlay = document.getElementById('loadingOverlay');
            if (overlay) {
                overlay.remove();
            }
        }
    </script>
</body>
</html>