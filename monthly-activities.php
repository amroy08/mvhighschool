<?php include "db.php"; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Monthly Activities | M.V. High School</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
 <link rel="icon" type="image/png" href="/favicon.png">
  <link rel="stylesheet" href="styles.css">
   <link rel="stylesheet" href="premium-header.css">
</head>

<body>

<header></header>
<script src="load-header.js"></script>

<section class="section">
  <div class="container">
    
    <h2>Monthly Activities Calendar</h2>
    <p class="lead">Clubs, competitions, workshops, and special assemblies.</p>

    <!-- Filters
    <div class="activity-controls">
      <input id="searchBox" type="text" placeholder="Search activities..." class="input-control">
      <select id="monthFilter" class="input-control">
        <option value="">All Months</option>
        <option value="Jan">January</option>
        <option value="Feb">February</option>
        <option value="Mar">March</option>
        <option value="Apr">April</option>
        <option value="May">May</option>
        <option value="Jun">June</option>
        <option value="Jul">July</option>
        <option value="Aug">August</option>
        <option value="Sep">September</option>
        <option value="Oct">October</option>
        <option value="Nov">November</option>
        <option value="Dec">December</option>
      </select>

      <button onclick="exportPDF()" class="btn-primary">Export PDF</button>
    </div> -->

    <!-- TABLE -->
   <div class="table-wrap">
  <table class="table activities-table">
      <thead>
        <tr>
          <th>Date</th>
          <th>Activity</th>
          <th>Class/Group</th>
          <th>Venue</th>
          <th>Status</th>
        </tr>
      </thead>

      <tbody>
      <?php
          $result = mysqli_query($conn, "SELECT * FROM events ORDER BY id DESC");

          while ($row = mysqli_fetch_assoc($result)) {

              // status badge class
              $statusAttr = $row['status']; // Completed / Upcoming / Open / Register

              echo "
              <tr>
                  <td>{$row['event_date']}</td>
                  <td>{$row['activity']}</td>
                  <td>{$row['class_group']}</td>
                  <td>{$row['venue']}</td>
                  <td><span class='badge' data-status=\"$statusAttr\">{$row['status']}</span></td>
              </tr>
              ";
          }
      ?>
      </tbody>
    </table>
    </div>

  </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="script.js"></script>
<script src="footer.js"></script>


</body>
</html>
