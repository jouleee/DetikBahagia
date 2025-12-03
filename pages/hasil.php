<?php
session_start();

if (!isset($_SESSION['user_data']) || !isset($_SESSION['quiz_data'])) {
    header('Location: ../index.php');
    exit();
}

$userData = $_SESSION['user_data'];
$quizData = $_SESSION['quiz_data'];

// Calculate total hours from total minutes
$totalMinutes = $quizData['total_duration'] ?? 0;
$totalHours = round($totalMinutes / 60, 1);

// Get age category
$ageCategory = $userData['usia_kategori'] ?? 'Dewasa';

// Define range limits based on age category
$ranges = [
    'Remaja' => [
        'A' => 7.1,
        'B' => 14.2,
        'C' => 21.3,
        'D' => 28.4,
        'E' => 35.5
    ],
    'Dewasa Muda' => [
        'A' => 14.2,
        'B' => 28.4,
        'C' => 42.6,
        'D' => 56.8,
        'E' => 71
    ],
    'Dewasa' => [
        'A' => 14.2,
        'B' => 28.4,
        'C' => 42.6,
        'D' => 56.8,
        'E' => 71
    ]
];

$currentRanges = $ranges[$ageCategory] ?? $ranges['Dewasa'];

// Determine category based on total hours
$category = '';
$categoryData = [];

if ($totalHours < $currentRanges['A']) {
    $category = 'Sangat Ringan';
    $categoryData = [
        'label' => 'Sangat Ringan',
        'percentage' => round(($totalHours / $currentRanges['E']) * 100),
        'color' => 'bg-green-500',
        'border' => 'border-green-500',
        'icon' => 'info',
        'description' => 'Jam nontonmu tergolong sedikit. Good balance, keep it up!'
    ];
} elseif ($totalHours >= $currentRanges['A'] && $totalHours < $currentRanges['B']) {
    $category = 'Ringan';
    $categoryData = [
        'label' => 'Ringan',
        'percentage' => round(($totalHours / $currentRanges['E']) * 100),
        'color' => 'bg-teal-500',
        'border' => 'border-teal-500', 
        'icon' => 'info',
        'description' => 'Kamu masih di batas wajar. Senal aja tapi tetap jaga ritme ya!'
    ];
} elseif ($totalHours >= $currentRanges['B'] && $totalHours < $currentRanges['C']) {
    $category = 'Sedang';
    $categoryData = [
        'label' => 'Sedang',
        'percentage' => round(($totalHours / $currentRanges['E']) * 100),
        'color' => 'bg-orange-500',
        'border' => 'border-orange-500',
        'icon' => 'warning',
        'description' => 'Lumayan sering nonton ini. Nggak apa-apa tapi tetap imbang dengan aktivitas lain!'
    ];
} elseif ($totalHours >= $currentRanges['C'] && $totalHours < $currentRanges['D']) {
    $category = 'Berat';
    $categoryData = [
        'label' => 'Berat',
        'percentage' => round(($totalHours / $currentRanges['E']) * 100),
        'color' => 'bg-red-500',
        'border' => 'border-red-500',
        'icon' => 'alert',
        'description' => 'Wah, jam nontonmu mulai tinggi. Take a breath—seresah oleh makian enjoy filmnya!'
    ];
} else {
    $category = 'Sangat Berat';
    $categoryData = [
        'label' => 'Sangat Berat',
        'percentage' => 100,
        'color' => 'bg-red-600',
        'border' => 'border-red-600',
        'icon' => 'alert',
        'description' => 'Jam nontonmu cukup tinggi. Kamu adalah sensuan kok, coba sekedar jeda aja dulu feels good.'
    ];
}

