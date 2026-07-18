<?php
require_once '../../includes/auth.php';
requireAuth('student');
$db = Database::getInstance();
$userId = $_SESSION['user_id'];
$success = '';
$error = '';
$studentRow = $db->fetchOne("SELECT student_id FROM ST_STUDENT WHERE user_id = :u_id", ['u_id' => $userId]);
$studentId = $studentRow ? $studentRow['student_id'] : null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!$studentId) {
        $error = "Student profile not found.";
    } else {
        $subjectId = $_POST['subject_id'] ?? '';
        $locationId = $_POST['location_id'] ?? '';
        $classLevel = $_POST['class_level'] ?? '';
        $daysPerWeek = $_POST['days_per_week'] ?? '';
        $monthlySalary = $_POST['monthly_salary'] ?? '';
        $additionalInfo = $_POST['additional_info'] ?? '';
        try {
            $db->execute(
                "INSERT INTO ST_TUITION_POST (student_id, subject_id, location_id, class_level, days_per_week, monthly_salary, additional_info, status) 
                 VALUES (:s_id, :sub_id, :loc_id, :cls, :days, :sal, :info, 'open')",
                [
                    's_id' => $studentId,
                    'sub_id' => $subjectId,
                    'loc_id' => $locationId,
                    'cls' => $classLevel,
                    'days' => $daysPerWeek,
                    'sal' => $monthlySalary,
                    'info' => $additionalInfo
                ]
            );
            $db->execute("COMMIT");
            $success = "Tuition job posted successfully!";
        } catch (Exception $e) {
            $error = "Failed to post job: " . $e->getMessage();
        }
    }
}
$subjects = $db->fetchAll("SELECT * FROM ST_SUBJECT ORDER BY subject_name");
$locations = $db->fetchAll("SELECT * FROM ST_LOCATION ORDER BY district, area_name");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Tuition | SmartTutor</title>
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
            <h3 class="fw-bold mb-4">Post a New Tuition Job</h3>
            <?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
            <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
            <div class="card card-custom p-4 p-md-5">
                <form action="create-tuition.php" method="POST">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary-custom">Subject</label>
                            <select name="subject_id" class="form-select form-control-lg bg-light border-0" required>
                                <option value="" selected disabled>Select Subject</option>
                                <?php foreach ($subjects as $sub): ?>
                                    <option value="<?= $sub['subject_id'] ?>"><?= htmlspecialchars($sub['subject_name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary-custom">Class / Academic Level</label>
                            <input type="text" name="class_level" class="form-control form-control-lg bg-light border-0" placeholder="e.g. Class 10, HSC 1st Year" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-secondary-custom">Days Per Week</label>
                            <select name="days_per_week" class="form-select form-control-lg bg-light border-0" required>
                                <option value="1">1 Day</option>
                                <option value="2">2 Days</option>
                                <option value="3" selected>3 Days</option>
                                <option value="4">4 Days</option>
                                <option value="5">5 Days</option>
                                <option value="6">6 Days</option>
                                <option value="7">7 Days</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-secondary-custom">Monthly Salary (BDT)</label>
                            <input type="number" name="monthly_salary" min="1" class="form-control form-control-lg bg-light border-0" placeholder="e.g. 5000" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-secondary-custom">Location / Area</label>
                            <select name="location_id" class="form-select form-control-lg bg-light border-0" required>
                                <option value="" selected disabled>Select Location</option>
                                <?php foreach ($locations as $loc): ?>
                                    <option value="<?= $loc['location_id'] ?>"><?= htmlspecialchars($loc['area_name'] . ', ' . $loc['district']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold text-secondary-custom">Additional Requirements / Details</label>
                            <textarea name="additional_info" class="form-control bg-light border-0" rows="5" placeholder="Specify any specific requirements, timing preferences, or student's current standing..."></textarea>
                        </div>
                    </div>
                    <hr class="my-5 border-secondary border-opacity-25">
                    <div class="d-flex justify-content-end gap-3">
                        <button type="reset" class="btn btn-outline-secondary px-4 fw-bold">Clear Form</button>
                        <button type="submit" class="btn btn-brand px-5">
                            Post Job
                        </button>
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
