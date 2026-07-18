<?php
require_once '../../includes/auth.php';
requireAuth('student');
$db = Database::getInstance();
$user_id = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mark_read'])) {
    $db->execute("UPDATE ST_NOTIFICATION SET is_read = 1 WHERE target_role = 'student' AND user_id = :u_id AND is_read = 0", ['u_id' => $user_id]);
    $db->execute("COMMIT");
    header("Location: notifications.php");
    exit;
}
$notifications = $db->fetchAll("
    SELECT notification_id, title, message, target_role, is_read, 
           TO_CHAR(created_at, 'YYYY-MM-DD HH24:MI:SS') as created_at 
    FROM ST_NOTIFICATION 
    WHERE target_role = 'student' AND user_id = :u_id 
    ORDER BY created_at DESC
", ['u_id' => $user_id]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications | Student Panel</title>
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
                <h3 class="fw-bold mb-0">Notifications</h3>
                <form method="POST" action="notifications.php">
                    <button type="submit" name="mark_read" class="btn btn-sm btn-outline-secondary">Mark all as read</button>
                </form>
            </div>
            <div class="card card-custom shadow-sm overflow-hidden">
                <div class="list-group list-group-flush">
                    <?php if (empty($notifications)): ?>
                        <div class="p-5 text-center text-muted">No notifications found.</div>
                    <?php else: ?>
                        <?php foreach ($notifications as $n): ?>
                            <div class="list-group-item p-4 <?= $n['is_read'] == 0 ? 'bg-primary bg-opacity-10 border-bottom' : 'border-bottom' ?>">
                                <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                                    <h6 class="mb-1 fw-bold <?= $n['is_read'] == 0 ? 'text-primary-custom' : 'text-secondary-custom' ?>">
                                        <?= htmlspecialchars($n['title']) ?>
                                    </h6>
                                    <small class="<?= $n['is_read'] == 0 ? 'text-primary-custom fw-bold' : 'text-muted' ?>">
                                        <?= date('M j, h:i A', strtotime($n['created_at'])) ?>
                                    </small>
                                </div>
                                <p class="mb-1 text-dark small"><?= htmlspecialchars($n['message']) ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/main.js"></script>
</body>
</html>