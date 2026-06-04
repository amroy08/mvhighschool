<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { 
    header("Location: login.php"); 
    exit(); 
}

include "../db.php";

// Fetch all levels
$levels = mysqli_query($conn, "SELECT * FROM academic_levels ORDER BY id ASC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Academics | Admin</title>

<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<link rel="stylesheet" href="../styles.css">

<style>
/* ================================
   ADMIN ACADEMICS – FINAL UI
   ================================ */

.section-box {
  background:#fff;
  padding:24px;
  border-radius:16px;
  box-shadow:var(--shadow);
  margin-bottom:30px;
}

/* Level header */
.level-header {
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:14px;
}

.level-header h3 {
  margin:0;
  font-size:20px;
}

/* Action buttons */
.action-group {
  display:flex;
  gap:8px;
}

/* Grade list */
.grade-list {
  margin-top:15px;
}

/* Grade card */
.grade-box {
  margin-top:18px;
  padding:16px;
  border:1px solid var(--border);
  border-radius:14px;
  background:#f9fafb;
}

/* Grade header */
.grade-header {
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:10px;
}

.grade-header h4 {
  margin:0;
  font-size:16px;
}

/* Add book button */
.add-book-btn {
  margin-bottom:10px;
}

/* Table compact */
.table {
  margin-top:8px;
}

.table th,
.table td {
  padding:10px 12px;
  font-size:14px;
}


</style>
</head>

<body>

<div class="container" style="margin-top:40px;">

<h2>Manage Academic Structure</h2>

<a href="add-level.php" class="btn primary" style="margin-bottom:20px;">
  + Add Level
</a>

<?php while ($level = mysqli_fetch_assoc($levels)): ?>

<div class="section-box">

  <!-- LEVEL HEADER -->
  <div class="level-header">
    <h3><?= $level['level_name'] ?></h3>
    <div class="action-group">
      <a href="edit-level.php?id=<?= $level['id'] ?>" class="btn">Edit</a>
      <a href="delete-level.php?id=<?= $level['id'] ?>"
         class="btn"
         style="background:#dc2626;color:white;"
         onclick="return confirm('Delete this level and all related grades & books?')">
         Delete
      </a>
    </div>
  </div>

  <a href="add-grade.php?level_id=<?= $level['id'] ?>" class="btn primary">
    + Add Grade
  </a>

  <?php
  $grades = mysqli_query(
    $conn,
    "SELECT * FROM academic_grades WHERE level_id=".$level['id']
  );
  ?>

  <div class="grade-list">

  <?php while ($grade = mysqli_fetch_assoc($grades)): ?>

    <!-- GRADE BOX -->
    <div class="grade-box">

      <div class="grade-header">
        <h4><?= $grade['grade_name'] ?></h4>
        <div class="action-group">
          <a href="edit-grade.php?id=<?= $grade['id'] ?>" class="btn">Edit</a>
          <a href="delete-grade.php?id=<?= $grade['id'] ?>"
             class="btn"
             style="background:#dc2626;color:white;"
             onclick="return confirm('Delete this grade and its books?')">
             Delete
          </a>
        </div>
      </div>

      <a href="add-book.php?grade_id=<?= $grade['id'] ?>"
         class="btn primary add-book-btn">
         + Add Book
      </a>

      <?php
      $books = mysqli_query(
        $conn,
        "SELECT * FROM academic_books WHERE grade_id=".$grade['id']
      );
      ?>

      <table class="table">
        <thead>
          <tr>
            <th>Subject</th>
            <th>Book</th>
            <th>Publisher</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>

        <?php while ($book = mysqli_fetch_assoc($books)): ?>
          <tr>
            <td><?= $book['subject'] ?></td>
            <td><?= $book['book_name'] ?></td>
            <td><?= $book['publisher'] ?></td>
            <td>
              <a href="edit-book.php?id=<?= $book['id'] ?>" class="btn">Edit</a>
              <a href="delete-book.php?id=<?= $book['id'] ?>"
                 class="btn"
                 style="background:#dc2626;color:white;"
                 onclick="return confirm('Delete this book?')">
                 Delete
              </a>
            </td>
          </tr>
        <?php endwhile; ?>

        </tbody>
      </table>

    </div>
    <!-- /GRADE BOX -->

  <?php endwhile; ?>

  </div>
</div>

<?php endwhile; ?>

</div>

</body>
</html>
