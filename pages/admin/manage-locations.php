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
            $area = trim($_POST['area_name']);
            $district = trim($_POST['district']);
            if ($area && $district) {
                $db->execute("INSERT INTO ST_LOCATION (area_name, district) VALUES (:area, :dist)", [
                    'area' => $area,
                    'dist' => $district
                ]);
                $db->execute("COMMIT");
                $success = "Location added successfully.";
            } else {
                $error = "Area name and district are required.";
            }
        } elseif ($action === 'edit') {
            $locId = (int)$_POST['location_id'];
            $area = trim($_POST['area_name']);
            $district = trim($_POST['district']);
            if ($locId && $area && $district) {
                $db->execute("UPDATE ST_LOCATION SET area_name = :area, district = :dist WHERE location_id = :id", [
                    'area' => $area,
                    'dist' => $district,
                    'id' => $locId
                ]);
                $db->execute("COMMIT");
                $success = "Location updated successfully.";
            }
        } elseif ($action === 'delete') {
            $locId = (int)$_POST['location_id'];
            if ($locId) {
                $db->execute("DELETE FROM ST_LOCATION WHERE location_id = :id", ['id' => $locId]);
                $db->execute("COMMIT");
                $success = "Location deleted successfully.";
            }
        }
    } catch (Exception $e) {
        $msg = $e->getMessage();
        if (strpos($msg, 'ORA-02292') !== false) {
            $error = "Cannot delete this location because there are tuition posts associated with it.";
        } elseif (strpos($msg, 'ORA-00001') !== false) {
            $error = "This location already exists.";
        } else {
            $error = "An error occurred. Please try again.";
        }
    }
}

// Fetch all locations
$locations = $db->fetchAll("SELECT * FROM ST_LOCATION ORDER BY district, area_name");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Locations | Admin Panel</title>
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
                <h3 class="fw-bold mb-0">Manage Locations</h3>
                <button type="button" class="btn btn-brand" data-bs-toggle="modal" data-bs-target="#addLocationModal">
                    Add Location
                </button>
            </div>

            <?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
            <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>

            <div class="card card-custom p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3">District</th>
                                <th class="px-4 py-3">Area Name</th>
                                <th class="px-4 py-3 text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($locations as $loc): ?>
                                <tr>
                                    <td class="px-4 py-3 text-muted">#<?= $loc['location_id'] ?></td>
                                    <td class="px-4 py-3 fw-bold text-secondary"><?= htmlspecialchars($loc['district']) ?></td>
                                    <td class="px-4 py-3"><?= htmlspecialchars($loc['area_name']) ?></td>
                                    <td class="px-4 py-3 text-end">
                                        <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#editLocationModal<?= $loc['location_id'] ?>">
                                            Edit
                                        </button>
                                        <form action="manage-locations.php" method="POST" class="d-inline" onsubmit="return confirm('Delete this location?');">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="location_id" value="<?= $loc['location_id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Modal for this row -->
                                <div class="modal fade" id="editLocationModal<?= $loc['location_id'] ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="manage-locations.php" method="POST">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Location</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="action" value="edit">
                                                    <input type="hidden" name="location_id" value="<?= $loc['location_id'] ?>">
                                                    <div class="mb-3">
                                                        <label class="form-label">District</label>
                                                        <input type="text" name="district" class="form-control" value="<?= htmlspecialchars($loc['district']) ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Area Name</label>
                                                        <input type="text" name="area_name" class="form-control" value="<?= htmlspecialchars($loc['area_name']) ?>" required>
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

<!-- Add Location Modal -->
<div class="modal fade" id="addLocationModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="manage-locations.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" value="add">
                    <div class="mb-3">
                        <label class="form-label">District</label>
                        <input type="text" name="district" class="form-control" placeholder="e.g. Dhaka" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Area Name</label>
                        <input type="text" name="area_name" class="form-control" placeholder="e.g. Dhanmondi" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-brand">Add Location</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/main.js"></script>
</body>
</html>
