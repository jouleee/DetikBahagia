<?php
session_start();
header('Content-Type: application/json');

// Check if user is authenticated
if (!isset($_SESSION['user_data'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Session expired. Please login again.'
    ]);
    exit();
}

// Get JSON input
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!isset($data['film']) || !isset($data['question']) || !isset($data['answer'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid data.'
    ]);
    exit();
}

// Initialize quiz_data if not exists
if (!isset($_SESSION['quiz_data'])) {
    $_SESSION['quiz_data'] = [
        'stranger-things' => ['watched' => null, 'season' => null, 'duration' => 0],
        'wednesday' => ['watched' => null, 'season' => null, 'duration' => 0],
        'squid-game' => ['watched' => null, 'season' => null, 'duration' => 0],
        'total_duration' => 0
    ];
}

$film = $data['film'];
$question = $data['question'];
$answer = $data['answer'];

// Duration data per season (in minutes) - SESUAI SPESIFIKASI ANDA
$durations = [
    'stranger-things' => [
        1 => 408,
        2 => 467,
        3 => 439,
        4 => 782,
        5 => 850  // Season 5 duration (estimasi)
    ],
    'wednesday' => [
        1 => 413,
        2 => 463
    ],
    'squid-game' => [
        1 => 496,
        2 => 428,
        3 => 450  // Season 3 duration (estimasi)
    ]
];

// Save answer
if ($question === 'watched') {
    $_SESSION['quiz_data'][$film]['watched'] = $answer;
    
    // If belum, set duration to 0
    if ($answer === 'belum') {
        $_SESSION['quiz_data'][$film]['duration'] = 0;
        $_SESSION['quiz_data'][$film]['season'] = 0;
    }
} elseif ($question === 'season') {
    $season = intval($answer);
    $_SESSION['quiz_data'][$film]['season'] = $season;
    
    // Calculate total duration from Season 1 to selected season
    // LOGIKA PENTING: Jumlahkan dari Season 1 sampai Season yang dipilih
    $totalDuration = 0;
    for ($i = 1; $i <= $season; $i++) {
        if (isset($durations[$film][$i])) {
            $totalDuration += $durations[$film][$i];
        }
    }
    
    $_SESSION['quiz_data'][$film]['duration'] = $totalDuration;
}

// Calculate total duration from all films
$_SESSION['quiz_data']['total_duration'] = 
    $_SESSION['quiz_data']['stranger-things']['duration'] +
    $_SESSION['quiz_data']['wednesday']['duration'] +
    $_SESSION['quiz_data']['squid-game']['duration'];

// Log to file (optional)
$logEntry = sprintf(
    "[%s] User: %s | Film: %s | Question: %s | Answer: %s | Duration: %d min\n",
    date('Y-m-d H:i:s'),
    $_SESSION['user_data']['nama'] ?? 'Unknown',
    $film,
    $question,
    $answer,
    $_SESSION['quiz_data'][$film]['duration'] ?? 0
);

$logFile = __DIR__ . '/../logs/quiz-answers.log';
$logDir = dirname($logFile);

if (!is_dir($logDir)) {
    mkdir($logDir, 0755, true);
}

file_put_contents($logFile, $logEntry, FILE_APPEND);

// Return success response
echo json_encode([
    'success' => true,
    'message' => 'Answer saved successfully',
    'data' => [
        'film' => $film,
        'question' => $question,
        'answer' => $answer,
        'duration' => $_SESSION['quiz_data'][$film]['duration'] ?? 0,
        'total_duration' => $_SESSION['quiz_data']['total_duration'] ?? 0,
        'quiz_data' => $_SESSION['quiz_data']  // Debug purpose
    ]
]);
?>