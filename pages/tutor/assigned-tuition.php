<?php
/**
 * SmartTutor - Assigned Tuition (Tutor)
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigned Tuition | SmartTutor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="bg-light">

<div class="dashboard-wrapper">
    <?php include '../../includes/tutor-sidebar.php'; ?>

    <main class="dashboard-main">
        <?php include '../../includes/tutor-navbar.php'; ?>

        <div class="dashboard-content">
            <h3 class="fw-bold mb-4">My Assigned Tuitions</h3>

            <!-- Grid Layout for Active Jobs -->
            <div class="row g-4">
                
                <div class="col-md-6 col-lg-4">
                    <div class="card card-custom h-100 p-0 overflow-hidden">
                        <div class="bg-success text-white text-center py-4">
                            <h5 class="fw-bold mb-1">Physics - HSC</h5>
                            <small class="text-white-50"><i class="bi bi-geo-alt-fill me-1"></i>Mirpur-10, Dhaka</small>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <img src="https://ui-avatars.com/api/?name=Amina+Begum&background=random" class="rounded-circle shadow-sm me-3" width="48" height="48">
                                <div>
                                    <h6 class="fw-bold mb-0">Amina Begum</h6>
                                    <small class="text-muted">Guardian</small>
                                </div>
                            </div>
                            
                            <div class="mb-3 d-flex justify-content-between border-bottom pb-2">
                                <span class="text-muted small fw-bold text-uppercase">Salary</span>
                                <span class="fw-bold text-success">8,000 BDT/mo</span>
                            </div>
                            <div class="mb-3 d-flex justify-content-between border-bottom pb-2">
                                <span class="text-muted small fw-bold text-uppercase">Schedule</span>
                                <span class="fw-medium">4 Days/Week</span>
                            </div>
                            <div class="mb-4 d-flex justify-content-between">
                                <span class="text-muted small fw-bold text-uppercase">Started</span>
                                <span class="fw-medium">Oct 12, 2023</span>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <a href="messages.php" class="btn btn-brand-outline"><i class="bi bi-chat-dots me-2"></i>Message Student</a>
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
