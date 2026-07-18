<?php
require_once '../../includes/auth.php';
requireAuth('admin');
$db = Database::getInstance();
$totalStudents = $db->fetchOne("SELECT COUNT(*) as count FROM ST_USER WHERE role = 'student'")['count'];
$totalTutors = $db->fetchOne("SELECT COUNT(*) as count FROM ST_USER WHERE role = 'tutor'")['count'];
$activePosts = $db->fetchOne("SELECT COUNT(*) as count FROM ST_TUITION_POST WHERE status = 'open'")['count'];
$totalApplications = $db->fetchOne("SELECT COUNT(*) as count FROM ST_APPLICATION")['count'];
$recentUsers = $db->fetchAll("
    SELECT * FROM (
        SELECT user_id, email, role, is_active, TO_CHAR(created_at, 'DD Mon, YYYY') as created_dt 
        FROM ST_USER 
        WHERE role != 'admin' 
        ORDER BY created_at DESC 
    ) WHERE ROWNUM <= 5
");
$recentPosts = $db->fetchAll("
    SELECT * FROM (
        SELECT p.post_id, p.class_level, p.status, s.subject_name, TO_CHAR(p.created_at, 'DD Mon, YYYY') as created_dt
        FROM ST_TUITION_POST p
        JOIN ST_SUBJECT s ON p.subject_id = s.subject_id
        ORDER BY p.created_at DESC
    ) WHERE ROWNUM <= 5
");
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
            </div>
            <div class="row g-4 mb-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="stat-card__label">Total Students</span>
                            <div class="stat-card__icon" style="background-color:var(--p-100); color:var(--p-500);">
                                <i class="bi bi-people"></i>
                            </div>
                        </div>
                        <div class="stat-card__value"><?= $totalStudents ?></div>
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
                        <div class="stat-card__value"><?= $totalTutors ?></div>
                        <div class="stat-card__sub" style="color:var(--text-muted);">Registered accounts</div>
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
                        <div class="stat-card__value"><?= $activePosts ?></div>
                        <div class="stat-card__sub" style="color:var(--text-muted);">Open requirements</div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="stat-card__label">Total Applications</span>
                            <div class="stat-card__icon" style="background-color:var(--color-warning-lt); color:var(--color-warning);">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                        </div>
                        <div class="stat-card__value"><?= $totalApplications ?></div>
                        <div class="stat-card__sub" style="color:var(--text-muted);">All-time submissions</div>
                    </div>
                </div>
            </div>
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
                                    <?php if (empty($recentUsers)): ?>
                                        <tr><td colspan="3" class="text-center py-3 text-muted">No users found.</td></tr>
                                    <?php else: ?>
                                        <?php foreach ($recentUsers as $u): ?>
                                            <tr>
                                                <td style="padding:1rem 1.25rem;">
                                                    <div style="font-weight:600; color:var(--text-primary);"><?= htmlspecialchars($u['email']) ?></div>
                                                    <div style="font-size:0.75rem; color:var(--text-muted);">Joined <?= htmlspecialchars($u['created_dt']) ?></div>
                                                </td>
                                                <td style="padding:1rem 1.25rem;">
                                                    <span class="badge bg-light text-dark border"><?= ucfirst(htmlspecialchars($u['role'])) ?></span>
                                                </td>
                                                <td style="padding:1rem 1.25rem;">
                                                    <?php if ($u['is_active']): ?>
                                                        <span class="badge-success px-2 py-1" style="font-size:0.7rem;">Active</span>
                                                    <?php else: ?>
                                                        <span class="badge-neutral px-2 py-1" style="font-size:0.7rem;">Blocked</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-custom p-0 h-100">
                        <div class="d-flex justify-content-between align-items-center p-4" style="border-bottom:1px solid var(--border-subtle);">
                            <h6 style="font-weight:700; color:var(--text-primary); margin:0;">Recent Posts</h6>
                            <a href="manage-posts.php" style="font-size:0.8125rem; font-weight:600; color:var(--p-500); text-decoration:none;">View all</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0" style="font-size:0.875rem;">
                                <thead>
                                    <tr>
                                        <th style="padding:0.75rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; border-bottom:1px solid var(--border-subtle);">Job Details</th>
                                        <th style="padding:0.75rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; border-bottom:1px solid var(--border-subtle);">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($recentPosts)): ?>
                                        <tr><td colspan="2" class="text-center py-3 text-muted">No posts found.</td></tr>
                                    <?php else: ?>
                                        <?php foreach ($recentPosts as $p): ?>
                                            <tr>
                                                <td style="padding:1rem 1.25rem;">
                                                    <div style="font-weight:600; color:var(--text-primary);"><?= htmlspecialchars($p['subject_name']) ?> <span class="text-muted fw-normal" style="font-size:0.75rem;">(<?= htmlspecialchars($p['class_level']) ?>)</span></div>
                                                    <div style="font-size:0.75rem; color:var(--text-muted);">Posted on <?= htmlspecialchars($p['created_dt']) ?></div>
                                                </td>
                                                <td style="padding:1rem 1.25rem;">
                                                    <?php if ($p['status'] === 'open'): ?>
                                                        <span class="badge-success px-2 py-1" style="font-size:0.7rem;">Open</span>
                                                    <?php else: ?>
                                                        <span class="badge-neutral px-2 py-1" style="font-size:0.7rem;"><?= ucfirst(htmlspecialchars($p['status'])) ?></span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
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
