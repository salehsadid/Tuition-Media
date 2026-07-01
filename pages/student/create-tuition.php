<?php
/**
 * SmartTutor - Create Tuition Post
 */
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

            <div class="card card-custom p-4 p-md-5">
                <form action="my-posts.php" method="GET">
                    
                    <div class="row g-4">
                        <!-- Subject -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary-custom">Subject</label>
                            <select class="form-select form-control-lg bg-light border-0" required>
                                <option value="" selected disabled>Select Subject</option>
                                <option>Mathematics</option>
                                <option>Physics</option>
                                <option>Chemistry</option>
                                <option>Biology</option>
                                <option>English</option>
                                <option>ICT</option>
                            </select>
                        </div>
                        
                        <!-- Class/Level -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary-custom">Class / Academic Level</label>
                            <input type="text" class="form-control form-control-lg bg-light border-0" placeholder="e.g. Class 10, HSC 1st Year" required>
                        </div>

                        <!-- Days per week -->
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-secondary-custom">Days Per Week</label>
                            <select class="form-select form-control-lg bg-light border-0" required>
                                <option value="1">1 Day</option>
                                <option value="2">2 Days</option>
                                <option value="3" selected>3 Days</option>
                                <option value="4">4 Days</option>
                                <option value="5">5 Days</option>
                                <option value="6">6 Days</option>
                            </select>
                        </div>

                        <!-- Salary -->
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-secondary-custom">Monthly Salary (BDT)</label>
                            <input type="number" class="form-control form-control-lg bg-light border-0" placeholder="e.g. 5000" required>
                        </div>

                        <!-- Preferred Gender -->
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-secondary-custom">Tutor Gender Preference</label>
                            <select class="form-select form-control-lg bg-light border-0" required>
                                <option value="any" selected>Any</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>

                        <!-- Location -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary-custom">Location / Area</label>
                            <select class="form-select form-control-lg bg-light border-0" required>
                                <option value="" selected disabled>Select Location</option>
                                <option>Dhanmondi, Dhaka</option>
                                <option>Mirpur, Dhaka</option>
                                <option>Uttara, Dhaka</option>
                                <option>Gulshan, Dhaka</option>
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="col-12">
                            <label class="form-label fw-bold text-secondary-custom">Additional Requirements / Details</label>
                            <textarea class="form-control bg-light border-0" rows="5" placeholder="Specify any specific requirements, timing preferences, or student's current standing..."></textarea>
                        </div>
                    </div>

                    <hr class="my-5 border-secondary border-opacity-25">

                    <div class="d-flex justify-content-end gap-3">
                        <button type="reset" class="btn btn-outline-secondary px-4 fw-bold">Clear Form</button>
                        <button type="submit" class="btn btn-brand px-5">
                            Post Job <i class="bi bi-send ms-2"></i>
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
