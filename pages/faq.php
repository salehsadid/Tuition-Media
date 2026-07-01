<?php
/**
 * SmartTutor - FAQ Page
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frequently Asked Questions | SmartTutor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">

<?php include '../includes/navbar.php'; ?>

<!-- Header Section -->
<div class="bg-primary text-white py-5 text-center">
    <div class="container">
        <h1 class="display-5 fw-bold text-white mb-3">Frequently Asked Questions</h1>
        <p class="lead mb-0 text-white-50">Find answers to common questions about using SmartTutor.</p>
    </div>
</div>

<main class="container py-5 my-4 flex-grow-1">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <h4 class="fw-bold mb-4 text-primary-custom">For Students & Guardians</h4>
            <div class="accordion mb-5 shadow-sm" id="studentFaq">
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#student1">
                            Is it free to post a tuition job?
                        </button>
                    </h2>
                    <div id="student1" class="accordion-collapse collapse show" data-bs-parent="#studentFaq">
                        <div class="accordion-body text-muted">
                            Yes! Posting a tuition requirement is 100% free for students and guardians. You can post as many requirements as you need.
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#student2">
                            How do you verify your tutors?
                        </button>
                    </h2>
                    <div id="student2" class="accordion-collapse collapse" data-bs-parent="#studentFaq">
                        <div class="accordion-body text-muted">
                            Every tutor on our platform must upload their valid university ID card and academic transcripts. Our team manually reviews these documents before granting a "Verified" badge to their profile.
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#student3">
                            How do I pay the tutor?
                        </button>
                    </h2>
                    <div id="student3" class="accordion-collapse collapse" data-bs-parent="#studentFaq">
                        <div class="accordion-body text-muted">
                            Payments are negotiated and handled directly between the guardian and the tutor. SmartTutor does not take any commission from the tutor's monthly salary.
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="fw-bold mb-4 text-primary-custom">For Tutors</h4>
            <div class="accordion shadow-sm" id="tutorFaq">
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#tutor1">
                            How do I apply for tuition jobs?
                        </button>
                    </h2>
                    <div id="tutor1" class="accordion-collapse collapse" data-bs-parent="#tutorFaq">
                        <div class="accordion-body text-muted">
                            Once you register and complete your profile, you can browse available tuition posts on the job board. Simply click "Apply" on the jobs that match your expertise and location.
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#tutor2">
                            Is there any registration fee?
                        </button>
                    </h2>
                    <div id="tutor2" class="accordion-collapse collapse" data-bs-parent="#tutorFaq">
                        <div class="accordion-body text-muted">
                            Basic registration is completely free. We may introduce premium features in the future, but browsing and applying for jobs will remain accessible.
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5 p-4 bg-light rounded">
                <h5 class="fw-bold mb-2">Still have questions?</h5>
                <p class="text-muted mb-3">Can't find the answer you're looking for? Please chat to our friendly team.</p>
                <a href="/pages/contact.php" class="btn btn-brand">Get in touch</a>
            </div>

        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
