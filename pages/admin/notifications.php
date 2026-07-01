<?php
/**
 * SmartTutor - Admin Notifications
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications | SmartTutor Admin</title>
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
                <h3 class="fw-bold mb-0">System Notifications</h3>
                <button class="btn btn-sm btn-outline-secondary">Mark all as read</button>
            </div>

            <div class="card card-custom overflow-hidden">
                <div class="list-group list-group-flush">

                    <!-- Unread -->
                    <a href="manage-users.php" class="list-group-item list-group-item-action p-4 border-bottom" style="background-color: #f8fafc;">
                        <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                            <h6 class="mb-0 fw-bold" style="color: var(--primary-color);">
                                <i class="bi bi-person-plus-fill me-2"></i>New Tutor Registration
                            </h6>
                            <small class="fw-semibold" style="color: var(--primary-color);">15 mins ago</small>
                        </div>
                        <p class="mb-0 text-dark small mt-1">Rakib Hasan has registered as a Tutor and is awaiting identity verification.</p>
                    </a>

                    <!-- Unread -->
                    <a href="manage-posts.php" class="list-group-item list-group-item-action p-4 border-bottom" style="background-color: #f8fafc;">
                        <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                            <h6 class="mb-0 fw-bold" style="color: var(--primary-color);">
                                <i class="bi bi-card-list me-2"></i>New Tuition Post Published
                            </h6>
                            <small class="fw-semibold" style="color: var(--primary-color);">1 hour ago</small>
                        </div>
                        <p class="mb-0 text-dark small mt-1">John Doe published a new tuition post: "Mathematics - Class 10, Dhanmondi".</p>
                    </a>

                    <!-- Read -->
                    <a href="manage-users.php" class="list-group-item list-group-item-action p-4 border-bottom">
                        <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                            <h6 class="mb-0 fw-bold text-secondary-custom">
                                <i class="bi bi-person-check-fill me-2 text-success"></i>Tutor Verified
                            </h6>
                            <small class="text-muted">Yesterday</small>
                        </div>
                        <p class="mb-0 text-muted small mt-1">Kamrul Islam's tutor profile was successfully verified by the admin.</p>
                    </a>

                    <!-- Read -->
                    <a href="manage-users.php" class="list-group-item list-group-item-action p-4 border-bottom">
                        <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                            <h6 class="mb-0 fw-bold text-secondary-custom">
                                <i class="bi bi-slash-circle me-2 text-danger"></i>User Account Blocked
                            </h6>
                            <small class="text-muted">2 days ago</small>
                        </div>
                        <p class="mb-0 text-muted small mt-1">The account of Nadia Rahman was blocked due to a policy violation report.</p>
                    </a>

                    <!-- Read -->
                    <a href="manage-posts.php" class="list-group-item list-group-item-action p-4">
                        <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                            <h6 class="mb-0 fw-bold text-secondary-custom">
                                <i class="bi bi-trash me-2 text-warning"></i>Post Removed
                            </h6>
                            <small class="text-muted">4 days ago</small>
                        </div>
                        <p class="mb-0 text-muted small mt-1">A tuition post for "Chemistry - O Levels, Gulshan" was removed by admin.</p>
                    </a>

                </div>
            </div>

        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/main.js"></script>
</body>
</html>
