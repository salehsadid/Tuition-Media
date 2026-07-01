<?php
/**
 * SmartTutor - Settings (Tutor)
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings | SmartTutor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="bg-light">

<div class="dashboard-wrapper">
    <?php include '../../includes/tutor-sidebar.php'; ?>

    <main class="dashboard-main">
        <?php include '../../includes/tutor-navbar.php'; ?>

        <div class="dashboard-content">
            <h3 class="fw-bold mb-4">Account Settings</h3>
            
            <div class="row g-4">
                <div class="col-lg-8">
                    <!-- Update Info Form -->
                    <div class="card card-custom p-4 mb-4">
                        <h5 class="fw-bold mb-4 border-bottom pb-3">Professional Information</h5>
                        <form action="profile.php" method="GET">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-secondary-custom small">Full Name</label>
                                    <input type="text" class="form-control bg-light border-0" value="Kamrul Islam">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-secondary-custom small">Phone Number</label>
                                    <input type="tel" class="form-control bg-light border-0" value="01612345678">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-secondary-custom small">University / Institution</label>
                                    <input type="text" class="form-control bg-light border-0" value="North South University">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-secondary-custom small">Current CGPA</label>
                                    <input type="text" class="form-control bg-light border-0" value="3.90">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-secondary-custom small">Years of Experience</label>
                                    <input type="number" class="form-control bg-light border-0" value="3">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-secondary-custom small">Expected Min. Salary (BDT)</label>
                                    <input type="number" class="form-control bg-light border-0" value="5000">
                                </div>
                                <div class="col-12 mt-4 text-end">
                                    <button type="submit" class="btn btn-brand px-4">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Change Password Form -->
                    <div class="card card-custom p-4">
                        <h5 class="fw-bold mb-4 border-bottom pb-3 text-danger">Change Password</h5>
                        <form action="#" method="GET">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-bold text-secondary-custom small">Current Password</label>
                                    <input type="password" class="form-control bg-light border-0">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-secondary-custom small">New Password</label>
                                    <input type="password" class="form-control bg-light border-0">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-secondary-custom small">Confirm New Password</label>
                                    <input type="password" class="form-control bg-light border-0">
                                </div>
                                <div class="col-12 mt-4 text-end">
                                    <button type="submit" class="btn btn-danger px-4">Update Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Document Verification -->
                <div class="col-lg-4">
                    <div class="card card-custom p-4 mb-4 bg-primary bg-opacity-10">
                        <h6 class="fw-bold text-primary-custom mb-3"><i class="bi bi-shield-check me-2"></i>Verification Status</h6>
                        <p class="small text-muted mb-3">Your student ID and documents have been verified by the admin team.</p>
                        <div class="badge bg-primary px-3 py-2 fs-6">Verified Tutor <i class="bi bi-patch-check-fill ms-1"></i></div>
                    </div>
                    
                    <div class="card card-custom border-top border-4 border-danger p-4">
                        <h6 class="fw-bold text-danger mb-3"><i class="bi bi-exclamation-triangle-fill me-2"></i>Danger Zone</h6>
                        <p class="small text-muted mb-4">Once you delete your account, there is no going back. Please be certain.</p>
                        <button class="btn btn-outline-danger w-100 fw-bold">Delete Account</button>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/main.js"></script>
</body>
</html>
