<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include "../db.php";

// Fetch all events
$result = mysqli_query($conn, "SELECT * FROM events ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Events | Admin</title>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
<style>
    body {
        font-family: Inter, sans-serif;
        background: #f1f5f9;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 900px;
        margin: 40px auto;
        background: #fff;
        padding: 28px;
        border-radius: 16px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.07);
    }
    h2 {
        margin-bottom: 20px;
        color: #0f172a;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 18px;
    }
    table th, table td {
        padding: 12px 10px;
        border-bottom: 1px solid #e2e8f0;
        font-size: 14px;
        text-align: left;
    }
    table th {
        font-weight: 600;
        background: #f8fafc;
    }
    .btn {
        padding: 7px 14px;
        border: none;
        border-radius: 6px;
        font-size: 13px;
        cursor: pointer;
        font-weight: 600;
    }
    .add-btn {
        background: #2563eb;
        color: #fff;
    }
    .edit-btn {
        background: #0ea5e9;
        color: #fff;
    }
    .delete-btn {
        background: #dc2626;
        color: #fff;
    }
    .logout {
        background: #64748b;
        color: white;
        padding: 8px 14px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 14px;
    }
    .actions {
        display: flex;
        gap: 8px;
    }
</style>
</head>
<body>

<div class="container">
    <h2>
        Manage Events
        <a href="logout.php" class="logout">Logout</a>
    </h2>

    <a href="add-event.php">
        <button class="btn add-btn">+ Add New Event</button>
    </a>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Activity</th>
                <th>Class</th>
                <th>Venue</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['event_date'] ?></td>
                <td><?= $row['activity'] ?></td>
                <td><?= $row['class_group'] ?></td>
                <td><?= $row['venue'] ?></td>
                <td><?= $row['status'] ?></td>
                <td class="actions">
                    <a href="edit-event.php?id=<?= $row['id'] ?>">
                        <button class="btn edit-btn">Edit</button>
                    </a>
                    <a href="delete-event.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this event?');">
                        <button class="btn delete-btn">Delete</button>
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

</div>

</body>
</html>
