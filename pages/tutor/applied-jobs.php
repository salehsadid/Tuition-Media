<?php
require_once '../../includes/auth.php';
requireAuth('tutor');

$db = Database::getInstance();
$userId = $_SESSION['user_id'];

// Get tutor_id
$tutorRow = $db->fetchOne("SELECT tutor_id FROM ST_TUTOR WHERE user_id = :u_id", ['u_id' => $userId]);
$tutorId = $tutorRow ? $tutorRow['tutor_id'] : 0;

// Handle Withdrawal
$success = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['withdraw_app_id'])) {
    $appId = (int)$_POST['withdraw_app_id'];
    try {
        // Ensure this application belongs to the tutor
        $app = $db->fetchOne("SELECT status FROM ST_APPLICATION WHERE application_id = :app_id AND tutor_id = :t_id", [
            'app_id' => $appId,
            't_id' => $tutorId
        ]);
        
        if ($app) {
            if ($app['status'] === 'pending') {
                $db->execute("DELETE FROM ST_APPLICATION WHERE application_id = :app_id", ['app_id' => $appId]);
                $db->execute("COMMIT");
                $success = "Application withdrawn successfully.";
            } else {
                $error = "You can only withdraw pending applications.";
            }
        }
    } catch (Exception $e) {
        $error = "Failed to withdraw application.";
    }
}

$search = trim($_GET['search'] ?? '');
$statusFilter = trim($_GET['status'] ?? '');

$whereClause = "a.tutor_id = :tid";
$params = ['tid' => $tutorId];

if ($search !== '') {
    $whereClause .= " AND (LOWER(s.subject_name) LIKE :search OR LOWER(st.full_name) LIKE :search)";
    $params['search'] = '%' . strtolower($search) . '%';
}

if ($statusFilter !== '') {
    $whereClause .= " AND a.status = :status";
    $params['status'] = $statusFilter;
}

// Fetch applications
$applications = $db->fetchAll("
    SELECT 
        a.application_id,
        a.status as app_status,
        TO_CHAR(a.applied_at, 'DD Mon, YYYY') as applied_dt,
        p.class_level,
        p.monthly_salary,
        p.days_per_week,
        s.subject_name,
        l.area_name,
        st.full_name as student_name
    FROM ST_APPLICATION a
    JOIN ST_TUITION_POST p ON a.post_id = p.post_id
    JOIN ST_SUBJECT s ON p.subject_id = s.subject_id
    JOIN ST_LOCATION l ON p.location_id = l.location_id
    JOIN ST_STUDENT st ON p.student_id = st.student_id
    WHERE $whereClause
    ORDER BY a.applied_at DESC
", $params);

/**
 * SmartTutor - Tutor Applied Jobs
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Applications | SmartTutor</title>
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

            <div class="page-header d-flex justify-content-between align-items-center">
                <h3>My Applications</h3>
                <a href="browse-tuition.php" class="btn btn-brand">
                    Find Jobs
                </a>
            </div>

            <!-- Search and Filter Form -->
            <form method="GET" action="applied-jobs.php" class="card card-custom p-3 mb-4">
                <div class="row g-3">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text bg-white text-muted border-end-0"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Search by subject or student..." value="<?= htmlspecialchars($search) ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select name="status" class="form-select text-muted">
                            <option value="">All Statuses</option>
                            <option value="pending" <?= $statusFilter === 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="accepted" <?= $statusFilter === 'accepted' ? 'selected' : '' ?>>Accepted</option>
                            <option value="rejected" <?= $statusFilter === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-brand w-100">Filter Results</button>
                    </div>
                </div>
            </form>

            <?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
            <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>

            <div class="card-custom p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0" style="font-size:0.875rem;">
                        <thead>
                            <tr>
                                <th style="padding:1rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.75rem; font-weight:700; text-transform:uppercase;">Job Details</th>
                                <th style="padding:1rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.75rem; font-weight:700; text-transform:uppercase;">Student</th>
                                <th style="padding:1rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.75rem; font-weight:700; text-transform:uppercase;">Location & Terms</th>
                                <th style="padding:1rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.75rem; font-weight:700; text-transform:uppercase;">Status</th>
                                <th style="padding:1rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.75rem; font-weight:700; text-transform:uppercase; text-align:right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($applications)): ?>
                                <tr><td colspan="5" class="text-center py-4 text-muted">You haven't applied to any jobs yet.</td></tr>
                            <?php else: ?>
                                <?php foreach ($applications as $app): ?>
                                    <tr>
                                        <td style="padding:1rem 1.25rem;">
                                            <div style="font-weight:600; color:var(--text-primary);"><?= htmlspecialchars($app['subject_name']) ?></div>
                                            <div style="font-size:0.75rem; color:var(--text-muted);">Class: <?= htmlspecialchars($app['class_level']) ?></div>
                                        </td>
                                        <td style="padding:1rem 1.25rem;">
                                            <div style="font-weight:500; color:var(--text-secondary);"><?= htmlspecialchars($app['student_name']) ?></div>
                                        </td>
                                        <td style="padding:1rem 1.25rem;">
                                            <div style="font-weight:500; color:var(--text-secondary);"><?= htmlspecialchars($app['area_name']) ?></div>
                                            <div style="font-size:0.75rem; color:var(--brand-primary); font-weight:600;"><?= htmlspecialchars($app['monthly_salary']) ?> BDT / <?= htmlspecialchars($app['days_per_week']) ?> days</div>
                                        </td>
                                        <td style="padding:1rem 1.25rem;">
                                            <?php if ($app['app_status'] === 'accepted'): ?>
                                                <span class="badge-success px-2 py-1" style="font-size:0.7rem;">Accepted</span>
                                            <?php elseif ($app['app_status'] === 'rejected'): ?>
                                                <span class="badge-danger px-2 py-1" style="font-size:0.7rem;">Rejected</span>
                                            <?php else: ?>
                                                <span class="badge-warning px-2 py-1" style="font-size:0.7rem;">Pending</span>
                                            <?php endif; ?>
                                        </td>
                                        <td style="padding:1rem 1.25rem; text-align:right;">
                                            <?php if ($app['app_status'] === 'pending'): ?>
                                                <form action="applied-jobs.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to withdraw your application?');">
                                                    <input type="hidden" name="withdraw_app_id" value="<?= $app['application_id'] ?>">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Withdraw</button>
                                                </form>
                                            <?php else: ?>
                                                <button class="btn btn-sm btn-light text-muted border" disabled>Closed</button>
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
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/main.js"></script>
</body>
</html>