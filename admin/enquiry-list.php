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
    <title>Admission Enquiries</title>
    <link rel="stylesheet" href="../styles.css">

    <style>
    .admin-container {
        max-width: 1300px;
        margin: 40px auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        box-shadow: var(--shadow);
        border-radius: 12px;
        overflow: hidden;
    }

    th, td {
        padding: 12px;
        border-bottom: 1px solid #e5e7eb;
        vertical-align: top;
    }

    th {
        background: #f1f5f9;
        text-align: left;
    }

    .btn-danger {
        background: #dc2626;
        padding: 6px 10px;
        color: #fff;
        border-radius: 6px;
        text-decoration: none;
    }

    .email-cell {
        min-width: 220px;
        word-break: break-word;
    }

    .year-cell {
        min-width: 120px;
        white-space: nowrap;
    }
    </style>
</head>
<body>

<div class="admin-container">
    <h2>Admission Enquiries</h2>

    <a href="dashboard.php" class="back-btn">
        ← Back to Dashboard
    </a>

    <table>
        <tr>
            <th>Student</th>
            <th>Parent</th>
            <th>Class</th>
            <th>Academic Year</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Message</th>
            <th>Received On</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)): ?>

        <tr>

            <td>
                <?= htmlspecialchars($row["student_name"] ?? ""); ?>
            </td>

            <td>
                <?= htmlspecialchars($row["parent_name"] ?? ""); ?>
            </td>

            <td>
                <?= htmlspecialchars($row["class"] ?? ""); ?>
            </td>

            <td class="year-cell">
                <?= htmlspecialchars($row["academic_year"] ?? ""); ?>
            </td>

            <td>
                <?= htmlspecialchars($row["phone"] ?? ""); ?>
            </td>

            <td class="email-cell">
                <?= htmlspecialchars($row["email"] ?? ""); ?>
            </td>

            <td>
                <?= nl2br(htmlspecialchars($row["message"] ?? "")); ?>
            </td>

            <td>
                <?= htmlspecialchars($row["date"] ?? ""); ?>
            </td>

            <td>
                <a class="btn-danger"
                   onclick="return confirm('Delete this enquiry?');"
                   href="enquiry-delete.php?id=<?= $row["id"]; ?>">
                   Delete
                </a>
            </td>

        </tr>

        <?php endwhile; ?>

    </table>
</div>

</body>
</html>