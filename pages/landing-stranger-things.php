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
    <title>Stranger Things - Netflix Quiz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Netflix+Sans:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    <link rel="icon" href="../assets/images/logo n.png" type="image/png">
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
            background: linear-gradient(to bottom, rgba(0,0,0,0.8), rgba(0,0,0,0.9)), 
                        url('../assets/images/Stranger Things Banner.png');
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
            width: 33.33%;
            transition: width 0.3s ease;
        }
    </style>
</head>
<body class="text-white min-h-screen overflow-x-hidden">
    <!-- Progress Bar -->
    <div class="progress-bar">
        <div class="progress-fill"></div>
    </div>

    <!-- Netflix Logo -->
    <div class="absolute top-6 left-6 z-50">
        <img src="../assets/images/logo nitflix.png" alt="NETFLIX" class="h-8 sm:h-10">
    </div>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center px-4 py-20">
        <div class="max-w-4xl w-full">
            <!-- Film Info Card -->
            <div class="bg-black bg-opacity-80 backdrop-blur-xl rounded-3xl p-8 sm:p-12 border border-red-900 border-opacity-30 shadow-2xl">
                <!-- Film Logo/Title -->
                <div class="text-center mb-8">
                    <img src="../assets/images/Stranger logo.png" alt="Stranger Things" class="h-24 sm:h-32 mx-auto mb-6">
                    <h1 class="text-2xl sm:text-3xl font-bold mb-4">Isi Kuisioner Film Berikut Ini</h1>
                    <p class="text-gray-300 text-sm sm:text-base">Sudah nonton? Isi kuisionernya sekarang</p>
                </div>

                <!-- Film Banner -->
                <div class="relative rounded-2xl overflow-hidden mb-8 shadow-2xl">
                    <img src="../assets/images/Stranger Things Banner.png" alt="Stranger Things Banner" class="w-full h-64 sm:h-80 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                </div>

                <!-- Film Description -->
                <div class="mb-8 text-center sm:text-left">
                    <p class="text-gray-300 text-sm sm:text-base leading-relaxed">
                        Ketika seorang anak laki-laki menghilang, kota kecilnya mengungkap misteri yang melibatkan eksperimen rahasia, kekuatan supernatural menakutkan, dan seorang gadis aneh yang baru saja muncul.
                    </p>
                </div>

                <!-- User Info -->
                <div class="bg-gray-900 bg-opacity-50 rounded-xl p-4 mb-8">
                    <p class="text-sm text-gray-400">Pengisi Kuisioner:</p>
                    <p class="text-lg font-semibold text-white"><?php echo htmlspecialchars($userData['nama']); ?></p>
                    <p class="text-sm text-gray-400"><?php echo htmlspecialchars($userData['usia_label']); ?></p>
                </div>

                <!-- CTA Button -->
                <div class="text-center">
                    <button 
                        onclick="window.location.href='quiz-stranger-things.php'"
                        class="bg-netflix-red hover:bg-red-700 text-white font-bold py-4 px-12 rounded-xl text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-2xl hover:shadow-red-500/50 inline-flex items-center space-x-3"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Isi Kuisioner</span>
                    </button>
                </div>

                <!-- Progress Indicator -->
                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-400">Film 1 dari 3</p>
                    <div class="flex justify-center space-x-2 mt-2">
                        <div class="w-3 h-3 rounded-full bg-netflix-red"></div>
                        <div class="w-3 h-3 rounded-full bg-gray-600"></div>
                        <div class="w-3 h-3 rounded-full bg-gray-600"></div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-6 text-gray-400 text-sm">
                <p>By: <span class="font-semibold text-white">DetikBahagia Team</span></p>
            </div>
        </div>
    </div>
</body>
</html>