<?php
/**
 * SmartTutor - Reusable Footer Include
 */
?>
<footer class="footer-custom mt-auto">
    <div class="container">
        <div class="row gy-4">
            <!-- Brand & Info -->
            <div class="col-lg-4 col-md-6">
                <a class="navbar-brand d-flex align-items-center text-white mb-3" href="/pages/index.php">
                    <i class="bi bi-mortarboard-fill me-2 fs-3 text-accent"></i>
                    <span style="color: white !important;">SmartTutor</span>
                </a>
                <p class="small pe-md-5" style="color: var(--p-100); opacity: 0.9;">
                    The most trusted platform connecting talented tutors with students across Bangladesh. Learn smarter, grow faster.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6">
                <h5 class="text-white mb-3 fw-bold">Platform</h5>
                <ul class="list-unstyled small space-y-2">
                    <li class="mb-2"><a href="/pages/index.php">Home</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div class="col-lg-2 col-md-6">
                <h5 class="text-white mb-3 fw-bold">Support</h5>
                <ul class="list-unstyled small space-y-2">
                    <li class="mb-2">support@smarttutor.com</li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-lg-4 col-md-6">
                <h5 class="text-white mb-3 fw-bold">Contact Us</h5>
                <ul class="list-unstyled small space-y-2 mb-3">
                    <li class="mb-2"><i class="bi bi-envelope me-2 text-accent"></i> support@smarttutor.com</li>
                    <li class="mb-2"><i class="bi bi-telephone me-2 text-accent"></i> +880 1234 567890</li>
                    <li class="mb-2"><i class="bi bi-geo-alt me-2 text-accent"></i> Dhaka, Bangladesh</li>
                </ul>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white fs-5"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white fs-5"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="text-white fs-5"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="text-white fs-5"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
        </div>

        <hr class="mt-5 mb-4 border-secondary">
        
        <div class="text-center small" style="color: var(--p-300);">
            &copy; <?= date('Y') ?> SmartTutor. All rights reserved. Designed for Database Systems Lab.
        </div>
    </div>
</footer>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Custom JS -->
<script src="../assets/js/main.js"></script>
</body>
</html>
