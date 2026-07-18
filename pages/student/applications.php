<?php
require_once '../../includes/auth.php';
requireAuth('student');

$db = Database::getInstance();
$userId = $_SESSION['user_id'];
$success = '';
$error = '';

// Get student_id
$studentRow = $db->fetchOne("SELECT student_id FROM ST_STUDENT WHERE user_id = :u_id", ['u_id' => $userId]);
$studentId = $studentRow ? $studentRow['student_id'] : 0;

// Handle Accept/Reject Actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && isset($_POST['app_id'])) {
    $appId = (int)$_POST['app_id'];
    $action = $_POST['action'];

    try {
        // Verify this application belongs to one of the student's posts
        $app = $db->fetchOne("
            SELECT a.application_id, a.post_id, a.status, a.tutor_id 
            FROM ST_APPLICATION a 
            JOIN ST_TUITION_POST p ON a.post_id = p.post_id 
            WHERE a.application_id = :aid AND p.student_id = :sid
        ", ['aid' => $appId, 'sid' => $studentId]);

        if ($app) {
            if ($action === 'accept') {
                // Update this application to accepted
                $db->execute("UPDATE ST_APPLICATION SET status = 'accepted' WHERE application_id = :aid", ['aid' => $appId]);
                // Delete all other applications for this post since the job is now filled
                $db->execute("DELETE FROM ST_APPLICATION WHERE post_id = :pid AND application_id != :aid", [
                    'pid' => $app['post_id'],
                    'aid' => $appId
                ]);
                // Mark the post as assigned and save the hired_tutor_id
                $db->execute("UPDATE ST_TUITION_POST SET status = 'assigned', hired_tutor_id = :tid WHERE post_id = :pid", [
                    'tid' => $app['tutor_id'],
                    'pid' => $app['post_id']
                ]);
                
                $db->execute("COMMIT");
                $success = "Application accepted! The connection has been established.";
            } elseif ($action === 'reject') {
                // Remove the application from the table completely
                $db->execute("DELETE FROM ST_APPLICATION WHERE application_id = :aid", ['aid' => $appId]);
                $db->execute("COMMIT");
                $success = "Application rejected and removed.";
            }
        } else {
            $error = "Invalid application.";
        }
    } catch (Exception $e) {
        $error = "Failed to update application status.";
    }
}

$search = trim($_GET['search'] ?? '');
$statusFilter = trim($_GET['status'] ?? '');

$whereClause = "p.student_id = :sid";
$params = ['sid' => $studentId];

if ($search !== '') {
    $whereClause .= " AND LOWER(t.full_name) LIKE :search";
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
        s.subject_name,
        t.full_name as tutor_name,
        t.university || ', ' || t.department as educational_background,
        t.tutor_id
    FROM ST_APPLICATION a
    JOIN ST_TUITION_POST p ON a.post_id = p.post_id
    JOIN ST_SUBJECT s ON p.subject_id = s.subject_id
    JOIN ST_TUTOR t ON a.tutor_id = t.tutor_id
    WHERE $whereClause
    ORDER BY a.applied_at DESC
", $params);

/**
 * SmartTutor - Applications Received (Student)
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications | SmartTutor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="bg-light">

<div class="dashboard-wrapper">
    <?php include '../../includes/student-sidebar.php'; ?>

    <main class="dashboard-main">
        <?php include '../../includes/student-navbar.php'; ?>

        <div class="dashboard-content">
            <h3 class="fw-bold mb-4">Application History</h3>

            <!-- Search and Filter Form -->
            <form method="GET" action="applications.php" class="card card-custom p-3 mb-4">
                <div class="row g-3">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text bg-white text-muted border-end-0"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Search by tutor name..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select name="status" class="form-select text-muted">
                            <option value="">All Statuses</option>
                            <option value="pending" <?= ($_GET['status'] ?? '') === 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="accepted" <?= ($_GET['status'] ?? '') === 'accepted' ? 'selected' : '' ?>>Accepted</option>
                            <option value="rejected" <?= ($_GET['status'] ?? '') === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-brand w-100">Filter Results</button>
                    </div>
                </div>
            </form>

            <?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
            <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>

            <!-- Table -->
            <div class="table-custom table-responsive card-custom p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="padding:1rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.75rem; font-weight:700; text-transform:uppercase;">Tutor Profile</th>
                            <th style="padding:1rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.75rem; font-weight:700; text-transform:uppercase;">Applied For</th>
                            <th style="padding:1rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.75rem; font-weight:700; text-transform:uppercase;">Background</th>
                            <th style="padding:1rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.75rem; font-weight:700; text-transform:uppercase;">Status</th>
                            <th style="padding:1rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.75rem; font-weight:700; text-transform:uppercase; text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($applications)): ?>
                            <tr><td colspan="5" class="text-center py-4 text-muted">No applications received yet.</td></tr>
                        <?php else: ?>
                            <?php foreach ($applications as $app): ?>
                                <tr>
                                    <td style="padding:1rem 1.25rem;">
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($app['tutor_name']) ?>&background=random" class="rounded-circle me-3" width="40" height="40">
                                            <div>
                                                <div class="fw-bold text-secondary-custom"><?= htmlspecialchars($app['tutor_name']) ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding:1rem 1.25rem;">
                                        <div class="fw-bold text-primary-custom small"><?= htmlspecialchars($app['subject_name']) ?></div>
                                        <div class="text-muted" style="font-size: 0.75rem;">Applied <?= htmlspecialchars($app['applied_dt']) ?></div>
                                    </td>
                                    <td style="padding:1rem 1.25rem;">
                                        <div class="small text-muted"><?= htmlspecialchars($app['educational_background'] ?? 'Not provided') ?></div>
                                    </td>
                                    <td style="padding:1rem 1.25rem;">
                                        <?php if ($app['app_status'] === 'pending'): ?>
                                            <span class="badge-warning">Pending</span>
                                        <?php elseif ($app['app_status'] === 'accepted'): ?>
                                            <span class="badge-success">Accepted</span>
                                        <?php else: ?>
                                            <span class="badge-danger">Rejected</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="padding:1rem 1.25rem;" class="text-end">
                                        <?php if ($app['app_status'] === 'pending'): ?>
                                            <form action="applications.php" method="POST" class="d-inline">
                                                <input type="hidden" name="app_id" value="<?= $app['application_id'] ?>">
                                                <input type="hidden" name="action" value="accept">
                                                <button type="submit" class="btn btn-sm btn-success me-1" title="Accept" onclick="return confirm('Accept this tutor? All other applications for this post will be rejected.');"><i class="bi bi-check-lg"></i></button>
                                            </form>
                                            <form action="applications.php" method="POST" class="d-inline">
                                                <input type="hidden" name="app_id" value="<?= $app['application_id'] ?>">
                                                <input type="hidden" name="action" value="reject">
                                                <button type="submit" class="btn btn-sm btn-danger me-1" title="Reject"><i class="bi bi-x-lg"></i></button>
                                            </form>
                                        <?php elseif ($app['app_status'] === 'accepted'): ?>
                                            <a href="tutor-profile.php?id=<?= $app['tutor_id'] ?>" class="btn btn-sm btn-primary-custom">Contact Tutor</a>
                                        <?php else: ?>
                                            <button class="btn btn-sm btn-light border" disabled>Closed</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/main.js"></script>
</body>
</html>