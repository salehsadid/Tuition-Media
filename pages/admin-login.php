<?php
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
        .auth-wrapper {
            background-color: #1e293b; /* Dark background for admin panel */
        }
        .auth-card {
            border-top: 5px solid var(--color-danger); /* Red accent to distinguish */
        }
        .btn-admin {
            background-color: var(--color-danger);
            color: white;
        }
        .btn-admin:hover {
            background-color: #b91c1c;
            color: white;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<?php include '../includes/navbar.php'; ?>

<main class="auth-wrapper flex-grow-1 d-flex align-items-center justify-content-center">
    <div class="auth-card mx-auto shadow-lg" style="max-width: 450px; width: 100%; background: white; border-radius: 12px; overflow: hidden;">
        
        <div class="auth-header text-center p-4 pb-0 mt-3">
            <div class="mb-3 d-inline-flex align-items-center justify-content-center" style="width: 64px; height: 64px; border-radius: 50%; background: rgba(239, 68, 68, 0.1); color: var(--color-danger);">
                <i class="bi bi-shield-lock-fill fs-2"></i>
            </div>
            <h3 class="fw-bold">Admin Portal</h3>
            <p class="text-muted small">Restricted access for system administrators.</p>
        </div>
        
        <?php if ($error): ?>
            <div class="alert alert-danger mx-4 py-2 mt-2" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <div class="auth-body p-4 pt-3">
            <form action="admin-login.php" method="POST">
                <!-- Email Field -->
                <div class="mb-4">
                    <label class="form-label fw-medium small text-muted">Administrator Email</label>
                    <div class="input-group input-group-custom">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control form-control-lg fs-6" placeholder="admin@smarttutor.com" required>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between">
                        <label class="form-label fw-medium small text-muted">Password</label>
                    </div>
                    <div class="input-group input-group-custom">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" id="login-password" class="form-control form-control-lg fs-6" placeholder="••••••••" required>
                        <button class="btn btn-light border toggle-password bg-white" type="button" data-target="login-password">
                            <i class="bi bi-eye text-muted"></i>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-admin w-100 btn-lg fs-6 mb-4">
                    Secure Login <i class="bi bi-arrow-right ms-1"></i>
                </button>

                <div class="text-center">
                    <a href="index.php" class="text-muted small text-decoration-none"><i class="bi bi-arrow-left me-1"></i>Back to Home</a>
                </div>
            </form>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        });
    });
</script>
</body>
</html>
