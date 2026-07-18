<?php
require_once '../../includes/auth.php';
requireAuth('tutor');

$db = Database::getInstance();
$userId = $_SESSION['user_id'];

// Get tutor_id
$tutorRow = $db->fetchOne("SELECT tutor_id FROM ST_TUTOR WHERE user_id = :u_id", ['u_id' => $userId]);
$tutorId = $tutorRow ? $tutorRow['tutor_id'] : 0;

// Active Tuitions (assigned applications)
$activeTuitions = $db->fetchOne("SELECT COUNT(*) as cnt FROM ST_APPLICATION WHERE tutor_id = :tid AND status = 'accepted'", ['tid' => $tutorId])['cnt'];

// Pending Applications
$pendingApps = $db->fetchOne("SELECT COUNT(*) as cnt FROM ST_APPLICATION WHERE tutor_id = :tid AND status = 'pending'", ['tid' => $tutorId])['cnt'];

// Total Applications
$totalApps = $db->fetchOne("SELECT COUNT(*) as cnt FROM ST_APPLICATION WHERE tutor_id = :tid", ['tid' => $tutorId])['cnt'];

// Recent Applications (Last 5)
$recentActivity = $db->fetchAll("
    SELECT * FROM (
        SELECT 
            a.status, 
            TO_CHAR(a.applied_at, 'DD Mon, YYYY') as applied_dt,
            s.subject_name,
            p.class_level
        FROM ST_APPLICATION a
        JOIN ST_TUITION_POST p ON a.post_id = p.post_id
        JOIN ST_SUBJECT s ON p.subject_id = s.subject_id
        WHERE a.tutor_id = :tid
        ORDER BY a.applied_at DESC
    ) WHERE ROWNUM <= 5
", ['tid' => $tutorId]);

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
                    Find Jobs
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
                        <div class="stat-card__value"><?= $activeTuitions ?></div>
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
                        <div class="stat-card__value"><?= $pendingApps ?></div>
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
                        <div class="stat-card__value"><?= $totalApps ?></div>
                        <div class="stat-card__sub" style="color:var(--text-muted);">Submitted so far</div>
                    </div>
                </div>
            </div>

            <!-- Activity -->
            <div class="row g-4">
                <div class="col-12">
                    <div class="card-custom p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h6 style="font-weight:700; color:var(--text-primary); margin:0;">Recent Applications</h6>
                            <a href="applied-jobs.php" style="font-size:0.8125rem; font-weight:600; color:var(--p-500); text-decoration:none;">View all</a>
                        </div>
                        
                        <?php if (empty($recentActivity)): ?>
                            <div class="text-center py-4 text-muted small">No recent applications found.</div>
                        <?php else: ?>
                            <div class="timeline">
                                <?php foreach ($recentActivity as $act): 
                                    $color = 'var(--gray-500)';
                                    if ($act['status'] === 'accepted') $color = 'var(--color-success)';
                                    if ($act['status'] === 'rejected') $color = 'var(--color-danger)';
                                    if ($act['status'] === 'pending') $color = 'var(--color-warning)';
                                ?>
                                    <div class="timeline-item">
                                        <div class="timeline-dot" style="color:<?= $color ?>; background:<?= $color ?>;"></div>
                                        <div class="timeline-content">
                                            <div class="timeline-title">Applied for <?= htmlspecialchars($act['subject_name']) ?> (<?= htmlspecialchars($act['class_level']) ?>)</div>
                                            <div class="timeline-meta"><?= htmlspecialchars($act['applied_dt']) ?> — <span style="color:<?= $color ?>; font-weight:600;"><?= ucfirst(htmlspecialchars($act['status'])) ?></span></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
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