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
    <title>Dashboard | SmartTutor Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
<div class="dashboard-wrapper">
    <?php include '../../includes/student-sidebar.php'; ?>
    <main class="dashboard-main">
        <?php include '../../includes/student-navbar.php'; ?>
        <div class="dashboard-content">

            <div class="page-header">
                <h3>Dashboard Overview</h3>
                <a href="create-tuition.php" class="btn btn-brand">
                    <i class="bi bi-plus-lg me-2"></i>Post New Tuition
                </a>
            </div>

            <!-- Stat Cards -->
            <div class="row g-4 mb-4">
                <div class="col-sm-6 col-xl-4">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="stat-card__label">Active Posts</span>
                            <div class="stat-card__icon" style="background-color:var(--p-100); color:var(--p-500);">
                                <i class="bi bi-card-list"></i>
                            </div>
                        </div>
                        <div class="stat-card__value">2</div>
                        <div class="stat-card__sub" style="color:var(--color-success);">1 posted this week</div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="stat-card__label">Pending Applications</span>
                            <div class="stat-card__icon" style="background-color:var(--color-warning-lt); color:var(--color-warning);">
                                <i class="bi bi-file-earmark-person"></i>
                            </div>
                        </div>
                        <div class="stat-card__value">14</div>
                        <div class="stat-card__sub" style="color:var(--text-muted);">Awaiting your review</div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="stat-card__label">Assigned Tutors</span>
                            <div class="stat-card__icon" style="background-color:var(--color-success-lt); color:var(--color-success);">
                                <i class="bi bi-person-check"></i>
                            </div>
                        </div>
                        <div class="stat-card__value">1</div>
                        <div class="stat-card__sub" style="color:var(--text-muted);">Currently active</div>
                    </div>
                </div>
            </div>

            <!-- Chart Placeholder + Activity -->
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card-custom p-4 h-100">
                        <h6 class="fw-700 mb-4" style="font-weight:700; color:var(--text-primary);">Applications Trend</h6>
                        <div class="d-flex align-items-center justify-content-center rounded" style="height:280px; background:var(--gray-50); border:1.5px dashed var(--gray-300);">
                            <div class="text-center">
                                <i class="bi bi-bar-chart-line" style="font-size:2.5rem; color:var(--gray-400);"></i>
                                <p class="mt-3 mb-0 fw-600" style="font-weight:600; color:var(--text-muted); font-size:0.875rem;">Chart.js Placeholder</p>
                                <p class="mb-0" style="font-size:0.8125rem; color:var(--text-subtle);">Application trend graph — Phase 2</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card-custom p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h6 style="font-weight:700; color:var(--text-primary); margin:0;">Recent Activity</h6>
                            <a href="notifications.php" style="font-size:0.8125rem; font-weight:600; color:var(--p-500); text-decoration:none;">View all</a>
                        </div>
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-dot" style="color:var(--p-500); background:var(--brand-primary);"></div>
                                <div class="timeline-item__title">New Application</div>
                                <div class="timeline-item__body">Hasan Mahmud applied for Math Tutor for Class 10.</div>
                                <div class="timeline-item__time">2 hours ago</div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-dot" style="color:var(--color-success); background:var(--color-success);"></div>
                                <div class="timeline-item__title">Tutor Hired</div>
                                <div class="timeline-item__body">You accepted Ayesha Rahman's application.</div>
                                <div class="timeline-item__time">Yesterday</div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-dot" style="color:var(--color-warning); background:var(--color-warning);"></div>
                                <div class="timeline-item__title">Job Posted</div>
                                <div class="timeline-item__body">You posted Physics Tutor for HSC.</div>
                                <div class="timeline-item__time">3 days ago</div>
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
