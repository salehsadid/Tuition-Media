<?php
require_once '../../includes/auth.php';
requireAuth('student');

$db = Database::getInstance();
$userId = $_SESSION['user_id'];

// Get student_id
$studentRow = $db->fetchOne("SELECT student_id FROM ST_STUDENT WHERE user_id = :u_id", ['u_id' => $userId]);
$studentId = $studentRow ? $studentRow['student_id'] : 0;

// Active Posts (open)
$activePosts = $db->fetchOne("SELECT COUNT(*) as cnt FROM ST_TUITION_POST WHERE student_id = :sid AND status = 'open'", ['sid' => $studentId])['cnt'];

// Pending Applications (received)
$pendingApps = $db->fetchOne("
    SELECT COUNT(*) as cnt 
    FROM ST_APPLICATION a
    JOIN ST_TUITION_POST p ON a.post_id = p.post_id
    WHERE p.student_id = :sid AND a.status = 'pending'
", ['sid' => $studentId])['cnt'];

// Assigned Tutors
$assignedTutors = $db->fetchOne("SELECT COUNT(*) as cnt FROM ST_TUITION_POST WHERE student_id = :sid AND status = 'assigned'", ['sid' => $studentId])['cnt'];

// Recent Applications (Last 5)
$recentActivity = $db->fetchAll("
    SELECT * FROM (
        SELECT 
            a.status, 
            TO_CHAR(a.applied_at, 'DD Mon, YYYY') as applied_dt,
            t.full_name as tutor_name,
            s.subject_name
        FROM ST_APPLICATION a
        JOIN ST_TUITION_POST p ON a.post_id = p.post_id
        JOIN ST_TUTOR t ON a.tutor_id = t.tutor_id
        JOIN ST_SUBJECT s ON p.subject_id = s.subject_id
        WHERE p.student_id = :sid
        ORDER BY a.applied_at DESC
    ) WHERE ROWNUM <= 5
", ['sid' => $studentId]);

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
                    Post New Tuition
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
                        <div class="stat-card__value"><?= $activePosts ?></div>
                        <div class="stat-card__sub" style="color:var(--color-success);">Currently Open</div>
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
                        <div class="stat-card__value"><?= $pendingApps ?></div>
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
                        <div class="stat-card__value"><?= $assignedTutors ?></div>
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
                            <h6 style="font-weight:700; color:var(--text-primary); margin:0;">Recent Applications</h6>
                            <a href="applications.php" style="font-size:0.8125rem; font-weight:600; color:var(--p-500); text-decoration:none;">View all</a>
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
                                            <div class="timeline-title"><?= htmlspecialchars($act['tutor_name']) ?> applied for <?= htmlspecialchars($act['subject_name']) ?></div>
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