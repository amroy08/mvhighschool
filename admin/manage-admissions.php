<?php
include("../db.php");
session_start();

if(!isset($_SESSION["admin_logged_in"])) {
    header("Location: login.php");
    exit;
}

$query = "SELECT * FROM admissions_content ORDER BY id ASC";
$result = mysqli_query($conn, $query);
?>
<!doctype html>
<html>
<head>
    <title>Manage Admissions</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

<div class="container">
    <h2>Manage Admissions Content</h2>
    <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

    <p>Edit Eligibility, Admission Process, and Documents Required.</p>

    <table border="1" cellpadding="10" style="width:100%; border-collapse:collapse;">
        <tr>
            <th>Section</th>
            <th>Content</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo ucfirst($row['section_name']); ?></td>
            <td><?php echo substr(strip_tags($row['content']), 0, 100) . "..."; ?></td>
            <td>
                <a class="btn" href="edit-admission-section.php?id=<?php echo $row['id']; ?>">Edit</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <br><br>
    <a class="btn primary" href="manage-enquiries.php">Manage Admission Enquiries</a>
</div>

</body>
</html>
