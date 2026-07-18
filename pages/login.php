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
            $requestedRole = $_POST['role'] ?? 'student';
            
            // Enforce role restriction for student and tutor, allow admin unconditionally
            if ($user['role'] !== 'admin' && $user['role'] !== $requestedRole) {
                $error = "This is not a " . ucfirst($requestedRole) . " account.";
            } else {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['role'] = $user['role'];
    
                // Redirect based on role
                if ($user['role'] === 'admin') {
                    header("Location: admin/dashboard.php");
                } elseif ($user['role'] === 'tutor') {
                    header("Location: tutor/dashboard.php");
                } else {
                    header("Location: student/dashboard.php");
                }
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
    <title>Login | SmartTutor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">

<?php include '../includes/navbar.php'; ?>

<main class="auth-wrapper">
    <div class="auth-card">
        
        <!-- Role Selector -->
        <div class="bg-light p-3 border-bottom d-flex justify-content-center">
            <ul class="nav nav-pills nav-pills-custom" role="tablist">
                <li class="nav-item me-2" role="presentation">
                    <a class="nav-link active role-tab" data-role="student" href="#">
                        <i class="bi bi-book me-2"></i>Login as Student
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link role-tab" data-role="tutor" href="#">
                        <i class="bi bi-person-workspace me-2"></i>Login as Tutor
                    </a>
                </li>
            </ul>
        </div>

        <div class="auth-header">
            <img id="login-illustration" src="https://illustrations.popsy.co/blue/student-going-to-school.svg" alt="Login Illustration" class="img-fluid mb-3" style="height: 120px;">
            <h3 id="login-title" class="fw-bold">Welcome back!</h3>
            <p class="text-muted small">Please enter your credentials to access your dashboard.</p>
        </div>
        
        <?php if ($error): ?>
            <div class="alert alert-danger mx-4 py-2" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <div class="auth-body">
            <form action="login.php" method="POST">
                <input type="hidden" name="role" id="role-input" value="student">
                
                <!-- Email Field -->
                <div class="mb-4">
                    <label class="form-label fw-medium small text-muted">Email Address</label>
                    <div class="input-group input-group-custom">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control form-control-lg fs-6" placeholder="name@example.com" required>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between">
                        <label class="form-label fw-medium small text-muted">Password</label>
                        <a href="#" class="small text-decoration-none text-primary-custom fw-medium">Forgot Password?</a>
                    </div>
                    <div class="input-group input-group-custom">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" id="login-password" class="form-control form-control-lg fs-6" placeholder="••••••••" required>
                        <button class="btn btn-light border toggle-password bg-white" type="button" data-target="login-password">
                            <i class="bi bi-eye text-muted"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Terms -->
                <div class="mb-4">
                    <div class="form-check mb-2">
                        <input class="form-check-input shadow-none" type="checkbox" id="rememberMe">
                        <label class="form-check-label small text-muted" for="rememberMe">
                            Remember me on this device
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-brand w-100 btn-lg fs-6 mb-4">
                    Sign In
                </button>

                <!-- Footer Links -->
                <div class="text-center">
                    <p class="text-muted small mb-2">Don't have an account? <a href="register.php" class="text-primary-custom fw-bold text-decoration-none">Register Now</a></p>
                    <a href="index.php" class="text-muted small text-decoration-none">Back to Home</a>
                </div>
            </form>
        </div>
    </div>
</main>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/main.js"></script>
</body>
</html>

