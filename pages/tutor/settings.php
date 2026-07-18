<?php
require_once '../../includes/auth.php';
requireAuth('tutor');
$db = Database::getInstance();
$userId = $_SESSION['user_id'];
$success = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['full_name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $university = $_POST['university'] ?? '';
    $department = $_POST['department'] ?? '';
    $cgpa = $_POST['cgpa'] ?? null;
    if ($cgpa === '') $cgpa = null;
    $experience = $_POST['experience_years'] ?? 0;
    if ($experience === '') $experience = 0;
    $salary = $_POST['expected_salary'] ?? null;
    if ($salary === '') $salary = null;
    $areas = $_POST['preferred_areas'] ?? '';
    try {
        $db->execute("UPDATE ST_TUTOR SET full_name = :fname, phone = :phone, university = :uni, department = :dept, cgpa = :cgpa, experience_years = :exp, expected_salary = :sal, preferred_areas = :areas WHERE user_id = :u_id", [
            'fname' => $fullName,
            'phone' => $phone,
            'uni' => $university,
            'dept' => $department,
            'cgpa' => $cgpa,
            'exp' => $experience,
            'sal' => $salary,
            'areas' => $areas,
            'u_id' => $userId
        ]);
        $db->execute("COMMIT");
        $success = "Profile updated successfully!";
    } catch (Exception $e) {
        $error = "Update failed: " . $e->getMessage();
    }
}
$tutor = $db->fetchOne("
    SELECT u.email, t.* 
    FROM ST_USER u 
    JOIN ST_TUTOR t ON u.user_id = t.user_id 
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
    <?php include '../../includes/tutor-sidebar.php'; ?>
    <main class="dashboard-main">
        <?php include '../../includes/tutor-navbar.php'; ?>
        <div class="dashboard-content">
            <h4 class="fw-bold mb-4">Settings</h4>
            <?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
            <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
            <div class="card card-custom">
                <div class="card-body p-4">
                    <form method="POST" action="settings.php">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Email (Read Only)</label>
                                <input type="email" class="form-control" value="<?= htmlspecialchars($tutor['email']) ?>" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Full Name</label>
                                <input type="text" name="full_name" class="form-control" value="<?= htmlspecialchars($tutor['full_name']) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Phone Number</label>
                                <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($tutor['phone'] ?? '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">University</label>
                                <input type="text" name="university" class="form-control" value="<?= htmlspecialchars($tutor['university'] ?? '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Department</label>
                                <input type="text" name="department" class="form-control" value="<?= htmlspecialchars($tutor['department'] ?? '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">CGPA</label>
                                <input type="number" name="cgpa" step="0.01" max="4.00" class="form-control" value="<?= htmlspecialchars($tutor['cgpa'] ?? '') ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted">Experience (Years)</label>
                                <input type="number" name="experience_years" class="form-control" value="<?= htmlspecialchars($tutor['experience_years'] ?? '') ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted">Expected Salary</label>
                                <input type="number" name="expected_salary" class="form-control" value="<?= htmlspecialchars($tutor['expected_salary'] ?? '') ?>">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label text-muted">Preferred Areas</label>
                                <input type="text" name="preferred_areas" class="form-control" value="<?= htmlspecialchars($tutor['preferred_areas'] ?? '') ?>">
                            </div>
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
