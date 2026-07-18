<?php
require_once '../../includes/auth.php';
requireAuth('admin');

$db = Database::getInstance();

// Fetch combined list of students and tutors using UNION ALL
$contacts = $db->fetchAll("
    SELECT full_name, phone, u.email, 'Student' AS user_role
    FROM ST_STUDENT s JOIN ST_USER u ON s.user_id = u.user_id
    UNION ALL
    SELECT full_name, phone, u.email, 'Tutor' AS user_role
    FROM ST_TUTOR t JOIN ST_USER u ON t.user_id = u.user_id
    ORDER BY user_role, full_name
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Directory - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-light">

<div class="dashboard-wrapper">
    <?php include '../../includes/admin-sidebar.php'; ?>
    <main class="dashboard-main">
        <?php include '../../includes/admin-navbar.php'; ?>
        <div class="dashboard-content">
                <div class="page-header d-flex justify-content-between align-items-center mb-4">
                    <h3>Contact Directory</h3>
                </div>

                <div class="card card-custom p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Role</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($contacts)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">No contacts found.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($contacts as $contact): ?>
                                        <tr>
                                            <td>
                                                <?php if ($contact['user_role'] === 'Student'): ?>
                                                    <span class="badge bg-primary text-white">Student</span>
                                                <?php else: ?>
                                                    <span class="badge bg-success text-white">Tutor</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="fw-semibold"><?= htmlspecialchars($contact['full_name']) ?></td>
                                            <td><?= htmlspecialchars($contact['email']) ?></td>
                                            <td><?= htmlspecialchars($contact['phone'] ?? 'N/A') ?></td>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/main.js"></script>
</body>
</html>
