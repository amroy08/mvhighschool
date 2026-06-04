<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include "../db.php";

if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];

    $imgRes = mysqli_query($conn, "SELECT image FROM about_trustee WHERE id=$id");
    if ($imgRes && mysqli_num_rows($imgRes) > 0) {
        $imgRow = mysqli_fetch_assoc($imgRes);
        if (!empty($imgRow['image']) && file_exists("../assets/" . $imgRow['image'])) {
            unlink("../assets/" . $imgRow['image']);
        }
    }

    mysqli_query($conn, "DELETE FROM about_trustee WHERE id=$id");
    header("Location: manage-trustee.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM about_trustee ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Manage Trustee</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        body {
            background: #f5f7fb;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 1100px;
            margin: 40px auto;
            background: #fff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        h2 {
            margin-bottom: 18px;
            color: #0f172a;
        }
        .top-bar {
            margin-bottom: 18px;
        }
        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            color: #fff;
            font-weight: 600;
            margin-right: 8px;
        }
        .btn-add {
            background: #6b7280;
        }
        .btn-edit {
            background: #0d6efd;
            padding: 8px 14px;
        }
        .btn-delete {
            background: #dc3545;
            padding: 8px 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            vertical-align: top;
        }
        th {
            background: #f3f4f6;
            text-align: center;
        }
        td img {
            width: 130px;
            border-radius: 8px;
        }
        .back-link {
            margin: 16px;
            display: inline-block;
            text-decoration: none;
        }
        .name {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 6px;
        }
        .designation {
            color: #374151;
            font-size: 14px;
        }
        .message-text {
            line-height: 1.6;
            white-space: pre-line;
        }
        .action-wrap a {
            margin-right: 8px;
        }
    </style>
</head>
<body>

<a href="dashboard.php" class="back-link">← Back to Dashboard</a>

<div class="container">
    <h2>Trustee Section</h2>

    <div class="top-bar">
        <a href="add-trustee.php" class="btn btn-add">+ Add New Trustee</a>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 160px;">Photo</th>
                <th style="width: 220px;">Name & Designation</th>
                <th>Message</th>
                <th style="width: 150px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && mysqli_num_rows($result) > 0) { ?>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td style="text-align:center;">
                            <?php if (!empty($row['image'])) { ?>
                                <img src="../assets/<?php echo $row['image']; ?>" alt="Trustee">
                            <?php } else { ?>
                                No Image
                            <?php } ?>
                        </td>
                        <td>
                            <div class="name"><?php echo htmlspecialchars($row['name']); ?></div>
                            <div class="designation"><?php echo htmlspecialchars($row['designation']); ?></div>
                        </td>
                        <td>
                            <div class="message-text"><?php echo nl2br(htmlspecialchars($row['message'])); ?></div>
                        </td>
                        <td class="action-wrap" style="text-align:center;">
                            <a href="edit-trustee.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">Edit</a>
                            <a href="manage-trustee.php?delete=<?php echo $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this trustee record?');">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="4" style="text-align:center;">No trustee records found.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>