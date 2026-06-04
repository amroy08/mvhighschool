<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit();
}
include "../db.php";

// Delete
if (isset($_GET["delete"])) {
  $id = (int)$_GET["delete"];

  $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT pdf_path FROM news_events WHERE id=$id"));
  if ($row && !empty($row["pdf_path"])) {
    $file = "../" . $row["pdf_path"];
    if (file_exists($file)) unlink($file);
  }

  mysqli_query($conn, "DELETE FROM news_events WHERE id=$id");
  header("Location: manage-news.php");
  exit();
}

$data = mysqli_query($conn, "SELECT * FROM news_events ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Manage News & Events</title>
  <link rel="stylesheet" href="../styles.css">
</head>
<body>

<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<div class="section-box">
  <h2>Manage News & Events</h2>

  <a href="add-news.php" class="btn primary" style="display:inline-block;margin:10px 0;">+ Add News/Event</a>

  <div style="overflow:auto;">
    <table class="table" style="width:100%; min-width:800px;">
      <thead>
        <tr>
          <th>Title</th>
          <th>Date</th>
          <th>Status</th>
          <th>PDF</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if(mysqli_num_rows($data)==0): ?>
          <tr><td colspan="5" style="text-align:center;padding:18px;">No News/Events added yet.</td></tr>
        <?php else: ?>
          <?php while($r = mysqli_fetch_assoc($data)): ?>
            <tr>
              <td><?= htmlspecialchars($r["title"]) ?></td>
              <td><?= $r["event_date"] ? htmlspecialchars($r["event_date"]) : "-" ?></td>
              <td><?= htmlspecialchars($r["status"]) ?></td>
              <td>
                <a href="/<?= htmlspecialchars($r["pdf_path"]) ?>" target="_blank">View PDF</a>
              </td>
              <td>
                <a class="btn" href="manage-news.php?delete=<?= (int)$r["id"] ?>" onclick="return confirm('Delete this item?')">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>
