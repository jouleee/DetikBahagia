<?php
session_start();

// Clear all session data
session_unset();
session_destroy();

// Start new session for fresh start
session_start();

// Return JSON response
header('Content-Type: application/json');
echo json_encode([
    'success' => true,
    'message' => 'Session cleared successfully',
    'redirect' => '../index.php'
]);
?>
