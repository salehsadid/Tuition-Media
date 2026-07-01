<?php
/**
 * SmartTutor - Register Page
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | SmartTutor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">

<?php include '../includes/navbar.php'; ?>

<main class="auth-wrapper">
    <div class="auth-card register-card">
        
        <div class="row g-0">
            <!-- Left Side: Illustration & Info (Hidden on Mobile) -->
            <div class="col-md-5 bg-primary bg-opacity-10 d-none d-md-flex flex-column justify-content-center align-items-center p-4 border-end">
                <img id="register-illustration" src="https://illustrations.popsy.co/blue/student-graduation.svg" alt="Registration Illustration" class="img-fluid mb-4" style="max-height: 200px;">
                <h4 class="fw-bold text-primary-custom text-center mb-3">Join SmartTutor</h4>
                <ul class="list-unstyled small text-muted space-y-2">
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Free lifetime access</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Smart matching system</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Verified community</li>
                </ul>
            </div>

            <!-- Right Side: Form -->
            <div class="col-md-7">
                
                <!-- Role Selector -->
                <div class="bg-light p-3 border-bottom d-flex justify-content-center">
                    <ul class="nav nav-pills nav-pills-custom" role="tablist">
                        <li class="nav-item me-2" role="presentation">
                            <a class="nav-link active role-tab" data-role="student" href="#">
                                <i class="bi bi-book me-2"></i>Register as Student
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link role-tab" data-role="tutor" href="#">
                                <i class="bi bi-person-workspace me-2"></i>Register as Tutor
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="auth-body pt-4">
                    <h4 class="fw-bold mb-4">Create your account</h4>
                    
                    <form action="/pages/login.php" method="GET">
                        
                        <!-- Common Fields -->
                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <label class="form-label fw-medium small text-muted">Full Name</label>
                                <div class="input-group input-group-custom">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control fs-6" placeholder="John Doe" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-medium small text-muted">Email Address</label>
                                <div class="input-group input-group-custom">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control fs-6" placeholder="name@example.com" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-medium small text-muted">Phone Number</label>
                                <div class="input-group input-group-custom">
                                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                    <input type="tel" class="form-control fs-6" placeholder="01XXX-XXXXXX" required>
                                </div>
                            </div>
                        </div>

                        <!-- Dynamic Fields: Student -->
                        <div id="student-fields" class="dynamic-field-group active">
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-medium small text-muted">Institution Name</label>
                                    <div class="input-group input-group-custom">
                                        <span class="input-group-text"><i class="bi bi-building"></i></span>
                                        <input type="text" class="form-control fs-6" placeholder="School/College Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium small text-muted">Class / Academic Level</label>
                                    <div class="input-group input-group-custom">
                                        <span class="input-group-text"><i class="bi bi-bar-chart"></i></span>
                                        <input type="text" class="form-control fs-6" placeholder="e.g. Class 10, HSC">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-medium small text-muted">Current Address</label>
                                    <div class="input-group input-group-custom">
                                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                        <input type="text" class="form-control fs-6" placeholder="Area, City">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dynamic Fields: Tutor -->
                        <div id="tutor-fields" class="dynamic-field-group">
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-medium small text-muted">University Name</label>
                                    <div class="input-group input-group-custom">
                                        <span class="input-group-text"><i class="bi bi-bank"></i></span>
                                        <input type="text" class="form-control fs-6" placeholder="e.g. BUET, DU">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium small text-muted">Department</label>
                                    <div class="input-group input-group-custom">
                                        <span class="input-group-text"><i class="bi bi-book"></i></span>
                                        <input type="text" class="form-control fs-6" placeholder="e.g. CSE, Physics">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium small text-muted">CGPA</label>
                                    <div class="input-group input-group-custom">
                                        <span class="input-group-text"><i class="bi bi-award"></i></span>
                                        <input type="number" step="0.01" max="4.00" class="form-control fs-6" placeholder="3.50">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium small text-muted">Experience (Years)</label>
                                    <div class="input-group input-group-custom">
                                        <span class="input-group-text"><i class="bi bi-briefcase"></i></span>
                                        <input type="number" min="0" class="form-control fs-6" placeholder="2">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-medium small text-muted">Current Address</label>
                                    <div class="input-group input-group-custom">
                                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                        <input type="text" class="form-control fs-6" placeholder="Area, City">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Password Section -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-medium small text-muted">Password</label>
                                <div class="input-group input-group-custom">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" id="password" class="form-control fs-6" placeholder="••••••••" required>
                                    <button class="btn btn-light border toggle-password bg-white" type="button" data-target="password">
                                        <i class="bi bi-eye text-muted"></i>
                                    </button>
                                </div>
                                <!-- Strength UI -->
                                <div class="password-strength-meter">
                                    <div id="strength-bar" class="password-strength-bar"></div>
                                </div>
                                <div id="strength-text" class="small mt-1 text-muted"></div>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-medium small text-muted">Confirm Password</label>
                                <div class="input-group input-group-custom">
                                    <span class="input-group-text"><i id="match-icon" class="bi bi-shield-lock text-muted"></i></span>
                                    <input type="password" id="confirm-password" class="form-control fs-6" placeholder="••••••••" required>
                                    <button class="btn btn-light border toggle-password bg-white" type="button" data-target="confirm-password">
                                        <i class="bi bi-eye text-muted"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Terms -->
                        <div class="form-check mb-4">
                            <input class="form-check-input shadow-none" type="checkbox" id="terms" required>
                            <label class="form-check-label small text-muted" for="terms">
                                I agree to the <a href="#" class="text-primary-custom text-decoration-none">Terms</a> & <a href="#" class="text-primary-custom text-decoration-none">Privacy Policy</a>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-brand w-100 fs-6 mb-4">
                            Create Account <i class="bi bi-person-plus ms-2"></i>
                        </button>

                        <!-- Footer Links -->
                        <div class="text-center">
                            <p class="text-muted small mb-2">Already have an account? <a href="/pages/login.php" class="text-primary-custom fw-bold text-decoration-none">Sign In</a></p>
                            <a href="/pages/index.php" class="text-muted small text-decoration-none"><i class="bi bi-arrow-left me-1"></i>Back to Home</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/main.js"></script>
</body>
</html>
