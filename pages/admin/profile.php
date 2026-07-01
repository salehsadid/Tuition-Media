<?php
/**
 * SmartTutor - Admin Profile
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile | SmartTutor</title>
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
            <div class="row">
                <div class="col-lg-7 mx-auto">

                    <div class="card card-custom overflow-hidden mb-4">
                        <!-- Cover -->
                        <div style="height: 130px; background-color: var(--secondary-color);"></div>

                        <div class="card-body px-4 px-md-5 pb-5 position-relative">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=1E293B&color=fff&size=128"
                                 alt="Admin Avatar"
                                 class="rounded-circle border border-4 border-white shadow-sm position-absolute"
                                 style="top: -64px; left: 2rem; width: 96px; height: 96px;">

                            <div class="d-flex justify-content-end mb-4">
                                <a href="settings.php" class="btn btn-sm btn-outline-secondary fw-semibold">
                                    <i class="bi bi-pencil me-1"></i>Edit Profile
                                </a>
                            </div>

                            <h4 class="fw-bold mb-1 mt-2">System Administrator</h4>
                            <p class="text-muted mb-4">SmartTutor Platform — Super Admin</p>

                            <hr class="my-4" style="border-color: #e2e8f0;">

                            <h6 class="fw-bold text-uppercase text-muted mb-4" style="font-size: 0.75rem; letter-spacing: 0.08em;">Contact Details</h6>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="p-2 rounded" style="background-color: #f1f5f9;">
                                            <i class="bi bi-envelope-fill text-secondary-custom fs-5"></i>
                                        </div>
                                        <div>
                                            <div class="text-muted small fw-semibold text-uppercase" style="font-size: 0.7rem;">Email</div>
                                            <div class="fw-medium">admin@smarttutor.com</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="p-2 rounded" style="background-color: #f1f5f9;">
                                            <i class="bi bi-telephone-fill text-secondary-custom fs-5"></i>
                                        </div>
                                        <div>
                                            <div class="text-muted small fw-semibold text-uppercase" style="font-size: 0.7rem;">Phone</div>
                                            <div class="fw-medium">+880 1700 000000</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="p-2 rounded" style="background-color: #f1f5f9;">
                                            <i class="bi bi-shield-lock-fill text-secondary-custom fs-5"></i>
                                        </div>
                                        <div>
                                            <div class="text-muted small fw-semibold text-uppercase" style="font-size: 0.7rem;">Role</div>
                                            <div class="fw-medium">Super Administrator</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
