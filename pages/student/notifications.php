<?php
/**
 * SmartTutor - Notifications (Student)
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications | SmartTutor</title>
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
                <button class="btn btn-sm btn-outline-secondary">Mark all as read</button>
            </div>

            <div class="card card-custom shadow-sm overflow-hidden">
                <div class="list-group list-group-flush">
                    
                    <!-- Unread Notification -->
                    <a href="applications.php" class="list-group-item list-group-item-action p-4 bg-primary bg-opacity-10 border-bottom">
                        <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                            <h6 class="mb-1 fw-bold text-primary-custom"><i class="bi bi-person-plus-fill me-2"></i>New Application Received</h6>
                            <small class="text-primary-custom fw-bold">10 mins ago</small>
                        </div>
                        <p class="mb-1 text-dark small">Rakib Hasan applied for your post "Mathematics for Class 10".</p>
                    </a>

                    <!-- Read Notification -->
                    <a href="assigned-tuition.php" class="list-group-item list-group-item-action p-4 border-bottom">
                        <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                            <h6 class="mb-1 fw-bold text-success"><i class="bi bi-check-circle-fill me-2"></i>Tutor Assigned Successfully</h6>
                            <small class="text-muted">Yesterday</small>
                        </div>
                        <p class="mb-1 text-muted small">You have successfully accepted Kamrul Islam's application for English Spoken.</p>
                    </a>

                    <!-- Read Notification -->
                    <a href="my-posts.php" class="list-group-item list-group-item-action p-4">
                        <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                            <h6 class="mb-1 fw-bold text-secondary-custom"><i class="bi bi-megaphone-fill text-warning me-2"></i>Job Posted</h6>
                            <small class="text-muted">3 days ago</small>
                        </div>
                        <p class="mb-1 text-muted small">Your tuition requirement "Physics Tutor for HSC" is now live and visible to tutors.</p>
                    </a>

                </div>
            </div>
            
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/main.js"></script>
</body>
</html>
