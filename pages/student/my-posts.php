<?php
require_once '../../includes/auth.php';
requireAuth('student');



$db = Database::getInstance();
$userId = $_SESSION['user_id'];
$success = '';
$error = '';

// Get student_id
$studentRow = $db->fetchOne("SELECT student_id FROM ST_STUDENT WHERE user_id = :u_id", ['u_id' => $userId]);
$studentId = $studentRow ? $studentRow['student_id'] : null;

// Handle Delete Post
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_post_id'])) {
    $deletePostId = $_POST['delete_post_id'];
    try {
        // Only delete if status is open and it belongs to this student
        $db->execute("DELETE FROM ST_TUITION_POST WHERE post_id = :pid AND student_id = :sid AND status = 'open'", 
            ['pid' => $deletePostId, 'sid' => $studentId]);
        $db->execute("COMMIT");
        $success = "Post deleted successfully.";
    } catch (Exception $e) {
        $error = "Failed to delete post. It might have pending applications or you don't have permission.";
    }
}

// Fetch posts
$posts = [];
if ($studentId) {
    $posts = $db->fetchAll("
        SELECT 
            p.post_id,
            p.class_level,
            p.monthly_salary,
            p.status,
            s.subject_name,
            l.area_name,
            l.district,
            FUNC_GET_TOTAL_APPS(p.post_id) as total_apps
        FROM ST_TUITION_POST p
        JOIN ST_SUBJECT s ON p.subject_id = s.subject_id
        JOIN ST_LOCATION l ON p.location_id = l.location_id
        WHERE p.student_id = :sid
        ORDER BY p.created_at DESC
    ", ['sid' => $studentId]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Posts | SmartTutor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="bg-light">

<div class="dashboard-wrapper">
    <?php include '../../includes/student-sidebar.php'; ?>

    <main class="dashboard-main">
        <?php include '../../includes/student-navbar.php'; ?>

        <div class="dashboard-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0">My Tuition Posts</h3>
                <a href="create-tuition.php" class="btn btn-brand btn-sm">
                    <i class="bi bi-plus me-1"></i>New Post
                </a>
            </div>
            
            <?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
            <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>

            <div class="table-custom table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Subject & Class</th>
                            <th>Location</th>
                            <th>Salary</th>
                            <th>Applications</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($posts)): ?>
                            <tr><td colspan="6" class="text-center py-4">No tuition posts found. <a href="create-tuition.php">Create one now</a>.</td></tr>
                        <?php else: ?>
                            <?php foreach ($posts as $post): ?>
                                <tr>
                                    <td>
                                        <div class="fw-bold text-secondary-custom"><?= htmlspecialchars($post['subject_name']) ?></div>
                                        <div class="small text-muted"><?= htmlspecialchars($post['class_level']) ?></div>
                                    </td>
                                    <td><?= htmlspecialchars($post['area_name'] . ', ' . $post['district']) ?></td>
                                    <td class="fw-bold"><?= htmlspecialchars($post['monthly_salary']) ?> BDT</td>
                                    <td>
                                        <span class="badge bg-primary rounded-pill px-3"><?= (int)$post['total_apps'] ?></span>
                                    </td>
                                    <td>
                                        <?php if ($post['status'] === 'open'): ?>
                                            <span class="badge-success">Open</span>
                                        <?php elseif ($post['status'] === 'assigned'): ?>
                                            <span class="badge-warning">Assigned</span>
                                        <?php else: ?>
                                            <span class="badge-neutral">Closed</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <?php if ($post['status'] === 'open'): ?>
                                            <form action="my-posts.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                                <input type="hidden" name="delete_post_id" value="<?= $post['post_id'] ?>">
                                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        <?php elseif ($post['status'] === 'assigned'): ?>
                                            <a href="#" class="btn btn-sm btn-primary-custom me-2">Tutor</a>
                                        <?php else: ?>
                                            <button class="btn btn-sm btn-outline-secondary" disabled>View</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/main.js"></script>
</body>
</html>

