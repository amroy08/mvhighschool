<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit(); }
include "../db.php";

// Pagination Logic
$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Search
$search = isset($_GET['search']) ? $_GET['search'] : "";

// Fetch Data
$query = "
    SELECT * FROM accomplishments 
    WHERE title LIKE '%$search%' OR category LIKE '%$search%'
    ORDER BY id DESC
    LIMIT $limit OFFSET $offset
";

$result = mysqli_query($conn, $query);

// Total Records
$countQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM accomplishments WHERE title LIKE '%$search%'");
$total = mysqli_fetch_assoc($countQuery)['total'];
$pages = ceil($total / $limit);
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Accomplishments</title>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<link rel="stylesheet" href="../styles.css">
</head>
<body>

<div class="container" style="margin-top:40px;">

<h2>Manage Accomplishments</h2>

<div style="display:flex; justify-content:space-between; margin-top:15px;">
    <a href="add-accomplishment.php" class="btn primary">+ Add New</a>

    <form method="GET">
        <input type="text" name="search" placeholder="Search..." value="<?= $search ?>" style="padding:8px;">
        <button class="btn">Search</button>
    </form>
</div>

<table class="table" style="margin-top:20px;">
  <thead>
    <tr>
      <th>Title</th>
      <th>Category</th>
      <th>Featured</th>
      <th>Image</th>
      <th>Actions</th>
    </tr>
  </thead>

  <tbody>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
    <tr>
      <td><?= $row['title'] ?></td>
      <td><?= $row['category'] ?></td>
      <td><?= $row['is_featured'] ? "⭐ Yes" : "—" ?></td>
      <td><img src="../<?= $row['image'] ?>" width="80" style="border-radius:6px;"></td>
      <td>
        <a href="edit-accomplishment.php?id=<?= $row['id'] ?>" class="btn">Edit</a>
        <a href="delete-accomplishment.php?id=<?= $row['id'] ?>" class="btn" style="background:#dc2626; color:white;" onclick="return confirm('Delete this?')">Delete</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<!-- PAGINATION -->
<div style="margin-top:20px;">
<?php for ($i=1; $i<=$pages; $i++): ?>
  <a href="?page=<?= $i ?>&search=<?= $search ?>" 
    style="padding:8px 12px; margin:4px; background:#e2e8f0; border-radius:6px; text-decoration:none;">
    <?= $i ?>
  </a>
<?php endfor; ?>
</div>

</div>

</body>
</html>
