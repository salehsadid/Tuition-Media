<?php 
$current_page = basename($_SERVER['PHP_SELF']); 
$sidebarDb = Database::getInstance();
$sidebarUnreadCount = $sidebarDb->fetchOne("SELECT COUNT(*) as cnt FROM ST_NOTIFICATION WHERE target_role = 'admin' AND is_read = 0")['cnt'] ?? 0;
?>
<div class="offcanvas-lg offcanvas-start dashboard-sidebar" tabindex="-1" id="sidebarMenu">
    <div class="sidebar-header">
        <a href="/pages/index.php" class="d-flex align-items-center text-decoration-none gap-2">
            <i class="bi bi-mortarboard-fill" style="font-size:1.25rem; color:var(--color-success);"></i>
            <span class="brand-name">SmartTutor</span>
        </a>
        <button type="button" class="btn-close btn-close-white d-lg-none ms-auto" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"></button>
    </div>
    <div class="offcanvas-body flex-column p-0 d-flex" style="background:var(--gray-900);">
        <div class="px-3 pt-3 pb-1">
            <span style="display:inline-block; background:rgba(220,38,38,0.2); color:#fca5a5; font-size:0.6875rem; font-weight:700; letter-spacing:0.1em; text-transform:uppercase; padding:0.25rem 0.625rem; border-radius:4px; margin:0 0.5rem;">Admin</span>
        </div>
        <ul class="sidebar-menu w-100">
            <span class="sidebar-section-label">Overview</span>
            <li>
                <a href="dashboard.php" class="sidebar-link <?= $current_page=='dashboard.php' ? 'active' : '' ?>">
                    <i class="bi bi-grid-1x2"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="connections.php" class="sidebar-link <?= $current_page=='connections.php' ? 'active' : '' ?>">
                    <i class="bi bi-link-45deg"></i> Successful Connections
                </a>
            </li>
            <span class="sidebar-section-label">User Management</span>
            <li>
                <a href="manage-users.php" class="sidebar-link <?= $current_page=='manage-users.php' ? 'active' : '' ?>">
                    <i class="bi bi-people"></i> Manage Users
                </a>
            </li>
            <span class="sidebar-section-label">Content</span>
            <li>
                <a href="manage-posts.php" class="sidebar-link <?= $current_page=='manage-posts.php' ? 'active' : '' ?>">
                    <i class="bi bi-card-list"></i> Manage Posts
                </a>
            </li>
            <li>
                <a href="manage-locations.php" class="sidebar-link <?= $current_page=='manage-locations.php' ? 'active' : '' ?>">
                    <i class="bi bi-geo-alt"></i> Manage Locations
                </a>
            </li>
            <li>
                <a href="manage-subjects.php" class="sidebar-link <?= $current_page=='manage-subjects.php' ? 'active' : '' ?>">
                    <i class="bi bi-book"></i> Manage Subjects
                </a>
            </li>
            <span class="sidebar-section-label">System</span>
            <li>
                <a href="contact-directory.php" class="sidebar-link <?= $current_page=='contact-directory.php' ? 'active' : '' ?>">
                    <i class="bi bi-person-lines-fill"></i> Contact Directory
                </a>
            </li>
            <li>
                <a href="untapped-locations.php" class="sidebar-link <?= $current_page=='untapped-locations.php' ? 'active' : '' ?>">
                    <i class="bi bi-map"></i> Untapped Locations
                </a>
            </li>
            <li>
                <a href="notifications.php" class="sidebar-link <?= $current_page=='notifications.php' ? 'active' : '' ?>">
                    <i class="bi bi-bell"></i> Notifications
                    <?php if ($sidebarUnreadCount > 0): ?>
                        <span class="p-1 bg-danger border border-light rounded-circle ms-auto"></span>
                    <?php endif; ?>
                </a>
            </li>
            <span class="sidebar-section-label">Account</span>
            <li>
                <a href="profile.php" class="sidebar-link <?= $current_page=='profile.php' ? 'active' : '' ?>">
                    <i class="bi bi-person-circle"></i> Profile
                </a>
            </li>
            <li style="margin-top:0.75rem; padding-top:0.75rem; border-top:1px solid rgba(255,255,255,0.07);">
                <a href="../logout.php" class="sidebar-link" style="color:rgba(248,113,113,0.8);">
                   Logout
                </a>
            </li>
        </ul>
    </div>
</div>
