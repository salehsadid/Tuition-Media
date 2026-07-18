<?php
require_once __DIR__ . '/../config/database.php';

function requireAuth($expectedRole) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== $expectedRole) {
        header('Location: ../login.php');
        exit;
    }

    $db = Database::getInstance();
    $userId = $_SESSION['user_id'];
    
    // Cross-check with database to ensure user still exists and role matches
    $user = $db->fetchOne("SELECT role FROM ST_USER WHERE user_id = :u_id", ['u_id' => $userId]);
    
    if (!$user || $user['role'] !== $expectedRole) {
        // Destroy session and redirect if user is deleted or role changed
        session_destroy();
        header('Location: ../login.php');
        exit;
    }
}

function getLoggedInUserName() {
    if (!isset($_SESSION['user_id'])) return "Unknown User";
    
    $db = Database::getInstance();
    $userId = $_SESSION['user_id'];
    $role = $_SESSION['role'];

    if ($role === 'student') {
        $row = $db->fetchOne("SELECT full_name FROM ST_STUDENT WHERE user_id = :u_id", ['u_id' => $userId]);
        return $row ? $row['full_name'] : "Student";
    } else if ($role === 'tutor') {
        $row = $db->fetchOne("SELECT full_name FROM ST_TUTOR WHERE user_id = :u_id", ['u_id' => $userId]);
        return $row ? $row['full_name'] : "Tutor";
    } else if ($role === 'admin') {
        $row = $db->fetchOne("SELECT full_name FROM ST_ADMIN WHERE user_id = :u_id", ['u_id' => $userId]);
        return $row ? $row['full_name'] : "Admin";
    }
    
    return "Unknown User";
}
?>
