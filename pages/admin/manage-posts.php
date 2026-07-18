<?php
require_once '../../includes/auth.php';
requireAuth('admin');

$db = Database::getInstance();
$success = '';
$error = '';

// Handle Delete Post Action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_post_id'])) {
    $deleteId = (int)$_POST['delete_post_id'];
    
    try {
        // Delete applications associated with the post first
        $db->execute("DELETE FROM ST_APPLICATION WHERE post_id = :pid", ['pid' => $deleteId]);
        // Delete the post
        $db->execute("DELETE FROM ST_TUITION_POST WHERE post_id = :pid", ['pid' => $deleteId]);
        $db->execute("COMMIT");
        $success = "Post completely deleted.";
    } catch (Exception $e) {
        $error = "Failed to delete post: " . $e->getMessage();
    }
}

$search = trim($_GET['search'] ?? '');
$statusFilter = trim($_GET['status'] ?? '');

$whereClause = "1=1";
$params = [];

if ($search !== '') {
    $whereClause .= " AND (LOWER(s.subject_name) LIKE :search OR LOWER(st.full_name) LIKE :search)";
    $params['search'] = '%' . strtolower($search) . '%';
}

if ($statusFilter !== '') {
    $whereClause .= " AND p.status = :status";
    $params['status'] = $statusFilter;
}

// Fetch all posts
$posts = $db->fetchAll("
    SELECT 
        p.post_id,
        p.class_level,
        p.monthly_salary,
        p.status,
        TO_CHAR(p.created_at, 'DD Mon, YYYY') as created_dt,
        s.subject_name,
        l.area_name,
        l.district,
        u.email as student_email,
        st.full_name as student_name
    FROM ST_TUITION_POST p
    JOIN ST_SUBJECT s ON p.subject_id = s.subject_id
    JOIN ST_LOCATION l ON p.location_id = l.location_id
    JOIN ST_STUDENT st ON p.student_id = st.student_id
    JOIN ST_USER u ON st.user_id = u.user_id
    WHERE $whereClause
    ORDER BY p.created_at DESC
", $params);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Posts | SmartTutor Admin</title>
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

            <div class="page-header d-flex justify-content-between align-items-center mb-4">
                <h3>Manage Tuition Posts</h3>
            </div>
            
            <!-- Search and Filter Form -->
            <form method="GET" action="manage-posts.php" class="card card-custom p-3 mb-4">
                <div class="row g-3">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text bg-white text-muted border-end-0"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Search by subject or student..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select name="status" class="form-select text-muted">
                            <option value="">All Statuses</option>
                            <option value="open" <?= ($_GET['status'] ?? '') === 'open' ? 'selected' : '' ?>>Open</option>
                            <option value="assigned" <?= ($_GET['status'] ?? '') === 'assigned' ? 'selected' : '' ?>>Assigned</option>
                            <option value="closed" <?= ($_GET['status'] ?? '') === 'closed' ? 'selected' : '' ?>>Closed</option>
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
                                <th style="padding:1rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.75rem; font-weight:700; text-transform:uppercase;">Post Details</th>
                                <th style="padding:1rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.75rem; font-weight:700; text-transform:uppercase;">Posted By (Student)</th>
                                <th style="padding:1rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.75rem; font-weight:700; text-transform:uppercase;">Location & Salary</th>
                                <th style="padding:1rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.75rem; font-weight:700; text-transform:uppercase;">Status</th>
                                <th style="padding:1rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.75rem; font-weight:700; text-transform:uppercase; text-align:right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($posts)): ?>
                                <tr><td colspan="5" class="text-center py-4 text-muted">No posts found.</td></tr>
                            <?php else: ?>
                                <?php foreach ($posts as $p): ?>
                                    <tr>
                                        <td style="padding:1rem 1.25rem;">
                                            <div style="font-weight:600; color:var(--text-primary);"><?= htmlspecialchars($p['subject_name']) ?></div>
                                            <div style="font-size:0.75rem; color:var(--text-muted);">Class: <?= htmlspecialchars($p['class_level']) ?> • Posted <?= htmlspecialchars($p['created_dt']) ?></div>
                                        </td>
                                        <td style="padding:1rem 1.25rem;">
                                            <div style="font-weight:500; color:var(--text-secondary);"><?= htmlspecialchars($p['student_name']) ?></div>
                                            <div style="font-size:0.75rem; color:var(--text-muted);"><?= htmlspecialchars($p['student_email']) ?></div>
                                        </td>
                                        <td style="padding:1rem 1.25rem;">
                                            <div style="font-weight:500; color:var(--text-secondary);"><?= htmlspecialchars($p['area_name'] . ', ' . $p['district']) ?></div>
                                            <div style="font-size:0.75rem; color:var(--brand-primary); fw-bold"><?= htmlspecialchars($p['monthly_salary']) ?> BDT</div>
                                        </td>
                                        <td style="padding:1rem 1.25rem;">
                                            <?php if ($p['status'] === 'open'): ?>
                                                <span class="badge-success px-2 py-1" style="font-size:0.7rem;">Open</span>
                                            <?php elseif ($p['status'] === 'assigned'): ?>
                                                <span class="badge-warning px-2 py-1" style="font-size:0.7rem;">Assigned</span>
                                            <?php else: ?>
                                                <span class="badge-neutral px-2 py-1" style="font-size:0.7rem;"><?= ucfirst(htmlspecialchars($p['status'])) ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td style="padding:1rem 1.25rem; text-align:right;">
                                            <form action="manage-posts.php" method="POST" class="d-inline" onsubmit="return confirm('WARNING: This will permanently delete this post and all associated applications. Are you sure?');">
                                                <input type="hidden" name="delete_post_id" value="<?= $p['post_id'] ?>">
                                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Delete</button>
                                            </form>
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
