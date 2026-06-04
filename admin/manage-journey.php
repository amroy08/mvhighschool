<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit();
}

include "../db.php";

// Fetch all journey entries ordered by year (ascending)
$journey = mysqli_query($conn, "SELECT * FROM about_journey ORDER BY year ASC");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>School Journey Timeline</title>
  <link rel="stylesheet" href="../styles.css">

  <style>
    .container {
      max-width: 1000px;
      margin: 40px auto;
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }
    h2 { margin-bottom: 15px; }
    table {
      width: 100%; border-collapse: collapse; margin-top: 15px;
    }
    table th, table td {
      border: 1px solid #ddd; padding: 10px; vertical-align: top;
    }
    table th {
      background: #f0f0f0;
    }
    .btn { padding: 8px 14px; border-radius: 4px; text-decoration: none; }
    .btn-primary { background:#007bff;color:white; }
    .btn-secondary { background:#6c757d;color:white; }
    .btn-danger { background:#dc3545;color:white; }
    img.timeline-photo { max-width:120px; border-radius:6px; }
  </style>
</head>
<body>

<a href="dashboard.php" style="margin: 16px;">← Back to Dashboard</a>

<div class="container">
  <h2>School Journey / Timeline</h2>

  <a href="add-journey.php" class="btn btn-primary">+ Add Timeline Event</a>

  <table>
    <tr>
      <th>Year</th>
      <th>Title</th>
      <th>Description</th>
      <th>Photo</th>
      <th>Actions</th>
    </tr>

    <?php while ($j = mysqli_fetch_assoc($journey)) { ?>
      <tr>
        <td><strong><?php echo htmlspecialchars($j['year']); ?></strong></td>

        <td><?php echo htmlspecialchars($j['title']); ?></td>

        <td style="max-width: 300px;"><?php echo nl2br(htmlspecialchars($j['description'])); ?></td>

        <td>
          <?php if ($j['image']) { ?>
            <img src="../assets/<?php echo $j['image']; ?>" class="timeline-photo">
          <?php } else { echo "No Image"; } ?>
        </td>

        <td>
          <a href="edit-journey.php?id=<?php echo $j['id']; ?>" class="btn btn-secondary">Edit</a>
          <a onclick="return confirm('Delete this timeline event?');"
             href="delete-journey.php?id=<?php echo $j['id']; ?>"
             class="btn btn-danger">Delete</a>
        </td>
      </tr>
    <?php } ?>

  </table>

</div>

</body>
</html>
