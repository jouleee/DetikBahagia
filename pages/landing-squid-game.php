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
            background: linear-gradient(to bottom, rgba(0,0,0,0.9), rgba(0,0,0,0.95)), 
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
        
        .video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            background: #000;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8);
        }
        
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        
        .play-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.7));
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 10;
        }
        
        .play-overlay:hover {
            background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.8));
        }
        
        .play-overlay:hover .play-button {
            transform: scale(1.1);
            box-shadow: 0 0 40px rgba(229, 9, 20, 0.8);
        }
        
        .play-button {
            width: 100px;
            height: 100px;
            background: rgba(229, 9, 20, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 0 20px rgba(229, 9, 20, 0.6);
        }
        
        @media (max-width: 640px) {
            .play-button {
                width: 70px;
                height: 70px;
            }
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

                <!-- Video Player -->
                <div class="mb-6 sm:mb-8 lg:mb-10">
                    <div class="video-container" id="videoContainer">
                        <div class="play-overlay" id="playOverlay" onclick="playVideo()">
                            <div class="play-button">
                                <svg class="w-12 h-12 sm:w-14 sm:h-14 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>
                        <div id="player"></div>
                    </div>
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

    <!-- YouTube IFrame API -->
    <script>
        var player;
        var playerReady = false;
        
        // Load YouTube IFrame API
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        
        // Initialize player when API is ready
        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                height: '100%',
                width: '100%',
                videoId: 'zgGTVaG2UiQ', // Squid Game trailer
                playerVars: {
                    'playsinline': 1,
                    'autoplay': 0,
                    'controls': 1,
                    'rel': 0,
                    'modestbranding': 1,
                    'fs': 1, // Enable fullscreen
                    'hd': 1,
                    'vq': 'hd2160' // Request 4K quality
                },
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }
        
        function onPlayerReady(event) {
            playerReady = true;
            // Set quality to highest available
            var availableQualityLevels = player.getAvailableQualityLevels();
            if (availableQualityLevels.length > 0) {
                player.setPlaybackQuality(availableQualityLevels[0]);
            }
        }
        
        function onPlayerStateChange(event) {
            // Hide overlay when video starts playing
            if (event.data == YT.PlayerState.PLAYING) {
                document.getElementById('playOverlay').style.display = 'none';
            }
        }
        
        function playVideo() {
            if (playerReady) {
                player.playVideo();
                document.getElementById('playOverlay').style.display = 'none';
            }
        }
    </script>
</body>
</html>