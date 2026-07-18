<?php
require_once __DIR__ . '/../config/database.php';

// Each role gets its own independent session so multiple roles can be tested
// simultaneously in different tabs of the same browser.
define('SESSION_NAMES', [
    'student' => 'STU_SESSION',
    'tutor'   => 'TUT_SESSION',
    'admin'   => 'ADM_SESSION',
]);

$sessionPath = __DIR__ . '/../sessions';
if (!is_dir($sessionPath)) mkdir($sessionPath, 0777, true);

/**
 * Boot the session for $role. Must be called before any output.
 */
function _bootSession($role) {
    static $booted = [];
    if (isset($booted[$role])) return;
    $booted[$role] = true;

    $sessionPath = __DIR__ . '/../sessions';
    $name = SESSION_NAMES[$role] ?? 'SMARTTUTOR_SESSION';

    session_save_path($sessionPath);
    ini_set('session.gc_maxlifetime', 86400 * 30);
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
}

/**
 * Require a logged-in user with $expectedRole.
 * Redirects to /pages/login.php if check fails.
 */
function requireAuth($expectedRole) {
    _bootSession($expectedRole);

    if (!isset($_SESSION['user_id'], $_SESSION['role']) || $_SESSION['role'] !== $expectedRole) {
        header('Location: /pages/login.php');
        exit;
    }
}

function requireAdminAuth() {
    _bootSession('admin');

    if (!isset($_SESSION['user_id'], $_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header('Location: /pages/admin-login.php');
        exit;
    }
}

/**
 * Returns the display name of the currently logged-in user.
 * Caches the name in session so Oracle is only hit once per session.
 */
function getLoggedInUserName() {
    if (!isset($_SESSION['user_id'])) return 'Guest';

    if (isset($_SESSION['display_name'])) {
        return $_SESSION['display_name'];
    }

    try {
        $db     = Database::getInstance();
        $userId = $_SESSION['user_id'];
        $role   = $_SESSION['role'] ?? '';

        if ($role === 'student') {
            $row = $db->fetchOne("SELECT full_name FROM ST_STUDENT WHERE user_id = :u_id", ['u_id' => $userId]);
        } elseif ($role === 'tutor') {
            $row = $db->fetchOne("SELECT full_name FROM ST_TUTOR WHERE user_id = :u_id", ['u_id' => $userId]);
        } elseif ($role === 'admin') {
            $row = $db->fetchOne("SELECT full_name FROM ST_ADMIN WHERE user_id = :u_id", ['u_id' => $userId]);
        } else {
            $row = null;
        }

        $name = $row['full_name'] ?? ucfirst($role ?: 'User');
        $_SESSION['display_name'] = $name;
        return $name;
    } catch (Exception $e) {
        return ucfirst($_SESSION['role'] ?? 'User');
    }
}
?>
