<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include "../db.php";

$alumni = mysqli_query($conn, "SELECT * FROM alumni ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Alumni</title>
<link rel="stylesheet" href="../styles.css">

<style>
.page-box {
    background: white;
    padding: 25px;
    border-radius: 16px;
    box-shadow: var(--shadow);
    margin-top: 40px;
}

.table img {
    width: 60px;
    height: 60px;
    border-radius: 6px;
    object-fit: cover;
}
</style>
</head>

<body>

<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<div class="container">

<div class="page-box">
    <h2>Alumni Records</h2>

    <a href="add-alumni.php" class="btn primary" style="margin-bottom:15px;">+ Add Alumni</a>

    <table class="table">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Name</th>
                <th>Passing Year</th>
                <th>Achievement</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($row = mysqli_fetch_assoc($alumni)) { ?>
            <tr>
                <td><img src="../assets/<?= $row['photo']; ?>"></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['passing_year']; ?></td>
                <td><?= $row['achievement']; ?></td>
                <td>
                    <a href="edit-alumni.php?id=<?= $row['id']; ?>" class="btn">Edit</a>
                    <a href="delete-alumni.php?id=<?= $row['id']; ?>" class="btn delete" onclick="return confirm('Delete?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>

    </table>
</div>

</div>

</body>
</html>
