<?php
/**
 * SmartTutor - Assigned Tutors (Student)
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigned Tutors | SmartTutor</title>
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
            <h3 class="fw-bold mb-4">Assigned Tutors</h3>

            <!-- Grid Layout for Tutors -->
            <div class="row g-4">
                
                <div class="col-md-6 col-lg-4">
                    <div class="card card-custom h-100 p-0 overflow-hidden">
                        <div class="bg-primary text-white text-center py-4">
                            <img src="https://ui-avatars.com/api/?name=Kamrul+Islam&background=fff&color=2563EB" class="rounded-circle shadow-sm border border-3 border-white mb-2" width="80" height="80">
                            <h5 class="fw-bold mb-0">Kamrul Islam</h5>
                            <small class="text-white-50">NSU, BBA</small>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <small class="text-muted text-uppercase fw-bold d-block mb-1">Subject</small>
                                <span class="fw-medium">English Spoken</span>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted text-uppercase fw-bold d-block mb-1">Salary & Schedule</small>
                                <span class="fw-medium">8,000 BDT / 3 Days</span>
                            </div>
                            <div class="mb-4">
                                <small class="text-muted text-uppercase fw-bold d-block mb-1">Started On</small>
                                <span class="fw-medium">October 12, 2023</span>
                                <span class="badge bg-success ms-2">Active</span>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <a href="messages.php" class="btn btn-brand"><i class="bi bi-chat-dots me-2"></i>Message Tutor</a>
                                <button class="btn btn-outline-danger"><i class="bi bi-x-circle me-2"></i>End Contract</button>
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
