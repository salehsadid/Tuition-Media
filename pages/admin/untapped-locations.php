<?php
require_once '../../includes/auth.php';
requireAuth('admin');
$db = Database::getInstance();
$untapped = $db->fetchAll("
    SELECT area_name, district FROM ST_LOCATION
    MINUS
    SELECT l.area_name, l.district 
    FROM ST_LOCATION l 
    JOIN ST_TUITION_POST p ON l.location_id = p.location_id
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Untapped Locations - Admin</title>
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
                    <h3>Untapped Locations</h3>
                </div>
                <div class="alert alert-info border-0 rounded-4 mb-4">
                    <i class="bi bi-info-circle me-2"></i> These are the locations where no tuition jobs have been posted yet.
                </div>
                <div class="card card-custom p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Area Name</th>
                                    <th>District</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($untapped)): ?>
                                    <tr>
                                        <td colspan="2" class="text-center text-muted py-4">All locations currently have active tuition posts!</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($untapped as $loc): ?>
                                        <tr>
                                            <td class="fw-semibold"><?= htmlspecialchars($loc['area_name']) ?></td>
                                            <td><?= htmlspecialchars($loc['district']) ?></td>
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
