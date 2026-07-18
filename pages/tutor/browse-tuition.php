<?php
require_once '../../includes/auth.php';
requireAuth('tutor');
$db = Database::getInstance();
$search = trim($_GET['search'] ?? '');
$district = trim($_GET['district'] ?? '');
$whereClause = "1=1";
$params = [];
if ($search !== '') {
    $whereClause .= " AND (LOWER(subject_name) LIKE :search OR LOWER(class_level) LIKE :search OR LOWER(area_name) LIKE :search)";
    $params['search'] = '%' . strtolower($search) . '%';
}
if ($district !== '') {
    $whereClause .= " AND district = :district";
    $params['district'] = $district;
}
$posts = $db->fetchAll("
    SELECT 
        post_id,
        class_level,
        monthly_salary,
        days_per_week,
        formatted_date as created_at,
        subject_name,
        area_name,
        district
    FROM V_ACTIVE_POSTS
    WHERE $whereClause
    ORDER BY created_at DESC
", $params);
$districts = $db->fetchAll("SELECT DISTINCT district FROM ST_LOCATION ORDER BY district");
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
            <form method="GET" action="browse-tuition.php" class="card card-custom p-3 mb-4">
                <div class="row g-3">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text bg-white text-muted border-end-0"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Search by subject, class, or area..." value="<?= htmlspecialchars($search) ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select name="district" class="form-select text-muted">
                            <option value="">All Districts</option>
                            <?php foreach ($districts as $d): ?>
                                <option value="<?= htmlspecialchars($d['district']) ?>" <?= $district === $d['district'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($d['district']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-brand w-100">Filter Results</button>
                    </div>
                </div>
            </form>
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
                                    <a href="tuition-details.php?id=<?= $post['post_id'] ?>" class="btn btn-sm btn-outline-custom fw-bold">View Details</a>
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
