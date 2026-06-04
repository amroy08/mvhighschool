<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit();
}

include "../db.php";

$team = mysqli_query($conn, "SELECT * FROM about_leadership_team ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Leadership Team</title>
  <link rel="stylesheet" href="../styles.css">
  <style>
    .container {
      max-width: 1000px;
      margin: 40px auto;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }
    table th, table td {
      border: 1px solid #ddd;
      padding: 10px;
    }
    table th {
      background: #f0f0f0;
    }
    .btn {
      padding: 8px 14px;
      text-decoration: none;
      border-radius: 4px;
      font-size: 14px;
    }
    .btn-primary { background: #007bff; color: white; }
    .btn-danger { background: #dc3545; color: white; }
    .btn-secondary { background: #6c757d; color: white; }
    img.member-photo {
      max-width: 100px;
      border-radius: 6px;
    }
  </style>
</head>
<body>

<a href="dashboard.php" style="margin: 16px; display:inline-block;">← Back to Dashboard</a>

<div class="container">
  <h2>Leadership Team</h2>

  <a href="add-leadership.php" class="btn btn-primary">+ Add Leadership Member</a>

  <table>
    <tr>
      <th>Photo</th>
      <th>Name</th>
      <th>Designation</th>
      <th>Message</th>
      <th>Actions</th>
    </tr>

    <?php while($m = mysqli_fetch_assoc($team)) { ?>
    <tr>
      <td>
        <?php if ($m['image']) { ?>
          <img src="../assets/<?php echo $m['image']; ?>" class="member-photo">
        <?php } ?>
      </td>
      
      <td><?php echo htmlspecialchars($m['name']); ?></td>
      <td><?php echo htmlspecialchars($m['designation']); ?></td>

      <td style="max-width: 300px;">
        <?php echo nl2br(htmlspecialchars($m['message'])); ?>
      </td>

      <td>
        <a href="edit-leadership.php?id=<?php echo $m['id']; ?>" class="btn btn-secondary">Edit</a>
        <a href="delete-leadership.php?id=<?php echo $m['id']; ?>"
           class="btn btn-danger"
           onclick="return confirm('Delete this member?');">
          Delete
        </a>
      </td>
    </tr>
    <?php } ?>

  </table>

</div>

</body>
</html>
