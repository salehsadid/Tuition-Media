<?php
/**
 * SmartTutor - Student Dashboard Overview
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard | SmartTutor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="bg-light">

<div class="dashboard-wrapper">
    <!-- Sidebar -->
    <?php include '../../includes/student-sidebar.php'; ?>

    <!-- Main Content -->
    <main class="dashboard-main">
        <!-- Top Navbar -->
        <?php include '../../includes/student-navbar.php'; ?>

        <div class="dashboard-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0">Dashboard Overview</h3>
                <a href="create-tuition.php" class="btn btn-primary-custom shadow-sm">
                    <i class="bi bi-plus-circle me-2"></i>Post New Job
                </a>
            </div>

            <!-- Stats Row -->
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card card-custom p-4 border-0 h-100">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="text-muted fw-bold mb-0">Active Tuition Posts</h6>
                            <div class="bg-primary bg-opacity-10 text-primary-custom p-2 rounded">
                                <i class="bi bi-card-list fs-5"></i>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-0">2</h2>
                        <div class="mt-2 text-success small fw-bold">
                            <i class="bi bi-arrow-up-right me-1"></i> 1 new this week
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card card-custom p-4 border-0 h-100">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="text-muted fw-bold mb-0">Pending Applications</h6>
                            <div class="bg-warning bg-opacity-10 text-warning p-2 rounded">
                                <i class="bi bi-file-earmark-person-fill fs-5"></i>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-0">14</h2>
                        <div class="mt-2 text-muted small fw-medium">
                            Needs your review
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-custom p-4 border-0 h-100">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="text-muted fw-bold mb-0">Assigned Tutors</h6>
                            <div class="bg-success bg-opacity-10 text-success p-2 rounded">
                                <i class="bi bi-person-check-fill fs-5"></i>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-0">1</h2>
                        <div class="mt-2 text-muted small fw-medium">
                            Currently hired
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart & Activity Row -->
            <div class="row g-4">
                <!-- Chart Placeholder -->
                <div class="col-lg-8">
                    <div class="card card-custom border-0 p-4 h-100">
                        <h5 class="fw-bold mb-4">Applications Trend</h5>
                        <div class="d-flex align-items-center justify-content-center bg-light rounded" style="height: 300px; border: 2px dashed #cbd5e1;">
                            <div class="text-center text-muted">
                                <i class="bi bi-bar-chart-fill display-4 mb-2 d-block text-secondary-custom"></i>
                                <p class="mb-0 fw-medium">Chart.js Placeholder</p>
                                <small>Will display application stats over time in Phase 2</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="col-lg-4">
                    <div class="card card-custom border-0 p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0">Recent Activity</h5>
                            <a href="notifications.php" class="small text-primary-custom text-decoration-none fw-bold">View All</a>
                        </div>
                        
                        <div class="position-relative">
                            <!-- Timeline Line -->
                            <div class="position-absolute h-100 border-start border-2 border-primary" style="left: 11px; top: 0; z-index: 0; opacity: 0.2;"></div>
                            
                            <div class="d-flex mb-4 position-relative z-1">
                                <div class="bg-primary rounded-circle mt-1 flex-shrink-0" style="width: 24px; height: 24px; border: 4px solid white; box-shadow: 0 0 0 1px #2563EB;"></div>
                                <div class="ms-3">
                                    <h6 class="fw-bold mb-1 fs-6">New Application Received</h6>
                                    <p class="text-muted small mb-0">Hasan Mahmud applied for "Math Tutor for Class 10".</p>
                                    <small class="text-muted" style="font-size: 0.7rem;">2 hours ago</small>
                                </div>
                            </div>

                            <div class="d-flex mb-4 position-relative z-1">
                                <div class="bg-success rounded-circle mt-1 flex-shrink-0" style="width: 24px; height: 24px; border: 4px solid white; box-shadow: 0 0 0 1px #22C55E;"></div>
                                <div class="ms-3">
                                    <h6 class="fw-bold mb-1 fs-6">Tutor Hired</h6>
                                    <p class="text-muted small mb-0">You accepted Ayesha Rahman's application.</p>
                                    <small class="text-muted" style="font-size: 0.7rem;">Yesterday</small>
                                </div>
                            </div>

                            <div class="d-flex position-relative z-1">
                                <div class="bg-warning rounded-circle mt-1 flex-shrink-0" style="width: 24px; height: 24px; border: 4px solid white; box-shadow: 0 0 0 1px #F59E0B;"></div>
                                <div class="ms-3">
                                    <h6 class="fw-bold mb-1 fs-6">Job Posted</h6>
                                    <p class="text-muted small mb-0">You posted "Physics Tutor for HSC".</p>
                                    <small class="text-muted" style="font-size: 0.7rem;">3 days ago</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/main.js"></script>
</body>
</html>
