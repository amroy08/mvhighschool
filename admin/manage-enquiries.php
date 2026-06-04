<?php
include("../db.php");
session_start();

if(!isset($_SESSION["admin_logged_in"])) {
    header("Location: login.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM admission_enquiries ORDER BY id DESC");
?>
<!doctype html>
<html>
<head>
    <title>Manage Admission Enquiries</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

<div class="container">
    <h2>Admission Enquiries</h2>
    <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

    <table border="1" cellpadding="10" style="width:100%; border-collapse:collapse;">
        <tr>
            <th>Student</th>
            <th>Parent</th>
            <th>Class</th>
            <th>Academic Year</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date</th>
            <th></th>
        </tr>

        <?php while($row=mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row["student_name"] ?? ""); ?></td>
            <td><?php echo htmlspecialchars($row["parent_name"] ?? ""); ?></td>
            <td><?php echo htmlspecialchars($row["class"] ?? ""); ?></td>
            <td><?php echo htmlspecialchars($row["academic_year"] ?? ""); ?></td>
            <td><?php echo htmlspecialchars($row["phone"] ?? ""); ?></td>
            <td><?php echo htmlspecialchars($row["email"] ?? ""); ?></td>
            <td><?php echo nl2br(htmlspecialchars($row["message"] ?? "")); ?></td>
            <td><?php echo htmlspecialchars($row["date"] ?? ""); ?></td>
            <td>
                <a class="btn" onclick="return confirm('Delete this enquiry?');" href="delete-enquiry.php?id=<?php echo $row["id"]; ?>">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>

    </table>
</div>

</body>
</html>