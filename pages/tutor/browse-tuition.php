<?php
session_start();
require_once '../../config/database.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'tutor') {
    header('Location: ../login.php');
    exit;
}
$db = Database::getInstance();

$posts = $db->fetchAll("
    SELECT 
        p.post_id,
        p.class_level,
        p.monthly_salary,
        p.days_per_week,
        TO_CHAR(p.created_at, 'YYYY-MM-DD HH24:MI:SS') as created_at,
        s.subject_name,
        l.area_name,
        l.district
    FROM ST_TUITION_POST p
    JOIN ST_SUBJECT s ON p.subject_id = s.subject_id
    JOIN ST_LOCATION l ON p.location_id = l.location_id
    WHERE p.status = 'open'
    ORDER BY p.created_at DESC
");

/**
 * Helper to calculate time ago
 */
function timeElapsedString($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $w = floor($diff->d / 7);
    $diff->d -= $w * 7;
    $string = [
        'y' => 'year',
        'm' => 'month',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    ];
    foreach ($string as $k => &$v) {
        if ($k === 'w') {
            if ($w) $v = $w . ' week' . ($w > 1 ? 's' : '');
            else unset($string[$k]);
        } else {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    }
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Tuition | SmartTutor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="bg-light">

<div class="dashboard-wrapper">
    <?php include '../../includes/tutor-sidebar.php'; ?>

    <main class="dashboard-main">
        <?php include '../../includes/tutor-navbar.php'; ?>

        <div class="dashboard-content">
            <h3 class="fw-bold mb-4">Browse Tuition Jobs</h3>

            <!-- Job Cards Grid -->
            <div class="row g-4">
                <?php if (empty($posts)): ?>
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-inbox fs-1 text-muted mb-3"></i>
                        <h5 class="text-muted">No open tuition jobs available right now.</h5>
                    </div>
                <?php else: ?>
                    <?php foreach ($posts as $post): ?>
                        <div class="col-lg-6 col-xl-4">
                            <div class="card card-custom h-100 p-4 job-card">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <h5 class="fw-bold text-primary-custom mb-1"><?= htmlspecialchars($post['subject_name']) ?></h5>
                                        <span class="badge bg-light text-dark border"><?= htmlspecialchars($post['class_level']) ?></span>
                                    </div>
                                    <h5 class="fw-bold text-success mb-0"><?= htmlspecialchars($post['monthly_salary']) ?>৳<small class="text-muted fw-normal" style="font-size: 0.7rem;">/mo</small></h5>
                                </div>
                                
                                <div class="mb-4">
                                    <div class="d-flex align-items-center mb-2 text-muted small">
                                        <i class="bi bi-geo-alt-fill me-2 text-danger"></i> <?= htmlspecialchars($post['area_name'] . ', ' . $post['district']) ?>
                                    </div>
                                    <div class="d-flex align-items-center mb-2 text-muted small">
                                        <i class="bi bi-calendar3 me-2 text-primary"></i> <?= (int)$post['days_per_week'] ?> Days / Week
                                    </div>
                                </div>

                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Posted <?= timeElapsedString($post['created_at']) ?></small>
                                    <a href="#" class="btn btn-sm btn-outline-custom fw-bold">View Details</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/main.js"></script>
</body>
</html>
