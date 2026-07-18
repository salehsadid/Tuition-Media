<?php
$sessionPath = __DIR__ . '/../sessions';
if (!is_dir($sessionPath)) mkdir($sessionPath, 0777, true);
session_save_path($sessionPath);
ini_set('session.gc_maxlifetime', 86400 * 30);
session_name('ADM_SESSION');
session_set_cookie_params([
    'lifetime' => 86400 * 30,
    'path'     => '/',
    'secure'   => false,
    'httponly' => true,
    'samesite' => 'Lax',
]);
session_start();
require_once '../config/database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        $db = Database::getInstance();
        $user = $db->fetchOne("SELECT * FROM ST_USER WHERE email = :email AND is_active = 1", ['email' => $email]);

        if ($user && password_verify($password, $user['password_hash'])) {
            if ($user['role'] !== 'admin') {
                $error = "Access Denied: This page is for administrators only.";
            } else {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['role'] = $user['role'];
                header("Location: admin/dashboard.php");
                exit;
            }
        } else {
            $error = 'Invalid email or password.';
        }
    } else {
        $error = 'Please enter both email and password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | SmartTutor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body { background-color: #1e293b; }
        .admin-card {
            max-width: 430px;
            width: 100%;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            border-top: 5px solid #ef4444;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 align-items-center justify-content-center">

<div class="admin-card shadow-lg p-4">
    <div class="text-center mb-4">
        <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-circle"
             style="width:64px;height:64px;background:rgba(239,68,68,0.1);color:#ef4444;">
            <i class="bi bi-shield-lock-fill fs-2"></i>
        </div>
        <h4 class="fw-bold mb-1">Admin Portal</h4>
        <p class="text-muted small mb-0">Restricted access — administrators only.</p>
    </div>

    <?php if ($error): ?>
        <div class="alert alert-danger py-2"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="admin-login.php" method="POST">
        <div class="mb-3">
            <label class="form-label fw-medium small text-muted">Administrator Email</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="admin@smarttutor.com" required>
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label fw-medium small text-muted">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" id="admin-pass" class="form-control" placeholder="••••••••" required>
                <button class="btn btn-light border toggle-password bg-white" type="button" data-target="admin-pass">
                    <i class="bi bi-eye text-muted"></i>
                </button>
            </div>
        </div>
        <button type="submit" class="btn w-100 btn-lg mb-3 text-white fw-semibold" style="background:#ef4444;">
            Secure Login
        </button>
        <div class="text-center">
            <a href="index.php" class="text-muted small text-decoration-none">Back to Home</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function () {
            const input = document.getElementById(this.dataset.target);
            const icon = this.querySelector('i');
            input.type = input.type === 'password' ? 'text' : 'password';
            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        });
    });
</script>
</body>
</html>
