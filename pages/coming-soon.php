<?php
/**
 * SmartTutor - Coming Soon Page
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon | SmartTutor</title>
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
                <img src="https://illustrations.popsy.co/blue/product-launch.svg" alt="Coming Soon Illustration" class="img-fluid mb-4" style="max-height: 250px;">
                <span class="badge bg-primary bg-opacity-10 text-primary-custom px-3 py-2 rounded-pill mb-3 fw-bold">
                    Under Construction
                </span>
                <h2 class="fw-bold mb-3">We are working on this feature!</h2>
                <p class="text-muted lead mb-5">
                    This section of the platform is currently being developed by our team. Please check back later.
                </p>
                
                <div class="d-flex justify-content-center gap-3">
                    <a href="javascript:history.back()" class="btn btn-brand-outline">
                        <i class="bi bi-arrow-left me-2"></i>Go Back
                    </a>
                    <a href="/pages/index.php" class="btn btn-brand">
                        <i class="bi bi-house-door me-2"></i>Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
