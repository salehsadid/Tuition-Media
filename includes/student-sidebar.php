<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<div class="offcanvas-lg offcanvas-start dashboard-sidebar" tabindex="-1" id="sidebarMenu">
    <div class="sidebar-header">
        <a href="/pages/index.php" class="d-flex align-items-center text-decoration-none gap-2">
            <i class="bi bi-mortarboard-fill" style="font-size:1.25rem; color:var(--color-success);"></i>
            <span class="brand-name">SmartTutor</span>
        </a>
        <button type="button" class="btn-close btn-close-white d-lg-none ms-auto" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"></button>
    </div>
    <div class="offcanvas-body flex-column p-0 d-flex" style="background:var(--gray-900);">
        <!-- Role badge -->
        <div class="px-3 pt-3 pb-1">
            <span style="display:block; font-size:0.6875rem; font-weight:700; letter-spacing:0.1em; text-transform:uppercase; color:rgba(255,255,255,0.3); padding:0 0.5rem 0.25rem;">Student Panel</span>
        </div>
        <ul class="sidebar-menu w-100">
            <span class="sidebar-section-label">Overview</span>
            <li>
                <a href="dashboard.php" class="sidebar-link <?= $current_page=='dashboard.php' ? 'active' : '' ?>">
                    <i class="bi bi-grid-1x2"></i> Dashboard
                </a>
            </li>

            <span class="sidebar-section-label">Tuition Management</span>
            <li>
                <a href="create-tuition.php" class="sidebar-link <?= $current_page=='create-tuition.php' ? 'active' : '' ?>">
                    <i class="bi bi-plus-square"></i> Create Tuition
                </a>
            </li>
            <li>
                <a href="my-posts.php" class="sidebar-link <?= $current_page=='my-posts.php' ? 'active' : '' ?>">
                    <i class="bi bi-card-list"></i> My Posts
                </a>
            </li>
            <li>
                <a href="applications.php" class="sidebar-link <?= $current_page=='applications.php' ? 'active' : '' ?>">
                    <i class="bi bi-file-earmark-person"></i> Applications
                </a>
            </li>
            <li>
                <a href="assigned-tutors.php" class="sidebar-link <?= $current_page=='assigned-tutors.php' ? 'active' : '' ?>">
                    <i class="bi bi-person-check"></i> Assigned Tutors
                </a>
            </li>

            <span class="sidebar-section-label">Communication</span>
            <li>
                <a href="notifications.php" class="sidebar-link <?= $current_page=='notifications.php' ? 'active' : '' ?>">
                    <i class="bi bi-bell"></i> Notifications
                    <span class="badge bg-danger ms-auto">5</span>
                </a>
            </li>

            <span class="sidebar-section-label">Account</span>
            <li>
                <a href="profile.php" class="sidebar-link <?= $current_page=='profile.php' ? 'active' : '' ?>">
                    <i class="bi bi-person-circle"></i> Profile
                </a>
            </li>
            <li>
                <a href="settings.php" class="sidebar-link <?= $current_page=='settings.php' ? 'active' : '' ?>">
                    <i class="bi bi-gear"></i> Settings
                </a>
            </li>
            <li style="margin-top:0.75rem; padding-top:0.75rem; border-top:1px solid rgba(255,255,255,0.07);">
                <a href="/pages/index.php" class="sidebar-link" style="color:rgba(248,113,113,0.8);">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</div>
