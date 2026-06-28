<?php
/**
 * SmartTutor - Browse Tuition (Job Board)
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Tuition | SmartTutor</title>
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
            <h3 class="fw-bold mb-4">Browse Tuition Jobs</h3>

            <!-- Search & Filters -->
            <div class="card card-custom border-0 p-3 mb-4">
                <form action="#" method="GET">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                                <input type="text" class="form-control border-start-0" placeholder="Search subject or class...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option value="">Any Location</option>
                                <option>Dhanmondi</option>
                                <option>Mirpur</option>
                                <option>Uttara</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option value="">Sort By</option>
                                <option>Newest First</option>
                                <option>Highest Salary</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary-custom w-100">Filter</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Job Cards Grid -->
            <div class="row g-4">
                
                <!-- Job Card 1 -->
                <div class="col-lg-6 col-xl-4">
                    <div class="card card-custom border-0 h-100 p-4 job-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="fw-bold text-primary-custom mb-1">Mathematics</h5>
                                <span class="badge bg-light text-dark border">Class 10 (SSC)</span>
                            </div>
                            <h5 class="fw-bold text-success mb-0">5,000৳<small class="text-muted fw-normal" style="font-size: 0.7rem;">/mo</small></h5>
                        </div>
                        
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-2 text-muted small">
                                <i class="bi bi-geo-alt-fill me-2 text-danger"></i> Dhanmondi, Dhaka
                            </div>
                            <div class="d-flex align-items-center mb-2 text-muted small">
                                <i class="bi bi-calendar3 me-2 text-primary"></i> 3 Days / Week
                            </div>
                            <div class="d-flex align-items-center text-muted small">
                                <i class="bi bi-person-fill me-2 text-info"></i> Any Gender Preferred
                            </div>
                        </div>

                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <small class="text-muted">Posted 2 hours ago</small>
                            <a href="tuition-details.php" class="btn btn-sm btn-outline-custom fw-bold">View Details</a>
                        </div>
                    </div>
                </div>

                <!-- Job Card 2 -->
                <div class="col-lg-6 col-xl-4">
                    <div class="card card-custom border-0 h-100 p-4 job-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="fw-bold text-primary-custom mb-1">Physics & Chemistry</h5>
                                <span class="badge bg-light text-dark border">HSC 1st Year</span>
                            </div>
                            <h5 class="fw-bold text-success mb-0">8,000৳<small class="text-muted fw-normal" style="font-size: 0.7rem;">/mo</small></h5>
                        </div>
                        
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-2 text-muted small">
                                <i class="bi bi-geo-alt-fill me-2 text-danger"></i> Mirpur-10, Dhaka
                            </div>
                            <div class="d-flex align-items-center mb-2 text-muted small">
                                <i class="bi bi-calendar3 me-2 text-primary"></i> 4 Days / Week
                            </div>
                            <div class="d-flex align-items-center text-muted small">
                                <i class="bi bi-person-fill me-2 text-info"></i> Male Tutor Preferred
                            </div>
                        </div>

                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <small class="text-muted">Posted 5 hours ago</small>
                            <a href="tuition-details.php" class="btn btn-sm btn-outline-custom fw-bold">View Details</a>
                        </div>
                    </div>
                </div>

                <!-- Job Card 3 -->
                <div class="col-lg-6 col-xl-4">
                    <div class="card card-custom border-0 h-100 p-4 job-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="fw-bold text-primary-custom mb-1">English Spoken</h5>
                                <span class="badge bg-light text-dark border">Professional</span>
                            </div>
                            <h5 class="fw-bold text-success mb-0">10,000৳<small class="text-muted fw-normal" style="font-size: 0.7rem;">/mo</small></h5>
                        </div>
                        
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-2 text-muted small">
                                <i class="bi bi-geo-alt-fill me-2 text-danger"></i> Uttara Sector 7, Dhaka
                            </div>
                            <div class="d-flex align-items-center mb-2 text-muted small">
                                <i class="bi bi-calendar3 me-2 text-primary"></i> 2 Days / Week
                            </div>
                            <div class="d-flex align-items-center text-muted small">
                                <i class="bi bi-person-fill me-2 text-info"></i> Female Tutor Preferred
                            </div>
                        </div>

                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <small class="text-muted">Posted 1 day ago</small>
                            <a href="tuition-details.php" class="btn btn-sm btn-outline-custom fw-bold">View Details</a>
                        </div>
                    </div>
                </div>

            </div>
            
            <!-- Pagination -->
            <nav class="mt-5">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>

        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/main.js"></script>
</body>
</html>
