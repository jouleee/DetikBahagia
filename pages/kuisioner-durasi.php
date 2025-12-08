<?php
session_start();

if (!isset($_SESSION['user_data'])) {
    header('Location: ../index.php');
    exit();
}

$userData = $_SESSION['user_data'];
$ageCategory = $userData['usia_kategori'] ?? 'Dewasa';

// Define options based on age category with correct values in MINUTES
$options = [];

if ($ageCategory === 'Remaja') {
    $options = [
        [
            'label' => '1 jam per hari',
            'daily_hours' => 1,
            'weekly_hours' => 7,
            'total_minutes' => 426,
            'category' => 'Sangat Ringan'
        ],
        [
            'label' => '2 jam per hari',
            'daily_hours' => 2,
            'weekly_hours' => 14,
            'total_minutes' => 852,
            'category' => 'Ringan'
        ],
        [
            'label' => '3 jam per hari',
            'daily_hours' => 3,
            'weekly_hours' => 21,
            'total_minutes' => 1278,
            'category' => 'Sedang'
        ],
        [
            'label' => '4 jam per hari',
            'daily_hours' => 4,
            'weekly_hours' => 28,
            'total_minutes' => 1704,
            'category' => 'Berat'
        ],
        [
            'label' => '5 jam per hari',
            'daily_hours' => 5,
            'weekly_hours' => 35,
            'total_minutes' => 2130,
            'category' => 'Sangat Berat'
        ]
    ];
} else {
    // Dewasa Muda & Dewasa
    $options = [
        [
            'label' => '2 jam per hari',
            'daily_hours' => 2,
            'weekly_hours' => 14,
            'total_minutes' => 852,
            'category' => 'Sangat Ringan'
        ],
        [
            'label' => '4 jam per hari',
            'daily_hours' => 4,
            'weekly_hours' => 28,
            'total_minutes' => 1704,
            'category' => 'Ringan'
        ],
        [
            'label' => '6 jam per hari',
            'daily_hours' => 6,
            'weekly_hours' => 42,
            'total_minutes' => 2556,
            'category' => 'Sedang'
        ],
        [
            'label' => '8 jam per hari',
            'daily_hours' => 8,
            'weekly_hours' => 56,
            'total_minutes' => 3408,
            'category' => 'Berat'
        ],
        [
            'label' => '10 jam per hari',
            'daily_hours' => 10,
            'weekly_hours' => 70,
            'total_minutes' => 4260,
            'category' => 'Sangat Berat'
        ]
    ];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Durasi Menonton - Netflix Quiz</title>
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
            background: #000000;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }
        
        /* Netflix-style background with red glow effects */
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
                radial-gradient(circle at 50% 50%, rgba(229, 9, 20, 0.1) 0%, transparent 70%);
            z-index: 0;
            pointer-events: none;
            animation: subtleRotate 30s linear infinite;
        }
        
        body::after {
            content: '';
            position: fixed;
            inset: 0;
            background: linear-gradient(180deg, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0.7) 50%, rgba(0,0,0,0.9) 100%);
            z-index: 1;
            pointer-events: none;
        }
        
        @keyframes subtleRotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Content wrapper to ensure it's above background */
        .content-wrapper {
            position: relative;
            z-index: 2;
        }
        
        .option-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        
        .option-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(229, 9, 20, 0) 0%, rgba(229, 9, 20, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        
        .option-card:hover {
            transform: translateX(8px) scale(1.02);
            border-color: rgba(229, 9, 20, 0.8);
            box-shadow: 0 10px 30px rgba(229, 9, 20, 0.3);
        }
        
        .option-card:hover::before {
            opacity: 1;
        }
        
        .option-card.selected {
            background: linear-gradient(135deg, rgba(229, 9, 20, 0.25) 0%, rgba(139, 0, 0, 0.2) 100%);
            border-color: #E50914;
            box-shadow: 0 0 30px rgba(229, 9, 20, 0.5), inset 0 0 20px rgba(229, 9, 20, 0.1);
        }
        
        .option-card.selected::before {
            opacity: 1;
        }
        
        /* Glow effect for selected option */
        .option-card.selected .check-icon {
            filter: drop-shadow(0 0 8px #E50914);
            animation: pulse 2s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        /* Container styling */
        .main-container {
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(229, 9, 20, 0.3);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.8), 0 0 40px rgba(229, 9, 20, 0.2);
        }
        
        /* Category badge styling */
        .category-badge {
            background: linear-gradient(135deg, rgba(229, 9, 20, 0.2) 0%, rgba(139, 0, 0, 0.3) 100%);
            border: 1px solid rgba(229, 9, 20, 0.4);
            box-shadow: inset 0 1px 3px rgba(229, 9, 20, 0.2);
        }
        
        /* Button styling */
        #nextBtn:not(:disabled) {
            background: linear-gradient(135deg, #E50914 0%, #B20710 100%);
            box-shadow: 0 4px 15px rgba(229, 9, 20, 0.4);
        }
        
        #nextBtn:not(:disabled):hover {
            background: linear-gradient(135deg, #F40612 0%, #C40812 100%);
            box-shadow: 0 6px 25px rgba(229, 9, 20, 0.6);
            transform: translateY(-2px);
        }
        
        /* Responsive adjustments */
        @media (max-width: 640px) {
            .option-card:hover {
                transform: translateX(5px) scale(1.01);
            }
        }
        
        @media (min-width: 1024px) {
            .option-card:hover {
                transform: translateX(12px) scale(1.03);
            }
        }
        
        /* Loading animation enhancement */
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="text-white min-h-screen">
    <!-- Netflix Logo -->
    <div class="content-wrapper">
        <div class="fixed top-3 sm:top-4 md:top-6 left-3 sm:left-4 md:left-6 z-50">
            <img src="../assets/images/logo nitflix.webp" alt="NETFLIX" class="h-5 sm:h-6 md:h-8 lg:h-10 transition-all duration-300 hover:scale-110" style="filter: drop-shadow(0 4px 10px rgba(229, 9, 20, 0.6));">
        </div>

        <!-- Main Content -->
        <div class="min-h-screen flex items-center justify-center px-3 sm:px-4 md:px-6 lg:px-8 py-20 sm:py-24 md:py-28">
            <div class="w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl">
                <div class="main-container rounded-xl sm:rounded-2xl md:rounded-3xl p-5 sm:p-6 md:p-8 lg:p-10">
                    <!-- Header -->
                    <div class="text-center mb-5 sm:mb-6 md:mb-8">
                        <div class="flex justify-center mb-4 sm:mb-5">
                            <div class="relative">
                                <svg class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 text-netflix-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div class="absolute inset-0 blur-xl bg-netflix-red opacity-30"></div>
                            </div>
                        </div>
                        <h1 class="text-base sm:text-lg md:text-xl lg:text-2xl font-bold mb-4 sm:mb-5 text-white leading-relaxed px-2 sm:px-4 text-center">
                            Jika kamu tidak menonton semua series sebelumnya, kira-kira berapa lama sih kamu menghabiskan waktu untuk menonton film atau series dalam sehari?
                        </h1>
                        <div class="category-badge rounded-lg sm:rounded-xl p-2 sm:p-3 inline-block">
                            <p class="text-gray-400 text-xs sm:text-sm">Kategori Usia:</p>
                            <p class="text-white font-bold text-sm sm:text-base md:text-lg"><?= htmlspecialchars($ageCategory) ?></p>
                        </div>
                    </div>

                    <!-- Options -->
                    <form id="durationForm">
                        <div class="space-y-2 sm:space-y-3 md:space-y-4 mb-5 sm:mb-6 md:mb-8">
                            <?php foreach ($options as $index => $option): ?>
                            <div class="option-card bg-gray-800 bg-opacity-40 border-2 border-gray-700 rounded-lg sm:rounded-xl md:rounded-2xl p-3 sm:p-4 md:p-5" 
                                 onclick="selectOption(<?= $option['total_minutes'] ?>, '<?= $option['category'] ?>', <?= $option['daily_hours'] ?>, <?= $option['weekly_hours'] ?>)">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="duration" value="<?= $option['total_minutes'] ?>" data-category="<?= $option['category'] ?>" class="hidden">
                                    <div class="flex-1">
                                        <div class="flex items-baseline space-x-1 sm:space-x-2">
                                            <span class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white"><?= $option['daily_hours'] ?></span>
                                            <span class="text-xs sm:text-sm md:text-base text-gray-300">jam per hari</span>
                                        </div>
                                    </div>
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 text-netflix-red opacity-0 check-icon transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </label>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Navigation -->
                        <div class="flex justify-end">
                            <button 
                                type="submit" 
                                id="nextBtn" 
                                disabled 
                                class="bg-gray-700 disabled:bg-gray-700 disabled:cursor-not-allowed disabled:opacity-50 text-white font-bold py-2 sm:py-3 md:py-4 px-6 sm:px-8 md:px-10 lg:px-12 rounded-lg sm:rounded-xl md:rounded-2xl text-xs sm:text-sm md:text-base transition-all duration-300 inline-flex items-center space-x-2"
                            >
                                <span>Lihat Hasil</span>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="text-center mt-4 sm:mt-5 md:mt-6 text-gray-400 text-xs sm:text-sm">
                    <p>By: <span class="font-semibold text-white">DetikBahagia Team</span></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedValue = null;
        let selectedCategory = null;
        let selectedDailyHours = null;
        let selectedWeeklyHours = null;

        function selectOption(totalMinutes, category, dailyHours, weeklyHours) {
            selectedValue = totalMinutes;
            selectedCategory = category;
            selectedDailyHours = dailyHours;
            selectedWeeklyHours = weeklyHours;
            
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

        document.getElementById('durationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!selectedValue || !selectedCategory) return;
            
            // Show loading
            showLoading();
            
            // Save to session
            fetch('../includes/save-duration.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    daily_hours: selectedDailyHours,
                    weekly_hours: selectedWeeklyHours,
                    total_minutes: selectedValue,
                    category: selectedCategory,
                    source: 'kuisioner-durasi'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    setTimeout(() => {
                        window.location.href = 'hasil.php';
                    }, 1500);
                } else {
                    hideLoading();
                    alert('Terjadi kesalahan. Silakan coba lagi.');
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
                        <div class="text-white text-lg font-semibold mb-2">Menghitung Hasil...</div>
                        <div class="text-gray-300 text-sm">Sedang menganalisis data Anda</div>
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
