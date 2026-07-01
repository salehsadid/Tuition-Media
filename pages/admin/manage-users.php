<?php
/**
 * SmartTutor - Admin Manage Users
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users | SmartTutor Admin</title>
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
                <h3 class="fw-bold mb-0">Manage Users</h3>
            </div>

            <!-- Filters -->
            <div class="card card-custom p-3 mb-4">
                <div class="row g-2 align-items-center">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 border" style="border-color: #e2e8f0;"><i class="bi bi-search text-muted"></i></span>
                            <input type="text" class="form-control border-start-0" placeholder="Search by name or email..." style="border-color: #e2e8f0;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" style="border-color: #e2e8f0;">
                            <option value="">All Roles</option>
                            <option value="student">Student</option>
                            <option value="tutor">Tutor</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" style="border-color: #e2e8f0;">
                            <option value="">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="pending">Pending Verification</option>
                            <option value="blocked">Blocked</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn w-100 fw-semibold text-white" style="background-color: var(--primary-color);">Filter</button>
                    </div>
                </div>
            </div>

            <!-- Users Table -->
            <div class="table-custom table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Role</th>
                            <th>Institution</th>
                            <th>Joined</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name=John+Doe&background=e2e8f0&color=334155" class="rounded-circle me-3" width="38" height="38">
                                    <div>
                                        <div class="fw-semibold">John Doe</div>
                                        <div class="text-muted small">johndoe@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge-success">Student</span></td>
                            <td class="text-muted small">Ideal School</td>
                            <td class="text-muted small">Oct 5, 2023</td>
                            <td><span class="badge-success">Active</span></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-secondary me-1" title="View Details"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-outline-danger" title="Block User"><i class="bi bi-slash-circle"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name=Kamrul+Islam&background=e2e8f0&color=334155" class="rounded-circle me-3" width="38" height="38">
                                    <div>
                                        <div class="fw-semibold">Kamrul Islam</div>
                                        <div class="text-muted small">kamrul@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge-brand">Tutor</span></td>
                            <td class="text-muted small">North South Univ.</td>
                            <td class="text-muted small">Sep 20, 2023</td>
                            <td><span class="badge-success">Verified</span></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-secondary me-1" title="View Details"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-outline-danger" title="Block User"><i class="bi bi-slash-circle"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name=Rakib+Hasan&background=e2e8f0&color=334155" class="rounded-circle me-3" width="38" height="38">
                                    <div>
                                        <div class="fw-semibold">Rakib Hasan</div>
                                        <div class="text-muted small">rakib@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge-brand">Tutor</span></td>
                            <td class="text-muted small">BUET, CSE</td>
                            <td class="text-muted small">Oct 14, 2023</td>
                            <td><span class="badge-warning">Pending</span></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-success me-1" title="Verify Tutor"><i class="bi bi-patch-check"></i> Verify</button>
                                <button class="btn btn-sm btn-outline-danger" title="Reject"><i class="bi bi-x-circle"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name=Nadia+Rahman&background=e2e8f0&color=334155" class="rounded-circle me-3" width="38" height="38">
                                    <div>
                                        <div class="fw-semibold">Nadia Rahman</div>
                                        <div class="text-muted small">nadia@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge-success">Student</span></td>
                            <td class="text-muted small">Viqarunnisa Noon</td>
                            <td class="text-muted small">Oct 15, 2023</td>
                            <td><span class="badge-danger">Blocked</span></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-secondary me-1" title="View Details"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-outline-success" title="Unblock User"><i class="bi bi-check-circle"></i> Unblock</button>
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
