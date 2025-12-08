<?php
session_start();
header('Content-Type: application/json');

// Get POST data
$nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
$usia = isset($_POST['usia']) ? trim($_POST['usia']) : '';

// Validation
if (empty($nama) || empty($usia)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Semua field harus diisi!'
    ]);
    exit();
}

if (strlen($nama) < 2) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Nama minimal 2 karakter!'
    ]);
    exit();
}

// Validate usia
$valid_usia = ['remaja', 'dewasa_muda', 'dewasa'];
if (!in_array($usia, $valid_usia)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Pilihan usia tidak valid!'
    ]);
    exit();
}

// Map usia to label and category
$usia_labels = [
    'remaja' => 'REMAJA 12 - 19 Tahun',
    'dewasa_muda' => 'DEWASA MUDA 20 - 30 Tahun',
    'dewasa' => 'DEWASA 31 - 70 Tahun'
];

$usia_kategori = [
    'remaja' => 'Remaja',
    'dewasa_muda' => 'Dewasa Muda',
    'dewasa' => 'Dewasa'
];

// Save to session
$_SESSION['user_data'] = [
    'nama' => htmlspecialchars($nama, ENT_QUOTES, 'UTF-8'),
    'usia' => $usia,
    'usia_label' => $usia_labels[$usia],
    'usia_kategori' => $usia_kategori[$usia], // Add category for quiz logic
    'timestamp' => date('Y-m-d H:i:s'),
    'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
];

// Log to file (optional)
$logEntry = sprintf(
    "[%s] Nama: %s | Usia: %s | IP: %s\n",
    date('Y-m-d H:i:s'),
    $nama,
    $usia_labels[$usia],
    $_SERVER['REMOTE_ADDR'] ?? 'unknown'
);

$logFile = __DIR__ . '/../logs/submissions.log';
$logDir = dirname($logFile);

if (!is_dir($logDir)) {
    mkdir($logDir, 0755, true);
}

file_put_contents($logFile, $logEntry, FILE_APPEND);

// Return success response
echo json_encode([
    'status' => 'success',
    'message' => 'Data berhasil disimpan!',
    'data' => [
        'nama' => $_SESSION['user_data']['nama'],
        'usia_label' => $_SESSION['user_data']['usia_label']
    ]
]);
?>