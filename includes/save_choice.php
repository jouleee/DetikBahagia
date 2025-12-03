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

if (!isset($data['choice'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid choice data.'
    ]);
    exit();
}

// Save choice to session
$_SESSION['user_choice'] = [
    'choice' => $data['choice'],
    'timestamp' => $data['timestamp'] ?? date('Y-m-d H:i:s'),
    'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
];

// Optional: Log to file
$logEntry = sprintf(
    "[%s] User: %s | Choice: %s | IP: %s\n",
    date('Y-m-d H:i:s'),
    $_SESSION['user_data']['nama'] ?? 'Unknown',
    $data['choice'],
    $_SERVER['REMOTE_ADDR'] ?? 'unknown'
);

$logFile = __DIR__ . '/../logs/choices.log';
$logDir = dirname($logFile);

if (!is_dir($logDir)) {
    mkdir($logDir, 0755, true);
}

file_put_contents($logFile, $logEntry, FILE_APPEND);

echo json_encode([
    'success' => true,
    'message' => 'Choice saved successfully',
    'data' => [
        'choice' => $data['choice'],
        'user' => $_SESSION['user_data']['nama'] ?? 'Unknown',
        'redirect' => $data['choice'] === 'pernah' ? 'page-a.php' : 'page-b.php'
    ]
]);
?>