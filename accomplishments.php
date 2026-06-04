<?php include "db.php"; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>School Accomplishments | M.V. High School</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/png" href="/favicon.png">
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="premium-header.css">


<style>
/* ----- PAGE HEADER ----- */
.section h2 {
  font-size: 32px;
  font-weight: 800;
  margin-bottom: 5px;
}
.lead {
  color: #64748b;
  margin-bottom: 30px;
}

/* ----- GRID ----- */
.grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 20px;
}

/* ----- CARD STYLE ----- */
.card {
  background: #ffffff;
  padding: 22px;
  border-radius: 16px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.06);
  transition: .2s;
  border-left: 4px solid var(--brand);
  cursor: pointer;
}

.card:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 16px rgba(0,0,0,0.08);
}

.card h3 {
  margin: 0;
  font-size: 20px;
  font-weight: 700;
  color: var(--brand);
}

.card p {
  margin-top: 10px;
  font-size: 15px;
  color: #475569;
  line-height: 1.5;
}

</style>
</head>
<body>

<header></header>
<script src="load-header.js"></script>

<section class="section">
  <div class="container">
    
    <h2>School Accomplishments</h2>
    <p class="lead">Celebrating our achievements in academics, sports, arts, and community service.</p>

    <div class="grid cards">
      <?php  
      $result = mysqli_query($conn, "SELECT * FROM accomplishments ORDER BY id DESC");

      while ($row = mysqli_fetch_assoc($result)) {
          echo "
          <article class='card' onclick=\"location.href='accomplishment-details.php?slug={$row['slug']}'\">
              <h3>{$row['title']}</h3>
              <p>".substr($row['description'], 0, 90)."...</p>
          </article>
          ";
      }
      ?>
    </div>

  </div>
</section>

<script src="script.js"></script>
<script src="footer.js"></script>

</body>
</html>
