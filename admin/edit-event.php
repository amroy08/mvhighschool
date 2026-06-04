<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include "../db.php";

if (!isset($_GET['id'])) {
    header("Location: manage-events.php");
    exit();
}

$id = intval($_GET['id']);

// Fetch existing event
$query = mysqli_query($conn, "SELECT * FROM events WHERE id = $id");
$event = mysqli_fetch_assoc($query);

if (!$event) {
    die("Event not found!");
}

$success = "";
$error = "";

// Update event
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = mysqli_real_escape_string($conn, $_POST['event_date']);
    $activity = mysqli_real_escape_string($conn, $_POST['activity']);
    $class_group = mysqli_real_escape_string($conn, $_POST['class_group']);
    $venue = mysqli_real_escape_string($conn, $_POST['venue']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $updateQuery = "
        UPDATE events 
        SET event_date='$date', activity='$activity', class_group='$class_group', venue='$venue', status='$status'
        WHERE id = $id
    ";

    if (mysqli_query($conn, $updateQuery)) {
        $success = "Event updated successfully!";
        // Refresh updated data
        $query = mysqli_query($conn, "SELECT * FROM events WHERE id = $id");
        $event = mysqli_fetch_assoc($query);
    } else {
        $error = "Error updating event: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Event | Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
<style>
    body { font-family: Inter, sans-serif; background: #f1f5f9; margin: 0; padding: 0; }
    .container {
        max-width: 620px; margin: 40px auto; background: #fff;
        padding: 28px; border-radius: 16px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.07);
    }
    h2 { margin-bottom: 12px; color: #0f172a; }
    label { font-weight: 600; margin-top: 10px; display: block; }
    input, select {
        width: 100%; padding: 10px; margin-top: 4px; margin-bottom: 14px;
        border: 1px solid #cbd5e1; border-radius: 10px;
    }
    button {
        padding: 10px 16px; background: #2563eb; color: white;
        font-weight: 600; border: none; border-radius: 8px; cursor: pointer;
    }
    .success { background: #dcfce7; color: #166534; padding: 10px; border-radius: 8px; margin-bottom: 15px; }
    .error { background: #fee2e2; color: #991b1b; padding: 10px; border-radius: 8px; margin-bottom: 15px; }
    a { color: #2563eb; text-decoration: none; font-size: 14px; }
</style>
</head>
<body>

<div class="container">
    <h2>Edit Event</h2>
    <a href="manage-events.php">← Back to Manage Events</a>

    <?php if ($success): ?>
        <div class="success"><?= $success ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">

        <label>Event Date</label>
        <input type="text" name="event_date" value="<?= $event['event_date'] ?>" required>

        <label>Activity</label>
        <input type="text" name="activity" value="<?= $event['activity'] ?>" required>

        <label>Class / Group</label>
        <input type="text" name="class_group" value="<?= $event['class_group'] ?>" required>

        <label>Venue</label>
        <input type="text" name="venue" value="<?= $event['venue'] ?>" required>

        <label>Status</label>
        <select name="status" required>
            <option value="Upcoming" <?= $event['status'] == "Upcoming" ? 'selected' : '' ?>>Upcoming</option>
            <option value="Completed" <?= $event['status'] == "Completed" ? 'selected' : '' ?>>Completed</option>
            <option value="Open" <?= $event['status'] == "Open" ? 'selected' : '' ?>>Open</option>
        </select>

        <button type="submit">Update Event</button>
    </form>

</div>

</body>
</html>
