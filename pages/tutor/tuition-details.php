<?php
/**
 * SmartTutor - Tuition Details
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuition Details | SmartTutor</title>
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
            <div class="mb-4">
                <a href="browse-tuition.php" class="text-decoration-none text-muted"><i class="bi bi-arrow-left me-1"></i> Back to Jobs</a>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card card-custom border-0 p-4 p-md-5 mb-4">
                        <div class="d-flex justify-content-between align-items-start mb-4 border-bottom pb-4">
                            <div>
                                <h2 class="fw-bold text-primary-custom mb-2">Mathematics Tutor Needed</h2>
                                <span class="badge bg-primary bg-opacity-10 text-primary-custom border border-primary px-3 py-2 fs-6">Class 10 (SSC)</span>
                            </div>
                            <div class="text-end">
                                <h3 class="fw-bold text-success mb-1">5,000 BDT</h3>
                                <small class="text-muted">per month</small>
                            </div>
                        </div>

                        <h5 class="fw-bold mb-3">Job Description</h5>
                        <p class="text-muted mb-4">
                            We are looking for an experienced and dedicated Mathematics tutor for a Class 10 student preparing for their upcoming SSC exams. The tutor must have a strong background in General Math and Higher Math. We prefer someone who can provide regular mock tests and solve test papers.
                        </p>

                        <div class="row g-4 mb-4">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light text-danger rounded p-2 me-3 fs-5"><i class="bi bi-geo-alt-fill"></i></div>
                                    <div>
                                        <div class="small text-muted fw-bold text-uppercase">Location</div>
                                        <div class="fw-medium">Dhanmondi, Dhaka</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light text-primary-custom rounded p-2 me-3 fs-5"><i class="bi bi-calendar3"></i></div>
                                    <div>
                                        <div class="small text-muted fw-bold text-uppercase">Schedule</div>
                                        <div class="fw-medium">3 Days / Week</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light text-info rounded p-2 me-3 fs-5"><i class="bi bi-gender-ambiguous"></i></div>
                                    <div>
                                        <div class="small text-muted fw-bold text-uppercase">Tutor Preference</div>
                                        <div class="fw-medium">Any Gender</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light text-warning rounded p-2 me-3 fs-5"><i class="bi bi-clock-history"></i></div>
                                    <div>
                                        <div class="small text-muted fw-bold text-uppercase">Posted On</div>
                                        <div class="fw-medium">October 15, 2023</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Right Sidebar / Action Card -->
                <div class="col-lg-4">
                    <div class="card card-custom border-0 p-4 sticky-top" style="top: calc(var(--navbar-height) + 2rem);">
                        <div class="text-center mb-4">
                            <img src="https://ui-avatars.com/api/?name=Syed+Ahmed&background=random" class="rounded-circle shadow-sm mb-3" width="80" height="80">
                            <h5 class="fw-bold mb-0">Syed Ahmed</h5>
                            <small class="text-muted">Guardian / Student</small>
                        </div>
                        
                        <div class="bg-light rounded p-3 text-center mb-4 border">
                            <h6 class="fw-bold mb-1">12</h6>
                            <small class="text-muted d-block">Tutors have applied so far</small>
                        </div>

                        <!-- Apply Form Simulation -->
                        <form action="applied-jobs.php" method="GET">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary-custom small">Why are you a good fit? (Optional)</label>
                                <textarea class="form-control bg-light border-0" rows="3" placeholder="Write a short cover note..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary-custom w-100 fw-bold fs-5 py-2">
                                Apply Now <i class="bi bi-send ms-2"></i>
                            </button>
                        </form>
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
