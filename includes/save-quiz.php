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

// Save answer
if ($question === 'watched') {
    $_SESSION['quiz_data'][$film]['watched'] = $answer;
    
    // If belum, set duration to 0
    if ($answer === 'belum') {
        $_SESSION['quiz_data'][$film]['duration'] = 0;
        $_SESSION['quiz_data'][$film]['season'] = [];
    }
} elseif ($question === 'season') {
    // New logic: answer is array of selected seasons with total_minutes
    if (isset($data['total_minutes'])) {
        // Store selected seasons array
        $_SESSION['quiz_data'][$film]['season'] = $answer; // array of {season, minutes}
        // Store total duration from selected seasons
        $_SESSION['quiz_data'][$film]['duration'] = intval($data['total_minutes']);
    } else {
        // Fallback for old format (single season number)
        $season = intval($answer);
        $_SESSION['quiz_data'][$film]['season'] = $season;
        $_SESSION['quiz_data'][$film]['duration'] = 0;
    }
}

// Calculate total duration from all films
$_SESSION['quiz_data']['total_duration'] = 
    $_SESSION['quiz_data']['stranger-things']['duration'] +
    $_SESSION['quiz_data']['wednesday']['duration'] +
    $_SESSION['quiz_data']['squid-game']['duration'];

// Log to file (optional)
$answerLog = is_array($answer) ? json_encode($answer) : $answer;
$logEntry = sprintf(
    "[%s] User: %s | Film: %s | Question: %s | Answer: %s | Duration: %d min\n",
    date('Y-m-d H:i:s'),
    $_SESSION['user_data']['nama'] ?? 'Unknown',
    $film,
    $question,
    $answerLog,
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