// Define advice based on category
$adviceTexts = [
    'Sangat Ringan' => [
        'Terus pertahankan kebiasaan menonton yang seimbang. Kamu sudah mampu menikmati tontonan tanpa mengorbankan aktivitas penting lainnya, dan ini menunjukkan kontrol diri yang baik dalam mengatur waktu hiburan.',
        'Sesekali cobalah eksplorasi jenis tontonan baru untuk memperkaya pengalaman tanpa menambah durasi menonton secara berlebihan. Strategi ini bisa menjaga hiburan tetap menyenangkan tanpa mengganggu rutinitas.',
        'Tetap perhatikan tanda-tanda awal kecenderungan binge watching, seperti sulit berhenti menonton. Dengan kesadaran sejak dini, kamu bisa mempertahankan gaya menonton yang sehat dalam jangka panjang.'
    ],
    'Ringan' => [
        'Kebiasaan menonton kamu masih dalam batas wajar, namun tetap penting untuk mulai mengatur durasi agar tidak perlahan meningkat. Dengan menetapkan batas waktu harian atau jumlah episode, kamu bisa menikmati tontonan secara lebih terarah.',
        'Cobalah mengombinasikan waktu menonton dengan aktivitas lain seperti membaca, olahraga ringan, atau hobi lain. Variasi ini dapat membantu mencegah kebiasaan menonton menjadi kebiasaan pasif yang menguras waktu.',
        'Perhatikan alasan kamu menonton lebih lama—apakah karena bosan, stres, atau FOMO. Mengetahui pemicunya bisa membantumu mengontrol perilaku menonton sebelum berubah menjadi kecenderungan binge watching yang lebih kuat.'
    ],
    'Sedang' => [
        'Kamu mulai menunjukkan kecenderungan binge watching yang cukup terasa, jadi penting untuk membuat jadwal menonton yang lebih terstruktur. Menetapkan jadwal bisa membantumu menikmati hiburan tanpa membuat aktivitas utama terganggu.',
        'Cobalah memakai teknik seperti jeda 10–15 menit setiap satu atau dua episode untuk membantu otak beristirahat dan memberikan kesempatan menilai apakah kamu ingin lanjut atau berhenti. Ini dapat mencegah menonton secara impulsif.',
        'Temukan alternatif pengalihan yang sehat ketika kamu ingin menonton berlebihan, seperti berjalan sebentar, berbincang dengan teman, atau menyelesaikan hal-hal kecil. Tindakan kecil ini sangat membantu mengurangi dorongan binge watching.'
    ],
    'Berat' => [
        'Kebiasaan binge watching kamu cukup intens dan mungkin sudah mulai mengganggu rutinitas. Mulailah menetapkan batas tegas seperti "maksimal 1 episode per hari" atau "tidak menonton setelah jam tertentu" untuk membantu memulihkan keseimbangan waktu.',
        'Evaluasi kebutuhan emosional yang membuatmu menonton terlalu banyak. Jika binge watching menjadi pelarian dari stres atau masalah, cobalah membagi beban lewat journaling, berbicara dengan seseorang, atau melakukan aktivitas yang menenangkan.',
        'Jika memungkinkan, kurangi akses yang memicu maraton menonton, seperti menonaktifkan autoplay atau membuat daftar tontonan yang lebih pendek. Strategi ini membantu kamu mengendalikan keinginan menonton tanpa harus berhenti total.'
    ],
    'Sangat Berat' => [
        'Kamu menunjukkan kebiasaan binge watching yang sangat kuat dan mungkin sudah berdampak pada tidur, pekerjaan, atau hubungan sosial. Pada tahap ini, membuat rencana kontrol yang ketat seperti "hari tanpa menonton" bisa sangat membantu memulihkan keseimbangan.',
        'Tinjau alasan utama kamu menonton secara berlebihan—apakah karena tekanan emosional, kesepian, atau kebutuhan untuk menghindari realitas. Mencari dukungan dari teman, keluarga, atau profesional dapat membantu kamu menemukan cara yang lebih sehat untuk menghadapi pemicu tersebut.',
        'Upayakan perlahan membangun rutinitas baru yang memuaskan selain menonton, seperti olahraga, komunitas hobi, atau aktivitas relaksasi. Kebiasaan positif ini dapat secara bertahap menggantikan dorongan kuat untuk binge watching dan meningkatkan kualitas hidupmu secara keseluruhan.'
    ]
];

$currentAdvice = $adviceTexts[$category] ?? $adviceTexts['Sedang'];

// Format time display
function formatTime($totalMinutes) {
    $hours = floor($totalMinutes / 60);
    $minutes = $totalMinutes % 60;
    
    if ($hours > 0 && $minutes > 0) {
        return $hours . ' Jam ' . $minutes . ' Menit';
    } elseif ($hours > 0) {
        return $hours . ' Jam';
    } else {
        return $minutes . ' Menit';
    }
}

