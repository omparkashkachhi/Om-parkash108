<?php
include '../includes/db_connect.php';

// Handle Update Request
if (isset($_POST['update'])) {
    $id = (int) $_POST['vaccine_id'];
    $stock = (int) $_POST['stock'];
    $availability = $_POST['available'];

    $stmt = $connect->prepare("UPDATE vaccines SET stock = ?, available = ?, updated_at = NOW() WHERE id = ?");
    $stmt->bind_param("isi", $stock, $availability, $id);
    $stmt->execute();
    $stmt->close();
}

// Fetch Vaccines
$vaccineQuery = "SELECT id,name, stock, available, updated_at FROM vaccines";
$vaccineResult = $connect->query($vaccineQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vaccine Management | Admin Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8fafc;
            color: #222;
        }

        .navbar {
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            color: #2BBBAD !important;
            font-weight: 600;
        }

        .navbar .nav-link:hover {
            color: #2BBBAD !important;
            text-decoration: underline;
        }

        .hero {
            background: linear-gradient(120deg, #2BBBAD 60%, #6ea8fe 100%);
            color: #fff;
            padding: 60px 0;
            text-align: center;
            border-radius: 0 0 40px 40px;
        }

        .dashboard-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px 0;
        }

        .badge-available {
            background-color: #2BBBAD;
        }

        .badge-unavailable {
            background-color: #dc3545;
        }

        .form-inline {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg mb-4 sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Admin Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <h1 class="display-5 fw-bold">Vaccine List & Management</h1>
            <p class="fs-5">Edit stock, update availability, and track vaccines.</p>
        </div>
    </section>

    <div class="container mt-4">
        <div class="dashboard-card">
            <h4><i class="bi bi-capsule"></i> Vaccines</h4>

            <div class="form-inline">
                <input type="text" id="searchInput" class="form-control" placeholder="Search by vaccine name...">
            </div>

            <table class="table table-bordered mt-3" id="vaccineTable">
                <thead>
                    <tr>
                        <th>Vaccine Name</th>
                        <th>Stock</th>
                        <th>Availability</th>
                        <th>Last Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($vaccine = $vaccineResult->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($vaccine['name']) ?></td>
                            <td><?= (int) $vaccine['stock'] ?> doses</td>
                            <td>
                                <?php if ($vaccine['available'] == 'Available'): ?>
                                    <span class="badge badge-available">Available</span>
                                <?php else: ?>
                                    <span class="badge badge-unavailable">Unavailable</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($vaccine['updated_at']) ?></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#editModal" data-id="<?= $vaccine['id'] ?>"
                                    data-name="<?= htmlspecialchars($vaccine['name']) ?>"
                                    data-stock="<?= $vaccine['stock'] ?>" data-availability="<?= $vaccine['available'] ?>">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Vaccine</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="vaccine_id" id="modalVaccineId">
                    <div class="mb-3">
                        <label for="modalVaccineName" class="form-label">Vaccine Name</label>
                        <input type="text" class="form-control" id="modalVaccineName" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="modalStock" class="form-label">Stock</label>
                        <input type="number" class="form-control" name="stock" id="modalStock" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="modalAvailability" class="form-label">Availability</label>
                        <select class="form-select" name="availability" id="modalAvailability" required>
                            <option value="Available">Available</option>
                            <option value="Unavailable">Unavailable</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('vaccineTable').getElementsByTagName('tbody')[0];

        searchInput.addEventListener('keyup', function () {
            const filter = searchInput.value.toLowerCase();
            for (const row of table.rows) {
                const text = row.cells[0].innerText.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            }
        });

        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            document.getElementById('modalVaccineId').value = button.getAttribute('data-id');
            document.getElementById('modalVaccineName').value = button.getAttribute('data-name');
            document.getElementById('modalStock').value = button.getAttribute('data-stock');
            document.getElementById('modalAvailability').value = button.getAttribute('data-available');
        });
    </script>

</body>

</html>