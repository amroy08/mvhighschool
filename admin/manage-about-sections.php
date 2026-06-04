<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include "../db.php";

// Fetch all sections
$query = mysqli_query($conn, "SELECT * FROM about_sections ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage About Sections</title>
    <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    



<div class="container mt-40">
    <h2 class="text-center">Manage About Sections</h2>

    <table class="table">
        <thead>
        <tr>
            <th>Section</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        <?php while ($row = mysqli_fetch_assoc($query)): ?>
            <tr>
                <td><?= ucfirst(str_replace("_", " ", $row['section'])) ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['designation'] ?></td>
                <td>
                    <img src="../assets/about_sections/<?= $row['image'] ?>"
                         width="70" style="border-radius:8px;">
                </td>
                <td>
                    <a href="edit-about-section.php?id=<?= $row['id'] ?>"
                       class="btn primary"
                       style="padding:8px 14px;">Edit</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
