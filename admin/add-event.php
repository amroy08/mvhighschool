<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include "../db.php";

$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = mysqli_real_escape_string($conn, $_POST['event_date']);
    $activity = mysqli_real_escape_string($conn, $_POST['activity']);
    $class_group = mysqli_real_escape_string($conn, $_POST['class_group']);
    $venue = mysqli_real_escape_string($conn, $_POST['venue']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $query = "INSERT INTO events (event_date, activity, class_group, venue, status) 
              VALUES ('$date', '$activity', '$class_group', '$venue', '$status')";

    if (mysqli_query($conn, $query)) {
        $success = "Event added successfully!";
    } else {
        $error = "Error adding event: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Event | Admin</title>
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
        max-width: 620px;
        margin: 40px auto;
        background: #fff;
        padding: 28px;
        border-radius: 16px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.07);
    }
    h2 {
        margin-bottom: 12px;
        color: #0f172a;
    }
    label {
        font-weight: 600;
        margin-top: 10px;
        display: block;
    }
    input, select {
        width: 100%;
        padding: 10px;
        margin-top: 4px;
        margin-bottom: 14px;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
    }
    button {
        padding: 10px 16px;
        background: #2563eb;
        color: white;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        cursor: pointer;
    }
    .success {
        background: #dcfce7;
        color: #166534;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 15px;
    }
    .error {
        background: #fee2e2;
        color: #991b1b;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 15px;
    }
    a {
        color: #2563eb;
        text-decoration: none;
        font-size: 14px;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Add New Event</h2>
    <a href="manage-events.php">← Back to Manage Events</a>

    <?php if ($success): ?>
        <div class="success"><?= $success ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">

        <label>Event Date (Example: Jan 18)</label>
        <input type="text" name="event_date" placeholder="Jan 18" required>

        <label>Activity</label>
        <input type="text" name="activity" placeholder="Science Exhibition" required>

        <label>Class / Group</label>
        <input type="text" name="class_group" placeholder="VI–X" required>

        <label>Venue</label>
        <input type="text" name="venue" placeholder="Lab Complex" required>

        <label>Status</label>
        <select name="status" required>
            <option value="Upcoming" selected>Upcoming</option>
            <option value="Completed">Completed</option>
            <option value="Open">Open</option>
        </select>

        <button type="submit">Add Event</button>
    </form>
</div>

</body>
</html>
