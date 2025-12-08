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

if (!isset($data['daily_hours']) || !isset($data['category'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid data.'
    ]);
    exit();
}

// Initialize quiz_data if not exists
if (!isset($_SESSION['quiz_data'])) {
    $_SESSION['quiz_data'] = [
        'stranger-things' => ['watched' => 'belum', 'season' => 0, 'duration' => 0],
        'wednesday' => ['watched' => 'belum', 'season' => 0, 'duration' => 0],
        'squid-game' => ['watched' => 'belum', 'season' => 0, 'duration' => 0],
        'total_duration' => 0
    ];
}

// Save duration data
$dailyHours = floatval($data['daily_hours']);
$weeklyHours = floatval($data['weekly_hours']);
$totalMinutes = intval($data['total_minutes']);
$category = $data['category'];

// Store the total duration
$_SESSION['quiz_data']['total_duration'] = $totalMinutes;

// Store additional metadata
$_SESSION['quiz_data']['duration_source'] = 'kuisioner-durasi';
$_SESSION['quiz_data']['daily_hours'] = $dailyHours;
$_SESSION['quiz_data']['weekly_hours'] = $weeklyHours;
$_SESSION['quiz_data']['duration_category'] = $category;

// Log to file (optional)
$logEntry = sprintf(
    "[%s] User: %s | Daily: %.1f hours | Weekly: %.1f hours | Total: %d min | Category: %s\n",
    date('Y-m-d H:i:s'),
    $_SESSION['user_data']['nama'] ?? 'Unknown',
    $dailyHours,
    $weeklyHours,
    $totalMinutes,
    $category
);

$logFile = __DIR__ . '/../logs/duration-quiz.log';
$logDir = dirname($logFile);

if (!is_dir($logDir)) {
    mkdir($logDir, 0755, true);
}

file_put_contents($logFile, $logEntry, FILE_APPEND);

// Return success response
echo json_encode([
    'success' => true,
    'message' => 'Duration saved successfully',
    'data' => [
        'daily_hours' => $dailyHours,
        'weekly_hours' => $weeklyHours,
        'total_minutes' => $totalMinutes,
        'category' => $category,
        'quiz_data' => $_SESSION['quiz_data']
    ]
]);
?>
