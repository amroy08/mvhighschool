<?php
include "db.php";
include "config.php";

$seoTitle    = "Monthly Activities Calendar | M.V. High School";
$seoDescription = "Monthly activity calendar for M.V. High School — clubs, competitions, workshops, special assemblies and events.";
$seoCanonical = BASE_URL . "/monthly-activities.php";

/* ---- DB — unchanged ---- */
$result = mysqli_query($conn, "SELECT * FROM events ORDER BY event_date DESC, id DESC");

$events = [];
while ($row = mysqli_fetch_assoc($result)) $events[] = $row;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?= htmlspecialchars($seoTitle) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?= htmlspecialchars($seoDescription) ?>">
  <link rel="canonical" href="<?= $seoCanonical ?>">
  <link rel="icon" type="image/png" href="/favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="styles.css?v=5">
  <link rel="stylesheet" href="main.css?v=5">
</head>
<body>

<header></header>
<script src="load-header.js?v=5" defer></script>

<!-- PAGE HERO -->
<section class="page-hero" aria-label="Monthly activities hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a>
      <span class="sep" aria-hidden="true">›</span>
      <span class="current" aria-current="page">Monthly Activities</span>
    </nav>
    <h1>Monthly Activities Calendar</h1>
    <p class="lead">Clubs, competitions, workshops and special assemblies throughout the year.</p>
  </div>
</section>

<main id="main-content">

<section class="section" style="background:var(--surface);" aria-labelledby="activities-heading">
  <div class="container">

    <div class="section-header" style="margin-bottom:18px;">
      <div class="eyebrow">School Calendar</div>
      <h2 id="activities-heading" style="color:var(--navy);">All Activities</h2>
    </div>

    <?php if(count($events) > 0): ?>

    <!-- Month filter -->
    <div style="margin-bottom:18px;display:flex;gap:8px;flex-wrap:wrap;" id="monthFilters" role="group" aria-label="Filter by month">
      <button class="tab-btn active" onclick="filterMonth('')" data-month="" type="button">All</button>
      <button class="tab-btn" onclick="filterMonth('Jan')" data-month="Jan" type="button">Jan</button>
      <button class="tab-btn" onclick="filterMonth('Feb')" data-month="Feb" type="button">Feb</button>
      <button class="tab-btn" onclick="filterMonth('Mar')" data-month="Mar" type="button">Mar</button>
      <button class="tab-btn" onclick="filterMonth('Apr')" data-month="Apr" type="button">Apr</button>
      <button class="tab-btn" onclick="filterMonth('May')" data-month="May" type="button">May</button>
      <button class="tab-btn" onclick="filterMonth('Jun')" data-month="Jun" type="button">Jun</button>
      <button class="tab-btn" onclick="filterMonth('Jul')" data-month="Jul" type="button">Jul</button>
      <button class="tab-btn" onclick="filterMonth('Aug')" data-month="Aug" type="button">Aug</button>
      <button class="tab-btn" onclick="filterMonth('Sep')" data-month="Sep" type="button">Sep</button>
      <button class="tab-btn" onclick="filterMonth('Oct')" data-month="Oct" type="button">Oct</button>
      <button class="tab-btn" onclick="filterMonth('Nov')" data-month="Nov" type="button">Nov</button>
      <button class="tab-btn" onclick="filterMonth('Dec')" data-month="Dec" type="button">Dec</button>
    </div>

    <div class="table-wrap">
      <table class="table activities-table" aria-label="Monthly activities" id="activitiesTable">
        <thead>
          <tr>
            <th scope="col">Date</th>
            <th scope="col">Activity</th>
            <th scope="col">Class / Group</th>
            <th scope="col">Venue</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($events as $row):
            $statusAttr = htmlspecialchars($row['status']);
            $dateRaw = $row['event_date'] ?? '';
            $dateDisplay = $dateRaw;
            if($dateRaw) {
              $ts = strtotime($dateRaw);
              if($ts) $dateDisplay = date('d M Y', $ts);
            }
            // Short month for data attribute (for JS filtering)
            $monthShort = $dateRaw ? date('M', strtotime($dateRaw) ?: time()) : '';
          ?>
          <tr data-month="<?= htmlspecialchars($monthShort) ?>">
            <td><?= htmlspecialchars($dateDisplay) ?></td>
            <td><?= htmlspecialchars($row['activity']) ?></td>
            <td><?= htmlspecialchars($row['class_group'] ?? '') ?></td>
            <td><?= htmlspecialchars($row['venue'] ?? '') ?></td>
            <td>
              <span class="badge" data-status="<?= $statusAttr ?>"><?= $statusAttr ?></span>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div id="noResults" class="empty-state" style="display:none;">
      <p>No activities found for the selected month.</p>
    </div>

    <?php else: ?>
    <div class="empty-state">
      <p>No activities have been scheduled yet. Please check back soon.</p>
    </div>
    <?php endif; ?>

  </div>
</section>

</main>

<script src="footer.js?v=5" defer></script>
<script>
function filterMonth(month) {
  document.querySelectorAll('#monthFilters .tab-btn').forEach(function(btn) {
    btn.classList.toggle('active', btn.dataset.month === month);
  });

  var rows = document.querySelectorAll('#activitiesTable tbody tr');
  var visible = 0;
  rows.forEach(function(row) {
    var show = !month || row.dataset.month === month;
    row.style.display = show ? '' : 'none';
    if (show) visible++;
  });

  var noResults = document.getElementById('noResults');
  if (noResults) noResults.style.display = visible === 0 ? 'block' : 'none';
}
</script>
</body>
</html>
