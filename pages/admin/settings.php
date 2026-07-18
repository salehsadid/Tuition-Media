<?php
require_once '../../includes/auth.php';
requireAuth('admin');
$db = Database::getInstance();
$userId = $_SESSION['user_id'];
$success = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['full_name'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    if (empty($fullName)) {
        $error = "Full Name cannot be empty.";
    } else if (!empty($newPassword) && $newPassword !== $confirmPassword) {
        $error = "New passwords do not match.";
    } else {
        try {
            $db->execute("UPDATE ST_ADMIN SET full_name = :fname WHERE user_id = :u_id", [
                'fname' => $fullName,
                'u_id' => $userId
            ]);
            if (!empty($newPassword)) {
                $hash = password_hash($newPassword, PASSWORD_BCRYPT);
                $db->execute("UPDATE ST_USER SET password_hash = :hash WHERE user_id = :u_id", [
                    'hash' => $hash,
                    'u_id' => $userId
                ]);
            }
            $db->execute("COMMIT");
            $success = "Profile updated successfully.";
        } catch (Exception $e) {
            $error = "Failed to update profile: " . $e->getMessage();
        }
    }
}
$admin = $db->fetchOne("
    SELECT u.email, a.full_name
    FROM ST_USER u
    JOIN ST_ADMIN a ON u.user_id = a.user_id
    WHERE u.user_id = :u_id
", ['u_id' => $userId]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings | SmartTutor</title>
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
            <h3 class="fw-bold mb-4">Account Settings</h3>
            <?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
            <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
            <div class="card card-custom p-4 mb-4">
                <form action="settings.php" method="POST">
                    <h5 class="fw-bold mb-4">Personal Information</h5>
                    <div class="row g-3 mb-4">
                        <div class="col-md-12">
                            <label class="form-label fw-medium small text-muted">Full Name</label>
                            <input type="text" name="full_name" class="form-control" value="<?= htmlspecialchars($admin['full_name']) ?>" required>
                        </div>
                    </div>
                    <hr class="my-4" style="border-color: #e2e8f0;">
                    <h5 class="fw-bold mb-4">Security</h5>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">New Password (leave blank to keep current)</label>
                            <input type="password" name="new_password" class="form-control" placeholder="••••••••">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Confirm New Password</label>
                            <input type="password" name="confirm_password" class="form-control" placeholder="••••••••">
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-brand">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/main.js"></script>
</body>
</html>
