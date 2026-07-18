<?php
// Logout: clear all 3 role sessions so complete signout happens regardless of which role is active
$sessionPath = __DIR__ . '/../sessions';
$roles = [
    'STU_SESSION',
    'TUT_SESSION',
    'ADM_SESSION',
];

foreach ($roles as $name) {
    session_save_path($sessionPath);
    session_name($name);
    session_set_cookie_params([
        'lifetime' => 86400 * 30,
        'path'     => '/',
        'secure'   => false,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_unset();
    session_destroy();
    // Clear the cookie
    setcookie($name, '', time() - 3600, '/');
    session_write_close();
}

header('Location: login.php');
exit;
?>
