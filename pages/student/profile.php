<?php
require_once '../../includes/auth.php';
requireAuth('student');


$db = Database::getInstance();
$userId = $_SESSION['user_id'];

$student = $db->fetchOne("
    SELECT u.email, s.* 
    FROM ST_USER u 
    JOIN ST_STUDENT s ON u.user_id = s.user_id 
    WHERE u.user_id = :u_id", ['u_id' => $userId]);

$nameParts = explode(' ', $student['full_name']);
$initials = strtoupper(substr($nameParts[0], 0, 1) . (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : ''));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | SmartTutor</title>
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
            
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    
                    <div class="card card-custom overflow-hidden mb-4">
                        <!-- Cover Photo -->
                        <div class="bg-primary bg-opacity-25" style="height: 150px;"></div>
                        
                        <div class="card-body px-4 px-md-5 pb-5 position-relative">
                            <!-- Avatar -->
                            <div class="rounded-circle border border-4 border-white shadow-sm position-absolute d-flex align-items-center justify-content-center bg-primary text-white fs-1 fw-bold" style="top: -64px; left: 2rem; width: 128px; height: 128px;">
                                <?= $initials ?>
                            </div>
                            
                            <!-- Action Button -->
                            <div class="d-flex justify-content-end mb-4">
                                <a href="settings.php" class="btn btn-outline-primary btn-sm fw-bold"><i class="bi bi-pencil me-1"></i>Edit Profile</a>
                            </div>

                            <h3 class="fw-bold mb-1 mt-2"><?= htmlspecialchars($student['full_name']) ?></h3>
                            <p class="text-muted mb-4"><i class="bi bi-book-half me-2"></i>Student</p>
                            
                            <hr class="border-secondary border-opacity-25 mb-4">

                            <h5 class="fw-bold mb-4">Contact Information</h5>
                            
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light text-primary-custom rounded p-2 me-3 fs-5"><i class="bi bi-envelope-fill"></i></div>
                                        <div>
                                            <div class="small text-muted fw-bold text-uppercase">Email Address</div>
                                            <div class="fw-medium"><?= htmlspecialchars($student['email']) ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light text-success rounded p-2 me-3 fs-5"><i class="bi bi-telephone-fill"></i></div>
                                        <div>
                                            <div class="small text-muted fw-bold text-uppercase">Phone Number</div>
                                            <div class="fw-medium"><?= htmlspecialchars($student['phone'] ?? 'Not provided') ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light text-danger rounded p-2 me-3 fs-5"><i class="bi bi-geo-alt-fill"></i></div>
                                        <div>
                                            <div class="small text-muted fw-bold text-uppercase">Current Address</div>
                                            <div class="fw-medium"><?= htmlspecialchars($student['address'] ?? 'Not provided') ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/main.js"></script>
</body>
</html>