$formattedTime = formatTime($totalMinutes);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Analisis - Netflix Quiz</title>
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
            background: linear-gradient(135deg, #000000 0%, #141414 25%, #000000 50%, #141414 75%, #000000 100%);
            min-height: 100vh;
        }
        
        .progress-ring {
            transform: rotate(-90deg);
        }
        
        .progress-circle {
            stroke-dasharray: 219.91;
            stroke-dashoffset: 219.91;
            transition: stroke-dashoffset 2s ease-in-out;
            stroke-linecap: round;
            filter: drop-shadow(0 0 8px currentColor);
        }
        
        .progress-bg {
            stroke-dasharray: 219.91;
        }
        
        .progress-container {
            filter: drop-shadow(0 4px 20px rgba(0, 0, 0, 0.5));
        }
        
        .advice-card {
            background: rgba(20, 20, 20, 0.95);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(229, 9, 20, 0.2);
        }
        
        .result-card {
            background: linear-gradient(145deg, rgba(20, 20, 20, 0.95) 0%, rgba(40, 40, 40, 0.8) 100%);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(229, 9, 20, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8);
        }
        
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 20px rgba(229, 9, 20, 0.3); }
            50% { box-shadow: 0 0 40px rgba(229, 9, 20, 0.6); }
        }
        
        .glow-animation {
            animation: glow 3s ease-in-out infinite;
        }
    </style>
