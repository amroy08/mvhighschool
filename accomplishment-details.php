<?php
include "db.php";

$slug = $_GET['slug'];
$res = mysqli_query($conn, "SELECT * FROM accomplishments WHERE slug='$slug'");
$acc = mysqli_fetch_assoc($res);

if(!$acc){ die("<h2>Accomplishment not found</h2>"); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= $acc['title'] ?> | M.V. High School</title>
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="premium-header.css">

<style>
.detail-box {
  background: #ffffff;
  padding: 30px;
  border-radius: 18px;
  box-shadow: 0 5px 18px rgba(0,0,0,0.08);
  max-width: 850px;
  margin: auto;
}

.detail-box h2 {
  margin-top: 0;
  font-size: 30px;
  font-weight: 800;
}

.detail-box p {
  font-size: 17px;
  line-height: 1.7;
  color: #334155;
}

.back-btn {
  display: inline-block;
  margin-top: 25px;
  padding: 10px 18px;
  background: var(--brand);
  color: #fff;
  border-radius: 8px;
  text-decoration: none;
  font-weight: 600;
}

.back-btn:hover {
  background: var(--brand-600);
}

@media (max-width: 768px) {

  .detail-box {
    padding: 18px;
    border-radius: 14px;
  }

  .detail-box h2 {
    font-size: 22px;
    line-height: 1.3;
  }

  .detail-box p {
    font-size: 15px;
  }

  .detail-box img {
    max-width: 100%;
    height: auto;
  }
}

</style>

</head>

<body>

<header></header>
<script src="load-header.js"></script>

<section class="section">
<div class="container">

  <div class="detail-box">
      <h2><?= $acc['title'] ?></h2>

      <?php if($acc['image'] != ""): ?>
        <img src="<?= htmlspecialchars($acc['image']) ?>" 
     style="width:100%; max-width:700px; border-radius:14px; margin-bottom:20px;">

      <?php endif; ?>

      <p><?= nl2br($acc['description']) ?></p>

      <a href="accomplishments.php" class="back-btn">← Back to Accomplishments</a>
  </div>

</div>
</section>

<script src="footer.js"></script>
</body>
</html>
