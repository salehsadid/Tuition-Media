<?php
require_once '../../includes/auth.php';
requireAdminAuth();
$db = Database::getInstance();
$search = trim($_GET['search'] ?? '');
$districtFilter = trim($_GET['district'] ?? '');
$whereClause = "p.status IN ('assigned', 'closed')";
$params = [];
if ($search !== '') {
    $whereClause .= " AND (LOWER(st.full_name) LIKE :search OR LOWER(t.full_name) LIKE :search)";
    $params['search'] = '%' . strtolower($search) . '%';
}
if ($districtFilter !== '') {
    $whereClause .= " AND l.district = :district";
    $params['district'] = $districtFilter;
}
$connections = $db->fetchAll("
    SELECT 
        p.post_id,
        p.class_level,
        p.monthly_salary,
        p.status,
        TO_CHAR(p.created_at, 'DD Mon YYYY') as post_date,
        s.subject_name,
        l.area_name,
        l.district,
        st.full_name as student_name,
        st.phone as student_phone,
        u_st.email as student_email,
        t.full_name as tutor_name,
        t.phone as tutor_phone,
        u_t.email as tutor_email
    FROM ST_TUITION_POST p
    JOIN ST_SUBJECT s ON p.subject_id = s.subject_id
    JOIN ST_LOCATION l ON p.location_id = l.location_id
    JOIN ST_STUDENT st ON p.student_id = st.student_id
    JOIN ST_USER u_st ON st.user_id = u_st.user_id
    JOIN ST_TUTOR t ON p.hired_tutor_id = t.tutor_id
    JOIN ST_USER u_t ON t.user_id = u_t.user_id
    WHERE $whereClause
    ORDER BY p.post_id DESC
", $params);
$districts = $db->fetchAll("
    SELECT DISTINCT l.district 
    FROM ST_LOCATION l
    JOIN ST_TUITION_POST p ON l.location_id = p.location_id 
    WHERE p.status IN ('assigned', 'closed')
    ORDER BY l.district
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Successful Connections | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="bg-light">
<div class="dashboard-wrapper">
    <?php include '../../includes/admin-sidebar.php'; ?>
    <main class="dashboard-main">
        <?php include '../../includes/admin-navbar.php'; ?>
        <div class="dashboard-content">
            <h3 class="fw-bold mb-4">Successful Connections</h3>
            <form method="GET" action="connections.php" class="card card-custom p-3 mb-4">
                <div class="row g-3">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text bg-white text-muted border-end-0"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Search by student or tutor name..." value="<?= htmlspecialchars($search) ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select name="district" class="form-select text-muted">
                            <option value="">All Districts</option>
                            <?php foreach ($districts as $d): ?>
                                <option value="<?= htmlspecialchars($d['district']) ?>" <?= $districtFilter === $d['district'] ? 'selected' : '' ?>>
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
            <div class="card card-custom p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3">Job Details</th>
                                <th class="px-4 py-3">Student Info</th>
                                <th class="px-4 py-3">Tutor Info</th>
                                <th class="px-4 py-3">Location & Salary</th>
                                <th class="px-4 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($connections)): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">No successful connections yet.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($connections as $conn): ?>
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="fw-bold text-primary-custom"><?= htmlspecialchars($conn['subject_name']) ?></div>
                                            <div class="small text-muted">Class: <?= htmlspecialchars($conn['class_level']) ?></div>
                                            <div class="small text-muted" style="font-size: 0.7rem;">Posted: <?= htmlspecialchars($conn['post_date']) ?></div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="fw-bold text-secondary"><?= htmlspecialchars($conn['student_name']) ?></div>
                                            <div class="small text-muted"><i class="bi bi-envelope me-1"></i><?= htmlspecialchars($conn['student_email']) ?></div>
                                            <?php if ($conn['student_phone']): ?>
                                                <div class="small text-muted"><i class="bi bi-telephone me-1"></i><?= htmlspecialchars($conn['student_phone']) ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="fw-bold text-secondary"><?= htmlspecialchars($conn['tutor_name']) ?></div>
                                            <div class="small text-muted"><i class="bi bi-envelope me-1"></i><?= htmlspecialchars($conn['tutor_email']) ?></div>
                                            <?php if ($conn['tutor_phone']): ?>
                                                <div class="small text-muted"><i class="bi bi-telephone me-1"></i><?= htmlspecialchars($conn['tutor_phone']) ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="fw-medium text-dark"><?= htmlspecialchars($conn['area_name']) ?>, <?= htmlspecialchars($conn['district']) ?></div>
                                            <div class="small fw-bold text-success mt-1"><?= htmlspecialchars($conn['monthly_salary']) ?> ৳ / mo</div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <?php if ($conn['status'] === 'assigned'): ?>
                                                <span class="badge bg-warning text-dark">Assigned</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Closed</span>
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
