<?php
/**
 * SmartTutor - Student Sidebar Include
 */

// Determine active page for highlighting the menu link
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

            <li class="px-3 mb-2 small text-uppercase text-white-50 fw-bold mt-4">Tuition Management</li>
            <li>
                <a href="create-tuition.php" class="sidebar-link <?= ($current_page == 'create-tuition.php') ? 'active' : '' ?>">
                    <i class="bi bi-plus-circle-fill"></i> Create Tuition
                </a>
            </li>
            <li>
                <a href="my-posts.php" class="sidebar-link <?= ($current_page == 'my-posts.php') ? 'active' : '' ?>">
                    <i class="bi bi-card-list"></i> My Tuition Posts
                </a>
            </li>
            <li>
                <a href="applications.php" class="sidebar-link <?= ($current_page == 'applications.php') ? 'active' : '' ?>">
                    <i class="bi bi-file-earmark-person-fill"></i> Applications
                </a>
            </li>
            <li>
                <a href="assigned-tutors.php" class="sidebar-link <?= ($current_page == 'assigned-tutors.php') ? 'active' : '' ?>">
                    <i class="bi bi-person-check-fill"></i> Assigned Tutors
                </a>
            </li>

            <li class="px-3 mb-2 small text-uppercase text-white-50 fw-bold mt-4">Communication</li>
            <li>
                <a href="notifications.php" class="sidebar-link <?= ($current_page == 'notifications.php') ? 'active' : '' ?>">
                    <i class="bi bi-bell-fill"></i> Notifications
                    <span class="badge bg-accent-custom text-dark ms-auto rounded-pill">5</span>
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
