<?php
/**
 * SmartTutor - Admin Settings
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings | SmartTutor Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="bg-light">

<div class="dashboard-wrapper">
    <?php include '../../includes/admin-sidebar.php'; ?>

    <main class="dashboard-main">
        <?php include '../../includes/admin-navbar.php'; ?>

        <div class="dashboard-content">
            <h3 class="fw-bold mb-4">Platform Settings</h3>

            <div class="row g-4">
                <div class="col-lg-8">

                    <!-- Admin Profile Update -->
                    <div class="card card-custom p-4 mb-4">
                        <h5 class="fw-bold mb-1">Admin Account</h5>
                        <p class="text-muted small mb-4">Update your administrator display name and contact email.</p>
                        <hr class="mt-0 mb-4" style="border-color: #e2e8f0;">
                        <form action="profile.php" method="GET">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-secondary-custom">Display Name</label>
                                    <input type="text" class="form-control" value="Administrator" style="border-color: #e2e8f0; background: #f8fafc;">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-secondary-custom">Admin Email</label>
                                    <input type="email" class="form-control" value="admin@smarttutor.com" style="border-color: #e2e8f0; background: #f8fafc;">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-secondary-custom">Phone Number</label>
                                    <input type="tel" class="form-control" value="+880 1700 000000" style="border-color: #e2e8f0; background: #f8fafc;">
                                </div>
                                <div class="col-12 text-end mt-3">
                                    <button type="submit" class="btn fw-semibold text-white px-4" style="background-color: var(--primary-color);">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Platform Settings -->
                    <div class="card card-custom p-4 mb-4">
                        <h5 class="fw-bold mb-1">Platform Configuration</h5>
                        <p class="text-muted small mb-4">Control global platform behaviour.</p>
                        <hr class="mt-0 mb-4" style="border-color: #e2e8f0;">
                        <form action="#" method="GET">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-secondary-custom">Platform Name</label>
                                    <input type="text" class="form-control" value="SmartTutor" style="border-color: #e2e8f0; background: #f8fafc;">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-secondary-custom">Contact Email</label>
                                    <input type="email" class="form-control" value="support@smarttutor.com" style="border-color: #e2e8f0; background: #f8fafc;">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-semibold text-secondary-custom">New Tutor Registration</label>
                                    <div class="form-check form-switch mt-1">
                                        <input class="form-check-input" type="checkbox" id="tutorReg" checked>
                                        <label class="form-check-label text-muted small" for="tutorReg">Allow new tutors to register on the platform</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-semibold text-secondary-custom">Student Registration</label>
                                    <div class="form-check form-switch mt-1">
                                        <input class="form-check-input" type="checkbox" id="studentReg" checked>
                                        <label class="form-check-label text-muted small" for="studentReg">Allow new students to register on the platform</label>
                                    </div>
                                </div>
                                <div class="col-12 text-end mt-3">
                                    <button type="submit" class="btn fw-semibold text-white px-4" style="background-color: var(--primary-color);">Save Settings</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Change Password -->
                    <div class="card card-custom p-4">
                        <h5 class="fw-bold mb-1 text-danger">Change Password</h5>
                        <p class="text-muted small mb-4">Update the admin account password.</p>
                        <hr class="mt-0 mb-4" style="border-color: #e2e8f0;">
                        <form action="#" method="GET">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label small fw-semibold text-secondary-custom">Current Password</label>
                                    <input type="password" class="form-control" style="border-color: #e2e8f0; background: #f8fafc;">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-secondary-custom">New Password</label>
                                    <input type="password" class="form-control" style="border-color: #e2e8f0; background: #f8fafc;">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-secondary-custom">Confirm New Password</label>
                                    <input type="password" class="form-control" style="border-color: #e2e8f0; background: #f8fafc;">
                                </div>
                                <div class="col-12 text-end mt-3">
                                    <button type="submit" class="btn btn-danger fw-semibold px-4">Update Password</button>
                                </div>
                            </div>
                        </form>
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
