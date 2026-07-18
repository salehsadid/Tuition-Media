<?php
require_once '../../includes/auth.php';
requireAuth('tutor');

$db = Database::getInstance();
$tutor_id = $_SESSION['user_id']; // This is actually the user_id. We need to get tutor_id from ST_TUTOR.

// Get real tutor_id
$tutorRow = $db->fetchOne("SELECT tutor_id, is_verified FROM ST_TUTOR WHERE user_id = :u_id", ['u_id' => $tutor_id]);
if (!$tutorRow) {
    die("Tutor profile not found.");
}
$real_tutor_id = $tutorRow['tutor_id'];
$is_verified = $tutorRow['is_verified'];

$post_id = $_GET['id'] ?? null;
if (!$post_id) {
    header("Location: browse-tuition.php");
    exit;
}

$error = '';
$success = '';

// Handle Application Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['apply_job'])) {
    try {
        // Check if already applied
        $existing = $db->fetchOne("SELECT application_id FROM ST_APPLICATION WHERE post_id = :pid AND tutor_id = :tid", [
            'pid' => $post_id,
            'tid' => $real_tutor_id
        ]);
        
        if ($existing) {
            $error = "You have already applied for this job.";
        } else {
            $db->execute("INSERT INTO ST_APPLICATION (post_id, tutor_id, cover_note, status, applied_at) VALUES (:pid, :tid, NULL, 'pending', CURRENT_TIMESTAMP)", [
                'pid' => $post_id,
                'tid' => $real_tutor_id
            ]);
            $db->execute("COMMIT");
            $success = "Application submitted successfully!";
        }
    } catch (Exception $e) {
        $error = "An error occurred while applying. Please try again.";
    }
}

// Fetch Post Details
$post = $db->fetchOne("
    SELECT 
        p.post_id,
        p.class_level,
        p.monthly_salary,
        p.days_per_week,
        p.additional_info,
        p.status,
        TO_CHAR(p.created_at, 'YYYY-MM-DD HH24:MI:SS') as created_at,
        s.subject_name,
        l.area_name,
        l.district,
        st.full_name as student_name
    FROM ST_TUITION_POST p
    JOIN ST_SUBJECT s ON p.subject_id = s.subject_id
    JOIN ST_LOCATION l ON p.location_id = l.location_id
    JOIN ST_STUDENT st ON p.student_id = st.student_id
    WHERE p.post_id = :pid
", ['pid' => $post_id]);

if (!$post) {
    die("Post not found.");
}

// Check if currently applied
$hasApplied = false;
$applicationStatus = '';
$appRow = $db->fetchOne("SELECT status FROM ST_APPLICATION WHERE post_id = :pid AND tutor_id = :tid", [
    'pid' => $post_id,
    'tid' => $real_tutor_id
]);
if ($appRow) {
    $hasApplied = true;
    $applicationStatus = $appRow['status'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuition Details | SmartTutor</title>
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
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0">Tuition Details</h3>
                <a href="browse-tuition.php" class="btn btn-outline-secondary btn-sm">Back to Browse</a>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card card-custom p-4 h-100">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h4 class="fw-bold text-primary-custom mb-1"><?= htmlspecialchars($post['subject_name']) ?></h4>
                                <span class="badge bg-light text-dark border"><?= htmlspecialchars($post['class_level']) ?></span>
                                <?php if($post['status'] !== 'open'): ?>
                                    <span class="badge bg-secondary ms-2"><?= ucfirst($post['status']) ?></span>
                                <?php endif; ?>
                            </div>
                            <h4 class="fw-bold text-success mb-0"><?= htmlspecialchars($post['monthly_salary']) ?>৳<small class="text-muted fw-normal fs-6">/mo</small></h4>
                        </div>
                        
                        <hr class="text-muted mb-4">

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <p class="text-muted small mb-1">Location</p>
                                <p class="fw-medium mb-0"><i class="bi bi-geo-alt-fill text-danger me-2"></i><?= htmlspecialchars($post['area_name'] . ', ' . $post['district']) ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted small mb-1">Schedule</p>
                                <p class="fw-medium mb-0"><i class="bi bi-calendar3 text-primary me-2"></i><?= (int)$post['days_per_week'] ?> Days / Week</p>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <p class="text-muted small mb-1">Posted By</p>
                                <p class="fw-medium mb-0"><i class="bi bi-person-fill text-secondary me-2"></i><?= htmlspecialchars($post['student_name']) ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted small mb-1">Posted On</p>
                                <p class="fw-medium mb-0"><i class="bi bi-clock-fill text-warning me-2"></i><?= date('d M Y, h:i A', strtotime($post['created_at'])) ?></p>
                            </div>
                        </div>

                        <?php if (!empty($post['additional_info'])): ?>
                            <div class="mb-4">
                                <h6 class="fw-bold">Additional Information</h6>
                                <p class="text-muted bg-light p-3 rounded border" style="white-space: pre-wrap;"><?= htmlspecialchars($post['additional_info']) ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card card-custom p-4 h-100">
                        <h5 class="fw-bold mb-4">Application Status</h5>
                        
                        <?php if ($hasApplied): ?>
                            <div class="text-center py-4">
                                <?php if ($applicationStatus === 'accepted'): ?>
                                    <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                                    <h5 class="mt-3 text-success">Application Accepted!</h5>
                                    <p class="text-muted small">The student has accepted your application.</p>
                                <?php elseif ($applicationStatus === 'rejected'): ?>
                                    <i class="bi bi-x-circle-fill text-danger" style="font-size: 3rem;"></i>
                                    <h5 class="mt-3 text-danger">Application Rejected</h5>
                                    <p class="text-muted small">Unfortunately, you were not selected for this tuition.</p>
                                <?php else: ?>
                                    <i class="bi bi-hourglass-split text-warning" style="font-size: 3rem;"></i>
                                    <h5 class="mt-3 text-warning">Pending Review</h5>
                                    <p class="text-muted small">Your application is currently being reviewed by the student.</p>
                                <?php endif; ?>
                            </div>
                        <?php elseif ($post['status'] !== 'open'): ?>
                            <div class="text-center py-4">
                                <i class="bi bi-lock-fill text-muted" style="font-size: 3rem;"></i>
                                <h5 class="mt-3 text-muted">Job Closed</h5>
                                <p class="text-muted small">This tuition post is no longer accepting applications.</p>
                            </div>
                        <?php else: ?>
                            <form action="tuition-details.php?id=<?= $post['post_id'] ?>" method="POST">
                                <button type="submit" name="apply_job" class="btn btn-brand w-100 fw-bold">
                                    Submit Application
                                </button>
                            </form>
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
