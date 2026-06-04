<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit();
}

include "../db.php";

// Fetch only 1 principal (if exists)
$principalRes = mysqli_query($conn, "SELECT * FROM about_principal ORDER BY id DESC LIMIT 1");
$principal = mysqli_fetch_assoc($principalRes);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Manage Principal</title>
  <link rel="stylesheet" href="../styles.css">
  <style>
    .container {
      max-width: 900px;
      margin: 40px auto;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }
    h2 {
      margin-bottom: 16px;
    }
    .btn {
      display: inline-block;
      padding: 8px 14px;
      border-radius: 4px;
      text-decoration: none;
      font-size: 14px;
      margin-right: 8px;
    }
    .btn-primary { background: #007bff; color: #fff; }
    .btn-danger { background: #dc3545; color: #fff; }
    .btn-secondary { background: #6c757d; color: #fff; }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 16px;
    }
    table th, table td {
      border: 1px solid #ddd;
      padding: 8px;
      font-size: 14px;
      vertical-align: top;
    }
    table th {
      background: #f5f5f5;
    }
    img.principal-photo {
      max-width: 120px;
      border-radius: 6px;
    }
    .actions {
      white-space: nowrap;
    }
  </style>
</head>
<body>

<a href="dashboard.php" class="back-btn" style="margin: 16px; display:inline-block;">← Back to Dashboard</a>

<div class="container">
  <h2>Principal Section</h2>

  <?php if (!$principal) { ?>
    <p>No Principal message added yet.</p>
    <a href="add-principal.php" class="btn btn-primary">+ Add Principal Message</a>
  <?php } else { ?>
    <a href="add-principal.php" class="btn btn-secondary">+ Add New (Replace)</a>

    <table>
      <tr>
        <th>Photo</th>
        <th>Name & Designation</th>
        <th>Message</th>
        <th>Actions</th>
      </tr>
      <tr>
        <td>
          <?php if (!empty($principal['image'])) { ?>
            <img src="../assets/<?php echo htmlspecialchars($principal['image']); ?>" 
                 alt="Principal Photo" 
                 class="principal-photo">
          <?php } else { ?>
            No image
          <?php } ?>
        </td>
        <td>
          <strong><?php echo htmlspecialchars($principal['name']); ?></strong><br>
          <small><?php echo htmlspecialchars($principal['designation']); ?></small>
        </td>
        <td style="max-width: 350px;">
          <?php echo nl2br(htmlspecialchars($principal['message'])); ?>
        </td>
        <td class="actions">
          <a href="edit-principal.php?id=<?php echo $principal['id']; ?>" class="btn btn-primary">Edit</a>
          <a href="delete-principal.php?id=<?php echo $principal['id']; ?>" 
             class="btn btn-danger"
             onclick="return confirm('Are you sure you want to delete this Principal message?');">
             Delete
          </a>
        </td>
      </tr>
    </table>
  <?php } ?>

</div>
</body>
</html>
