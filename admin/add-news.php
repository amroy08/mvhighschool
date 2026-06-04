<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit();
}

include "../db.php";

$msg = "";

// Ensure upload folder exists
$uploadDir = __DIR__ . "/../uploads/news_pdfs/";
if (!is_dir($uploadDir)) {
  mkdir($uploadDir, 0755, true);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $title  = trim($_POST["title"] ?? "");
  $date   = $_POST["event_date"] ?? "";
  $status = $_POST["status"] ?? "Published";

  if ($title === "") {
    $msg = "Title is required.";
  } elseif (!isset($_FILES["pdf"])) {
    $msg = "PDF field missing.";
  } elseif ($_FILES["pdf"]["error"] !== UPLOAD_ERR_OK) {
    $msg = "Upload error code: " . $_FILES["pdf"]["error"];
  } else {

    $ext = strtolower(pathinfo($_FILES["pdf"]["name"], PATHINFO_EXTENSION));
    if ($ext !== "pdf") {
      $msg = "Only PDF files are allowed.";
    } else {

      $base = pathinfo($_FILES["pdf"]["name"], PATHINFO_FILENAME);
      $base = preg_replace('/[^a-zA-Z0-9\-_]/', '_', $base);
      $safeName = time() . "-" . $base . ".pdf";

      $targetPath = $uploadDir . $safeName;

      if (!move_uploaded_file($_FILES["pdf"]["tmp_name"], $targetPath)) {
        $msg = "Upload failed while moving file. Check folder permissions: uploads/news_pdfs";
      } else {

        $dbPath = "uploads/news_pdfs/" . $safeName;
        $event_date = (!empty($date)) ? $date : NULL;

        $stmt = mysqli_prepare($conn, "INSERT INTO news_events (title, event_date, pdf_path, status) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
          die("Prepare failed: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt, "ssss", $title, $event_date, $dbPath, $status);

        if (!mysqli_stmt_execute($stmt)) {
          die("Insert failed: " . mysqli_stmt_error($stmt));
        }

        header("Location: manage-news.php");
        exit();
      }
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add News/Event (PDF)</title>
  <link rel="stylesheet" href="../styles.css">
</head>
<body>

<a href="manage-news.php" class="back-btn">← Back</a>

<div class="section-box" style="max-width:720px;margin:20px auto;">
  <h2>Add News/Event (Upload PDF Circular)</h2>

  <?php if($msg): ?>
    <div style="background:#ffeaea;color:#b00020;padding:10px 12px;border-radius:10px;margin-bottom:12px;">
      <?= htmlspecialchars($msg) ?>
    </div>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data">
    <label>Title *</label>
    <input type="text" name="title" required placeholder="e.g., Unit Test Timetable Circular">

    <label>Date (optional)</label>
    <input type="date" name="event_date">

    <label>Status</label>
    <select name="status">
      <option value="Published">Published</option>
      <option value="Draft">Draft</option>
    </select>

    <label>Upload PDF *</label>
    <input type="file" name="pdf" accept="application/pdf" required>

    <button type="submit" class="btn primary" style="margin-top:12px;">Upload PDF</button>
  </form>

  <p style="margin-top:14px;opacity:.75;font-size:13px;">
    Upload folder: <b>/public_html/uploads/news_pdfs/</b>
  </p>
</div>

</body>
</html>
