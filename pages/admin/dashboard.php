<?php
/**
 * SmartTutor - Admin Dashboard Overview
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | SmartTutor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
<div class="dashboard-wrapper">
    <?php include '../../includes/admin-sidebar.php'; ?>
    <main class="dashboard-main">
        <?php include '../../includes/admin-navbar.php'; ?>
        <div class="dashboard-content">

            <div class="page-header">
                <h3>Platform Overview</h3>
                <span class="badge-neutral">Live data — Phase 2</span>
            </div>

            <!-- Stat Cards -->
            <div class="row g-4 mb-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="stat-card__label">Total Students</span>
                            <div class="stat-card__icon" style="background-color:var(--p-100); color:var(--p-500);">
                                <i class="bi bi-people"></i>
                            </div>
                        </div>
                        <div class="stat-card__value">248</div>
                        <div class="stat-card__sub" style="color:var(--text-muted);">Registered accounts</div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="stat-card__label">Total Tutors</span>
                            <div class="stat-card__icon" style="background-color:var(--color-info-lt); color:var(--color-info);">
                                <i class="bi bi-mortarboard"></i>
                            </div>
                        </div>
                        <div class="stat-card__value">134</div>
                        <div class="stat-card__sub" style="color:var(--color-warning);">12 pending verification</div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="stat-card__label">Active Posts</span>
                            <div class="stat-card__icon" style="background-color:var(--color-success-lt); color:var(--color-success);">
                                <i class="bi bi-card-list"></i>
                            </div>
                        </div>
                        <div class="stat-card__value">89</div>
                        <div class="stat-card__sub" style="color:var(--text-muted);">Open requirements</div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="stat-card__label">Assignments</span>
                            <div class="stat-card__icon" style="background-color:var(--color-warning-lt); color:var(--color-warning);">
                                <i class="bi bi-person-workspace"></i>
                            </div>
                        </div>
                        <div class="stat-card__value">312</div>
                        <div class="stat-card__sub" style="color:var(--text-muted);">All-time contracts</div>
                    </div>
                </div>
            </div>

            <!-- Recent Registrations & Posts -->
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card-custom p-0 h-100">
                        <div class="d-flex justify-content-between align-items-center p-4" style="border-bottom:1px solid var(--border-subtle);">
                            <h6 style="font-weight:700; color:var(--text-primary); margin:0;">Recent Registrations</h6>
                            <a href="manage-users.php" style="font-size:0.8125rem; font-weight:600; color:var(--p-500); text-decoration:none;">View all</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0" style="font-size:0.875rem;">
                                <thead>
                                    <tr>
                                        <th style="padding:0.75rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; border-bottom:1px solid var(--border-subtle);">User</th>
                                        <th style="padding:0.75rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; border-bottom:1px solid var(--border-subtle);">Role</th>
                                        <th style="padding:0.75rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; border-bottom:1px solid var(--border-subtle);">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding:0.875rem 1.25rem; border-bottom:1px solid var(--gray-100);">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="https://ui-avatars.com/api/?name=Rakib+Hasan&background=E5E7EB&color=374151&size=64" class="rounded-circle" width="32" height="32">
                                                <div>
                                                    <div style="font-weight:600; color:var(--text-primary); font-size:0.875rem;">Rakib Hasan</div>
                                                    <div style="font-size:0.75rem; color:var(--text-subtle);">rakib@example.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding:0.875rem 1.25rem; border-bottom:1px solid var(--gray-100);"><span class="badge-brand">Tutor</span></td>
                                        <td style="padding:0.875rem 1.25rem; border-bottom:1px solid var(--gray-100);"><span class="badge-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:0.875rem 1.25rem; border-bottom:1px solid var(--gray-100);">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="https://ui-avatars.com/api/?name=Nadia+Rahman&background=E5E7EB&color=374151&size=64" class="rounded-circle" width="32" height="32">
                                                <div>
                                                    <div style="font-weight:600; color:var(--text-primary); font-size:0.875rem;">Nadia Rahman</div>
                                                    <div style="font-size:0.75rem; color:var(--text-subtle);">nadia@example.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding:0.875rem 1.25rem; border-bottom:1px solid var(--gray-100);"><span class="badge-success">Student</span></td>
                                        <td style="padding:0.875rem 1.25rem; border-bottom:1px solid var(--gray-100);"><span class="badge-success">Active</span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:0.875rem 1.25rem;">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="https://ui-avatars.com/api/?name=Farhan+Ahmed&background=E5E7EB&color=374151&size=64" class="rounded-circle" width="32" height="32">
                                                <div>
                                                    <div style="font-weight:600; color:var(--text-primary); font-size:0.875rem;">Farhan Ahmed</div>
                                                    <div style="font-size:0.75rem; color:var(--text-subtle);">farhan@example.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding:0.875rem 1.25rem;"><span class="badge-brand">Tutor</span></td>
                                        <td style="padding:0.875rem 1.25rem;"><span class="badge-success">Verified</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card-custom p-0 h-100">
                        <div class="d-flex justify-content-between align-items-center p-4" style="border-bottom:1px solid var(--border-subtle);">
                            <h6 style="font-weight:700; color:var(--text-primary); margin:0;">Recent Tuition Posts</h6>
                            <a href="manage-posts.php" style="font-size:0.8125rem; font-weight:600; color:var(--p-500); text-decoration:none;">View all</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0" style="font-size:0.875rem;">
                                <thead>
                                    <tr>
                                        <th style="padding:0.75rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; border-bottom:1px solid var(--border-subtle);">Subject</th>
                                        <th style="padding:0.75rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; border-bottom:1px solid var(--border-subtle);">Salary</th>
                                        <th style="padding:0.75rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; border-bottom:1px solid var(--border-subtle);">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding:0.875rem 1.25rem; border-bottom:1px solid var(--gray-100);">
                                            <div style="font-weight:600; color:var(--text-primary);">Mathematics</div>
                                            <div style="font-size:0.75rem; color:var(--text-subtle);">Class 10 — Dhanmondi</div>
                                        </td>
                                        <td style="padding:0.875rem 1.25rem; border-bottom:1px solid var(--gray-100); font-weight:600; color:var(--text-primary);">5,000 BDT</td>
                                        <td style="padding:0.875rem 1.25rem; border-bottom:1px solid var(--gray-100);"><span class="badge-success">Open</span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:0.875rem 1.25rem; border-bottom:1px solid var(--gray-100);">
                                            <div style="font-weight:600; color:var(--text-primary);">Physics</div>
                                            <div style="font-size:0.75rem; color:var(--text-subtle);">HSC — Mirpur</div>
                                        </td>
                                        <td style="padding:0.875rem 1.25rem; border-bottom:1px solid var(--gray-100); font-weight:600; color:var(--text-primary);">8,000 BDT</td>
                                        <td style="padding:0.875rem 1.25rem; border-bottom:1px solid var(--gray-100);"><span class="badge-neutral">Assigned</span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:0.875rem 1.25rem;">
                                            <div style="font-weight:600; color:var(--text-primary);">English</div>
                                            <div style="font-size:0.75rem; color:var(--text-subtle);">Professional — Gulshan</div>
                                        </td>
                                        <td style="padding:0.875rem 1.25rem; font-weight:600; color:var(--text-primary);">10,000 BDT</td>
                                        <td style="padding:0.875rem 1.25rem;"><span class="badge-success">Open</span></td>
                                    </tr>
                                </tbody>
                            </table>
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
