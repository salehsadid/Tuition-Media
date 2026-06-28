<?php
/**
 * SmartTutor - Tutor Dashboard Overview
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutor Dashboard | SmartTutor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="bg-light">

<div class="dashboard-wrapper">
    <!-- Sidebar -->
    <?php include '../../includes/tutor-sidebar.php'; ?>

    <!-- Main Content -->
    <main class="dashboard-main">
        <!-- Top Navbar -->
        <?php include '../../includes/tutor-navbar.php'; ?>

        <div class="dashboard-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0">Dashboard Overview</h3>
                <a href="browse-tuition.php" class="btn btn-primary-custom shadow-sm">
                    <i class="bi bi-search me-2"></i>Find Jobs
                </a>
            </div>

            <!-- Stats Row -->
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="card card-custom p-4 border-0 h-100">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="text-muted fw-bold mb-0">Active Tuitions</h6>
                            <div class="bg-primary bg-opacity-10 text-primary-custom p-2 rounded">
                                <i class="bi bi-person-workspace fs-5"></i>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-0">3</h2>
                        <div class="mt-2 text-muted small fw-medium">
                            Currently teaching
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card card-custom p-4 border-0 h-100">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="text-muted fw-bold mb-0">Pending Applications</h6>
                            <div class="bg-secondary bg-opacity-10 text-secondary-custom p-2 rounded">
                                <i class="bi bi-file-earmark-person fs-5"></i>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-0">5</h2>
                        <div class="mt-2 text-muted small fw-medium">
                            Awaiting response
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Row -->
            <div class="row g-4">
                <!-- Recent Activity -->
                <div class="col-12">
                    <div class="card card-custom border-0 p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0">Recent Status</h5>
                            <a href="applied-jobs.php" class="small text-primary-custom text-decoration-none fw-bold">View All</a>
                        </div>
                        
                        <div class="position-relative">
                            <div class="position-absolute h-100 border-start border-2 border-primary" style="left: 11px; top: 0; z-index: 0; opacity: 0.2;"></div>
                            
                            <div class="d-flex mb-4 position-relative z-1">
                                <div class="bg-success rounded-circle mt-1 flex-shrink-0" style="width: 24px; height: 24px; border: 4px solid white; box-shadow: 0 0 0 1px #22C55E;"></div>
                                <div class="ms-3">
                                    <h6 class="fw-bold mb-1 fs-6 text-success">Application Accepted!</h6>
                                    <p class="text-muted small mb-0">You were hired for "Physics HSC".</p>
                                    <small class="text-muted" style="font-size: 0.7rem;">Yesterday</small>
                                </div>
                            </div>

                            <div class="d-flex mb-4 position-relative z-1">
                                <div class="bg-primary rounded-circle mt-1 flex-shrink-0" style="width: 24px; height: 24px; border: 4px solid white; box-shadow: 0 0 0 1px #2563EB;"></div>
                                <div class="ms-3">
                                    <h6 class="fw-bold mb-1 fs-6">Application Submitted</h6>
                                    <p class="text-muted small mb-0">You applied for "Math Class 10".</p>
                                    <small class="text-muted" style="font-size: 0.7rem;">3 days ago</small>
                                </div>
                            </div>

                            <div class="d-flex position-relative z-1">
                                <div class="bg-secondary rounded-circle mt-1 flex-shrink-0" style="width: 24px; height: 24px; border: 4px solid white; box-shadow: 0 0 0 1px #64748b;"></div>
                                <div class="ms-3">
                                    <h6 class="fw-bold mb-1 fs-6">Application Rejected</h6>
                                    <p class="text-muted small mb-0">Your application for "Chemistry O Levels" was closed.</p>
                                    <small class="text-muted" style="font-size: 0.7rem;">1 week ago</small>
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
