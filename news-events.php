<?php
include "db.php";
$items = mysqli_query($conn, "SELECT * FROM news_events WHERE status='Published' ORDER BY event_date DESC, id DESC");

// Common note for every circular
$common_note = "Due to unavoidable circumstances, there may be changes in the scheduled dates. Parents are kindly requested to cooperate with the school.";
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>News & Events | M.V. High School</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/png" href="/favicon.png">
  
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="premium-header.css">
</head>
<body>

<header></header>
<script src="load-header.js"></script>

<section class="section">
  <div class="container">
    <h2>News & Events</h2>
    <p class="lead">Announcements, circulars, achievements, and upcoming programs.</p>

    <div style="display:grid;gap:14px;margin-top:18px;">
      <?php if(mysqli_num_rows($items)==0): ?>
        <div class="card" style="padding:16px;border-radius:14px;background:#fff;">
          No circulars uploaded yet.
        </div>
      <?php else: ?>
        <?php while($n = mysqli_fetch_assoc($items)): ?>
          <div class="card" style="padding:16px;border-radius:14px;background:#fff;display:flex;flex-direction:column;gap:10px;">

            <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;">
              <div>
                <div style="font-weight:800;font-size:18px;">
                  <?= htmlspecialchars($n["title"]) ?>
                </div>
                <div style="opacity:.75;margin-top:4px;">
                  <?= $n["event_date"] ? date("d M Y", strtotime($n["event_date"])) : "Date not set" ?>
                </div>
              </div>

              <a href="news-details.php?id=<?= (int)$n['id'] ?>" class="btn primary" style="text-decoration:none;">
  View Details
</a>
            </div>

            <!-- ✅ Common note shown under every PDF -->
            <div style="
              background:#f5f8ff;
              border:1px solid #dbe6ff;
              padding:10px 12px;
              border-radius:12px;
              font-size:14px;
              line-height:1.4;
              color:#123;
            ">
              <strong>Note:</strong> <?= htmlspecialchars($common_note) ?>
            </div>

          </div>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>

  </div>
</section>

<script src="footer.js"></script>
</body>
</html>
