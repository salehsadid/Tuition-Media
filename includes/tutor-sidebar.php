<?php
/**
 * SmartTutor - Tutor Sidebar Include
 */
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!-- Sidebar Backdrop for Mobile -->
<div class="offcanvas-lg offcanvas-start dashboard-sidebar" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
    <div class="sidebar-header">
        <a class="navbar-brand d-flex align-items-center text-white text-decoration-none" href="/pages/index.php">
            <i class="bi bi-mortarboard-fill me-2 fs-3 text-accent-custom"></i>
            <span class="fs-4">SmartTutor</span>
        </a>
        <button type="button" class="btn-close btn-close-white d-lg-none ms-auto" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body flex-column p-0">
        <ul class="sidebar-menu w-100">
            <li class="px-3 mb-2 small text-uppercase text-white-50 fw-bold mt-2">Overview</li>
            <li>
                <a href="dashboard.php" class="sidebar-link <?= ($current_page == 'dashboard.php') ? 'active' : '' ?>">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
            </li>

            <li class="px-3 mb-2 small text-uppercase text-white-50 fw-bold mt-4">Job Management</li>
            <li>
                <a href="browse-tuition.php" class="sidebar-link <?= ($current_page == 'browse-tuition.php' || $current_page == 'tuition-details.php') ? 'active' : '' ?>">
                    <i class="bi bi-search"></i> Browse Tuition
                </a>
            </li>
            <li>
                <a href="applied-jobs.php" class="sidebar-link <?= ($current_page == 'applied-jobs.php') ? 'active' : '' ?>">
                    <i class="bi bi-briefcase-fill"></i> Applied Jobs
                </a>
            </li>
            <li>
                <a href="assigned-tuition.php" class="sidebar-link <?= ($current_page == 'assigned-tuition.php') ? 'active' : '' ?>">
                    <i class="bi bi-person-workspace"></i> Assigned Tuition
                </a>
            </li>
            <li class="px-3 mb-2 small text-uppercase text-white-50 fw-bold mt-4">Communication</li>
            <li>
                <a href="notifications.php" class="sidebar-link <?= ($current_page == 'notifications.php') ? 'active' : '' ?>">
                    <i class="bi bi-bell-fill"></i> Notifications
                    <span class="badge bg-accent-custom text-dark ms-auto rounded-pill">1</span>
                </a>
            </li>

            <li class="px-3 mb-2 small text-uppercase text-white-50 fw-bold mt-4">Account</li>
            <li>
                <a href="profile.php" class="sidebar-link <?= ($current_page == 'profile.php') ? 'active' : '' ?>">
                    <i class="bi bi-person-circle"></i> Profile
                </a>
            </li>
            <li>
                <a href="settings.php" class="sidebar-link <?= ($current_page == 'settings.php') ? 'active' : '' ?>">
                    <i class="bi bi-gear-fill"></i> Settings
                </a>
            </li>
            <li class="mt-2">
                <a href="/pages/index.php" class="sidebar-link text-danger">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</div>
