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
    <title>Dashboard | SmartTutor Tutor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
<div class="dashboard-wrapper">
    <?php include '../../includes/tutor-sidebar.php'; ?>
    <main class="dashboard-main">
        <?php include '../../includes/tutor-navbar.php'; ?>
        <div class="dashboard-content">

            <div class="page-header">
                <h3>Dashboard Overview</h3>
                <a href="browse-tuition.php" class="btn btn-brand">
                    <i class="bi bi-search me-2"></i>Find Jobs
                </a>
            </div>

            <!-- Stat Cards -->
            <div class="row g-4 mb-4">
                <div class="col-sm-6 col-xl-4">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="stat-card__label">Active Tuitions</span>
                            <div class="stat-card__icon" style="background-color:var(--p-100); color:var(--p-500);">
                                <i class="bi bi-person-workspace"></i>
                            </div>
                        </div>
                        <div class="stat-card__value">3</div>
                        <div class="stat-card__sub" style="color:var(--text-muted);">Currently teaching</div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="stat-card__label">Pending Applications</span>
                            <div class="stat-card__icon" style="background-color:var(--color-warning-lt); color:var(--color-warning);">
                                <i class="bi bi-hourglass-split"></i>
                            </div>
                        </div>
                        <div class="stat-card__value">5</div>
                        <div class="stat-card__sub" style="color:var(--text-muted);">Awaiting response</div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="stat-card__label">Total Applications</span>
                            <div class="stat-card__icon" style="background-color:var(--color-success-lt); color:var(--color-success);">
                                <i class="bi bi-briefcase"></i>
                            </div>
                        </div>
                        <div class="stat-card__value">18</div>
                        <div class="stat-card__sub" style="color:var(--text-muted);">Submitted so far</div>
                    </div>
                </div>
            </div>

            <!-- Chart Placeholder + Activity -->
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card-custom p-4 h-100">
                        <h6 style="font-weight:700; color:var(--text-primary); margin-bottom:1.25rem;">Job Activity Overview</h6>
                        <div class="d-flex align-items-center justify-content-center rounded" style="height:280px; background:var(--gray-50); border:1.5px dashed var(--gray-300);">
                            <div class="text-center">
                                <i class="bi bi-graph-up" style="font-size:2.5rem; color:var(--gray-400);"></i>
                                <p class="mt-3 mb-0 fw-600" style="font-weight:600; color:var(--text-muted); font-size:0.875rem;">Chart.js Placeholder</p>
                                <p class="mb-0" style="font-size:0.8125rem; color:var(--text-subtle);">Applications submitted over time — Phase 2</p>
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
                                <div class="timeline-dot" style="color:var(--color-success); background:var(--color-success);"></div>
                                <div class="timeline-item__title">Application Accepted</div>
                                <div class="timeline-item__body">Hired for Physics HSC — Mirpur.</div>
                                <div class="timeline-item__time">Yesterday</div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-dot" style="color:var(--p-500); background:var(--brand-primary);"></div>
                                <div class="timeline-item__title">Application Submitted</div>
                                <div class="timeline-item__body">Applied for Math Class 10.</div>
                                <div class="timeline-item__time">3 days ago</div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-dot" style="color:var(--gray-400); background:var(--gray-400);"></div>
                                <div class="timeline-item__title">Application Rejected</div>
                                <div class="timeline-item__body">Chemistry O Levels application closed.</div>
                                <div class="timeline-item__time">1 week ago</div>
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
