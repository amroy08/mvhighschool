<?php
include "db.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
  die("<h2>News not found</h2>");
}

$res = mysqli_query($conn, "SELECT * FROM news_events WHERE id=$id AND status='Published' LIMIT 1");
$news = mysqli_fetch_assoc($res);

if (!$news) {
  die("<h2>News not found</h2>");
}

$note = "Due to unavoidable circumstances, there may be changes in the scheduled dates. Parents are kindly requested to cooperate with the school.";

// Safe date display
$dateText = "Date not set";
if (!empty($news['event_date'])) {
  $ts = strtotime($news['event_date']);
  if ($ts) $dateText = date("d M Y", $ts);
}

// PDF path
$pdf = isset($news['pdf_path']) ? ltrim($news['pdf_path'], '/') : '';
$pdfUrl = '/' . str_replace('%2F','/', rawurlencode($pdf)); // encode but keep slashes
?>
<!DOCTYPE html>
<html>
<head>
  <title><?= htmlspecialchars($news['title']) ?> | News & Events</title>
  <link rel="icon" type="image/png" href="/favicon.png">
  
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="premium-header.css">

  <style>
    .detail-box{
      background:#fff;
      padding:22px;
      border-radius:16px;
      box-shadow:0 6px 18px rgba(0,0,0,0.06);
    }
    .meta{
      display:flex;
      gap:10px;
      align-items:center;
      flex-wrap:wrap;
      margin-top:6px;
      color:#475569;
      font-size:14px;
    }
    .badge{
      padding:6px 12px;
      border-radius:999px;
      font-size:12px;
      font-weight:700;
      background:#e0f2fe;
      color:#075985;
    }
    .note{
      margin-top:14px;
      background:#f5f8ff;
      border:1px solid #dbe6ff;
      padding:10px 12px;
      border-radius:12px;
      font-size:14px;
      color:#123;
      line-height:1.5;
    }
    .pdf-wrap{
      margin-top:18px;
      border-radius:14px;
      overflow:hidden;
      border:1px solid #e5e7eb;
      height:80vh;
      background:#fff;
    }
    .pdf-wrap iframe{
      width:100%;
      height:100%;
      border:0;
    }
    .actions{
      display:flex;
      gap:10px;
      flex-wrap:wrap;
      margin-top:14px;
    }
    .btn-link{
      display:inline-block;
      padding:10px 14px;
      border-radius:12px;
      background:#0b5ed7;
      color:#fff;
      text-decoration:none;
      font-weight:700;
    }
    .btn-outline{
      display:inline-block;
      padding:10px 14px;
      border-radius:12px;
      background:#fff;
      border:1px solid #cbd5e1;
      color:#0f172a;
      text-decoration:none;
      font-weight:700;
    }
  </style>
</head>

<body>
<header></header>
<script src="load-header.js"></script>

<section class="section">
  <div class="container">

    <div class="detail-box">
      <h2 style="margin:0;"><?= htmlspecialchars($news['title']) ?></h2>

      <div class="meta">
        <span>📅 <?= htmlspecialchars($dateText) ?></span>
        <span class="badge"><?= htmlspecialchars($news['status']) ?></span>
      </div>

      <div class="note">
        <strong>Note:</strong> <?= htmlspecialchars($note) ?>
      </div>

      <div class="actions">
        <a class="btn-link" href="<?= htmlspecialchars($pdfUrl) ?>" target="_blank">Open PDF</a>
        <a class="btn-outline" href="<?= htmlspecialchars($pdfUrl) ?>" download>Download PDF</a>
        <a class="btn-outline" href="news-events.php">← Back</a>
      </div>

      <div class="pdf-wrap">
        <iframe src="<?= htmlspecialchars($pdfUrl) ?>"></iframe>
      </div>
    </div>

  </div>
</section>

<script src="footer.js"></script>
</body>
</html>
