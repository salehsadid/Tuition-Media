<?php
require_once '../../includes/auth.php';
requireAdminAuth();

$db = Database::getInstance();
$success = '';
$error = '';

// Handle Add/Edit/Delete
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    try {
        if ($action === 'add') {
            $subject = trim($_POST['subject_name']);
            if ($subject) {
                $db->execute("INSERT INTO ST_SUBJECT (subject_name) VALUES (:sub)", ['sub' => $subject]);
                $db->execute("COMMIT");
                $success = "Subject added successfully.";
            } else {
                $error = "Subject name is required.";
            }
        } elseif ($action === 'edit') {
            $subId = (int)$_POST['subject_id'];
            $subject = trim($_POST['subject_name']);
            if ($subId && $subject) {
                $db->execute("UPDATE ST_SUBJECT SET subject_name = :sub WHERE subject_id = :id", [
                    'sub' => $subject,
                    'id' => $subId
                ]);
                $db->execute("COMMIT");
                $success = "Subject updated successfully.";
            }
        } elseif ($action === 'delete') {
            $subId = (int)$_POST['subject_id'];
            if ($subId) {
                $db->execute("DELETE FROM ST_SUBJECT WHERE subject_id = :id", ['id' => $subId]);
                $db->execute("COMMIT");
                $success = "Subject deleted successfully.";
            }
        }
    } catch (Exception $e) {
        $msg = $e->getMessage();
        if (strpos($msg, 'ORA-02292') !== false) {
            $error = "Cannot delete this subject because there are tuition posts associated with it.";
        } elseif (strpos($msg, 'ORA-00001') !== false) {
            $error = "This subject already exists.";
        } else {
            $error = "An error occurred. Please try again.";
        }
    }
}

// Fetch all subjects
$subjects = $db->fetchAll("SELECT * FROM ST_SUBJECT ORDER BY subject_name");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Subjects | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="bg-light">

<div class="dashboard-wrapper">
    <?php include '../../includes/admin-sidebar.php'; ?>

    <main class="dashboard-main">
        <?php include '../../includes/admin-navbar.php'; ?>

        <div class="dashboard-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0">Manage Subjects</h3>
                <button type="button" class="btn btn-brand" data-bs-toggle="modal" data-bs-target="#addSubjectModal">
                    Add Subject
                </button>
            </div>

            <?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
            <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>

            <div class="card card-custom p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3" style="width: 100px;">ID</th>
                                <th class="px-4 py-3">Subject Name</th>
                                <th class="px-4 py-3 text-end" style="width: 200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($subjects as $sub): ?>
                                <tr>
                                    <td class="px-4 py-3 text-muted">#<?= $sub['subject_id'] ?></td>
                                    <td class="px-4 py-3 fw-bold"><?= htmlspecialchars($sub['subject_name']) ?></td>
                                    <td class="px-4 py-3 text-end">
                                        <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#editSubjectModal<?= $sub['subject_id'] ?>">
                                            Edit
                                        </button>
                                        <form action="manage-subjects.php" method="POST" class="d-inline" onsubmit="return confirm('Delete this subject?');">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="subject_id" value="<?= $sub['subject_id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Modal for this row -->
                                <div class="modal fade" id="editSubjectModal<?= $sub['subject_id'] ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="manage-subjects.php" method="POST">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Subject</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="action" value="edit">
                                                    <input type="hidden" name="subject_id" value="<?= $sub['subject_id'] ?>">
                                                    <div class="mb-3">
                                                        <label class="form-label">Subject Name</label>
                                                        <input type="text" name="subject_name" class="form-control" value="<?= htmlspecialchars($sub['subject_name']) ?>" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Add Subject Modal -->
<div class="modal fade" id="addSubjectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="manage-subjects.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" value="add">
                    <div class="mb-3">
                        <label class="form-label">Subject Name</label>
                        <input type="text" name="subject_name" class="form-control" placeholder="e.g. Mathematics" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-brand">Add Subject</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/main.js"></script>
</body>
</html>
