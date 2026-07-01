<?php
/**
 * SmartTutor - Admin Manage Posts
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Posts | SmartTutor Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="bg-light">

<div class="dashboard-wrapper">
    <?php include '../../includes/admin-sidebar.php'; ?>

    <main class="dashboard-main">
        <?php include '../../includes/admin-navbar.php'; ?>

        <div class="dashboard-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0">Manage Tuition Posts</h3>
            </div>

            <!-- Filters -->
            <div class="card card-custom p-3 mb-4">
                <div class="row g-2 align-items-center">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 border" style="border-color: #e2e8f0;"><i class="bi bi-search text-muted"></i></span>
                            <input type="text" class="form-control border-start-0" placeholder="Search by subject or location..." style="border-color: #e2e8f0;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" style="border-color: #e2e8f0;">
                            <option value="">All Statuses</option>
                            <option value="open">Open</option>
                            <option value="assigned">Assigned</option>
                            <option value="closed">Closed</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" style="border-color: #e2e8f0;">
                            <option value="">All Subjects</option>
                            <option>Mathematics</option>
                            <option>Physics</option>
                            <option>Chemistry</option>
                            <option>English</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn w-100 fw-semibold text-white" style="background-color: var(--primary-color);">Filter</button>
                    </div>
                </div>
            </div>

            <!-- Posts Table -->
            <div class="table-custom table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Subject &amp; Class</th>
                            <th>Posted By</th>
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
                                <div class="fw-semibold">Mathematics</div>
                                <div class="text-muted small">Class 10 (SSC)</div>
                            </td>
                            <td>
                                <div class="fw-semibold small">John Doe</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Student</div>
                            </td>
                            <td class="text-muted small">Dhanmondi</td>
                            <td class="fw-semibold">5,000 BDT</td>
                            <td><span class="badge bg-secondary bg-opacity-10 text-secondary border px-2">12</span></td>
                            <td><span class="badge-success">Open</span></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-secondary me-1" title="View Post"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-outline-danger" title="Remove Post"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="fw-semibold">Physics</div>
                                <div class="text-muted small">HSC 1st Year</div>
                            </td>
                            <td>
                                <div class="fw-semibold small">Syed Ahmed</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Student</div>
                            </td>
                            <td class="text-muted small">Mirpur-10</td>
                            <td class="fw-semibold">8,000 BDT</td>
                            <td><span class="badge bg-secondary bg-opacity-10 text-secondary border px-2">7</span></td>
                            <td><span class="badge-neutral">Assigned</span></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-secondary me-1" title="View Post"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-outline-danger" title="Remove Post"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="fw-semibold">Chemistry</div>
                                <div class="text-muted small">O Levels</div>
                            </td>
                            <td>
                                <div class="fw-semibold small">Nadia Rahman</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Student</div>
                            </td>
                            <td class="text-muted small">Gulshan</td>
                            <td class="fw-semibold">12,000 BDT</td>
                            <td><span class="badge bg-secondary bg-opacity-10 text-secondary border px-2">3</span></td>
                            <td><span class="badge-danger">Closed</span></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-secondary me-1" title="View Post"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-outline-danger" title="Remove Post"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="fw-semibold">English Spoken</div>
                                <div class="text-muted small">Professional</div>
                            </td>
                            <td>
                                <div class="fw-semibold small">Amina Begum</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Student</div>
                            </td>
                            <td class="text-muted small">Uttara</td>
                            <td class="fw-semibold">10,000 BDT</td>
                            <td><span class="badge bg-secondary bg-opacity-10 text-secondary border px-2">18</span></td>
                            <td><span class="badge-success">Open</span></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-secondary me-1" title="View Post"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-outline-danger" title="Remove Post"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <nav class="mt-4">
                <ul class="pagination justify-content-end mb-0">
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
