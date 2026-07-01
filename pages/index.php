<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartTutor</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php include '../includes/navbar.php'; ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start">
                <span style="display:inline-flex; align-items:center; gap:0.5rem; background:var(--p-100); color:var(--p-600); font-size:0.8rem; font-weight:600; letter-spacing:0.04em; padding:0.35rem 0.875rem; border-radius:99px; margin-bottom:1.25rem; border:1px solid rgba(92,92,153,0.2);">
                    #1 Tuition Platform in Bangladesh
                </span>
                <h1 class="hero-title">
                    Find the Perfect <span style="color:var(--p-500);">Tutor</span><br>for Your Future.
                </h1>
                <p class="hero-subtitle">
                    Connect with thousands of verified, expert tutors across Bangladesh. 
                    Whether it's for school, college, or university preparation, we have the right match for you.
                </p>
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start">
                    <a href="/pages/register.php" class="btn btn-brand btn-lg shadow-sm">
                        <i class="bi bi-search me-2"></i>Find a Tutor
                    </a>
                    <a href="/pages/register.php" class="btn btn-brand-outline btn-lg bg-white">
                        <i class="bi bi-person-workspace me-2"></i>Become a Tutor
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <!-- Using a generic placeholder image from unDraw style sources -->
                <img src="https://illustrations.popsy.co/blue/student-going-to-school.svg" alt="Education Illustration" class="img-fluid rounded" style="max-height: 450px;">
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-5 bg-white border-bottom">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-md-4">
                <h2 class="display-5 fw-bold text-primary-custom mb-0">10,000+</h2>
                <p class="text-muted fw-medium fs-5">Verified Tutors</p>
            </div>
            <div class="col-md-4">
                <h2 class="display-5 fw-bold text-success mb-0">50,000+</h2>
                <p class="text-muted fw-medium fs-5">Happy Students</p>
            </div>
            <div class="col-md-4">
                <h2 class="display-5 fw-bold" style="color: var(--accent-color);">5,000+</h2>
                <p class="text-muted fw-medium fs-5">Active Tuition Posts</p>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 my-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Why Choose SmartTutor?</h2>
            <p class="text-muted">We provide a premium, secure, and smart environment for education.</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="card card-custom card-hover h-100 p-4 border-0">
                    <div class="feature-icon-wrapper">
                        <i class="bi bi-cpu"></i>
                    </div>
                    <h5 class="fw-bold">Smart Matching</h5>
                    <p class="text-muted small mb-0">Our algorithm matches students with tutors based on subject, location, and budget.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card card-custom card-hover h-100 p-4 border-0">
                    <div class="feature-icon-wrapper text-success bg-success bg-opacity-10">
                        <i class="bi bi-patch-check"></i>
                    </div>
                    <h5 class="fw-bold">Verified Tutors</h5>
                    <p class="text-muted small mb-0">Every tutor goes through a strict ID and educational background verification process.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card card-custom card-hover h-100 p-4 border-0">
                    <div class="feature-icon-wrapper" style="color: var(--accent-color); background-color: rgba(56, 189, 248, 0.1);">
                        <i class="bi bi-lightning-charge"></i>
                    </div>
                    <h5 class="fw-bold">Fast Hiring</h5>
                    <p class="text-muted small mb-0">Post a job and get applications within minutes. Hire your ideal tutor the same day.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card card-custom card-hover h-100 p-4 border-0">
                    <div class="feature-icon-wrapper text-danger bg-danger bg-opacity-10">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    <h5 class="fw-bold">Secure Platform</h5>
                    <p class="text-muted small mb-0">Your data and privacy are protected with industry-standard security measures.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-5 bg-white border-top border-bottom">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold">How It Works</h2>
            <p class="text-muted">A simple 3-step process to start your learning journey.</p>
        </div>
        <div class="row text-center position-relative">
            <!-- Connecting Line (Desktop Only) -->
            <div class="d-none d-md-block position-absolute top-50 start-50 translate-middle w-75" style="height: 2px; background-color: #e2e8f0; z-index: 0;"></div>
            
            <div class="col-md-4 mb-4 mb-md-0 position-relative" style="z-index: 1;">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 shadow" style="width: 80px; height: 80px; font-size: 2rem; font-weight: bold;">1</div>
                <h5 class="fw-bold">Post Tuition</h5>
                <p class="text-muted small px-3">Tell us your requirements, subject, budget, and location.</p>
            </div>
            <div class="col-md-4 mb-4 mb-md-0 position-relative" style="z-index: 1;">
                <div class="bg-white text-primary border border-primary border-2 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 shadow" style="width: 80px; height: 80px; font-size: 2rem; font-weight: bold;">2</div>
                <h5 class="fw-bold">Tutors Apply</h5>
                <p class="text-muted small px-3">Qualified tutors will review your post and send their applications.</p>
            </div>
            <div class="col-md-4 position-relative" style="z-index: 1;">
                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 shadow" style="width: 80px; height: 80px; font-size: 2rem; font-weight: bold;">3</div>
                <h5 class="fw-bold">Select & Start</h5>
                <p class="text-muted small px-3">Review tutor profiles, select the best fit, and start learning.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5 my-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">What Our Users Say</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card card-custom p-4 h-100">
                    <div class="d-flex mb-3 text-warning">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p class="fst-italic text-muted mb-4">"Finding a Physics tutor for my daughter was a nightmare before SmartTutor. I posted a job and hired an amazing BUET student the very next day. Highly recommended!"</p>
                    <div class="d-flex align-items-center mt-auto">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 48px; height: 48px;">SA</div>
                        <div>
                            <h6 class="mb-0 fw-bold">Syed Ahmed</h6>
                            <small class="text-muted">Guardian, Dhaka</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-custom p-4 h-100">
                    <div class="d-flex mb-3 text-warning">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p class="fst-italic text-muted mb-4">"As a university student, SmartTutor helped me find part-time tuition jobs near my campus effortlessly. The platform is clean, professional, and very easy to use."</p>
                    <div class="d-flex align-items-center mt-auto">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 48px; height: 48px;">NR</div>
                        <div>
                            <h6 class="mb-0 fw-bold">Nusrat Rahman</h6>
                            <small class="text-muted">Tutor, DU</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5 bg-white border-top">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Frequently Asked Questions</h2>
                </div>
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item border-0 border-bottom mb-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Is it free to post a tuition job?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Yes! Posting a tuition requirement is 100% free for students and guardians.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 border-bottom mb-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                How do you verify tutors?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                We require tutors to upload their university ID card and recent academic transcripts, which are manually reviewed by our team before their profile gets verified.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                How do I pay the tutor?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Currently, payments are handled directly between the guardian and the tutor. We do not take a cut from the tutor's monthly salary.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include '../includes/footer.php'; ?>
