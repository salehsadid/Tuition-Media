<?php
/**
 * SmartTutor - Tutor Dashboard Top Navbar Include
 */
?>
<header class="dashboard-navbar">
    <div class="d-flex align-items-center">
        <!-- Mobile Sidebar Toggle -->
        <button class="btn btn-light d-lg-none me-3 shadow-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
            <i class="bi bi-list fs-5"></i>
        </button>
        
        <h5 class="mb-0 fw-bold text-secondary-custom d-none d-sm-block">Tutor Dashboard</h5>
    </div>

    <div class="d-flex align-items-center gap-3">
        <!-- Notifications Dropdown (Dummy) -->
        <div class="dropdown">
            <button class="btn btn-light rounded-circle position-relative p-2 shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-bell fs-5 text-secondary-custom"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                    1
                </span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="width: 300px;">
                <li><h6 class="dropdown-header fw-bold">Recent Notifications</h6></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item py-2" href="#"><div class="small fw-bold text-success">Application Accepted!</div><span class="text-muted small">You were hired for "Math Tutor".</span></a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-center small text-primary-custom fw-bold" href="notifications.php">View All</a></li>
            </ul>
        </div>

        <!-- Profile Dropdown -->
        <div class="dropdown">
            <button class="btn border-0 p-0 d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="d-none d-md-block text-end me-2">
                    <div class="fw-bold text-secondary-custom" style="font-size: 0.9rem;">Kamrul Islam</div>
                    <div class="text-muted" style="font-size: 0.75rem;">Tutor (Verified <i class="bi bi-patch-check-fill text-primary-custom"></i>)</div>
                </div>
                <img src="https://ui-avatars.com/api/?name=Kamrul+Islam&background=38BDF8&color=fff" alt="Profile" class="rounded-circle shadow-sm" width="40" height="40">
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                <li><a class="dropdown-item py-2" href="profile.php"><i class="bi bi-person me-2"></i>My Profile</a></li>
                <li><a class="dropdown-item py-2" href="settings.php"><i class="bi bi-gear me-2"></i>Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item py-2 text-danger" href="/pages/index.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
            </ul>
        </div>
    </div>
</header>
