<?php
/**
 * SmartTutor - 404 Error Page
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found | SmartTutor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">

<?php include '../includes/navbar.php'; ?>

<main class="flex-grow-1 d-flex align-items-center justify-content-center py-5">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <!-- Using an unDraw 404 illustration placeholder -->
                <img src="https://illustrations.popsy.co/blue/surreal-hourglass.svg" alt="404 Illustration" class="img-fluid mb-4" style="max-height: 250px;">
                <h1 class="display-1 fw-bold text-primary-custom mb-2">404</h1>
                <h2 class="fw-bold mb-3">Page Not Found</h2>
                <p class="text-muted lead mb-5">
                    Oops! The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
                </p>
                <a href="/pages/index.php" class="btn btn-brand btn-lg">
                    <i class="bi bi-house-door me-2"></i>Back to Home
                </a>
            </div>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
