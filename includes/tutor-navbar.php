<?php /* SmartTutor - Tutor Dashboard Navbar */ ?>
<header class="dashboard-navbar">
    <div class="d-flex align-items-center gap-3">
        <button class="btn btn-neutral btn-sm d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" style="width:36px;height:36px;padding:0;display:flex;align-items:center;justify-content:center;">
            <i class="bi bi-list" style="font-size:1.125rem;"></i>
        </button>
        <h6 class="mb-0 d-none d-sm-block" style="font-weight:600; color:var(--text-muted); font-size:0.875rem;">Tutor Dashboard</h6>
    </div>

    <div class="d-flex align-items-center gap-2">
        <div class="dropdown">
            <button class="btn btn-neutral btn-sm position-relative" style="width:36px;height:36px;padding:0;display:flex;align-items:center;justify-content:center;border-radius:50%;" type="button" data-bs-toggle="dropdown">
                <i class="bi bi-bell" style="font-size:1rem; color:var(--text-secondary);"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:0.55rem;">1</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" style="width:300px;">
                <li class="px-3 pt-2 pb-1"><span style="font-size:0.75rem; font-weight:700; color:var(--text-primary); text-transform:uppercase; letter-spacing:0.06em;">Notifications</span></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="notifications.php" style="font-size:0.8125rem;">
                    <div style="font-weight:600; color:var(--color-success);">Application Accepted</div>
                    <div style="color:var(--text-muted); font-size:0.75rem; margin-top:1px;">You were hired for Physics HSC.</div>
                </a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-center" href="notifications.php" style="font-size:0.8125rem; font-weight:600; color:var(--p-500);">View all notifications</a></li>
            </ul>
        </div>

        <div class="dropdown">
            <button class="btn border-0 p-0 d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                <img src="https://ui-avatars.com/api/?name=Kamrul+Islam&background=0D9488&color=fff&size=64" class="rounded-circle" width="34" height="34" style="border:2px solid var(--border-subtle);">
                <div class="d-none d-md-block text-start">
                    <div style="font-size:0.8125rem; font-weight:600; color:var(--text-primary); line-height:1.2;">
                        Kamrul Islam
                        <i class="bi bi-patch-check-fill ms-1" style="color:var(--p-500); font-size:0.75rem;"></i>
                    </div>
                    <div style="font-size:0.6875rem; color:var(--text-muted); line-height:1.2;">Verified Tutor</div>
                </div>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="profile.php"><i class="bi bi-person me-2 text-muted"></i>My Profile</a></li>
                <li><a class="dropdown-item" href="settings.php"><i class="bi bi-gear me-2 text-muted"></i>Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/pages/index.php" style="color:var(--color-danger);"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
            </ul>
        </div>
    </div>
</header>
