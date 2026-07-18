<?php
require_once '../../includes/auth.php';
requireAuth('admin');
$db = Database::getInstance();
$success = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user_id'])) {
    $deleteId = (int)$_POST['delete_user_id'];
    if ($deleteId === (int)$_SESSION['user_id']) {
        $error = "You cannot delete your own admin account.";
    } else {
        try {
            $u = $db->fetchOne("SELECT role FROM ST_USER WHERE user_id = :u_id", ['u_id' => $deleteId]);
            if ($u) {
                if ($u['role'] === 'student') {
                    $db->execute("DELETE FROM ST_APPLICATION WHERE post_id IN (SELECT post_id FROM ST_TUITION_POST WHERE student_id IN (SELECT student_id FROM ST_STUDENT WHERE user_id = :u_id))", ['u_id' => $deleteId]);
                    $db->execute("DELETE FROM ST_TUITION_POST WHERE student_id IN (SELECT student_id FROM ST_STUDENT WHERE user_id = :u_id)", ['u_id' => $deleteId]);
                    $db->execute("DELETE FROM ST_STUDENT WHERE user_id = :u_id", ['u_id' => $deleteId]);
                } elseif ($u['role'] === 'tutor') {
                    $db->execute("DELETE FROM ST_APPLICATION WHERE tutor_id IN (SELECT tutor_id FROM ST_TUTOR WHERE user_id = :u_id)", ['u_id' => $deleteId]);
                    $db->execute("DELETE FROM ST_TUTOR WHERE user_id = :u_id", ['u_id' => $deleteId]);
                }
                $db->execute("DELETE FROM ST_USER WHERE user_id = :u_id", ['u_id' => $deleteId]);
                $db->execute("COMMIT");
                $success = "User account completely deleted.";
            }
        } catch (Exception $e) {
            $error = "Failed to delete user: " . $e->getMessage();
        }
    }
}
$search = trim($_GET['search'] ?? '');
$roleFilter = trim($_GET['role'] ?? '');
$whereClause = "1=1";
$params = [];
if ($search !== '') {
    $whereClause .= " AND (LOWER(COALESCE(s.full_name, t.full_name, a.full_name)) LIKE :search OR LOWER(u.email) LIKE :search)";
    $params['search'] = '%' . strtolower($search) . '%';
}
if ($roleFilter !== '') {
    $whereClause .= " AND u.role = :role";
    $params['role'] = $roleFilter;
}
$users = $db->fetchAll("
    SELECT 
        u.user_id, 
        u.email, 
        u.role, 
        u.is_active, 
        TO_CHAR(u.created_at, 'DD Mon, YYYY') as created_dt,
        COALESCE(s.full_name, t.full_name, a.full_name) as full_name,
        COALESCE(s.phone, t.phone) as phone
    FROM ST_USER u
    LEFT JOIN ST_STUDENT s ON u.user_id = s.user_id
    LEFT JOIN ST_TUTOR t ON u.user_id = t.user_id
    LEFT JOIN ST_ADMIN a ON u.user_id = a.user_id
    WHERE $whereClause
    ORDER BY u.created_at DESC
", $params);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users | SmartTutor Admin</title>
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
                <h3>Manage Users</h3>
            </div>
            <form method="GET" action="manage-users.php" class="card card-custom p-3 mb-4">
                <div class="row g-3">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text bg-white text-muted border-end-0"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Search by name or email..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select name="role" class="form-select text-muted">
                            <option value="">All Roles</option>
                            <option value="student" <?= ($_GET['role'] ?? '') === 'student' ? 'selected' : '' ?>>Student</option>
                            <option value="tutor" <?= ($_GET['role'] ?? '') === 'tutor' ? 'selected' : '' ?>>Tutor</option>
                            <option value="admin" <?= ($_GET['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
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
                                <th style="padding:1rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.75rem; font-weight:700; text-transform:uppercase;">User Name</th>
                                <th style="padding:1rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.75rem; font-weight:700; text-transform:uppercase;">Contact</th>
                                <th style="padding:1rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.75rem; font-weight:700; text-transform:uppercase;">Role</th>
                                <th style="padding:1rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.75rem; font-weight:700; text-transform:uppercase;">Status</th>
                                <th style="padding:1rem 1.25rem; background:var(--gray-50); color:var(--text-muted); font-size:0.75rem; font-weight:700; text-transform:uppercase; text-align:right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($users)): ?>
                                <tr><td colspan="5" class="text-center py-4 text-muted">No users found.</td></tr>
                            <?php else: ?>
                                <?php foreach ($users as $u): ?>
                                    <tr>
                                        <td style="padding:1rem 1.25rem;">
                                            <div style="font-weight:600; color:var(--text-primary);"><?= htmlspecialchars($u['full_name'] ?? 'Incomplete Profile') ?></div>
                                            <div style="font-size:0.75rem; color:var(--text-muted);">Joined <?= htmlspecialchars($u['created_dt']) ?></div>
                                        </td>
                                        <td style="padding:1rem 1.25rem;">
                                            <div style="font-weight:500; color:var(--text-secondary);"><?= htmlspecialchars($u['email']) ?></div>
                                            <div style="font-size:0.75rem; color:var(--text-muted);"><?= htmlspecialchars($u['phone'] ?? 'N/A') ?></div>
                                        </td>
                                        <td style="padding:1rem 1.25rem;">
                                            <span class="badge bg-light text-dark border"><?= ucfirst(htmlspecialchars($u['role'])) ?></span>
                                        </td>
                                        <td style="padding:1rem 1.25rem;">
                                            <?php if ($u['is_active']): ?>
                                                <span class="badge-success px-2 py-1" style="font-size:0.7rem;">Active</span>
                                            <?php else: ?>
                                                <span class="badge-neutral px-2 py-1" style="font-size:0.7rem;">Blocked</span>
                                            <?php endif; ?>
                                        </td>
                                        <td style="padding:1rem 1.25rem; text-align:right;">
                                            <?php if ($u['user_id'] != $_SESSION['user_id']): ?>
                                                <form action="manage-users.php" method="POST" class="d-inline" onsubmit="return confirm('WARNING: This will permanently delete this user and ALL their posts and applications. Are you sure?');">
                                                    <input type="hidden" name="delete_user_id" value="<?= $u['user_id'] ?>">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Delete</button>
                                                </form>
                                            <?php else: ?>
                                                <span class="text-muted small">You (Admin)</span>
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
