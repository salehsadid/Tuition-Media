<?php
/**
 * SmartTutor - Reusable Navbar Include
 */
?>
<nav class="navbar navbar-expand-lg navbar-custom sticky-top py-3">
    <div class="container">
        <!-- Brand Logo -->
        <a class="navbar-brand d-flex align-items-center" href="/pages/index.php">
            <i class="bi bi-mortarboard-fill me-2 fs-3 text-primary-custom"></i>
            SmartTutor
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list fs-1 text-secondary-custom"></i>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item mx-2">
                    <a class="nav-link active" aria-current="page" href="/pages/index.php">Home</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#">Find Tutors</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#">Find Tuition</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>

            <!-- Auth Buttons -->
            <div class="d-flex align-items-center mt-3 mt-lg-0 gap-3">
                <a href="/pages/login.php" class="btn btn-outline-custom w-100 w-lg-auto">Login</a>
                <a href="/pages/register.php" class="btn btn-primary-custom w-100 w-lg-auto shadow-sm">Register</a>
            </div>
        </div>
    </div>
</nav>
