<?php
/**
 * SmartTutor - Applied Jobs (Tutor)
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applied Jobs | SmartTutor</title>
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
            <h3 class="fw-bold mb-4">Applied Jobs</h3>

            <div class="table-custom table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Job Details</th>
                            <th>Location & Salary</th>
                            <th>Applied On</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="fw-bold text-secondary-custom">Mathematics - Class 10</div>
                                <div class="small text-muted">Posted by Syed Ahmed</div>
                            </td>
                            <td>
                                <div class="fw-bold">5,000 BDT</div>
                                <div class="small text-muted">Dhanmondi, Dhaka</div>
                            </td>
                            <td>October 15, 2023</td>
                            <td>
                                <span class="badge-warning">Pending</span>
                            </td>
                            <td class="text-end">
                                <a href="tuition-details.php" class="btn btn-sm btn-outline-primary" title="View Job"><i class="bi bi-eye"></i></a>
                                <button class="btn btn-sm btn-outline-danger" title="Withdraw Application"><i class="bi bi-x-circle"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="fw-bold text-secondary-custom">Physics - HSC</div>
                                <div class="small text-muted">Posted by Amina Begum</div>
                            </td>
                            <td>
                                <div class="fw-bold">8,000 BDT</div>
                                <div class="small text-muted">Mirpur, Dhaka</div>
                            </td>
                            <td>October 10, 2023</td>
                            <td>
                                <span class="badge-success">Accepted</span>
                            </td>
                            <td class="text-end">
                                <a href="assigned-tuition.php" class="btn btn-sm btn-primary-custom fw-bold">Go to Job</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="fw-bold text-secondary-custom">Chemistry - O Levels</div>
                                <div class="small text-muted">Posted by Rafiqul Islam</div>
                            </td>
                            <td>
                                <div class="fw-bold">12,000 BDT</div>
                                <div class="small text-muted">Gulshan, Dhaka</div>
                            </td>
                            <td>September 28, 2023</td>
                            <td>
                                <span class="badge-danger">Rejected</span>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-secondary" disabled><i class="bi bi-eye"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/main.js"></script>
</body>
</html>
