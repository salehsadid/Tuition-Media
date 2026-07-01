<?php
/**
 * SmartTutor - My Tuition Posts (Student)
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Posts | SmartTutor</title>
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
                <h3 class="fw-bold mb-0">My Tuition Posts</h3>
                <a href="create-tuition.php" class="btn btn-brand btn-sm">
                    <i class="bi bi-plus me-1"></i>New Post
                </a>
            </div>

            <!-- Table -->
            <div class="table-custom table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Subject & Class</th>
                            <th>Location</th>
                            <th>Salary</th>
                            <th>Applications</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="fw-bold text-secondary-custom">Mathematics</div>
                                <div class="small text-muted">Class 10 (SSC)</div>
                            </td>
                            <td>Dhanmondi, Dhaka</td>
                            <td class="fw-bold">5,000 BDT</td>
                            <td>
                                <span class="badge bg-primary rounded-pill px-3">12</span>
                            </td>
                            <td>
                                <span class="badge-success">Open</span>
                            </td>
                            <td class="text-end">
                                <a href="applications.php" class="btn btn-sm btn-outline-primary me-2"><i class="bi bi-eye"></i> View</a>
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="fw-bold text-secondary-custom">Physics</div>
                                <div class="small text-muted">HSC 1st Year</div>
                            </td>
                            <td>Mirpur-10, Dhaka</td>
                            <td class="fw-bold">6,500 BDT</td>
                            <td>
                                <span class="badge bg-secondary rounded-pill px-3">0</span>
                            </td>
                            <td>
                                <span class="badge-success">Open</span>
                            </td>
                            <td class="text-end">
                                <a href="#" class="btn btn-sm btn-outline-primary me-2"><i class="bi bi-pencil"></i> Edit</a>
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="fw-bold text-secondary-custom">English Spoken</div>
                                <div class="small text-muted">Professional</div>
                            </td>
                            <td>Uttara, Dhaka</td>
                            <td class="fw-bold">8,000 BDT</td>
                            <td>
                                <span class="badge bg-secondary rounded-pill px-3">5</span>
                            </td>
                            <td>
                                <span class="badge-warning">Assigned</span>
                            </td>
                            <td class="text-end">
                                <a href="assigned-tutors.php" class="btn btn-sm btn-primary-custom me-2"><i class="bi bi-person-check"></i> Tutor</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="fw-bold text-secondary-custom">Chemistry</div>
                                <div class="small text-muted">SSC</div>
                            </td>
                            <td>Gulshan, Dhaka</td>
                            <td class="fw-bold">5,500 BDT</td>
                            <td>
                                <span class="badge bg-secondary rounded-pill px-3">8</span>
                            </td>
                            <td>
                                <span class="badge-neutral">Closed</span>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-secondary" disabled><i class="bi bi-eye"></i> View</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination (Dummy) -->
            <nav class="mt-4">
                <ul class="pagination justify-content-end">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
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
