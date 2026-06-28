<?php
/**
 * SmartTutor - Applications Received (Student)
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications | SmartTutor</title>
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
            <h3 class="fw-bold mb-4">Application History</h3>

            <!-- Filters -->
            <div class="card card-custom border-0 p-3 mb-4">
                <div class="row g-2 align-items-center">
                    <div class="col-md-4">
                        <select class="form-select border-0 bg-light">
                            <option value="">Filter by Post: All</option>
                            <option value="1">Mathematics - Class 10</option>
                            <option value="2">English Spoken</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select border-0 bg-light">
                            <option value="">Status: All</option>
                            <option value="pending">Pending</option>
                            <option value="accepted">Accepted</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="table-custom table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Tutor Profile</th>
                            <th>Applied For</th>
                            <th>CGPA / Experience</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name=Rakib+Hasan&background=random" class="rounded-circle me-3" width="40" height="40">
                                    <div>
                                        <div class="fw-bold text-secondary-custom">Rakib Hasan</div>
                                        <div class="small text-muted">BUET, CSE</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold text-primary-custom small">Mathematics</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Applied 2 hrs ago</div>
                            </td>
                            <td>
                                <div class="fw-bold">3.85</div>
                                <div class="small text-muted">3 years exp.</div>
                            </td>
                            <td>
                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2 py-1">Pending</span>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-success me-1" title="Accept"><i class="bi bi-check-lg"></i></button>
                                <button class="btn btn-sm btn-danger me-1" title="Reject"><i class="bi bi-x-lg"></i></button>
                                <button class="btn btn-sm btn-outline-primary" title="View Profile"><i class="bi bi-person"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name=Sadia+Islam&background=random" class="rounded-circle me-3" width="40" height="40">
                                    <div>
                                        <div class="fw-bold text-secondary-custom">Sadia Islam</div>
                                        <div class="small text-muted">Dhaka University, Physics</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold text-primary-custom small">Mathematics</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Applied 1 day ago</div>
                            </td>
                            <td>
                                <div class="fw-bold">3.70</div>
                                <div class="small text-muted">1 year exp.</div>
                            </td>
                            <td>
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-2 py-1">Rejected</span>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary" title="View Profile"><i class="bi bi-person"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name=Kamrul+Islam&background=random" class="rounded-circle me-3" width="40" height="40">
                                    <div>
                                        <div class="fw-bold text-secondary-custom">Kamrul Islam</div>
                                        <div class="small text-muted">North South University, BBA</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold text-primary-custom small">English Spoken</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Applied 1 week ago</div>
                            </td>
                            <td>
                                <div class="fw-bold">3.90</div>
                                <div class="small text-muted">5 years exp.</div>
                            </td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1">Accepted</span>
                            </td>
                            <td class="text-end">
                                <a href="assigned-tutors.php" class="btn btn-sm btn-primary-custom"><i class="bi bi-chat"></i> Contact</a>
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
