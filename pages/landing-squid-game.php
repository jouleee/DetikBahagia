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
    <title>Squid Game - Netflix Quiz</title>
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
            background: linear-gradient(to bottom, rgba(0,0,0,0.8), rgba(0,0,0,0.9)), 
                        url('../assets/images/Squid Game Banner.webp');
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
            width: 100%;
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
    <div class="absolute top-4 sm:top-6 left-4 sm:left-6 z-50">
        <img src="../assets/images/logo nitflix.webp" alt="NETFLIX" class="h-6 sm:h-8 lg:h-10">
    </div>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center px-3 sm:px-6 lg:px-8 py-16 sm:py-20">
        <div class="max-w-sm sm:max-w-lg md:max-w-2xl lg:max-w-3xl xl:max-w-4xl w-full">
            <!-- Film Info Card -->
            <div class="bg-black bg-opacity-80 backdrop-blur-xl rounded-2xl sm:rounded-3xl p-6 sm:p-8 lg:p-10 xl:p-12 border border-green-900 border-opacity-30 shadow-2xl">
                <!-- Film Logo/Title -->
                <div class="text-center mb-6 sm:mb-8">
                    <img src="../assets/images/Squid logo.webp" alt="Squid Game" class="h-16 sm:h-20 md:h-24 lg:h-28 xl:h-32 mx-auto mb-4 sm:mb-6">
                    <h1 class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-bold mb-3 sm:mb-4 leading-tight">Isi Kuisioner Film Berikut Ini</h1>
                    <p class="text-gray-300 text-xs sm:text-sm md:text-base px-2 sm:px-0">Sudah nonton? Isi kuisionernya sekarang</p>
                </div>

                <!-- Film Banner -->
                <div class="relative rounded-xl sm:rounded-2xl overflow-hidden mb-6 sm:mb-8 shadow-2xl">
                    <img src="../assets/images/Squid Game Banner.webp" alt="Squid Game Banner" class="w-full h-48 sm:h-56 md:h-64 lg:h-72 xl:h-80 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                </div>

                <!-- Film Description -->
                <div class="mb-6 sm:mb-8 text-center sm:text-left px-2 sm:px-0">
                    <p class="text-gray-300 text-xs sm:text-sm md:text-base lg:text-base leading-relaxed">
                        Squid Game adalah serial televisi survival drama Korea Selatan yang dibintangi oleh Lee Jung-jae dan Park Hae-soo. Ratusan orang yang putus asa secara finansial menerima undangan misterius untuk berkompetisi dalam permainan anak-anak. Di balik setiap permainan ada hadiah yang menggoda - tetapi taruhannya mematikan.
                    </p>
                </div>

                <!-- User Info -->
                <div class="bg-gray-900 bg-opacity-50 rounded-lg sm:rounded-xl p-3 sm:p-4 mb-6 sm:mb-8 mx-2 sm:mx-0">
                    <p class="text-xs sm:text-sm text-gray-400">Pengisi Kuisioner:</p>
                    <p class="text-sm sm:text-base md:text-lg font-semibold text-white"><?php echo htmlspecialchars($userData['nama']); ?></p>
                    <p class="text-xs sm:text-sm text-gray-400"><?php echo htmlspecialchars($userData['usia_label']); ?></p>
                </div>

                <!-- CTA Button -->
                <div class="text-center px-2 sm:px-0">
                    <button 
                        onclick="window.location.href='quiz-squid-game.php'"
                        class="bg-netflix-red hover:bg-red-700 text-white font-bold py-3 sm:py-4 px-8 sm:px-10 lg:px-12 rounded-lg sm:rounded-xl text-sm sm:text-base lg:text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-2xl hover:shadow-red-500/50 inline-flex items-center space-x-2 sm:space-x-3 w-full sm:w-auto justify-center"
                    >
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Isi Kuisioner</span>
                    </button>
                </div>

                <!-- Progress Indicator -->
                <div class="mt-6 sm:mt-8 text-center">
                    <p class="text-xs sm:text-sm text-gray-400">Film 3 dari 3</p>
                    <div class="flex justify-center space-x-2 mt-2">
                        <div class="w-2 h-2 sm:w-3 sm:h-3 rounded-full bg-green-500"></div>
                        <div class="w-2 h-2 sm:w-3 sm:h-3 rounded-full bg-green-500"></div>
                        <div class="w-2 h-2 sm:w-3 sm:h-3 rounded-full bg-netflix-red"></div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-4 sm:mt-6 text-gray-400 text-xs sm:text-sm">
                <p>By: <span class="font-semibold text-white">DetikBahagia Team</span></p>
            </div>
        </div>
    </div>
</body>
</html>