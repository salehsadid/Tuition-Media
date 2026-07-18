<?php
require_once '../../includes/auth.php';
requireAuth('student');
$db = Database::getInstance();
$tutor_id = $_GET['id'] ?? null;
if (!$tutor_id) {
    header("Location: dashboard.php");
    exit;
}
$tutor = $db->fetchOne("
    SELECT 
        t.tutor_id,
        t.full_name,
        t.phone,
        t.university,
        t.department,
        t.cgpa,
        t.experience_years,
        t.expected_salary,
        t.preferred_areas,
        t.is_verified,
        u.email
    FROM ST_TUTOR t
    JOIN ST_USER u ON t.user_id = u.user_id
    WHERE t.tutor_id = :tid
", ['tid' => $tutor_id]);
if (!$tutor) {
    die("Tutor not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutor Profile | SmartTutor</title>
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
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0">Tutor Profile</h3>
                <button onclick="history.back()" class="btn btn-outline-secondary btn-sm">Go Back</button>
            </div>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card card-custom text-center p-4">
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($tutor['full_name']) ?>&background=0D9488&color=fff&size=128" class="rounded-circle mx-auto mb-3" width="128" height="128" style="border: 4px solid var(--border-subtle);">
                        <h4 class="fw-bold mb-1">
                            <?= htmlspecialchars($tutor['full_name']) ?>
                            <?php if ($tutor['is_verified'] == 1): ?>
                                <i class="bi bi-patch-check-fill text-success" title="Verified Tutor"></i>
                            <?php endif; ?>
                        </h4>
                        <p class="text-muted small mb-4"><?= $tutor['is_verified'] == 1 ? 'Verified Tutor' : 'Unverified Tutor' ?></p>
                        <div class="d-grid gap-2">
                            <a href="mailto:<?= htmlspecialchars($tutor['email']) ?>" class="btn btn-brand w-100"><i class="bi bi-envelope me-2"></i>Email Tutor</a>
                            <?php if ($tutor['phone']): ?>
                                <a href="tel:<?= htmlspecialchars($tutor['phone']) ?>" class="btn btn-outline-primary"><i class="bi bi-telephone me-2"></i><?= htmlspecialchars($tutor['phone']) ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card card-custom p-4 h-100">
                        <h5 class="fw-bold mb-4 border-bottom pb-2">Academic Information</h5>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small fw-bold mb-1">University</label>
                                <div><?= htmlspecialchars($tutor['university'] ?? 'Not specified') ?></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small fw-bold mb-1">Department</label>
                                <div><?= htmlspecialchars($tutor['department'] ?? 'Not specified') ?></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small fw-bold mb-1">CGPA</label>
                                <div><?= htmlspecialchars($tutor['cgpa'] ?? 'N/A') ?></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small fw-bold mb-1">Experience</label>
                                <div><?= htmlspecialchars($tutor['experience_years']) ?> Years</div>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-4 border-bottom pb-2 mt-2">Preferences</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small fw-bold mb-1">Preferred Areas</label>
                                <div><?= htmlspecialchars($tutor['preferred_areas'] ?? 'Any area') ?></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small fw-bold mb-1">Expected Salary</label>
                                <div>
                                    <?php if ($tutor['expected_salary']): ?>
                                        <span class="text-success fw-bold"><?= htmlspecialchars($tutor['expected_salary']) ?> ৳</span> / month
                                    <?php else: ?>
                                        Negotiable
                                    <?php endif; ?>
                                </div>
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
