<?php
require_once '../../includes/auth.php';
requireAuth('student');



$db = Database::getInstance();
$userId = $_SESSION['user_id'];
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['full_name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    
    try {
        $db->execute("UPDATE ST_STUDENT SET full_name = :fname, phone = :phone, address = :addr WHERE user_id = :u_id", [
            'fname' => $fullName,
            'phone' => $phone,
            'addr' => $address,
            'u_id' => $userId
        ]);
        $db->execute("COMMIT");
        $success = "Profile updated successfully!";
    } catch (Exception $e) {
        $error = "Update failed: " . $e->getMessage();
    }
}

// Fetch current details
$student = $db->fetchOne("
    SELECT u.email, s.* 
    FROM ST_USER u 
    JOIN ST_STUDENT s ON u.user_id = s.user_id 
    WHERE u.user_id = :u_id", ['u_id' => $userId]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings | SmartTutor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="bg-light">

<div class="dashboard-wrapper">
    <?php include '../../includes/student-sidebar.php'; ?>

    <main class="dashboard-main">
        <?php include '../../includes/student-navbar.php'; ?>

        <div class="dashboard-content">
            <h4 class="fw-bold mb-4">Settings</h4>
            
            <?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
            <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>

            <div class="card card-custom">
                <div class="card-body p-4">
                    <form method="POST" action="settings.php">
                        <div class="mb-3">
                            <label class="form-label text-muted">Email (Read Only)</label>
                            <input type="email" class="form-control" value="<?= htmlspecialchars($student['email']) ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Full Name</label>
                            <input type="text" name="full_name" class="form-control" value="<?= htmlspecialchars($student['full_name']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Phone Number</label>
                            <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($student['phone'] ?? '') ?>">
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-muted">Current Address</label>
                            <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($student['address'] ?? '') ?>">
                        </div>
                        <button type="submit" class="btn btn-brand">Update Profile</button>
                    </form>
                </div>
            </div>
            
        </div>
    </main>
</div>

</body>
</html>

