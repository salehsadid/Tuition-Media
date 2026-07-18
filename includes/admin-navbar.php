<?php 
$navDb = Database::getInstance();
$adminNavNotifs = $navDb->fetchAll("SELECT * FROM (SELECT title, message FROM ST_NOTIFICATION WHERE target_role = 'admin' ORDER BY created_at DESC) WHERE ROWNUM <= 5");
$adminUnreadCount = $navDb->fetchOne("SELECT COUNT(*) as cnt FROM ST_NOTIFICATION WHERE target_role = 'admin' AND is_read = 0")['cnt'] ?? 0;
?>
<header class="dashboard-navbar">
    <div class="d-flex align-items-center gap-3">
        <button class="btn btn-neutral btn-sm d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" style="width:36px;height:36px;padding:0;display:flex;align-items:center;justify-content:center;">
            <i class="bi bi-list" style="font-size:1.125rem;"></i>
        </button>
        <h6 class="mb-0 d-none d-sm-block" style="font-weight:600; color:var(--text-muted); font-size:0.875rem;">Admin Control Panel</h6>
    </div>
    <div class="d-flex align-items-center gap-2">
        <div class="dropdown">
            <button class="btn btn-neutral btn-sm position-relative" style="width:36px;height:36px;padding:0;display:flex;align-items:center;justify-content:center;border-radius:50%;" type="button" data-bs-toggle="dropdown">
                <i class="bi bi-bell" style="font-size:1rem; color:var(--text-secondary);"></i>
                <?php if ($adminUnreadCount > 0): ?>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                <?php endif; ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" style="width:300px;">
                <li class="px-3 pt-2 pb-1"><span style="font-size:0.75rem; font-weight:700; color:var(--text-primary); text-transform:uppercase; letter-spacing:0.06em;">System Alerts</span></li>
                <li><hr class="dropdown-divider"></li>
                <?php if (empty($adminNavNotifs)): ?>
                    <li><div class="dropdown-item text-muted text-center" style="font-size:0.8125rem;">No new alerts</div></li>
                <?php else: ?>
                    <?php foreach ($adminNavNotifs as $n): ?>
                        <li><a class="dropdown-item" href="notifications.php" style="font-size:0.8125rem; white-space: normal;">
                            <div style="font-weight:600; color:var(--text-primary);"><?= htmlspecialchars($n['title']) ?></div>
                            <div style="color:var(--text-muted); font-size:0.75rem; margin-top:1px; line-height: 1.3;"><?= htmlspecialchars($n['message']) ?></div>
                        </a></li>
                    <?php endforeach; ?>
                <?php endif; ?>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-center" href="notifications.php" style="font-size:0.8125rem; font-weight:600; color:var(--p-500);">View all alerts</a></li>
            </ul>
        </div>
        <div class="dropdown">
            <button class="btn border-0 p-0 d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                <img src="https://ui-avatars.com/api/?name=Admin&background=1F2937&color=fff&size=64" class="rounded-circle" width="34" height="34" style="border:2px solid var(--border-subtle);">
                <div class="d-none d-md-block text-start">
                    <div style="font-size:0.8125rem; font-weight:600; color:var(--text-primary); line-height:1.2;"><?= htmlspecialchars(getLoggedInUserName()) ?></div>
                    <div style="font-size:0.6875rem; color:var(--text-muted); line-height:1.2;">Super Admin</div>
                </div>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="profile.php"><i class="bi bi-person me-2 text-muted"></i>Profile</a></li>
                <li><a class="dropdown-item" href="settings.php"><i class="bi bi-gear me-2 text-muted"></i>Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="../logout.php" style="color:var(--color-danger);">Logout</a></li>
            </ul>
        </div>
    </div>
</header>
