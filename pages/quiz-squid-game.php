<?php
session_start();

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
    <title>Kuisioner Squid Game - Netflix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Netflix+Sans:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    <link rel="icon" href="../assets/images/logo n.webp" type="image/webp">
    <style>
        body {
            font-family: 'Netflix Sans', Arial, sans-serif;
            background: linear-gradient(to bottom, rgba(0,0,0,0.9), rgba(0,0,0,0.95)), 
                        url('../assets/images/Squid Game Banner.webp');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .progress-bar { height: 4px; background: rgba(255,255,255,0.2); position: fixed; top: 0; left: 0; right: 0; z-index: 100; }
        .progress-fill { height: 100%; background: #E50914; width: 83.33%; }
        .option-card { transition: all 0.3s ease; cursor: pointer; }
        .option-card:hover { transform: translateX(5px); border-color: rgba(229, 9, 20, 0.6); }
        .option-card.selected { background: rgba(229, 9, 20, 0.2); border-color: #E50914; }
    </style>
</head>
<body class="text-white min-h-screen">
    <div class="progress-bar"><div class="progress-fill"></div></div>
    <div class="absolute top-6 left-6 z-50">
        <img src="../assets/images/logo nitflix.webp" alt="NETFLIX" class="h-8 sm:h-10">
    </div>

    <div class="min-h-screen flex items-center justify-center px-4 py-20">
        <div class="max-w-3xl w-full">
            <div class="bg-black bg-opacity-80 backdrop-blur-xl rounded-3xl p-8 sm:p-12 border border-green-900 border-opacity-30 shadow-2xl">
                <div class="text-center mb-8">
                    <img src="../assets/images/Squid logo.webp" alt="Squid Game" class="h-16 sm:h-20 mx-auto mb-6">
                    <div class="text-sm text-gray-400 mb-2">5/6</div>
                    <h2 class="text-2xl sm:text-3xl font-bold mb-4">Pernah Nonton Squid Game?</h2>
                </div>

                <form id="quizForm">
                    <div class="space-y-4 mb-8">
                        <div class="option-card bg-gray-800 bg-opacity-50 border-2 border-gray-700 rounded-xl p-5" onclick="selectOption('pernah')">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="watched" value="pernah" class="hidden">
                                <div class="flex-1"><span class="text-lg font-semibold">Pernah</span></div>
                                <svg class="w-6 h-6 text-netflix-red opacity-0 check-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </label>
                        </div>

                        <div class="option-card bg-gray-800 bg-opacity-50 border-2 border-gray-700 rounded-xl p-5" onclick="selectOption('belum')">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="watched" value="belum" class="hidden">
                                <div class="flex-1"><span class="text-lg font-semibold">Belum</span></div>
                                <svg class="w-6 h-6 text-netflix-red opacity-0 check-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" id="nextBtn" disabled class="bg-netflix-red hover:bg-red-700 disabled:bg-gray-700 disabled:cursor-not-allowed text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 inline-flex items-center space-x-2">
                            <span>Selanjutnya</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            <div class="text-center mt-6 text-gray-400 text-sm">
                <p>By: <span class="font-semibold text-white">DetikBahagia Team</span></p>
            </div>
        </div>
    </div>

    <script>
        let selectedValue = null;
        function selectOption(value) {
            selectedValue = value;
            document.querySelectorAll('.option-card').forEach(card => {
                card.classList.remove('selected');
                card.querySelector('.check-icon').style.opacity = '0';
            });
            event.currentTarget.classList.add('selected');
            event.currentTarget.querySelector('.check-icon').style.opacity = '1';
            document.getElementById('nextBtn').disabled = false;
        }

        document.getElementById('quizForm').addEventListener('submit', function(e) {
            e.preventDefault();
            if (!selectedValue) return;
            
            // Show loading overlay
            showLoading();
            
            fetch('../includes/save-quiz.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    film: 'squid-game',
                    question: 'watched',
                    answer: selectedValue
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    setTimeout(() => {
                        if (selectedValue === 'belum') {
                            // Check if all series are "belum"
                            const quizData = data.data.quiz_data;
                            const allBelum = 
                                quizData['stranger-things'].watched === 'belum' &&
                                quizData['wednesday'].watched === 'belum' &&
                                quizData['squid-game'].watched === 'belum';
                            
                            if (allBelum) {
                                // Redirect to duration questionnaire
                                window.location.href = 'kuisioner-durasi.php';
                            } else {
                                // Redirect to result page
                                window.location.href = 'hasil.php';
                            }
                        } else {
                            window.location.href = 'quiz-squid-game-season.php';
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