</head>
<body class="text-white min-h-screen">
    <!-- Netflix Logo -->
    <div class="absolute top-4 sm:top-6 left-4 sm:left-6 z-50">
        <img src="../assets/images/logo nitflix.png" alt="NETFLIX" class="h-6 sm:h-8 lg:h-10">
    </div>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        <div class="max-w-xs sm:max-w-md md:max-w-lg lg:max-w-2xl xl:max-w-4xl w-full">
            
            <!-- Main Result Card -->
            <div class="result-card glow-animation rounded-xl sm:rounded-2xl p-4 sm:p-6 lg:p-8 mb-4 sm:mb-6">
                <!-- Header -->
                <div class="text-center mb-6 sm:mb-8">
                    <div class="flex justify-center mb-3 sm:mb-4">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-netflix-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-2 sm:mb-3 text-white">Hasil Analisis Jam Nonton Anda</h1>
                    <p class="text-gray-300 text-xs sm:text-sm">Berikut hasil analisis berdasarkan jawaban Anda</p>
                </div>

                <!-- Results Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 lg:gap-12 items-center">
                    
                    <!-- Progress Circle -->
                    <div class="text-center">
                        <div class="relative inline-block progress-container">
                            <svg class="w-32 h-32 sm:w-40 sm:h-40 lg:w-48 lg:h-48" viewBox="0 0 100 100">
                                <!-- Background circle -->
                                <circle 
                                    cx="50" cy="50" r="35" 
                                    stroke="rgba(40, 40, 40, 0.9)" 
                                    stroke-width="10" 
                                    fill="none"
                                    class="progress-bg"
                                ></circle>
                                <!-- Progress circle -->
                                <circle 
                                    cx="50" cy="50" r="35" 
                                    stroke="<?= $categoryData['color'] === 'bg-green-500' ? '#10B981' : ($categoryData['color'] === 'bg-teal-500' ? '#14B8A6' : ($categoryData['color'] === 'bg-orange-500' ? '#F59E0B' : ($categoryData['color'] === 'bg-red-500' ? '#EF4444' : '#DC2626'))) ?>" 
                                    stroke-width="10" 
                                    fill="none"
                                    stroke-linecap="round"
                                    class="progress-circle progress-ring"
                                    id="progressCircle"
                                ></circle>
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <div class="text-xl sm:text-2xl lg:text-3xl font-bold text-white" id="percentageText">0%</div>
                            </div>
                        </div>
                        <div class="mt-4 sm:mt-6">
                            <div class="text-lg sm:text-xl lg:text-2xl font-bold text-white mb-1"><?= $formattedTime ?></div>
                            <div class="text-base sm:text-lg font-medium text-gray-300 mb-2">Total: <?= $totalHours ?> Jam</div>
                            <div class="text-xs sm:text-sm text-gray-400 italic">*Hasil analisis ini bergantung pada range umur Anda.</div>
                        </div>
                    </div>

                    <!-- Category Card -->
                    <div class="<?= str_replace('bg-', 'bg-gradient-to-br from-', $categoryData['color']) ?> to-black rounded-xl sm:rounded-2xl p-4 sm:p-6 text-center border border-gray-700 shadow-xl">
                        <div class="flex justify-center mb-3 sm:mb-4">
                            <?php if ($categoryData['icon'] === 'info'): ?>
                                <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            <?php elseif ($categoryData['icon'] === 'warning'): ?>
                                <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            <?php else: ?>
                                <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            <?php endif; ?>
                        </div>
                        <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white mb-2 sm:mb-3 drop-shadow-lg"><?= $categoryData['label'] ?></h2>
                        <p class="text-white text-xs sm:text-sm opacity-95 leading-relaxed drop-shadow-sm"><?= $categoryData['description'] ?></p>
                    </div>
                </div>
            </div>

            <!-- Advice Section -->
            <div class="advice-card rounded-xl sm:rounded-2xl p-4 sm:p-6 lg:p-8">
                <div class="flex items-center mb-4 sm:mb-6">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 bg-netflix-red rounded-full flex items-center justify-center mr-3 shadow-lg">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-white">Perhatikan Beberapa Hal Berikut</h3>
                </div>

                <div class="space-y-3 sm:space-y-4">
                    <?php foreach ($currentAdvice as $index => $advice): ?>
                    <div class="bg-black bg-opacity-60 rounded-lg sm:rounded-xl p-3 sm:p-4 border border-gray-800 hover:border-netflix-red transition-colors duration-300">
                        <p class="text-gray-200 text-xs sm:text-sm leading-relaxed"><?= $advice ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Action Button -->
            <div class="text-center mt-4 sm:mt-6">
                <button 
                    onclick="window.location.href='../index.php'"
                    class="bg-netflix-red hover:bg-red-700 text-white font-bold py-2 sm:py-3 px-6 sm:px-8 lg:px-10 rounded-lg sm:rounded-xl text-sm sm:text-base transition-all duration-300 transform hover:scale-105 hover:shadow-xl hover:shadow-red-500/50 inline-flex items-center space-x-2"
                >
                    <span>Selesai & Keluar</span>
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </button>
            </div>

            <!-- Footer -->
            <div class="text-center mt-4 sm:mt-6 text-gray-400 text-xs sm:text-sm">
                <p>By: <span class="font-semibold text-white">DetikBahagia Team</span></p>
            </div>
        </div>
    </div>

    <script>
        // Debug: Show category data
        console.log('Category:', '<?= $category ?>');
        console.log('Color:', '<?= $categoryData['color'] ?>');
        console.log('Percentage:', <?= $categoryData['percentage'] ?>);
        
        // Animate progress circle and percentage on load
        document.addEventListener('DOMContentLoaded', function() {
            const targetPercentage = <?= $categoryData['percentage'] ?>;
            const circle = document.querySelector('.progress-circle');
            const percentageText = document.getElementById('percentageText');
            
            // Debug: Check if elements exist
            console.log('Circle element:', circle);
            console.log('Percentage text:', percentageText);
            
            // Set initial state
            circle.style.strokeDashoffset = '219.91';
            
            setTimeout(function() {
                // Animate circle
                const targetOffset = 219.91 - (219.91 * targetPercentage / 100);
                circle.style.strokeDashoffset = targetOffset;
                
                // Animate percentage counter
                let currentPercentage = 0;
                const increment = targetPercentage / 60; // 2 seconds animation
                
                const timer = setInterval(function() {
                    currentPercentage += increment;
                    if (currentPercentage >= targetPercentage) {
                        currentPercentage = targetPercentage;
                        clearInterval(timer);
                    }
                    percentageText.textContent = Math.round(currentPercentage) + '%';
                }, 33); // ~30fps
                
            }, 800);
        });
    </script>
</body>
</html>