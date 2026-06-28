<?php
/**
 * SmartTutor - Profile (Tutor)
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutor Profile | SmartTutor</title>
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
            
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    
                    <div class="card card-custom border-0 overflow-hidden mb-4">
                        <div class="bg-primary bg-opacity-25" style="height: 150px;"></div>
                        
                        <div class="card-body px-4 px-md-5 pb-5 position-relative">
                            <img src="https://ui-avatars.com/api/?name=Kamrul+Islam&background=38BDF8&color=fff&size=128" alt="Profile" class="rounded-circle border border-4 border-white shadow-sm position-absolute" style="top: -64px; left: 2rem;">
                            
                            <div class="d-flex justify-content-end mb-4">
                                <a href="settings.php" class="btn btn-outline-primary btn-sm fw-bold"><i class="bi bi-pencil me-1"></i> Edit Profile</a>
                            </div>

                            <div class="d-flex align-items-center mt-2 mb-1">
                                <h3 class="fw-bold mb-0 me-2">Kamrul Islam</h3>
                                <i class="bi bi-patch-check-fill text-primary-custom fs-4" title="Verified Tutor"></i>
                            </div>
                            <p class="text-muted mb-3"><i class="bi bi-mortarboard-fill me-2"></i>BBA Student at North South University</p>
                            
                            <div class="d-flex gap-3 mb-4">
                                <span class="badge bg-warning text-dark px-3 py-2 fs-6"><i class="bi bi-star-fill me-1"></i> 4.9 Rating</span>
                                <span class="badge bg-light text-dark border px-3 py-2 fs-6">3 Years Experience</span>
                            </div>

                            <hr class="border-secondary border-opacity-25 mb-4">

                            <h5 class="fw-bold mb-4">Professional Information</h5>
                            
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <div class="small text-muted fw-bold text-uppercase mb-1">Current CGPA</div>
                                    <div class="fw-medium">3.90</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="small text-muted fw-bold text-uppercase mb-1">Expected Salary</div>
                                    <div class="fw-medium">From 5,000 BDT/mo</div>
                                </div>
                                <div class="col-12">
                                    <div class="small text-muted fw-bold text-uppercase mb-1">Preferred Subjects</div>
                                    <div class="d-flex gap-2 flex-wrap mt-2">
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border">English</span>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border">ICT</span>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border">General Math</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="small text-muted fw-bold text-uppercase mb-1">Preferred Areas</div>
                                    <div class="fw-medium">Bashundhara, Banani, Gulshan</div>
                                </div>
                            </div>

                            <hr class="border-secondary border-opacity-25 mb-4">

                            <h5 class="fw-bold mb-4">Contact Information</h5>
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light text-primary-custom rounded p-2 me-3 fs-5"><i class="bi bi-envelope-fill"></i></div>
                                        <div>
                                            <div class="small text-muted fw-bold text-uppercase">Email</div>
                                            <div class="fw-medium">kamrul@example.com</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light text-success rounded p-2 me-3 fs-5"><i class="bi bi-telephone-fill"></i></div>
                                        <div>
                                            <div class="small text-muted fw-bold text-uppercase">Phone</div>
                                            <div class="fw-medium">+880 1612 345678</div>
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
