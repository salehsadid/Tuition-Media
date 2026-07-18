<?php
$sessionPath = realpath(__DIR__ . '/../sessions') ?: (__DIR__ . '/../sessions');
session_save_path($sessionPath);
ini_set('session.gc_maxlifetime', 86400 * 30);
session_name('SMARTTUTOR_SESSION');
session_set_cookie_params([
    'lifetime' => 86400 * 30,
    'path'     => '/',
    'secure'   => false,
    'httponly' => true,
    'samesite' => 'Lax',
]);
session_start();
header('Content-Type: text/plain');
echo "=== SESSION DEBUG ===\n\n";
echo "session_name      : " . session_name() . "\n";
echo "session_id        : " . session_id() . "\n";
echo "session_save_path : " . session_save_path() . "\n";
echo "session_status    : " . session_status() . " (1=none, 2=active, 3=disabled)\n\n";
echo "=== SESSION DATA ===\n";
print_r($_SESSION);
echo "\n=== COOKIES ===\n";
print_r($_COOKIE);
echo "\n=== SESSION FILE ===\n";
$file = session_save_path() . DIRECTORY_SEPARATOR . 'sess_' . session_id();
echo "Expected file: $file\n";
echo "File exists: " . (file_exists($file) ? 'YES' : 'NO') . "\n";
echo "\n=== SESSIONS FOLDER FILES ===\n";
$files = glob(session_save_path() . DIRECTORY_SEPARATOR . 'sess_*');
echo "Total session files: " . count($files) . "\n";
foreach ($files as $f) {
    echo basename($f) . " — " . date('Y-m-d H:i:s', filemtime($f)) . "\n";
}
?>
