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
    <title>Wednesday - Netflix Quiz</title>
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
                        url('../assets/images/Wednesday\ banner.webp');
            background-size: cover;
            background-position: center 30%;
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
            width: 66.66%;
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
    <div class="absolute top-6 left-6 z-50">
        <img src="../assets/images/logo nitflix.webp" alt="NETFLIX" class="h-8 sm:h-10">
    </div>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center px-4 py-20">
        <div class="max-w-4xl w-full">
            <!-- Film Info Card -->
            <div class="bg-black bg-opacity-80 backdrop-blur-xl rounded-3xl p-8 sm:p-12 border border-gray-700 border-opacity-30 shadow-2xl">
                <!-- Film Logo/Title -->
                <div class="text-center mb-8">
                    <img src="../assets/images/Wednesday logo.webp" alt="Wednesday" class="h-24 sm:h-32 mx-auto mb-6">
                    <h1 class="text-2xl sm:text-3xl font-bold mb-4">Isi Kuisioner Film Berikut Ini</h1>
                    <p class="text-gray-300 text-sm sm:text-base">Sudah nonton? Isi kuisionernya sekarang</p>
                </div>

                <!-- Video Player -->
                <div class="mb-8 sm:mb-10 lg:mb-12">
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
                <div class="text-center">
                    <button 
                        onclick="window.location.href='quiz-wednesday.php'"
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
                    <p class="text-sm text-gray-400">Film 2 dari 3</p>
                    <div class="flex justify-center space-x-2 mt-2">
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        <div class="w-3 h-3 rounded-full bg-netflix-red"></div>
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
                videoId: '03u4xyj0TH4', // Wednesday trailer
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