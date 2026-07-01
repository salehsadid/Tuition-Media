<?php
/**
 * SmartTutor - Contact Page
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | SmartTutor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">

<?php include '../includes/navbar.php'; ?>

<!-- Header Section -->
<div class="bg-primary text-white py-5 text-center">
    <div class="container">
        <h1 class="display-5 fw-bold text-white mb-3">Get in Touch</h1>
        <p class="lead mb-0 text-white-50">We'd love to hear from you. Please fill out this form or shoot us an email.</p>
    </div>
</div>

<main class="container py-5 my-4 flex-grow-1">
    <div class="row g-5 justify-content-center">
        
        <!-- Contact Information -->
        <div class="col-lg-4">
            <div class="card card-custom p-4 h-100">
                <h4 class="fw-bold mb-4">Contact Information</h4>
                
                <div class="d-flex align-items-start mb-4">
                    <div class="feature-icon-wrapper bg-primary bg-opacity-10 text-primary-custom flex-shrink-0 me-3" style="width: 48px; height: 48px; font-size: 1.25rem;">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Our Office</h6>
                        <p class="text-muted small mb-0">Software Technology Park<br>Janata Tower, Kawran Bazar<br>Dhaka 1215, Bangladesh</p>
                    </div>
                </div>

                <div class="d-flex align-items-start mb-4">
                    <div class="feature-icon-wrapper bg-success bg-opacity-10 text-success flex-shrink-0 me-3" style="width: 48px; height: 48px; font-size: 1.25rem;">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Email Us</h6>
                        <p class="text-muted small mb-0">support@smarttutor.com<br>info@smarttutor.com</p>
                    </div>
                </div>

                <div class="d-flex align-items-start">
                    <div class="feature-icon-wrapper bg-info bg-opacity-10 text-info flex-shrink-0 me-3" style="width: 48px; height: 48px; font-size: 1.25rem;">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Call Us</h6>
                        <p class="text-muted small mb-0">+880 1712 345678<br>Mon-Fri, 9am to 6pm</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="col-lg-6">
            <div class="card card-custom p-4 p-md-5">
                <h4 class="fw-bold mb-4">Send us a message</h4>
                <form action="#" method="GET">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">First Name</label>
                            <input type="text" class="form-control form-control-lg fs-6" placeholder="Jane" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Last Name</label>
                            <input type="text" class="form-control form-control-lg fs-6" placeholder="Doe" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-medium small text-muted">Email Address</label>
                            <input type="email" class="form-control form-control-lg fs-6" placeholder="name@example.com" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-medium small text-muted">Subject</label>
                            <input type="text" class="form-control form-control-lg fs-6" placeholder="How can we help you?" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-medium small text-muted">Message</label>
                            <textarea class="form-control fs-6" rows="5" placeholder="Write your message here..." required></textarea>
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-brand w-100 btn-lg fs-6">
                                Send Message <i class="bi bi-send ms-2"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Google Map Placeholder -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 rounded-4 overflow-hidden shadow-sm">
                <!-- Using an iframe placeholder for the map -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.1287798363717!2d90.39088667615967!3d23.742803689073145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8eb81f8f3c3%3A0xc66bb6b353df0a25!2sJanata%20Tower%20Software%20Technology%20Park!5e0!3m2!1sen!2sbd!4v1700000000000!5m2!1sen!2sbd" 
                        width="100%" height="400" style="border:0; display:block;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
